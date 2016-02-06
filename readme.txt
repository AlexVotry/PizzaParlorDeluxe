User's manual:
 Technical points:

application/config.php:
	setting base_url
	$config['base_url'] = 'http://localhost/pizzaParlorDeluxe/'; 
 	if I change the the name, I need to change this

database.php within codeigniter\application\config.
	change data base to database being used.
	currently set at:
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'votr5810',
	'dbdriver' => 'mysqli',

I Moved starting point to home.php by going to route.php and changing default from welcome to home.

User experience:

Go to localhost/pizzaParlorDeluxe

This will take you to the Home page. This page allows you to either purchase a pizza, or login to the administrator's side.
	1. To order a pizza:
		a.  Click on the red area of either "Choose one of our Specialty Pizzas!", or "Build you own masterpiece!".
		b.  A drop down menu will appear for the pizza you chose.
		c.  Click at least one item from each of the sections and click "perfect".
		d.  This will take you to the customer information page.
		e.  Provide you customer information in the spaces provided, then click "Give me my pizza".
		f.  A Summary page will appear showing your delivery information, contact information, the pizza you ordered with the price, and the time it will be delivered.
	2.  To login:
		a.  Click the word "login" in the header of the home page.
		b.  If you are already an administrator, type in your username and password.
		c.  If you are new, type in any name and type in 'Noth1ng!' for the password.
			i.   This will take you to a "new member" page.  
			ii.  You will fill out the necessary information and be assigned a 2 in administration level.
			iii.  The first user (userID = 1), will have full administration authority to edit, delete, etc.
			iv.  After entering your information, you will be back at the login page.  
			v.  Type in your new username and password.
		d.  You have three tries to get your username and password correct.
			i.  After three incorrect logon attempts, you will be directed to a page telling you to contact and administrator.
			ii.  After 10 incorrect logon attempts youy will receive a different message.
			iii.  There is a reset button provided to reset the count to zero.  I left this in for testing purposes.
			iv.  There is a "back to login" that will just go back to login page without resetting the number of attempts.
	3.  Undelivered Pizzas.
		a.  This is where a successful login will take you.
		b.  This page lists all the pizzas ordered, but not delivered for the day.
		c.  By clicking the 'deliver' hyperlink you will have changed the status of that order to delivered.
		d.  The 'deliver' hyperlink will also take you to a new page: "Delivered Pizzas for 'date' ".
		e.  Other hyperlinks on this page include:
			i.  "List of Delivered Pizzas for Today" this will take you to "Delivered Pizzas for 'date' ".
			ii.  "List All Delivered Pizzas": This will take you to a list of all the pizzas delivered regardless of date.
			iii.  "Administrators list": If your admin level is "1", or you are the first administrator, you will be taken to a list of all administrators.
						If your admin level is not "1", you will be sent to a page explaining you lack the authority.
	4.  Administrators list.
		a.  This is a list of all administrators, you get here from the hyperlink on "undelivered pizzas" page.
		b.  On this page, you can edit, delete, or add a new administrator.
		c.  Clicking the Delete button will:
			i. Trigger an alert asking if you are sure you want to delete the user.
			ii.  If you click "yes", then it will delete the user.
		d.  Clicking the Edit hyperlink will take you to an edit page.
			i.  All the info of the user to be edited will be in the provided text areas.
			ii.  Simply change any or all of the fields to update the user's information.
			iii.  Click "update" to update the user.
		e.  Click on add new user:
			i.  This will take you to a page allowing you to add a new user.
			ii.  This is the same page I used for new user to sign up.
			iii.  After submitting the new user information, you will be brought back to the Administrators List.
	5.  Log out.
		a.  On every page there is a hyperlink to logout.
		b.  This link will take you back to the login page.
		c.  You can either log back in, or click on the Home button to go to the customer side of the site.
	6.  Change password.
		a.  You must have an administrator with an Admin. level of 1 to change your password.
		b.  Go to Aministrators list and click on edit.
		c.  Replace existing password with new password.
