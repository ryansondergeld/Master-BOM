<?php

// Namespace Statement
namespace Controllers;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Controller;
use Classes\Session;
use Models\Task;
use Models\Part;

// Include files
include_once("App/Classes/Controller.php");
include_once("App/Classes/Session.php");
include_once("App/Models/Task.php");
include_once("App/Models/Part.php");

//-----------------------------------------------------------------------------
class Home extends Controller
{
    public $title = "Master BOM";
    public $message = "Sir, this is a Wendys.";
    public $view = "App/Views/Home.php";
    public $parts = [];
    public $user = [];
    //-------------------------------------------------------------------------
    public function index($parameters)
    {

        // Check login
        $this->check_login();

        // Create a session
        //$session = new Session();

        // load user information
        //$user['email'] = $session->get_user('email');

        // Create a user to query the database tasks
        //$user['user'] = $session->get_user('email');

        // Also want to create a not done clause
        //$not['complete'] = 1;

        // Create a new task object
        //$task = new Task();
        //$part = new Part();

        // Get all Tasks from current user and store them in tasks
        //$this->parts = $part->find_all();
    }

    //-------------------------------------------------------------------------
    public function done($parameters)
    {
        // Create a session
        $session = new Session();

        // Check to make sure we are logged in
        $this->check_login();

        // Check if we have parameter 0 (ID).  If not, exit
        if(!isset($parameters[0])) { $this->redirect_home();}

        // At this point we know we have the ID parameter, so get it
        $query['id'] = $parameters[0];

        // Add the user as well
        $query['user'] = $session->get_user('email');

        // Create a new task object
        $task = new Task();

        // Validate the task
        $check = $task->where($query);

        // If the task is empty, then run the index and exit
        if(empty($check)) { $this->redirect_home();}

        // Create the done data
        $data['complete'] = 1;

        // Create the complete date data
        $data['complete_date'] = date('Y-m-d H:i:s');

        // Update the record
        $task->update($parameters[0], $data);

        // Redirect to home
        $this->redirect_home();
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
        header("Location: " . ROOT . "home");

        // Make sure no more of the script executes after redirect
        die;
    }
    //-------------------------------------------------------------------------
}