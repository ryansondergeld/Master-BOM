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

class Login extends Controller
{

    public $errors = [];
    public $values = [];
    //-------------------------------------------------------------------------
    public function process($parameters)
    {

        // Create new session data
        $session = new Session();

        // Create a new Request
        $request = new Request();

        // If there is no post data, there is no need to continue
        if(!$request->post_used()){ return;}

        // If user is already logged in, send a message
        if($session->logged_in()) { echo 'Someone is already logged in!';}

        // Gather the post data
        $data = $request->post();

        // Create a new user model
        $user = new User();

        // If data is invalid, set user form data and don't continue
        if(!$user->validate_login($data))
        {
            //$this->show($user->errors);
            // Log errors
            $this->errors = $user->errors;

            // Store values
            $this->values = $data;

            // Log out
            $session->log_out();

            // return from the function
            return;
        }

        // We have a valid user here, create an email query
        $email['email'] = $data['email'];

        // Get the list of users - which should only contain 1 item
        $list_of_user = $user->where($email);

        // Transfer user info into the data array
        foreach($list_of_user[0] as $key => $value)
        {
            $data[$key] = $value;
        }

        // Unset the password
        unset($data['password']);

        // Set the user session variable as logged in
        $session->log_in($data);

        // Redirect to login page in the future
        header("Location: " . ROOT . "home");

        // Make sure no more of the script executes after redirect
        die;

    }
    //-------------------------------------------------------------------------
}