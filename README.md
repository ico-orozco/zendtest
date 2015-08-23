# zendtest
Evaluation test in Zend Framework 2 (By Ildefonso Orozco)

Install instruction:
--------------

**1. Clone this code to your server with PHP >= 5.3 & MySQL**

    $ git clone https://github.com/ico1983/zendtest.git

**2. Create table in your Database:**

    CREATE TABLE user (
      id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
      NAME TEXT NOT NULL,
      email VARCHAR(255) NOT NULL,
      PASSWORD TEXT NOT NULL,
      PRIMARY KEY (id),
      UNIQUE INDEX idx_email(email)
    );

**3. Configure database conection:** /config/autoload/global.php  ( Ip, database name, username and pasword )

**4. Configure your virtualhost for load correctly ZF2 and point directly to zendtest/public/ folder.** Example:

    <VirtualHost *:80>
        ServerName _YOUR_IP_OR_NAMESERVER_
        DocumentRoot /var/www/zendtest/public
        SetEnv APPLICATION_ENV "development"
        <Directory /var/www/zendtest/public>
            DirectoryIndex index.php
            AllowOverride All
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>
    
**5. The first time running the application you need to register a new user before login**

All is done! :)

Details of the application:
--------------

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
