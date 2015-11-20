</head>
<body>
		<form method="post" action="<?php echo base_url();?>index.php/admin/insertNewUser">
			<table width="400" border="0" cellpadding="5">
				<tr>
					<th width="213" align="right" scope="row">Enter your username</th>
					<td width="161"><input type="text" name="username" size="20" /></td>
				</tr>
				<tr>
					<th align="right" scope="row">Enter your first name</th>
					<td><input type="text" name="firstName" size="20" /></td>
				</tr>
				<tr>
					<th align="right" scope="row">Enter your last name</th>
					<td><input type="text" name="lastName" size="20" /></td>
				</tr>
				<tr>
					<th align="right" scope="row">Enter your password</th>
					<td><input type="text" name="password" ></td>
				</tr>
			<!-- 	<tr>
					<th align="right" scope="row">Re-enter your password</th>
					<td><input type="text" name="pw2"></td>
				</tr> -->
				<tr>
					<input type="hidden" name="adminLevel" value="2" />
				
					<th align="right" scope="row">&nbsp;</th>
					<td><input type="submit" name="submit" value="Send" /></td>
				</tr>
			</table>
		</form>
	</body>
</html>


