<!DOCTYPE html>
<html data-bs-theme="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>MasterBOM</title>
    <link rel="icon" type="image/svg+xml" sizes="150x150" href="<?=ROOT?>public/assets/img/la--list-alt-primary.svg">
    <link rel="icon" type="image/svg+xml" sizes="150x150" href="<?=ROOT?>public/assets/img/la--list-alt-primary.svg" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/svg+xml" sizes="150x150" href="<?=ROOT?>public/assets/img/la--list-alt-primary.svg">
    <link rel="icon" type="image/svg+xml" sizes="150x150" href="<?=ROOT?>public/assets/img/la--list-alt-primary.svg" media="(prefers-color-scheme: dark)">
    <link rel="icon" type="image/svg+xml" sizes="150x150" href="<?=ROOT?>public/assets/img/la--list-alt-primary.svg">
    <link rel="icon" type="image/svg+xml" sizes="150x150" href="<?=ROOT?>public/assets/img/la--list-alt-primary.svg">
    <link rel="icon" type="image/svg+xml" sizes="150x150" href="<?=ROOT?>public/assets/img/la--list-alt-primary.svg">
    <link rel="stylesheet" href="<?=ROOT?>public/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=ROOT?>public/assets/fonts/line-awesome.min.css">
    <link rel="stylesheet" href="<?=ROOT?>public/assets/fonts/typicons.min.css">
    <link rel="stylesheet" href="<?=ROOT?>public/assets/css/Floating-Action-Button.css">
    <link rel="stylesheet" href="<?=ROOT?>public/assets/css/Floating-Button.css">
    <link rel="stylesheet" href="<?=ROOT?>public/assets/css/Navbar-Right-Links-icons.css">
</head>

<body>
    <div class="container" id="content-container">
        <div class="row" id="content-row">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4 col-xxl-3 mx-auto" id="content-column" style="width: 353px;">
                <section id="header-section">
                    <div class="text-center" id="header-icon-div" style="margin-bottom: 20px;"><i class="la la-list-alt" style="font-size: 100px;color: var(--bs-primary);"></i></div>
                    <div class="text-center" id="header-title-div">
                        <h4>Master Bill of Materials</h4>
                    </div>
                    <div id="header-sub-title-div" style="text-align: center;">
                        <p>List of Locations</p>
                    </div>
                </section>
                <section id="list-section">
                    <!-- Let's read all tasks here  -->
                    <?php

                    // Exit if there are no locations
                    if(!$p->locations) { exit();}

                    // Create a card for each company
                    foreach($p->locations as $location) {
                        // Create the card body
                        echo '<div class="card" style="margin-bottom: 16px;">';
                        echo '<div class="card-body">';
                        echo '<h4 class="card-title">' . $location->description . '</h4>';
                        echo "<a href=" . ROOT . "read-part/where/location/" . $location->id . " class='card-link'>See all parts in location</a>";
                        echo '<br>';
                        echo "<a href=" . ROOT . "update-location/load/" . $location->id . " class='card-link'><i class='typcn typcn-edit w-100' style='text-align: center;font-size: 36px;'></i></a>";
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                    <!-- End For Each loop  -->
                </section>
                <section id="login-footer-section">
                    <div class="text-center" style="margin-bottom: 32px;">
                        <p></p><a href="<?=ROOT?>home">&lt;Back to Home</a>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>