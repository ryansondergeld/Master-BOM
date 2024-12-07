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

class CompanyCreate extends Controller
{
    public $errors = [];
    public $user = [];
    public $values = [];
    //-------------------------------------------------------------------------
    public function index()
    {
        // check to ensure we are logged in
        $this->check_login();
    }
    //-------------------------------------------------------------------------
    public function process($parameters)
    {
        // check to ensure we are logged in
        $this->check_login();

        // Creat a new request data
        $request = new Request();

        // If there is no post data, there is no need to continue
        if(!$request->post_used()){ return;}

        // Gather the post data
        $data = $request->post();

        // Create a new location model
        $company = new Company();

        // If data is invalid, set user form data and don't continue
        if(!$company->validate_insert($data))
        {
            $this->values = $data;
            $this->errors = $company->errors;
            return;
        }

        // Insert the new item into the database
        $company->insert($data);

        // Redirect to the list page
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