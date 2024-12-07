<?php

// Namespace Statement
namespace Controllers;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Controller;
use Models\User;

// Include files
include_once("App/Classes/Controller.php");
include_once("App/Models/User.php");

class UserCreate extends Controller
{
    public $errors = [];

    public $values = [];

    //-------------------------------------------------------------------------
    public function process($parameters)
    {
        // If there is no post data there is no need to continue
        if(!$_POST) { return; }

        // Gather the post data
        $data = $_POST;

        // Create a new user model
        $user = new User();

        // If data is invalid, set user form data and don't continue
        if(!$user->validate_insert($data))
        {
            $this->errors = $user->errors;
            $this->values = $data;
            return;
        }

        // At this point, data is valid, so create a password hash
        $hash = password_hash($data['password'], PASSWORD_DEFAULT);

        // Replace password with the hash
        $data['password'] = $hash;

        // Insert the new account into the database
        $user->insert($data);

        // Redirect to login page in the future
        header("Location: " . ROOT . "home");

        // Make sure no more of the script executes after redirect
        die;
    }
    //-------------------------------------------------------------------------
}