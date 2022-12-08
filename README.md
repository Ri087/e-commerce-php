<h1>E-COMMERCE</h1>
	The main objective of this project is to create website that recreate a real e-commerce site <i>(without the legal, the payment and real data part)</i>.

<h2>Summary</h2>

  1. How to install & run te project
	
  2. How to use
	
  3. Credits
	
  4. Contact
	
<h2>1. How to install & run the project</h2>

  Firstly, you'll need to install git, composer <i>(composer is a tool for dependency management in PHP)</i>, nodejs and Wamp.
    
  Afterwards, you have to clone the project (https://github.com/B2-INFO-22-23/e-commerce-php-les-bests-benjou-et-jeremoux.git) in the www folder of Wamp and open the project
    
  Now that the project is cloned and opened, make sure to open a terminal and run the commands:
	
	composer install
  	composer dump-autoload
  	composer update
	npm install -D tailwind
    
  Fourthly, import the e_commerce.sql file into Wamp
  
  Fifthly, create a file in the path <b>src/inc/</b> named <b>config.php</b>
	
  To finish, just put this code inside the file:
	
	<?php
	define("DB_HOST", "localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
	define("DB_DATABASE_NAME", "e_commerce");
	?>
	
Good job ! You are now able to use the website.
<h2>2. How to use</h2>

The website is now running and opetational. You can access by clicking on the link : http://localhost/e-commerce-php-les-bests-benjou-et-jeremoux/

If you wanna access the admins pages, you need to update the permission of one member. Go here : http://localhost/phpmyadmin/index.php?route=/database/sql&db=e_commerce and write:

	UPDATE T_User SET User_Permission = 1 WHERE User_ID = ID;
	(replace ID by your user ID)
	
Now, log onto your user and go here :  http://localhost/e-commerce-php-les-bests-benjou-et-jeremoux/admin 

You can now do your admin job.

<h2>3. Credits</h2>

Thanks to Benjamin (aka CezGain) et Jeremy (aka El_jeRem) for this unbelievable website.
	
If you wanna ask question about the project and how did they manage to achieve it in 10 days, feel free to ask them by sending a mail or a message on discord.
	
<h2>4. Contact</h2>
	Benjamin:
	
- Mail: benjamin.vernet@ynov.com

- Discord: CezGain#0860 (can be outdated)

Jeremy:

- Mail: jeremy.dura@ynov.com

- Discord: watugonadu#4999 (can be outdated)
