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
        <div class="row align-items-center vh-100" id="content-row">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4 col-xxl-3 mx-auto" id="content-column" style="width: 353px;">
                <section id="header-section">
                    <div class="text-center" id="header-icon-div" style="margin-bottom: 20px;"><i class="la la-list-alt" style="font-size: 100px;color: var(--bs-primary);"></i></div>
                    <div class="text-center" id="header-title-div">
                        <h4>Master Bill of Materials</h4>
                    </div>
                    <div id="header-sub-title-div" style="text-align: center;">
                        <p>Update a Company</p>
                    </div>
                </section>
                <section style="margin-bottom: 16px;">
                    <div class="row">
                        <div class="col-6">
                            <div class="text-start"><a href="<?=ROOT?>home">&lt;-Back</a></div>
                        </div>
                        <div class="col-6">
                            <?php if($p->user['level'] < 2) {
                                echo '<div class="text-end"><a href="'. ROOT .'update-company/delete/' . $p->values['id'] . '" style="color: var(--bs-danger);">X Delete</a></div>';
                            } ?>
                        </div>
                    </div>
                </section>
                <section id="login-form-section">
                    <div class="card">
                        <div class="card-body">
                            <form id="create-company-form" action="<?=ROOT?>update-company/process" method="post">
                                <input type="hidden" name="id" id="id" <?php if(isset($p->values['id'])) { echo "value='" . $p->values['id'] . "'";} ?>>
                                <div id="name-div" style="margin-bottom: 16px;">
                                    <label class="form-label">Company Name (Required):</label>
                                    <?php if(isset($p->errors['name'])) { echo "<h6 id='name-error' style='color:var(--bs-danger);'>" . $p->errors['name'] . "</h6>";} ?>
                                    <input class="form-control" type="text" name="name" placeholder="Company Name" <?php if(isset($p->values['name'])) { echo "value='" . $p->values['name'] . "'";} ?>>
                                </div>
                                <div id="is-manufacturer-div" style="margin-bottom: 16px;">
                                    <div class="form-check">
                                        <input type="hidden" name="is_manufacturer" id="is_manufacturer" value="<?php if($p->checked('is_manufacturer')){ echo 1;} else{echo 0;} ?>"><input class="form-check-input" type="checkbox" id="formCheck-2" onclick="this.previousSibling.value=1-this.previousSibling.value" <?php if($p->checked('is_manufacturer')){ echo 'checked';} ?>>
                                        <label class="form-check-label" for="formCheck-2">Is a Manufacturer?</label>
                                    </div>
                                </div>
                                <div id="is-vendor-div" style="margin-bottom: 16px;">
                                    <div class="form-check">
                                        <input type="hidden" name="is_vendor" id="is_vendor" value="<?php if($p->checked('is_vendor')){ echo 1;} else{echo 0;} ?>"><input class="form-check-input" type="checkbox" id="formCheck-1" onclick="this.previousSibling.value=1-this.previousSibling.value" <?php if($p->checked('is_vendor')){ echo 'checked';} ?>>
                                        <label class="form-check-label" for="formCheck-1">Is a Vendor?</label>
                                    </div>
                                </div>
                                <div id="is_active-div" style="margin-bottom: 16px;">
                                    <div class="form-check">
                                        <input type="hidden" name="is_active" id="is_active" value="<?php if($p->checked('is_active')){ echo 1;} else{echo 0;} ?>"><input class="form-check-input" type="checkbox" id="formCheck-3" onclick="this.previousSibling.value=1-this.previousSibling.value" <?php if($p->checked('is_active')){ echo 'checked';} ?>>
                                        <label class="form-check-label" for="formCheck-3">Is Active?</label
                                        ></div>
                                </div>
                                <div id="submit-button-div">
                                    <button class="btn btn-primary d-block w-100" type="submit">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>