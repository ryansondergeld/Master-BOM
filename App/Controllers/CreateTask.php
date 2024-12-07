<?php

// Namespace Statement
namespace Controllers;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Controller;
use Classes\Request;
use Classes\Session;
use Models\Task;

// Include files
include_once("App/Classes/Controller.php");
include_once("App/Classes/Request.php");
include_once("App/Classes/Session.php");
include_once("App/Models/Task.php");

class CreateTask extends Controller
{
    public function index()
    {
        // Create new session data
        $session = new Session();

        // If we aren't logged in, redirect to login page
        if(!$session->logged_in())
        {
            // Redirect to login page
            header("Location: " . ROOT . "login");

            // Make sure no more of the script executes after redirect
            die;
        }
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

        // Create a new user model
        $task = new Task();

        // If data is invalid, set user form data and don't continue
        if(!$task->validate_insert($data))
        {

            $this->show($task->errors);
            return;
        }

        // Add a default value for user
        $data['user'] = $session->get_user('email');

        // Add a default hour value
        $data['hours'] = 0;

        // Insert the new task into the database
        $task->insert($data);

        // Redirect to login page in the future
        //header("refresh:5;url=" . ROOT . "home");
        header("Location: " . ROOT . "home");

        // Make sure no more of the script executes after redirect
        die;
    }
    //-------------------------------------------------------------------------
}