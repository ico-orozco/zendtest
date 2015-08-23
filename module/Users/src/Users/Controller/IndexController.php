<?php

	namespace Users\Controller;

	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;

	use Zend\Authentication\AuthenticationService;

	class IndexController extends AbstractActionController
	{

		protected $authservice;

		public function indexAction()
		{
			
			$user_email = $this->getAuthService()->getStorage()->read();
			$viewModel = new ViewModel(array(
				'user_email' => $user_email
			));
			return $viewModel;

			//$view = new ViewModel();
			//return $view;
		}

		public function registerAction()
		{
			$view = new ViewModel();
			$view->setTemplate('users/index/new-user');
			return $view;
		}

		public function loginAction()
		{
			$view = new ViewModel();
			$view->setTemplate('users/index/login');
			return $view;
		}

		public function getAuthService()
		{

			if (!$this->authservice) {
				$authService = new AuthenticationService();
				$this->authservice = $authService;
			}

			return $this->authservice;
		}

	}			