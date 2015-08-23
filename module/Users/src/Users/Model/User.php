<?php

	namespace Users\Model;

	class User
	{
		public $id;
		public $name;
		public $email;
		public $password;


		// Implement a setPassword() method which will assign a MD5 version password to the UserTable entity for storage:

		public function setPassword($clear_password)
		{
			$this->password = md5($clear_password);
		}

		// Implement the exchangeArray() method; this method is used while mapping the User entity to the UserTable entity:

		function exchangeArray($data)
		{
			$this->name = (isset($data['name'])) ? $data['name'] : null;
			$this->email = (isset($data['email'])) ? $data['email'] : null;
			if (isset($data["password"]))
			{
				$this->setPassword($data["password"]);
			}
		}

	}