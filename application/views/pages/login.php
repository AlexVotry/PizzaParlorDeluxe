
</head>
<body>


<div id="container">
    <h1>Login</h1>

    <!-- <form name="login" method="post" action="index.php/admin/loginValidation"> -->
       <?php echo validation_errors(); ?> 
    <!-- part of form helper. -->
    <?php echo form_open('index.php/admin/loginValidation'); ?>

        <fieldset class = "aform">
            <legend>Login: </legend>
            <p><label>User Name </label>
            <input type="text" name="username" /></p>

            <p><label>Password </label>
            <input type="password" name="password" /></p>

            <button type="submit" name="submit" class="positive">Submit</button>
            
    <?php echo form_close(); ?>
        </fieldset>
<a href="<?php echo base_url() . 'index.php/home' ?>"><button id='homeLogin' class="negative">HOME</button></a>
</div>

    <div id="body">
<?php
// used this to determine where this was coming from and how many log in attempts
// echo $_SERVER['HTTP_REFERER']."<br>"; //check for the referring page using a built-in PHP server variable
// // check how manny log in attempts were made
// if (!isset($_SESSION["logOnAttempt"])) {
//     echo "<a href='".base_url()."index.php/home'". ">HOME</a>";
// }   else {
//         echo $_SESSION["logOnAttempt"];
//     }
?>      
    </div>
</body>
</html>