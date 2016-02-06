</head>
<body>
	<span id="loginWarn">
	<h1>YOU SHALL NOT PASS!!</h1>
            <?php
            // Session variable to display login in warning
            if (isset($_SESSION["loginWarn"])){
                echo $_SESSION["loginWarn"];
                echo "<a href='reset'>Reset</a><br>";
                echo "<a href='login'>back to login</a>";
            }
            ?>
    </span>

</body>
</html>