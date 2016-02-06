</head>
<body>
<fieldset>
	<legend>New Employee</legend>
		<form class="aform" method="post" action="<?php echo base_url();?>index.php/admin/insertNewUser">
		       <?php echo validation_errors(); 
		       echo form_open('main/signup_validation'); 

					echo "<p>Enter your username: ";
					echo form_input('username', $this->input->post('username')); // this puts the entered username back in the spot
					echo "</p>";

					echo "<p>Enter your first name: ";
					echo form_input('firstName', $this->input->post('firstName')); // this puts the entered first name back in the spot
					echo "</p>";

					echo "<p>Enter your last name: ";
					echo form_input('lastName', $this->input->post('lastName')); // this puts the entered last name back in the spot
					echo "</p>";
//echo validation_errors(); 
					echo "<p>Password:  ";
					echo form_password('password');
					echo "</p>";

					echo "<p>Confirm Password:  ";
					echo form_password('cpassword');
					echo "</p>";
						$chk = 'onclick="chkForm($this)"';
					echo "<p>";
					echo form_submit('signup_submit', 'Sign up', '$chk');
					echo "</p>";

					echo form_hidden("adminLevel", "2");
					// 	$btn = array(
					// 		'name' => 'reset form',
					// 		'type' => 'reset',
					// 		'content' => 'Reset');
					// echo "<p>";
					// echo form_button($btn);
					// echo "</p>";
					echo "<a href='login'>back to login</a>";
					echo form_close();
?> 
			
		</form>
	</fieldset>
	</body>
</html>


