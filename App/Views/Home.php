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
    <link rel="icon" type="image/svg+xml" sizes="150x150" href="<?=ROOT?>public//img/la--list-alt-primary.svg">
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
        <div class="row align-items-center vh-100" id="content-row">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4 col-xxl-3 mx-auto" id="content-column" style="width: 353px;">
                <section id="header-section" style="margin-bottom: 24px;">
                    <div class="text-center" id="header-icon"><i class="la la-list-alt" style="font-size: 100px;color: var(--bs-primary);"></i></div>
                    <div class="text-center" id="header-title">
                        <h3>Master Bill of Materials</h3>
                    </div>
                    <div id="header-sub-title" style="text-align: center;">
                        <p>Main Menu</p>
                    </div>
                </section>
                <section id="user-info-section" style="margin-bottom: 24px;">
                    <div style="height: 68px;">
                        <div class="input-group h-100"><span class="input-group-text w-25">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor" class="w-100" style="font-size: 32px;">
                                    <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"></path>
                                </svg>
                            </span>
                            <div class="dropup w-75"><button class="btn btn-primary dropdown-toggle rounded-0 rounded-end w-100 h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button">User</button>
                                <div class="dropdown-menu w-100">
                                    <a class="dropdown-item" href="<?=ROOT?>logout">Log Out</a>
                            </div>
                            <!--
                            <span class="input-group-text w-75 justify-content-center"><?php echo $p->user['email']; ?>
                            </span>
                            -->
                        </div>
                    </div>
                </section>
                <section id="menu-cards-section" style="margin-bottom: 24px;">
                    <div id="parts-menu-div" style="margin-bottom: 24px;height: 68px;">
                        <div class="input-group w-100"><span class="input-group-text w-25" style="text-align: center;"><i class="typcn typcn-spanner w-100" style="text-align: center;font-size: 36px;"></i></span>
                            <div class="dropup w-75"><button class="btn btn-primary dropdown-toggle rounded-0 rounded-end w-100 h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button">Parts</button>
                                <div class="dropdown-menu w-100">
                                    <a class="dropdown-item" href="<?=ROOT?>create-part">Create a new Part</a>
                                    <a class="dropdown-item" href="<?=ROOT?>read-part">List of all Parts</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="companies-menu-div" style="margin-bottom: 24px;height: 68px;">
                        <div class="input-group w-100 h-100"><span class="input-group-text w-25" style="text-align: center;"><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="w-100" style="text-align: center;font-size: 36px;">
                                    <rect fill="none" height="24" width="24"></rect>
                                    <path d="M12,7V3H2v18h20V7H12z M10,19H4v-2h6V19z M10,15H4v-2h6V15z M10,11H4V9h6V11z M10,7H4V5h6V7z M20,19h-8V9h8V19z M18,11h-4v2 h4V11z M18,15h-4v2h4V15z"></path>
                                </svg></span>
                            <div class="dropup w-75"><button class="btn btn-primary dropdown-toggle rounded-0 rounded-end w-100 h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button">Companies</button>
                                <div class="dropdown-menu w-100">
                                    <a class="dropdown-item" href="<?=ROOT?>create-company">Create a new Company</a>
                                    <a class="dropdown-item" href="<?=ROOT?>read-company">List of all Companies</a>
                                    <a class="dropdown-item" href="<?=ROOT?>read-company/where/vendor">List of all Vendors</a>
                                    <a class="dropdown-item" href="<?=ROOT?>read-company/where/manufacturer">List of all Manufacturers</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="locations-menu-div">
                        <div class="input-group w-100"><span class="input-group-text w-25" style="text-align: center;"><i class="typcn typcn-location-outline w-100" style="text-align: center;font-size: 36px;"></i></span>
                            <div class="dropup w-75"><button class="btn btn-primary dropdown-toggle rounded-0 rounded-end w-100 h-100" aria-expanded="false" data-bs-toggle="dropdown" type="button">Locations</button>
                                <div class="dropdown-menu w-100">
                                    <a class="dropdown-item" href="<?=ROOT?>create-location">Create a new Location</a>
                                    <a class="dropdown-item" href="<?=ROOT?>read-location"">List of all Locations</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="<?=ROOT?>public/assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>