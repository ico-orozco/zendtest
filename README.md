# zendtest
Evaluation test in Zend Framework 2

-- Install instruction:

1. Clone this code to your server with PHP >= 5.3 & MySQL  ( $ git clone https://github.com/ico1983/zendtest.git )
2. Configure database conection: /config/autoload/global.php
3. Configure your virtualhost for load directly zendtest/public/ folder

All is done! :)


-- Details of the application:

We would like you to develop an application which accomplishes the following:
1.	Login 
2.	Logout
3.	A screen with the following form fields:
  a.	input field - should be mandatory and accept only an integer value from 1 to 100
  b.	submit button

When the form is submitted:
1.	An array should be created which holds values from 1 to 100
2.	The value that has been entered by the user should be deleted from the array
3.	Without prior knowledge of what number was submitted by the user, a function should be written to return the missing number from the array
4.	Display the missing number to the screen
