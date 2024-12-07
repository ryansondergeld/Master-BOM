<?php

// Namespace Statement
namespace Controllers;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Controller;
use Classes\Request;
use Classes\Session;
use Models\Part;
use Models\Company;
use Models\Location;
use Models\User;

// Include files
include_once("App/Classes/Controller.php");
include_once("App/Classes/Request.php");
include_once("App/Classes/Session.php");
include_once("App/Models/Part.php");
include_once("App/Models/Company.php");
include_once("App/Models/Location.php");
include_once("App/Models/User.php");

class PartUpdate extends Controller
{
    public $locations = [];
    public $manufacturers = [];
    public $vendors = [];

    public $user = [];
    public $parts = [];

    public $errors = [];
    public $values = [];

    public function index()
    {
        $this->check_login();
        $this->get_data();
    }
    //-------------------------------------------------------------------------
    public function load($parameters)
    {
        // Check login
        $this->check_login();

        // Load data
        $this->get_data();

        // Check if we have parameter 0 (ID).  If not, exit
        if(!isset($parameters[0])) { $this->redirect_home();}

        // At this point we know we have the ID parameter, so get it
        $query['id'] = $parameters[0];

        // Create a new part object
        $part = new Part();

        // Get all Tasks from current user and store them in tasks
        $this->parts = $part->where($query);

        // We need to check if this part actually exists!  If not,
        // return to list of parts
        if(!$this->parts) { $this->redirect_home(); }

        // At this point we want to put all data into the values array
        foreach($this->parts[0] as $key => $value)
        {
            $this->values[$key] = $value;
        }

        //$this->show($this->parts);
        //$this->show($this->values);
    }
    //-------------------------------------------------------------------------
    public function delete($parameters)
    {
        // Check login
        $this->check_login();

        // Check if we have parameter 0 (ID).  If not, exit
        if(!isset($parameters[0])) { $this->redirect_home();}

        // Create a new location object
        $part = new Part();

        // Execute the delete command
        $part->delete($parameters[0]);

        // Go back to the list
        header("Location: " . ROOT . "home");
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
        $part = new Part();

        // If data is invalid, set user form data and don't continue
        if(!$part->validate_insert($data))
        {
            $this->values = $data;
            $this->errors = $part->errors;
            return;
        }

        // Filter for any columns that might be blank before submitting
        foreach($data as $key => $value)
        {
            if(empty($value) and !($key == 'is_active')) { unset($data[$key]); }
        }

        // Update the record
        $part->update($data['id'], $data);

        // Redirect to login page in the future
        header("Location: " . ROOT . "read-part");

        // Make sure no more of the script executes after redirect
        die;
    }
    //-------------------------------------------------------------------------
    public function get_data()
    {
        // Create a new company and set parameters
        $company = new Company;
        $company->set_order_column('name');
        $company->set_limit(100);

        // Create a new location and set parameters
        $location = new Location;
        $location->set_order_column('description');
        $company->set_limit(100);

        // Create a new user and session
        //$user = new User;
        //$session = new Session();

        // Create a manufacturer query
        $is_manufacturer = [];
        $is_manufacturer['is_manufacturer'] = 1;
        $is_manufacturer['is_active'] = 1;

        // Create a vendors query
        $is_vendor = [];
        $is_vendor['is_vendor'] = 1;
        $is_vendor['is_active'] = 1;

        // Create a user query
        //$email = [];
       // $email['email'] = $session->get_user('email');

        // Populate the manufacturers
        $this->manufacturers = $company->where($is_manufacturer);

        // Populate the vendors
        $this->vendors = $company->where($is_vendor);

        // Populate the locations
        $this->locations = $location->find_all();

        // Populate the user
        //$this->user = $user->where($email);

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