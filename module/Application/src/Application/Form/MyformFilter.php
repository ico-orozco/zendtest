<?php

	namespace Application\Form;

	use Zend\InputFilter\InputFilter;

	class MyformFilter extends InputFilter
	{

		public function __construct()
		{

			$this->add(array(
				'name' => 'mynumber',
				'required' => true,
				'filters' => array(
					array('name' => 'Int'),
				),
				'validators' => array(
					array(
						'name' => 'Between',
						'options' => array(
							'min' => 1,
							'max' => 100,
						),
					),
				),
			));			

		}

	}