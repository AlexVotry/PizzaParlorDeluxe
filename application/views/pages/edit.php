</head>
<body>
	<h1>Edit Administrator's information</h1>
		<form method="post" action="<?php echo base_url();?>index.php/admin/update">
		<?php
		extract($admin); // this comes from $data['admin'] from edit()
		?>
			<table cellpadding="5">
				<tr>
					<th width="213" align="right" scope="row">Enter username</th>
					<td width="161"><input type="text" name="username" size="20" value="<?php echo $username; ?>"  /></td>
				</tr>
				<tr>
					<th align="right" scope="row">Enter first name</th>
					<td><input type="text" name="firstName" size="20" value="<?php echo $firstName; ?>" /></td>
				</tr>
				<tr>
					<th align="right" scope="row">Enter last name</th>
					<td><input type="text" name="lastName" size="20" value="<?php echo $lastName; ?>" /></td>
				</tr>
				<tr>
					<th align="right" scope="row">Enter new password</th>
					<td><input type="text" name="password" ></td>
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
