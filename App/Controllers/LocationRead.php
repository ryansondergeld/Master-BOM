<?php

// Namespace Statement
namespace Controllers;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Controller;
use Classes\Request;
use Classes\Session;
use Models\Location;

// Include files
include_once("App/Classes/Controller.php");
include_once("App/Classes/Request.php");
include_once("App/Classes/Session.php");
include_once("App/Models/Location.php");

//-----------------------------------------------------------------------------
class LocationRead extends Controller
{
    public $locations = [];
    public $user;
    //-------------------------------------------------------------------------
    public function index($parameters)
    {

        // Check login
        $this->check_login();

        // Create a new location object
        $location = new Location();

        // Get all Tasks from current user and store them in tasks
        $this->locations = $location->find_all();
    }
    //-------------------------------------------------------------------------
    private function check_login()
    {
        // Create a session
        $session = new Session();

        // If we are logged in, all is good
        if($session->logged_in())
        {
            // Load user information
            $this->user['email'] = $session->get_user('email');
            $this->user['first_name'] = $session->get_user('first_name');
            $this->user['last_name'] = $session->get_user('last_name');
            $this->user['id'] = $session->get_user('id');
            $this->user['level'] = $session->get_user('level');

            // return
            return;
        }

        // We aren't logged in - so Redirect to login page
        header("Location: " . ROOT . "login");

        // Make sure no more of the script executes after redirect
        die;
    }
    //-------------------------------------------------------------------------
}