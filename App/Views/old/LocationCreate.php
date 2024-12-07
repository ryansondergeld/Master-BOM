<?php
// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");
?>
<!DOCTYPE html>
<head>
    <Title>Create Task</Title>
</head>
<body>
<div>
    <h1>Create a new location</h1>
    <a href="<?=ROOT?>read-location"><-Back</a><br><br>
</div>
<div>
    <form action="<?=ROOT?>create-location/process" method="post">
        <label for="description">Description</label><br>
        <input type="text" name="description" id="description"><br>
        <button type="submit" id="submit">Add Location</button><br>
    </form>
</div>
</body>