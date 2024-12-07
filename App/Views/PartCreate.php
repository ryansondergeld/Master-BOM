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
    <link rel="stylesheet" href="<?=ROOT?>public/assets/css/Floating-Action-Button.css">
    <link rel="stylesheet" href="<?=ROOT?>public/assets/css/Floating-Button.css">
    <link rel="stylesheet" href="<?=ROOT?>public/assets/css/Navbar-Right-Links-icons.css">
</head>

<body>
    <div class="container" id="content-container">
        <div class="row" id="content-row" >
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4 col-xxl-3 mx-auto" id="content-column" style="width: 353px;">
                <section id="login-header-section">
                    <div class="text-center" id="login-icon-div" style="margin-bottom: 20px;"><i class="la la-list-alt" style="font-size: 100px;color: var(--bs-primary);"></i></div>
                    <div class="text-center" id="login-title-div">
                        <h4>Master Bill of Materials</h4>
                    </div>
                    <div style="text-align: center;">
                        <p>Create a new Part</p>
                    </div>
                    <div></div>
                </section>
                <section id="login-form-section">
                    <div class="card">
                        <div class="card-body">
                            <form id="user-login-form" action="<?=ROOT?>create-part/process" method="post">
                                <div id="article-number-div" style="margin-bottom: 16px;">
                                    <label class="form-label">Article Number (Required)</label>
                                    <?php if(isset($p->errors['article_number'])) { echo "<h6 id='name-error' style='color:var(--bs-danger);'>" . $p->errors['article_number'] . "</h6>";} ?>
                                    <input class="form-control" type="text" name="article_number" placeholder="Article Number">
                                </div>
                                <div id="order-number-div" style="margin-bottom: 16px;">
                                    <label class="form-label">Order Number:</label>
                                    <input class="form-control" type="text" name="order_number" placeholder="Order Number" <?php if(isset($p->values['order_number'])) { echo "value='" . $p->values['order_number'] . "'";} ?>>
                                </div>
                                <div id="description-div" style="margin-bottom: 16px;"><label class="form-label">Description:</label>
                                    <textarea class="form-control" name="description" placeholder="Enter Description"><?php if(isset($p->values['description'])) { echo $p->values['description']; } ?></textarea>
                                </div>
                                <div id="manufacturer-div" style="margin-bottom: 16px;">
                                    <label class="form-label">Manufacturer:</label>
                                    <select class="form-select" name="manufacturer_id">
                                        <!-- For Each Here -->
                                        <?php
                                        foreach($p->manufacturers as $manufacturer)
                                        {
                                            if($manufacturer->id == $p->values['manufacturer_id'])
                                            {
                                                echo "<option value ='" . $manufacturer->id . "' selected>" . $manufacturer->name . "</option>";
                                            }
                                            else
                                            {
                                                echo "<option value ='" . $manufacturer->id . "'>" . $manufacturer->name . "</option>";
                                            }
                                        }

                                        ?>
                                        <!-- End For Each Here -->
                                    </select>
                                </div>
                                <div id="vendor-div" style="margin-bottom: 16px;">
                                    <label class="form-label">Vendor:</label>
                                    <select class="form-select" name="vendor_id">
                                        <!-- For Each Here -->
                                        <?php
                                        foreach($p->vendors as $vendor)
                                        {
                                            if($vendor->id == $p->values['vendor_id'])
                                            {
                                                echo "<option value ='" . $vendor->id . "' selected>" . $vendor->name . "</option>";
                                            }
                                            else
                                            {
                                                echo "<option value ='" . $vendor->id . "'>" . $vendor->name . "</option>";
                                            }
                                        }
                                        ?>
                                        <!-- End For Each Here -->
                                    </select>
                                </div>
                                <div id="price-div" style="margin-bottom: 16px;">
                                    <label class="form-label">Price:</label>
                                    <input class="form-control" type="number" name="price" placeholder="Price" step=".01" <?php if(isset($p->values['price'])) { echo "value='" . $p->values['price'] . "'";} ?>>
                                </div>
                                <div id="price-date-div" style="margin-bottom: 16px;">
                                    <label class="form-label">Price Date:</label>
                                    <input class="form-control" type="date" name="price_date" <?php if(isset($p->values['price_date'])) { echo "value='" . $p->values['price_date'] . "'";} ?>>
                                </div>
                                <div id="location-div" style="margin-bottom: 16px;">
                                    <label class="form-label">Location:</label>
                                    <select class="form-select" name="location_id">
                                        <!-- For Each Here -->
                                        <?php
                                        foreach($p->locations as $location)
                                        {
                                            if($location->id == $p->values['location_id'])
                                            {
                                                echo "<option value ='" . $location->id . "' selected>" . $location->description . "</option>";
                                            }
                                            else
                                            {
                                                echo "<option value ='" . $location->id . "'>" . $location->description . "</option>";
                                            }
                                        }
                                        ?>
                                        <!-- End For Each Here -->
                                    </select>
                                </div>
                                <div id="quantity-div" style="margin-bottom: 16px;">
                                    <label class="form-label">Quantity:</label>
                                    <input class="form-control" type="number" name="quantity" <?php if(isset($p->values['quantity'])) { echo "value='" . $p->values['quantity'] . "'";} ?>>
                                </div>
                                <div id="is_active-div" style="margin-bottom: 16px;text-align: left;">
                                    <div class="form-check">
                                        <input type="hidden" name="is_active" id="is_active" value="<?php if($p->checked('is_active')){ echo 1;} else{echo 0;} ?>"><input class="form-check-input" type="checkbox" id="formCheck-3" onclick="this.previousSibling.value=1-this.previousSibling.value" <?php if($p->checked('is_active')){ echo 'checked';} ?>><label class="form-check-label" for="formCheck-3" >Is Active?</label></div>
                                </div>
                                <div id="submit-button-div"><button class="btn btn-primary d-block w-100" type="submit">Create</button></div>
                            </form>
                        </div>
                    </div>
                </section>
                <section id="login-footer-section">
                    <div class="text-center" style="margin-bottom: 32px;">
                        <p></p><a href="<?=ROOT?>home">&lt;Back</a>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>