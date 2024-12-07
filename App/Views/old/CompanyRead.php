<?php
// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");
?>
<!DOCTYPE html>
<head>
    <Title><?=$p->title?></Title>
</head>
<body>
<div>
    <h1>Company List</h1>
    <p><?=$p->message?></p>
    <a href="<?=ROOT?>home">Home</a>
    <a href="<?=ROOT?>read-location">locations</a>
    <a href="<?=ROOT?>read-company">companies</a>
    <br>
    <br>
    <a href="<?=ROOT?>create-company">create new company</a>
</div>
<div>
    <br>
    <br>
    <!-- Let's read all tasks here  -->
    <?php

    // Exit if there are no locations
    if(!$p->companies) { exit();}

    // Create a counter
    $c = 1;

    // Create the table header
    echo '<table>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>NAME</th>';
    echo '<th>Edit</th>';
    echo '</tr>';

    // Create each row of data
    foreach($p->companies as $company)
    {
        echo "<tr>";
        echo "<td>$c</td>";
        echo "<td>$company->name</td>";
        echo "<td><a href=" . ROOT . "update-company/load/" . $company->id .">Edit</a></td>";
        echo "</tr>";

        // Increment the count by one
        $c = $c + 1;
    }

    // Done
    echo "</table>";

    ?>
    <!-- End For Each loop  -->
</div>
</body>
