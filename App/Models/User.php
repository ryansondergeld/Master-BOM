<?php
//-----------------------------------------------------------------------------
//  _   _
// | | | |___ ___ _ _
// | |_| (_-</ -_) '_|
//  \___//__/\___|_|
//
//-----------------------------------------------------------------------------
// 2024-11-12 Ryan Sondergeld
//
// User class is created for login information
//
//
// Here are a list of users and passwords I used for testing:
//
// Username: a@aol.com
// Password: password
// First Name: andy
// Last Name : banks
// Inserted as level 3
//-----------------------------------------------------------------------------

// Namespace Statement
namespace Models;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Model;

// Include files
include_once("App/Classes/Model.php");
class User extends Model
{
    // Override the correct table
    protected $table = "`user`";

    // Override the correct columns
    protected $allowed_columns =
    [
        'email',
        'password',
        'first_name',
        'last_name'
    ];
    //-------------------------------------------------------------------------
    public function validate_insert($data)
    {
        // Check if Email is empty or invalid
        if(empty($data['email']))
        {
            // Send an Email Required Error
           $this->errors['email'] = "Email is required";
        }
        // Check if Email is Invalid
        elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            // Send an Email Invalid Error
            $this->errors['email'] = "Invalid email format";
        }

        // Check if password is empty
        if(empty($data['password']))
        {
            // Send a Password Required Error
            $this->errors['password'] = "Password is required";
        }
        // Check if password is too short
        elseif(strlen($data['password']) < 8)
        {
            // Send a Password too short Error
            $this->errors['password'] = "Password must be at least 8 characters";
        }

        // Check if First name is empty
        if(empty($data['first_name']))
        {
            // Send a First Name required error
            $this->errors['first_name'] = "First name is required";
        }

        // Check if last name is empty
        if(empty($data['last_name']))
        {
            // Send a Last Name required error
            $this->errors['last_name'] = "Last name is required";
        }

        // If we got to this point with no errors check account
        if(empty($this->errors))
        {
            // Create a copy of the data array
            $email = $data;

            // Remove the password - we only want to search for email
            unset($email['password']);

            // Query to see if the email is taken
            $available = $this->where($email);

            // If email is already used, add to errors
            if(!empty($available))
            {
                // Send an Email exists Error
                $this->errors['email'] = "This email is already registered";
            }
        }

        // If there are no errors, Return True
        if(empty($this->errors)){ return true; }

        // Otherwise, Return False
        else { return false;}
    }
    //-------------------------------------------------------------------------
    public function validate_update($data)
    {
        // Check if Email is empty or invalid
        if(empty($data['email']))
        {
            // Send an Email Required Error
            $this->errors['email'] = "Email is required";
        }
        // Check if Email is Invalid
        elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            // Send an Email Invalid Error
            $this->errors['email'] = "Invalid email format";
        }

        // Check if password is empty
        if(empty($data['password']))
        {
            // Send a Password Required Error
            $this->errors['password'] = "Password is required";
        }
        // Check if password is too short
        elseif(strlen($data['password']) < 8)
        {
            // Send a Password too short Error
            $this->errors['password'] = "Password must be at least 8 characters";
        }

        // Check if First name is empty
        if(empty($data['first_name']))
        {
            // Send a First Name required error
            $this->errors['first_name'] = "First name is required";
        }

        // Check if last name is empty
        if(empty($data['last_name']))
        {
            // Send a Last Name required error
            $this->errors['last_name'] = "Last name is required";
        }

        // If there are no errors, Return True
        if(empty($this->errors)){ return true; }

        // Otherwise, Return False
        else { return false;}
    }
    //-------------------------------------------------------------------------
    public function validate_login($data)
    {
        // Check if Email is empty or invalid
        if(empty($data['email']))
        {
            // Send an Email Required Error
            $this->errors['email'] = "Email is required";
        }
        // Check if Email is Invalid
        elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
        {
            // Send an Email Invalid Error
            $this->errors['email'] = "Invalid email format";
        }

        // Check if password is empty
        if(empty($data['password']))
        {
            // Send a Password Required Error
            $this->errors['password'] = "Password is required";
        }
        // Check if password is too short
        elseif(strlen($data['password']) < 8)
        {
            // Send a Password too short Error
            $this->errors['password'] = "Password must be at least 8 characters";
        }

        // If we got to this point with any errors - return
        if(!empty($this->errors)) { return false; }

        // At this point we have form data
        $email = $data;

        // Remove the password - we only want to search for email
        unset($email['password']);

        // Query to see if the user exists
        $available = $this->where($email);

        // If account does not exist, add it to errors
        if(empty($available))
        {
            $this->errors['email'] = "Account does not exist";
            return false;
        }

        // Get the account info from item zero
        $hash = $available[0]->password;

        // Return true if the password matches
        if(password_verify($data['password'], $hash)) { return true;}

        // Otherwise, give error and return false
        else
        {
            $this->errors['password'] = "Password is incorrect";

            return false;
        }
    }
}