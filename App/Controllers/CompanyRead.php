<?php

// Namespace Statement
namespace Controllers;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Controller;
use Classes\Request;
use Classes\Session;
use Models\Company;

// Include files
include_once("App/Classes/Controller.php");
include_once("App/Classes/Request.php");
include_once("App/Classes/Session.php");
include_once("App/Models/Company.php");

//-----------------------------------------------------------------------------
class CompanyRead extends Controller
{
    public $companies = [];
    public $user;
    //-------------------------------------------------------------------------
    public function index($parameters)
    {

        // Check login
        $this->check_login();

        // Create a new task object
        $company = new Company();

        // The default is to find all companies
        $this->companies = $company->find_all();

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
        // First, we need to check if the count is only one
        if(count($parameters) != 1)
        {
            $this->index($parameters);
            return;
        }

        // If we are here, we have only 1 parameter; put it in company type
        $type = $parameters[0];

        // If neither filter exists, exit
        if($type !== 'manufacturer' && $type !== 'vendor')
        {
            $this->index($parameters);
            return;
        }

        // Create a filter array
        $filter = [];

        // Add a manufacturer filter
        if($type === 'manufacturer') { $filter['is_manufacturer'] = 1; }

        // Add a vendor filter
        if($type === 'vendor') { $filter['is_vendor'] = 1; }

        // Create a new task object
        $company = new Company();

        // The default is to find all companies
        $this->companies = $company->where($filter);

    }
    //-------------------------------------------------------------------------
}