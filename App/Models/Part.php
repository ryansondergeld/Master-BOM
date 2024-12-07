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
class Part extends Model
{
    // Override the correct table
    protected $table = "`part`";

    // Override the correct columns
    protected $allowed_columns =
        [
            'article_number',
            'order_number',
            'description',
            'manufacturer_id',
            'vendor_id',
            'price',
            'price_date',
            'location_id',
            'quantity',
            'user_id',
            'is_active'
        ];
    //-------------------------------------------------------------------------
    public function validate_insert($data)
    {
        // Check if Article Number is empty or invalid
        if(empty($data['article_number']))
        {
            // Send an Article Number Required error
            $this->errors['article_number'] = "An article number is required";
        }

        // Check for Manufacturer ID
        if(empty($data['manufacturer_id']))
        {
            // Send Error
            $this->errors['manufacturer_id'] = "No Manufacturer selected";
        }

        // Check for Manufacturer ID
        if(empty($data['vendor_id']))
        {
            // Send Error
            $this->errors['vendor_id'] = "No Vendor selected";
        }

        // If there are no errors, Return True
        if(empty($this->errors)){ return true; }

        // Otherwise, Return False
        else { return false;}
    }
    //-------------------------------------------------------------------------
}