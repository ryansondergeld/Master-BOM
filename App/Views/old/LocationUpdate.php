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
    <h1>Update Location Info</h1>
    <a href="<?=ROOT?>read-location"><-Back</a><br>
    <a href="<?=ROOT?>update-location/delete/<?php echo $p->id ?>"><-Delete</a><br>
</div>
<div>
    <form action="<?=ROOT?>update-location/process" method="post">
        <label for="description">Description</label><br>
        <!-- Insert our value into the form -->
        <input type="hidden" name="id" id="id" value="<?php echo $p->id ?>">
        <input type="text" name="description" id="description" value="<?php echo $p->description ?>"><br>
        <!-- End value insertion -->
        <button type="submit" id="submit">Save</button><br>
    </form>
</div>
<br>
<br>
</body>