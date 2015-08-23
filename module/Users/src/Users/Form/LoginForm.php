<?php

	// filename : module/Users/src/Users/Form/LoginForm.php

	namespace Users\Form;

	use Zend\Form\Form;

	// The LoginForm class extends Zend\Form\Form; the form's configuration is added to the constructor:

	class LoginForm extends Form
	{
		public function __construct($name = null)
		{
			parent::__construct('Login');
			$this->setAttribute('method', 'post');
			$this->setAttribute('enctype','multipart/formdata');

			$this->add(array(
				'name' => 'email',
				'attributes' => array(
					'type' => 'email',
					'required' => 'required',
					'class' => 'form-control',
				),
				'options' => array(
					'label' => 'Email',
				),
				'filters' => array(
					array('name' => 'StringTrim'),
				),
				'validators' => array(
					array(
						'name' => 'EmailAddress',
						'options' => array(
							'messages' => array(
								\Zend\Validator\EmailAddress::INVALID_FORMAT => 'Email address format is invalid'
							)	
						)
					)
				)
			));

			$this->add(array(
				'name' => 'password',
				'attributes' => array(
					'class' => 'form-control',
					'type' => 'password',
				),
				'options' => array(
					'label' => 'Password',
				),
			));				

			$this->add(array(
				'name' => 'submit',
				'attributes' => array(
					'value' => 'Login',
					'type' => 'submit',
				),
			));		

		}

	}