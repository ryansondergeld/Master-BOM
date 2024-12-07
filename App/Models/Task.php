<?php

// Namespace Statement
namespace Models;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Model;

// Include files
include_once("App/Classes/Model.php");
class Task extends Model
{
    // Override the correct table
    protected $table = "`tasks`";

    // Override the correct columns
    protected $allowed_columns =
    [
        'description',
        'hours',
        'user',
        'complete',
        'complete_date'
    ];
    //-------------------------------------------------------------------------
    public function validate_insert($data)
    {
        // Check if Description is empty or invalid
        if(empty($data['description']))
        {
            // Send a Description Required Error
           $this->errors['description'] = "Description is required";
        }

        // If there are no errors, Return True
        if(empty($this->errors)){ return true; }

        // Otherwise, Return False
        else { return false;}
    }
    //-------------------------------------------------------------------------
}