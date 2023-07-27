<?php if (isset($errors)): ?>
    <div class="error">
        <?php foreach ($errors as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<html>
<head>
    <title>Registration</title>
</head>
<body>
    <h1>Registration</h1>
    
    <form method="post" action="">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>
        <br>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>
        <br>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <br>
        <div>
            <label for="password_confirm">Confirm Password:</label>
            <input type="password" name="password_confirm" id="password_confirm">
        </div>
        <br>
        <div>
            <input type="submit" value="Register">
        </div>
    </form>
</body>
</html>
