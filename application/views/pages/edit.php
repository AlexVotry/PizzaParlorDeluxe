</head>
<body>
		<form method="post" action="<?php echo base_url();?>index.php/admin/update">
		<?php
		extract($admin);
		?>
			<table width="400" border="0" cellpadding="5">
				<tr>
					<th width="213" align="right" scope="row">Enter your username</th>
					<td width="161"><input type="text" name="username" size="20" value="<?php echo $username; ?>"  /></td>
				</tr>
				<tr>
					<th align="right" scope="row">Enter your first name</th>
					<td><input type="text" name="firstName" size="20" value="<?php echo $firstName; ?>" /></td>
				</tr>
				<tr>
					<th align="right" scope="row">Enter your last name</th>
					<td><input type="text" name="lastName" size="20" value="<?php echo $lastName; ?>" /></td>
				</tr>
				<tr>
					<th align="right" scope="row">Enter your password</th>
					<td><input type="text" name="password" value="<?php echo $password; ?>" ></td>
				</tr>
				<tr>
					<th align="right" scope="row">New Admin. level</th>
					<td><input type="text" name="adminLevel" value="<?php echo $adminLevel; ?>" /></td>
				</tr> 
				<tr>
					<th align="right" scope="row">&nbsp;</th>
					<td><input type="hidden" name="userID" value="<?php echo $userID; ?>" />
					<input type="submit" name="submit" value="Update" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>
