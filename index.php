<?php
//-----------------------------------------------------------------------------
//  ___         _
// |_ _|_ _  __| |_____ __
//  | || ' \/ _` / -_) \ /
// |___|_||_\__,_\___/_\_\
//
//-----------------------------------------------------------------------------
// 2024-11-21 Ryan Sondergeld
//
// The index page does two things:
//
// 1. List all CONSTANT variables.
// 2. Create an Application object.
//
// The application object will do one job and that is to determine which
// Controller object to load.
//
// For each page required in the application, a Controller should exist that
// houses all php code.  Most Controllers will also have an associated View
// page where all HTML should appear.  Any controllers that do not require a
// view will still need one listed for the constructor.  If there is no
// header redirect in the Controller it is recommended that the home view be
// used.
//
// There are only three reasons for php to appear in a View file:
//
// 1. A call at the top to prevent someone from running the view without
//    the application.
// 2. A php call to a variable like <?=VARIABLE? >. ( space not included )
// 3. A for loop to list out any data received from the database.
//
// This template additionally includes a basic user login, logout, and
// user creation templates.  These are not very robust and should be
// expanded upon if an actual application is to be used in any sort of
// production environment.
//
// This code was designed for my own personal use.  I do not take any
// responsibility for someone using it for their own projects.
//
//-----------------------------------------------------------------------------

// Define constants depending on what the server name is
const ROOT = "http://127.0.0.1/edsa-MasterBOM/";
const DBNAME = "master_bom";
const DBHOST = "localhost";
const DBUSER = 'root';
const DBPASS = '';

// Use statement for Application Class
use Classes\Application;

// Include the file
include_once("App/Classes/Application.php");

// Run the application
$app = new Application();
