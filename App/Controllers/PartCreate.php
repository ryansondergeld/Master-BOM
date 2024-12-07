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


// Include files
include_once("App/Classes/Controller.php");
include_once("App/Classes/Request.php");
include_once("App/Classes/Session.php");
include_once("App/Models/Part.php");
include_once("App/Models/Company.php");
include_once("App/Models/Location.php");


class PartCreate extends Controller
{
    public $errors = [];
    public $locations = [];
    public $manufacturers = [];
    public $user = [];
    public $values = [];
    public $vendors = [];

    public function index()
    {
        $this->check_login();

        $this->load_data();
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

        // Create a new model
        $part = new Part();

        // If data is invalid, set user form data and don't continue
        if(!$part->validate_insert($data))
        {

            // save data
            $this->values = $data;
            $this->errors = $part->errors;
            $this->load_data();

            // Return
            return;
        }

        // Add user id to the data set
        $data['user_id'] = $this->user['id'];

        // Filter for any columns that might be blank before submitting
        foreach($data as $key => $value)
        {
            if(empty($value) and !($key == 'is_active')) { unset($data[$key]); }
        }

        // Insert the new task into the database
        $part->insert($data);

        // Redirect to login page in the future
        header("Location: " . ROOT . "home");

        // Make sure no more of the script executes after redirect
        die;
    }
    //-------------------------------------------------------------------------
    public function load_data()
    {
        // Create a new company and set parameters
        $company = new Company;
        $company->set_order_column('name');
        $company->set_limit(100);

        // Create a new location and set parameters
        $location = new Location;
        $location->set_order_column('description');
        $company->set_limit(100);

        // Create a manufacturer query
        $is_manufacturer = [];
        $is_manufacturer['is_manufacturer'] = 1;
        $is_manufacturer['is_active'] = 1;

        // Create a vendors query
        $is_vendor = [];
        $is_vendor['is_vendor'] = 1;
        $is_vendor['is_active'] = 1;

        // Populate the manufacturers
        $this->manufacturers = $company->where($is_manufacturer);

        // Populate the vendors
        $this->vendors = $company->where($is_vendor);

        // Populate the locations
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