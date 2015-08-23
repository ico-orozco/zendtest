<?php

	// filename : module/Users/src/Users/Form/RegisterForm.php

	namespace Application\Form;

	use Zend\Form\Form;

	class MyformForm extends Form
	{
		public function __construct($name = null)
		{
			parent::__construct('Myform');
			$this->setAttribute('method', 'post');
			$this->setAttribute('enctype','multipart/formdata');

			$this->add(array(
				'name' => 'mynumber',
				'attributes' => array(
					'type' => 'text',
					'required' => 'required',
					'class' => 'form-control',
				),
				'options' => array(
					'label' => 'Number',
				),
				'filters' => array(
					array('name' => 'Int'),
				),
				'validators' => array(
					array(
						'name' => 'Between',
						'options' => array(
							'min' => 1,
                      		'max' => 1000,
						)
					)
				)
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