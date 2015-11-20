<title>Admin table</title>
  		<script type="text/javascript">
  			function show_confirm(act,gotoid) {
				if(act=="edit") {
					window.location="<?php echo base_url();?>index.php/admin/"+act+"/"+gotoid;
				}
				else {
					var reply = confirm("Do you really want to delete?");
				}
				if (reply == true) {
					window.location="<?php echo base_url();?>index.php/admin/"+act+"/"+gotoid;
				}
			}
  		</script>
</head>
<body>
<h2> Pizza Parlor Deluxe Administrators </h2>
<table id="adminTable">
	<tr>
		<th>user ID</th>
		<th>username</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>password</th>
		<th>Admin Level</th>
		<th colspan="2">Action</th>
	</tr>
		<?php foreach ($adminList as $adKey) { ?>
	<tr>
		<td><?php echo $adKey->userID; ?></td>
		<td><?php echo $adKey->username; ?></td>
		<td><?php echo $adKey->firstName; ?></td>
		<td><?php echo $adKey->lastName; ?></td>
		<td><?php echo $adKey->password; ?></td>
		<td><?php echo $adKey->adminLevel; ?></td>
  		<td width="40" align="left" ><a href="#" onClick="show_confirm('edit',<?php echo $adKey->userID; ?>)">Edit</a></td>
  		<td userID="40" align="left" ><a href="#" onClick="show_confirm('delete',<?php echo $adKey->userID; ?>)">Delete </a></td>
	</tr>
		<?php } ?>
		<tr>
  		<td colspan="8" id="insert"> <a href="<?php echo base_url();?>index.php/admin/addForm">Insert New User</a></td>
  		</tr>
</table>
</body>
</html>