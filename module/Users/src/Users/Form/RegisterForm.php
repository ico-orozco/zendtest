<?php

	// filename : module/Users/src/Users/Form/RegisterForm.php

	namespace Users\Form;

	use Zend\Form\Form;

	// The RegisterForm class extends Zend\Form\Form; the form's configuration is added to the constructor:

	class RegisterForm extends Form
	{
		public function __construct($name = null)
		{
			parent::__construct('Register');
			$this->setAttribute('method', 'post');
			$this->setAttribute('enctype','multipart/formdata');

			// All fields are added to the form using the $this->add() method on the form's constructor:

			$this->add(array(
				'name' => 'name',
				'attributes' => array(
					'class' => 'form-control',
					'type' => 'text',
				),
				'options' => array(
					'label' => 'Full Name',
				),
			));			

			// Additional validators/filters can be added to the fields while declaring the fields in the form. In this case we are adding special validation for the EmailAddress field:

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

			// password, confirm_password & submit

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
				'name' => 'confirm_password',
				'attributes' => array(
					'class' => 'form-control',
					'type' => 'password',
				),
				'options' => array(
					'label' => 'Confirm Password',
				),
			));	

			$this->add(array(
				'name' => 'submit',
				'attributes' => array(
					'value' => 'Submit',
					'type' => 'submit',
				),
			));		

		}

	}