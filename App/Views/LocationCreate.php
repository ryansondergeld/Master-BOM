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
                    <div class="text-center" id="header-icon" style="margin-bottom: 20px;"><i class="la la-list-alt" style="font-size: 100px;color: var(--bs-primary);"></i></div>
                    <div class="text-center" id="header-title">
                        <h4>Master Bill of Materials</h4>
                    </div>
                    <div id="header-sub-title" style="text-align: center;">
                        <p>Create a new Location</p>
                    </div>
                </section>
                <section id="form-section">
                    <div class="card">
                        <div class="card-body">
                            <form id="create-company-form" action="<?=ROOT?>create-location/process" method="post">
                                <div id="location-div" style="margin-bottom: 16px;">
                                    <label class="form-label">Location Name: (Required)</label>
                                    <?php if(isset($p->errors['description'])) { echo "<h6 id='email-error' style='color:var(--bs-danger);'>" . $p->errors['description'] . "</h6>";} ?>
                                    <input class="form-control" type="text" name="description" placeholder="Location Name"></div>
                                <div id="create-button-div"><button class="btn btn-primary d-block w-100" type="submit">Create</button></div>
                            </form>
                        </div>
                    </div>
                </section>
                <section id="footer-section">
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