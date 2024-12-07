<?php
// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");
?>
<!DOCTYPE html>
<head>
    <Title>Update Company</Title>
</head>
<body>
<div>
    <h1>Update a Company</h1>
    <a href="<?=ROOT?>read-company"><-Back</a><br>
    <a href="<?=ROOT?>update-company/delete/<?php echo $p->companies[0]->id ?>"><-Delete</a><br><br>
</div>
<div>
    <form action="<?=ROOT?>update-company/process" method="post">
        <input type="hidden" name="id" id="id" value="<?php echo $p->companies[0]->id ?>">
        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" value="<?php echo $p->companies[0]->name ?>">
        <br>
        <input type="hidden" name="is_manufacturer" id="is_manufacturer" value="<?php echo $p->companies[0]->is_manufacturer ?>"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" <?php if ($p->companies[0]->is_manufacturer) echo 'checked' ?>>
        <label for="is_manufacturer">is Manufacturer?</label>
        <br>
        <input type="hidden" name="is_vendor" id="is_vendor" value="<?php echo $p->companies[0]->is_vendor ?>"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"<?php if ($p->companies[0]->is_vendor) echo 'checked' ?>>
        <label for="is_vendor">is Vendor?</label>
        <br>
        <input type="hidden" name="is_active" id="is_active" value="<?php echo $p->companies[0]->is_active ?>"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" <?php if ($p->companies[0]->is_active) echo 'checked' ?>>
        <label for="is_active">is Active?</label>
        <br>
        <button type="submit" id="submit">Save</button><br>
    </form>
</div>
</body>