<?php

// Namespace Statement
namespace Controllers;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Controller;
use Classes\Session;
use Models\User;

// Include files
include_once("App/Classes/Controller.php");
include_once("App/Classes/Session.php");
include_once("App/Models/User.php");

class Logout extends Controller
{

    public $email = "";
    public $password = "";
    //-------------------------------------------------------------------------
    public function index($parameters)
    {
        // Create a session
        $session = new Session();

        // Log out
        $session->log_out();

        // Redirect to home page
        header("Location: " . ROOT . "home");

        // Make sure no more of the script executes after redirect
        die;
    }
    //-------------------------------------------------------------------------
}