<?php

	namespace Users\Controller;

	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;
	use Users\Form\LoginForm;
	use Users\Form\LoginFilter;

	// User Authentication
	use Zend\Authentication\AuthenticationService;
	use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;


	class LoginController extends AbstractActionController
	{

		protected $authservice;

		public function indexAction()
		{
			$form = new LoginForm();
			$viewModel = new ViewModel(array('form' => $form));
			return $viewModel;
		}
		public function confirmAction()
		{
			//$viewModel = new ViewModel();
			//return $viewModel;

			$user_email = $this->getAuthService()->getStorage()->read();
			$viewModel = new ViewModel(array(
				'user_email' => $user_email
			));
			return $viewModel;

		}

		public function processAction()
		{
			if (!$this->request->isPost()) {
				return $this->redirect()->toRoute(NULL, array( 
					'controller' => 'login',
					'action' => 'index'
				));
			}

			$post = $this->request->getPost();
			$form = new LoginForm();
			$inputFilter = new LoginFilter();
			$form->setInputFilter($inputFilter);
			$form->setData($post);

			if (!$form->isValid()) {
				$model = new ViewModel(array(
					'error' => true,
					'form' => $form,
				));
				$model->setTemplate('users/login/index');
				return $model;
			}

			/*
			return $this->redirect()->toRoute(NULL , array(
				'controller' => 'login',
				'action' => 'confirm'
			));
			*/

			$this->getAuthService()->getAdapter()->setIdentity($this->request->getPost('email'))->setCredential($this->request->getPost('password'));

			$result = $this->getAuthService()->authenticate();

			if ($result->isValid()) {
				$this->getAuthService()->getStorage()->write($this->request->getPost('email'));
				// correct login -> we send user to home

				/*
				return $this->redirect()->toRoute('Application' , array(
					'controller' => 'index',
					'action' => 'index'
				));
				*/
				return $this->redirect()->toUrl('/');
				
			} else {

				// incorrect login...
				$model = new ViewModel(array(
					'error' => true,
					'form' => $form,
				));
				$model->setTemplate('users/login/index');
				return $model;				


			}


		}

		
		public function logoutAction()
		{
			$auth = new AuthenticationService();
			// or prepare in the globa.config.php and get it from there
			// $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
			
			if ($auth->hasIdentity()) {
				$identity = $auth->getIdentity();
			}			
			
			$auth->clearIdentity();
	//		$auth->getStorage()->session->getManager()->forgetMe(); // no way to get the sessionmanager from storage
			$sessionManager = new \Zend\Session\SessionManager();
			$sessionManager->forgetMe();
			
			return $this->redirect()->toRoute(NULL , array(
				'controller' => 'login',
				'action' => 'index'
			));

		}	
		


		public function getAuthService()
		{

			if (!$this->authservice) {
				$dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
				$dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter, 'user', 'email', 'password', 'MD5(?)');
				$authService = new AuthenticationService();
				$authService->setAdapter($dbTableAuthAdapter);
				$this->authservice = $authService;
			}

			return $this->authservice;

		}


	} // end LoginController class