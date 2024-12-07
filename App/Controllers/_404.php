<?php

// Namespace Statement
namespace Controllers;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Controller;

// Include files
include_once("App/Classes/Controller.php");

class _404 extends Controller
{
    public $title = "This is my 404 page";
    public $message = "Hello, I'm a message from your page class!";

}