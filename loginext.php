<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>
    <div id="frm">
        <form action="process.php" method="post">
            <p>
                <label>Username:</label>
                <input type="email" id="user" name="email" />
            </p>
            <p>
                <label>Password :  </label>
                <input type="password" id="pass" name="pass" />
            </p>
            <p>
                <input type="submit" id="btn" value="Login" />

            </p>
        </form>
    </div>
</body>
</html>
