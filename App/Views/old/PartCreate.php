<?php
// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");
?>
<!DOCTYPE html>
<head>
    <Title>Create Part</Title>
</head>
<body>
<div>
    <h1>Create a new Part</h1>
    <a href="<?=ROOT?>home"><-Back</a><br><br>
</div>
<div>
    <form action="<?=ROOT?>create-part/process" method="post">
        <label for="article_number">Article Number</label><br>
        <input type="text" name="article_number" id="article_number">
        <br>
        <label for="order_number">Order Number</label><br>
        <input type="text" name="order_number" id="order_number">
        <br>
        <label for="description">Description</label><br>
        <input type="text" name="description" id="description">
        <br>
        <label for="manufacturer_id">Manufacturer</label><br>
        <select name="manufacturer_id" id="manufacturer_id">
            <!-- For Each Here -->
            <?php
            foreach($p->manufacturers as $manufacturer)
            {
            echo "<option value ='" . $manufacturer->id . "'>" . $manufacturer->name . "</option>";
            }
            ?>
            <!-- End For Each Here -->
        </select>
        <br>
        <label for="vendor_id">Vendor</label><br>
        <select name="vendor_id" id="vendor_id">
            <!-- For Each Here -->
            <?php
            foreach($p->vendors as $vendor)
            {
                echo "<option value ='" . $vendor->id . "'>" . $vendor->name . "</option>";
            }
            ?>
            <!-- End For Each Here -->
        </select>
        <br>
        <label for="price">Price</label><br>
        <input type="number" name="price" id="price" step=".01">
        <br>
        <label for="price_date">Price Date</label><br>
        <input type="date" name="price_date" id="price_date">
        <br>
        <label for="location_id">Location</label><br>
        <select name="location_id" id="location_id">
            <!-- For Each Here -->
            <?php
            foreach($p->locations as $location)
            {
                echo "<option value ='" . $location->id . "'>" . $location->description . "</option>";
            }
            ?>
            <!-- End For Each Here -->
        </select>
        <br>
        <label for="quantity">Quantity</label><br>
        <input type="number" name="quantity" id="quantity">
        <br>
        <input type="hidden" name="is_active" id="is_active" value="1"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value" checked>
        <label for="is_active">is Active?</label>
        <br>
        <button type="submit" id="submit">Add Part</button><br>
    </form>
</div>
</body>