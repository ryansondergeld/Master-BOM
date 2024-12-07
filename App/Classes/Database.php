<?php
//-----------------------------------------------------------------------------
//  ___       _        _
// |   \ __ _| |_ __ _| |__  __ _ ___ ___
// | |) / _` |  _/ _` | '_ \/ _` (_-</ -_)
// |___/\__,_|\__\__,_|_.__/\__,_/__/\___|
//
//-----------------------------------------------------------------------------
// 2024-11-12 Ryan Sondergeld
//
// This class exists for basic database functions in each model class
//
// This assumes the database will be pre-created using phpMyAdmin
//
// Here are the tables required for this application:
//
// Database name: master_bom
//
// id : primary key auto increment
// email : varchar255
// password : varchar255
// first_name : varchar255
// last name : varchar255
// created_date : datetime (Default = CURRENT_TIMESTAMP)
// level : int (Default = 2)
//-----------------------------------------------------------------------------
namespace Classes;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

use PDO;

class Database
{
    //-------------------------------------------------------------------------
    public function __construct()
    {
        // Connect
        $connection = $this->connect();

        // Display error if connection failed
        if(!$connection) { echo 'Failed to connect!'; }
    }
    //-------------------------------------------------------------------------
    private function connect()
    {
        // Connect to database listed in index.php
        $string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;

        // Return connection
        return new PDO($string, DBUSER, DBPASS);
    }
    //-------------------------------------------------------------------------
    public function query($query, $data=[])
    {
        // Make a connection
        $connection = $this->connect();

        // Prepare a statement
        $statement = $connection->prepare($query);

        // Check if the statement executed
        $check = $statement->execute($data);

        // If the statement did not execute, return false
        if(!$check) { return false;}

        // This executes if check was true
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        // If the result is less than 1 or not an array, return false
        if(!is_array($result) || (count($result) < 1)) { return false;}

        // At this point, we should have a result
        return $result;
    }
    //-------------------------------------------------------------------------
    public function show($m)
    {
        echo '<pre>';
        print_r($m);
        echo '</pre>';
    }
    //-------------------------------------------------------------------------
}