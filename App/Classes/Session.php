<?php
//-----------------------------------------------------------------------------
//  ___            _
// / __| ___ _____(_)___ _ _
// \__ \/ -_|_-<_-< / _ \ ' \
// |___/\___/__/__/_\___/_||_|
//
//-----------------------------------------------------------------------------
// 2024-11-12 Ryan Sondergeld
//
// This class exists for basic session data.
//
// It exists to keep from having to use $_SESSION variables and makes
// starting a session as simple as creating a new instance of this class.
//
//-----------------------------------------------------------------------------
namespace Classes;

// Check to make sure this page is not accessed elsewhere
use MongoDB\BSON\PackedArray;

defined("ROOT") OR exit("Access Denied!");

class Session
{

    public $app_key = 'APP';
    public $user_key = 'USER';

    //-------------------------------------------------------------------------
    public function __construct()
    {
        $this->start_session();
    }
    //-------------------------------------------------------------------------
    public function clear_all()
    {
        // Ensure a session is started
        $this->start_session();

        // Clear all session variables in app
        if(!empty($_SESSION[$this->app_key]))
        {
            unset($_SESSION[$this->app_key]);
        }
    }
    //-------------------------------------------------------------------------
    public function get($key)
    {
        // Ensure a session is started
        $this->start_session();

        // check if the session value exists
        if(isset($_SESSION[$this->app_key][$key]))
        {
            // If it does exist, return it
            return $_SESSION[$this->app_key][$key];
        }

        // If not, return null
        return null;
    }
    //-------------------------------------------------------------------------
    public function get_user($key)
    {
        // Ensure a session is started
        $this->start_session();

        // check if the session value exists
        if(isset($_SESSION[$this->user_key][$key]))
        {
            // If it does exist, return it
            return $_SESSION[$this->user_key][$key];
        }

        // If not, return null
        return null;
    }
    //-------------------------------------------------------------------------
    public function log_in($user)
    {
        // Ensure a session is started
        $this->start_session();

        // Set the user data
        $_SESSION[$this->user_key] = $user;
    }
    //-------------------------------------------------------------------------
    public function logged_in()
    {
        // Ensure a session is started
        $this->start_session();

        // check if user key is set and return boolean
        if(empty($_SESSION[$this->user_key])) { return false;}
        else { return true;}
    }
    //-------------------------------------------------------------------------
    public function log_out()
    {
        // Ensure a session is started
        $this->start_session();

        // If the user data is not empty, unset it
        if(!empty($_SESSION[$this->user_key]))
        {
            unset($_SESSION[$this->user_key]);
        }
    }
    //-------------------------------------------------------------------------
    private function start_session()
    {
        // Check if there is a session and if not, start it
        if(session_status() == PHP_SESSION_NONE) { session_start();}
    }
    //-------------------------------------------------------------------------
    public function set($key, $value)
    {
        // Ensure a session is started
        $this->start_session();

        // If we don't have an array, set the value and return
        if(!is_array($key))
        {
            // Set the session value
            $_SESSION[$this->app_key][$key] = $value;

            // We are done
            return;
        }

        // If we got to this point, we have an array so set the values
        foreach ($key as $k => $v) { $_SESSION[$this->app_key][$k] = $v; }
    }
    //-------------------------------------------------------------------------
}