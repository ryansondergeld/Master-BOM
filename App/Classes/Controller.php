<?php
//-----------------------------------------------------------------------------
//   ___         _           _ _
//  / __|___ _ _| |_ _ _ ___| | |___ _ _
// | (__/ _ \ ' \  _| '_/ _ \ | / -_) '_|
//  \___\___/_||_\__|_| \___/_|_\___|_|
//
//-----------------------------------------------------------------------------
// 2024-11-12 Ryan Sondergeld
//
// This class runs any code for an individual page.
//
// When the constructor is called, a session will be started.  If the view
// exists it will be set and called after any logic is performed.  if any
// action was passed on from the application and exists it will be
// performed.  If not, the index function will run - which usually does
// nothing except display the viewed page.
//
// It is important to note that the view page will always show up after
// any logic is performed.  If the view doesn't exist nothing will run.
//
//-----------------------------------------------------------------------------

namespace Classes;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Request;
use Classes\Session;

// Include files
include_once("App/Classes/Request.php");
include_once("App/Classes/Session.php");

class Controller
{
    public $view = "";
    //-------------------------------------------------------------------------
    public function __construct($view="", $data=[])
    {
        // Start a session
        $session = new Session();

        // Set our view if it exists
        $this->view = $view;

        // Let's determine an action to do
        $action = $this->get_action($data);

        // Grab any leftover parameters
        $parameters = $this->get_parameters($data);

        // Run the action if it exists
        if(method_exists($this, $action)) { $this->$action($parameters); }

        // Show the View / Page
        $this->show_view();
    }
    //-------------------------------------------------------------------------
    public function get_action($data=[])
    {
        // Check if the data has at least one record and return
        if(count($data) < 1) { return "index";}
        else { return $data[0];}
    }
    //-------------------------------------------------------------------------
    public function get_parameters($data=[])
    {
        // Check if there is at least one parameter
        if(count($data) < 2) { return [];}
        else
        {
            // Remove the action from the parameters
            unset($data[0]);

            // Re-order the parameters and return
            return array_values($data);
        }
    }
    //-------------------------------------------------------------------------
    public function show($m)
    {
        // Simple function for debugging
        echo '<pre>';
        print_r($m);
        echo '</pre>';
    }
    //-------------------------------------------------------------------------
    public function show_view()
    {
        // Create a reference to this page for the template
        $p = $this;

        // Check if the view exists
        $exists = file_exists($this->view);

        // If it exists, show the view!
        if($exists){ include_once($this->view); }
    }
    //-------------------------------------------------------------------------

}