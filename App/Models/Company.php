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
class Company extends Model
{
    // Override the correct table
    protected $table = "`company`";

    // Override the correct columns
    protected $allowed_columns =
        [
            'name',
            'is_vendor',
            'is_manufacturer',
            'is_active'
        ];

    protected $order_column = 'name';
    protected $order_type = 'ASC';
    //-------------------------------------------------------------------------
    public function validate_insert($data)
    {
        // Check if Email is empty or invalid
        if(empty($data['name']))
        {
            // Send an Email Required Error
            $this->errors['name'] = "A name is required";
        }

        // If there are no errors, Return True
        if(empty($this->errors)){ return true; }

        // Otherwise, Return False
        else { return false;}
    }
    //-------------------------------------------------------------------------
}