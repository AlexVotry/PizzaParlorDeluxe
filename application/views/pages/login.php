
</head>
<body>

<div id="container">
    <h1>Login</h1>

    <!-- <form name="login" method="post" action="index.php/main/login_validation"> -->
   
    <!-- part of form helper. -->
    <?php echo form_open('index.php/admin/login_validation'); ?>
     <?php echo validation_errors(); ?> 
        <fieldset>
            <legend>Login: </legend>
            <label>User Name: </label>
            <input type="text" name="username" /><br>

            <label>Password</label>
            <input type="password" name="password" /><br>

            <input type="submit" name="submit" value="submit">

        </fieldset>
    </form> 
</div>
    <div id="body">

    </div>

    <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>