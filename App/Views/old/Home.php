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
    <h1>Home Page</h1>
    <p><?=$p->message?></p>
    <a href="<?=ROOT?>logout">Log out</a><br><br>
    <a href="<?=ROOT?>home">Home</a>
    <a href="<?=ROOT?>read-location">locations</a>
    <a href="<?=ROOT?>read-company">companies</a>
    <a href="<?=ROOT?>create-part">create a part</a>
</div>
<div>
    <br>
    <br>
    <!-- Let's read all tasks here  -->
    <?php

    // Exit if there are no locations
    if(!$p->parts) { exit();}

    // Create a counter
    $c = 1;

    // Create the table header
    echo '<table>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>PART#</th>';
    echo '<th>DESCRIPTION</th>';
    //echo '<th>MANUFACTURER</th>';
    echo '</tr>';

    // Create each row of data
    foreach($p->parts as $part)
    {
        echo "<tr>";
        echo "<td>$c</td>";
        echo "<td>$part->article_number</td>";
        echo "<td>$part->description</td>";
        echo "<td><a href=" . ROOT . "update-part/load/" . $part->id .">Edit</a></td>";
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
