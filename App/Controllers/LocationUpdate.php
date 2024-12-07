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
class LocationUpdate extends Controller
{
    //public $title = "Master BOM";
    //public $message = "Sir, this is a Wendys.";
    //public $view = "App/Views/LocationUpdate.php";
    public $locations = [];
    public $id = 0;
    //public $description = "test";
    public $user;
    public $values = [];
    //-------------------------------------------------------------------------
    public function index($parameters)
    {

        // Check login
        $this->check_login();

        // Create a session
        $session = new Session();

        // Check if we have parameter 0 (ID).  If not, exit
        if(!isset($parameters[0])) { $this->redirect_home();}

        // At this point we know we have the ID parameter, so get it
        $query['id'] = $parameters[0];

        // Create a new task object
        //$task = new Task();
        $location = new Location();

        // Get all Tasks from current user and store them in tasks
        $this->locations = $location->where($query);

        // Grab the data and store it into shorter variables for editing
        $this->id = $this->locations[0]->id;
        $this->description = $this->locations[0]->description;
    }

    //-------------------------------------------------------------------------
    public function load($parameters)
    {
        // Check login
        $this->check_login();

        // Check if we have parameter 0 (ID).  If not, exit
        if(!isset($parameters[0])) { $this->redirect_home();}

        // At this point we know we have the ID parameter, so get it
        $query['id'] = $parameters[0];

        // Create a new task object
        $location = new Location();

        // Get all Tasks from current user and store them in tasks
        $this->locations = $location->where($query);

        // We need to check if this location actually exists!  If not,
        // return to list of locations
        if(!$this->locations) { $this->redirect_home(); }

        // At this point we want to put all data into the values array
        foreach($this->locations[0] as $key => $value)
        {
            $this->values[$key] = $value;
        }
    }
    //-------------------------------------------------------------------------
    public function delete($parameters)
    {
        // Check login
        $this->check_login();

        // Check if we have parameter 0 (ID).  If not, exit
        if(!isset($parameters[0])) { $this->redirect_home();}

        // Create a new location object
        $location = new Location();

        // Execute the delete command
        $location->delete($parameters[0]);

        // Go back to the list
        header("Location: " . ROOT . "read-location");
    }
    //-------------------------------------------------------------------------
    public function process($parameters)
    {
        // Create new session data
        $session = new Session();

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

            $this->show($location->errors);
            return;
        }

        // grab our id
        $this->id = $data['id'];

        // Insert the new task into the database
        $location->update($this->id, $data);

        //$this->show($data);

        // Redirect to login page in the future
        //header("refresh:5;url=" . ROOT . "home");
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
    private function redirect_home()
    {
        // Redirect to the home page
        header("Location: " . ROOT . "read-location");

        // Make sure no more of the script executes after redirect
        die;
    }
    //-------------------------------------------------------------------------
}