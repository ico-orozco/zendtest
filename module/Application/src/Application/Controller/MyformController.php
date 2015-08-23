<?php

	namespace Application\Controller;

	use Zend\Mvc\Controller\AbstractActionController;
	use Zend\View\Model\ViewModel;
	use Application\Form\MyformForm;
	use Application\Form\MyformFilter;

	// User Authentication
	use Zend\Authentication\AuthenticationService;

	class MyformController extends AbstractActionController
	{

		public function __construct()
		{

			// Check authentication
			$auth = new AuthenticationService();
			if (!$auth->hasIdentity()) {
				die('Access denied');
			} 
			
		}		

		public function indexAction()
		{
			$form = new MyformForm();
			$viewModel = new ViewModel(array('form' => $form));
			return $viewModel;
		}

		public function confirmAction()
		{
			$viewModel = new ViewModel();
			return $viewModel;
		}

		public function processAction()
		{

			if (!$this->request->isPost()) {
				return $this->redirect()->toRoute(NULL, array( 
					'controller' => 'myform',
					'action' => 'index'
				));
			}

			$post = $this->request->getPost();
			$form = new MyformForm();
			$inputFilter = new MyformFilter();
			$form->setInputFilter($inputFilter);
			$form->setData($post);

			// Validate form...

			if (!$form->isValid()) {
				$model = new ViewModel(array(
					'error' => true,
					'form' => $form,
				));
				$model->setTemplate('application/myform/index');
				return $model;
			}

			// Create array:
			$myarray = array();
			for($i=1;$i<=100;$i++) {
				$myarray[] = $i;
			}

			// Delete the value entered by the user from the array:
			$key = array_search($post['mynumber'], $myarray); // $clave = 2;
			unset($myarray[$key]);

			// Find the missing number (Without prior knowledge!)
			$missingnumber = $this->findNumber($myarray, 1, 100); //params: array, start, max

			// Load view passing the neccessary data:
			$viewModel = new ViewModel(array('missingnumber' => $missingnumber, 'myarray' => $myarray));

			return $viewModel;

		}


		// This recursive function find a missing number in array with the interval $check and $max 		
		protected function findNumber(array $data, $check, $max = NULL)
		{

			if($check > $max) {
				return "Missing number not found";
			}

			if (in_array($check, $data)) {
				//die("he encontrado $check en el array... posición x");
				return $this->findNumber($data, $check+1, $max);
			} else {
				//die("check is -- ".$check." --");
				return $check;
			}

		}

	} // end RegisterController class