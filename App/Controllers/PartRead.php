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

//-----------------------------------------------------------------------------
class PartRead extends Controller
{
    public $parts = [];
    public $user;
    //-------------------------------------------------------------------------
    public function index($parameters)
    {

        // Check login
        $this->check_login();

        // Create a new task object
        $parts = new Part();

        // Get all Tasks from current user and store them in tasks
        $this->parts = $parts->find_all();

        // Get all Company and Location Values
        $this->fill_data();
        /*
        foreach($this->parts as $part)
        {
            // Set up Company Data
            $company = new Company();
            $id = [];

            // Grab Manufacturer
            $id['id'] = $part->manufacturer_id;
            $list = $company->where($id);
            $part->manufacturer = $list[0];

            // Grab Vendor
            $id['id'] = $part->vendor_id;
            $list = $company->where($id);
            $part->vendor = $list[0];

            // Set up Location
            $location = new Location();
            $id['id'] = $part->location_id;
            $list = $location->where($id);
            $part->location = $list[0];

        }
        */

        //$this->show($this->parts);
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
    public function where($parameters)
    {
        // Check if there are valid filters or not
        if(count($parameters) < 2)
        {
            $this->index($parameters);
            return;
        }

        // Parameter zero should contain a valid query
        $c = $parameters[0];

        // Remove the query parameter
        unset($parameters[0]);

        // create a filter
        $filter = [];

        // Determine which function to call
        switch ($c)
        {
            case 'manufacturer':
                $filter['manufacturer_id'] = $parameters[1];
                break;
            case 'vendor':
                $filter['vendor_id'] = $parameters[1];
                break;
            case 'location':
                $filter['location_id'] = $parameters[1];
                break;
            default:
                $this->index($parameters);
                return;
        }

        // Create a part
        $part = new Part();

        // Execute the query
        $this->parts = $part->where($filter);

        // Fill missing data
        $this->fill_data();

    }
    //-------------------------------------------------------------------------
    public function fill_data()
    {
        // If there are no parts, return
        if(!$this->parts) { return; }

        // Otherwise, fill any data for the vendor, manufacturer, and location
        foreach($this->parts as $part)
        {
            // Set up Company Data
            $company = new Company();
            $id = [];

            // Grab Manufacturer
            $id['id'] = $part->manufacturer_id;
            $list = $company->where($id);
            $part->manufacturer = $list[0];

            // Grab Vendor
            $id['id'] = $part->vendor_id;
            $list = $company->where($id);
            $part->vendor = $list[0];

            // Set up Location
            $location = new Location();
            $id['id'] = $part->location_id;
            $list = $location->where($id);
            $part->location = $list[0];

        }
    }
    //-------------------------------------------------------------------------
}