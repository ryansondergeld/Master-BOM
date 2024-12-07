<?php

// Namespace Statement
namespace Controllers;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Controller;
use Classes\Request;
use Classes\Session;
use Models\User;

// Include files
include_once("App/Classes/Controller.php");
include_once("App/Classes/Request.php");
include_once("App/Classes/Session.php");
include_once("App/Models/User.php");

class UserUpdate extends Controller
{
    public $errors = [];
    public $user = [];
    public $values = [];
    //-------------------------------------------------------------------------
    public function index()
    {
        $this->check_login();

        // Load user data
        foreach($this->user as $key => $value)
        {
            $this->values[$key] = $value;
        }
    }
    //-------------------------------------------------------------------------
    public function load($parameters)
    {
        // Check login
        $this->check_login();

        // Check if we have parameter 0 (ID).  If not, exit
        //if(!isset($parameters[0])) { $this->redirect_home();}

        // At this point we know we have the ID parameter, so get it
        //$query['id'] = $parameters[0];

        // Create a new company object
        //$company = new User();

        // Get all Tasks from current user and store them in tasks
        //$this->user = $company->where($query);

        // We need to check if this actually exists.  if not, go back
        //if(!$this->companies) { $this->redirect_home(); }

        // At this point we want to put all data into the values array
        //foreach($this->user as $key => $value)
        //{
       //    $this->values[$key] = $value;
        //}

    }
    //-------------------------------------------------------------------------
    public function delete($parameters)
    {
        // Check login
        //$this->check_login();

        // Check if we have parameter 0 (ID).  If not, exit
        //if(!isset($parameters[0])) { $this->redirect_home();}

        // Create a new location object
        //$company = new Company();

        // Execute the delete command
        //$company->delete($parameters[0]);

        // Go back to the list
        //header("Location: " . ROOT . "read-company");
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
        $user = new User();

        // If data is invalid, set user form data and don't continue
        if(!$user->validate_update($data))
        {
            $this->values = $data;
            $this->errors = $user->errors;

            return;
        }
        $this->show($data);
        $this->show($this->user);

        // Update the record in the database
        $user->update($data['id'], $data);

        // Create a new Session
        $session = new Session();

        // Unset the password information from session data
        unset($data['password']);

        // Update the information in the session
        $session->log_in($data);

        // Redirect to login page in the future
        header("Location: " . ROOT . "home");

        // Make sure no more of the script executes after redirect
        die;
    }
    //-------------------------------------------------------------------------
    private function redirect_home()
    {
        // Redirect to the home page
        header("Location: " . ROOT . "read-company");

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
    public function checked($key)
    {
        // Used for boolean values on checkboxes in the view
        if(isset($this->values[$key]) and $this->values[$key] == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    //-------------------------------------------------------------------------
}