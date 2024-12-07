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

class LocationCreate extends Controller
{
    public $errors = [];
    public $user = [];
    public $values = [];

    public function index()
    {
        $this->check_login();
    }
    //-------------------------------------------------------------------------
    public function process($parameters)
    {
        // Create new session data
        $this->check_login();

        // Creat a new request data
        $request = new Request();

        // If there is no post data, there is no need to continue
        if(!$request->post_used()){ return;}

        // Gather the post data
        $data = $request->post();

        // Create a new location model
        $location = new Location();

        // If data is invalid, set user form data and don't continue
        if(!$location->validate_insert($data))
        {
            // List Errors
            $this->errors = $location->errors;

            // Store values
            $this->values = $data;

            return;
        }

        // Insert the new task into the database
        $location->insert($data);

        // Redirect to the list page
        header("Location: " . ROOT . "read-location");

        // Make sure no more of the script executes after redirect
        die;
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