<?php
// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");
?>
<!DOCTYPE html>
<head>
    <Title>Create Company</Title>
</head>
<body>
<div>
    <h1>Create a new Company</h1>
    <a href="<?=ROOT?>read-company"><-Back</a><br><br>
</div>
<div>
    <form action="<?=ROOT?>create-company/process" method="post">
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name">
        <br>
        <input type="hidden" name="is_manufacturer" id="is_manufacturer" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
        <label for="is_manufacturer">is Manufacturer?</label>
        <br>
        <input type="hidden" name="is_vendor" id="is_vendor" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
        <label for="is_vendor">is Vendor?</label>
        <br>
        <input type="hidden" name="is_active" id="is_active" value="1"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" checked>
        <label for="is_active">is Active?</label>
        <br>
        <button type="submit" id="submit">Add Company</button><br>
    </form>
</div>
</body>