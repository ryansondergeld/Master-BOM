<?php
// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");
?>
<!DOCTYPE html>
<head>
    <Title>Log into Account</Title>
</head>
<body>
<div>
    <h1>Log in to continue</h1>
    <h4>super secret application</h4>
</div>
<div>
    <form action="<?=ROOT?>login/process" method="post">
        <label for="email">Email:</label><br>
        <input type="text" name="email" id="hello"><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password"><br><br>
        <button type="submit" id="submit">Sign In</button><br>
    </form>
</div>
<div>
    <p>No account? Create one <a href="<?=ROOT?>create-account">Here</a></p>
</div>
</body>
