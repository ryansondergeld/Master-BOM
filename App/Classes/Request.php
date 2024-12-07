<?php
//-----------------------------------------------------------------------------
//  ___                      _
// | _ \___ __ _ _  _ ___ __| |_
// |   / -_) _` | || / -_|_-<  _|
// |_|_\___\__, |\_,_\___/__/\__|
//            |_|
//-----------------------------------------------------------------------------
// 2024-11-12 Ryan Sondergeld
//
// This class is a basic wrapper for all request operations.  It only exists
// to keep from having to use the $_GET and $_POST variables.
//
//-----------------------------------------------------------------------------
namespace Classes;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

class Request
{

    //-------------------------------------------------------------------------
    public function get($key='')
    {
        // Return all post data if no key is entered
        if(empty($key)){ return $_POST;}

        // If a key is entered and exists, return the value
        elseif(isset($_POST[$key])) { return $_POST[$key]; }

        // If none of the above are true, return null
        return null;
    }
    //-------------------------------------------------------------------------
    public function get_used()
    {
        // If we don't have GET data, return false
        if($this->method() != 'GET') { return false;}

        // At this point we do have GET data, so we check if it is empty
        if(count($_GET) < 1) { return false;}

        // GET must be true at this point
        return true;
    }
    //-------------------------------------------------------------------------
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    //-------------------------------------------------------------------------
    public function post($key = '')
    {
        // Return all post data if no key is entered
        if(empty($key)){ return $_POST;}

        // If a key is entered and exists, return the value
        elseif(isset($_POST[$key])) { return $_POST[$key]; }

        // If none of the above are true, return null
        return null;
    }
    //-------------------------------------------------------------------------
    public function post_used()
    {
        // If we don't have post data, return false
        if($this->method() != 'POST') { return false;}

        // At this point we do have post data, so we check if it is empty
        if(count($_POST) < 1) { return false;}

        // Posted must be true at this point
        return true;
    }
    //-------------------------------------------------------------------------
}