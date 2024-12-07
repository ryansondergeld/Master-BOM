<?php
// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");
?>
<!DOCTYPE html>
<head>
    <Title>Create Account</Title>
</head>
<body>
<div>
    <h1>Create a new account</h1>
</div>
<div>
    <form action="<?=ROOT?>create-account/process" method="post">
        <label for="email">Email:</label><br>
        <input type="text" name="email" id="hello"><br>
        <label for="password">Password:</label><br>
        <input type="text" name="password" id="password"><br>
        <label for="first_name">First Name:</label><br>
        <input type="text" name="first_name" id="first_name"><br>
        <label for="last_name">Last Name:</label><br>
        <input type="text" name="last_name" id="last_name"><br><br>
        <button type="submit" id="submit">Create Account</button><br>
    </form>
</div>
<div>
    <br>
    <br>
    <a href="<?=ROOT?>login">Back to Login Page</a><br><br>
</div>
</body>
