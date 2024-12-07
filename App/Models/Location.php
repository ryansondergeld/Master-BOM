<?php
//-----------------------------------------------------------------------------
//  _                 _   _
// | |   ___  __ __ _| |_(_)___ _ _
// | |__/ _ \/ _/ _` |  _| / _ \ ' \
// |____\___/\__\__,_|\__|_\___/_||_|
//
//-----------------------------------------------------------------------------
// 2024-11-12 Ryan Sondergeld
//
// Location class is for any parts bin or location
//-----------------------------------------------------------------------------

// Namespace Statement
namespace Models;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Model;

// Include files
include_once("App/Classes/Model.php");
class Location extends Model
{
    // Override the correct table
    protected $table = "`location`";

    // Override the correct columns
    protected $allowed_columns =
        [
            'description',
        ];
    protected $order_column = "description";
    //-------------------------------------------------------------------------
    public function validate_insert($data)
    {
        // Check if Email is empty or invalid
        if(empty($data['description']))
        {
            // Send an Email Required Error
            $this->errors['description'] = "A Location name is required";
        }

        // If there are no errors, Return True
        if(empty($this->errors)){ return true; }

        // Otherwise, Return False
        else { return false;}
    }
    //-------------------------------------------------------------------------
}