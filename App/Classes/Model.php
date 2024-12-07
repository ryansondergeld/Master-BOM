<?php
//-----------------------------------------------------------------------------
//  __  __         _     _
// |  \/  |___  __| |___| |
// | |\/| / _ \/ _` / -_) |
// |_|  |_\___/\__,_\___|_|
//
//-----------------------------------------------------------------------------
// 2024-11-12 Ryan Sondergeld
//
// This class exists for basic database functions in each model class
//
// It has basic insert, read, update, and delete functions.
//
//-----------------------------------------------------------------------------
namespace Classes;

// Check to make sure this page is not accessed elsewhere
defined("ROOT") OR exit("Access Denied!");

// Use Statements
use Classes\Database;

// Include files
include_once("App/Classes/Database.php");

class Model extends Database
{
    protected $allowed_columns =
    [
        'description',
        'complete'
    ];
    protected $limit = 100;
    protected $offset = 0;
    protected $order_type = "asc";
    protected $order_column = "id";
    protected $table = "";

    public $errors = [];

    //-------------------------------------------------------------------------
    public function delete($id, $id_column = "id")
    {
        // Start the statement and get the table
        $sql = 'delete from ' . $this->table;

        // Add where ID =
        $sql = $sql . ' where `' . $id_column . '` = "' . $id . '"';

        // Execute the query and return (always false)
        return $this->query($sql);
    }
    private function filter_columns($data)
    {
        // If allowed is empty, just return the data
        if(empty($this->allowed_columns)) { return $data; }

        // Cycle Through each key
        foreach($data as $key => $value)
        {
            // Determine if the key is in the allowed columns
            $remove = (!in_array($key, $this->allowed_columns));

            // If it is, we need to remove it
            if($remove) { unset($data[$key]); }
        }

        // Return the filtered data
        return $data;
    }
    //-------------------------------------------------------------------------
    public function find_all()
    {
        // Create the SQL statement
        $sql =  "select * from $this->table";

        // Add order By
        $sql = $sql . " order by $this->order_column $this->order_type";

        // Add limit
        $sql = $sql . " limit $this->limit";

        // Add offset
        $sql = $sql . " offset $this->offset";

        // Execute the SQL statement
        return $this->query($sql);
    }
    //-------------------------------------------------------------------------
    public function insert($data)
    {

        // Filter the columns
        $data = $this->filter_columns($data);

        // Get the array of keys
        $keys = array_keys($data);

        // Start with the basic statement
        $sql = "insert into $this->table (";

        // add column statement
        foreach($keys as $k) { $sql = $sql . "`" . $k . "`,"; }

        // Trim the last comma
        $sql = rtrim($sql, ",");

        // Values
        $sql = $sql . ") values (";

        // Add values
        foreach($keys as $k) { $sql = $sql . '"' . $data[$k] . '",'; }

        // Trim the last comma
        $sql = rtrim($sql, ",");

        // Add the last brace
        $sql = $sql . ")";

        // Execute and return result (always false)
        return $this->query($sql);
    }
    //-------------------------------------------------------------------------
    public function update($id, $data, $id_column = 'id')
    {
        //Filter the Columns
        $data = $this->filter_columns($data);

        // Get the array of keys
        $keys = array_keys($data);

        // Start with the basic statement
        $sql = "update $this->table set ";

        // Append all allowable columns
        foreach($keys as $k)
        {
            $sql = $sql . '`' . $k . '` = "' . $data[$k] . '", ';
        }

        // Trim the last comma
        $sql = rtrim($sql, ", ");

        // Add the Where statement
        $sql = $sql . " where `$id_column` = " . $id;

        // Run the query and return the results (always false)
        return $this->query($sql);
    }
    //-------------------------------------------------------------------------
    public function where($data=[], $data_not=[])
    {
        // If both where statements are blank, exit
        if(count($data) < 1 && count($data_not) < 1){ return []; }

        // Get the data key values
        $keys = array_keys($data);

        // Get data key values for NOT statement
        $keys_not = array_keys($data_not);

        // Start with our basic SQL statement
        $sql =  "select * from $this->table where ";

        // Append all where statements
        foreach($keys as $k)
        {
            $sql = $sql . '`' . $k . '` = "' . $data[$k] . '" && ';
        }

        // Append any NOT statements
        foreach($keys_not as $k)
        {
            $sql = $sql . '`' . $k . '` != "' . $data_not[$k]. '" && ';
        }

        // Trim the trailing &&
        $sql = trim($sql, " && ");

        // Add order by
        $sql = $sql . " order by $this->order_column $this->order_type ";

        // Add limits
        $sql = $sql . "limit $this->limit ";

        // Add offset
        $sql = $sql . "offset $this->offset";

        // Execute and return
        return $this->query($sql);
    }
    //-------------------------------------------------------------------------
    public function set_ascending()
    {
        $this->order_type = "asc";
    }
    //-------------------------------------------------------------------------
    public function set_descending()
    {
        $this->order_type = "desc";
    }
    //-------------------------------------------------------------------------
    public function set_limit($limit)
    {
        $this->limit = $limit;
    }
    //-------------------------------------------------------------------------
    public function set_order_column($column)
    {
        // Look through the allowed columns
        foreach($this->allowed_columns as $c)
        {
            // If the passed column is in the allowed columns, set order
            // column
            if($c == $column) { $this->order_column = $column; }
        }
    }
    //-------------------------------------------------------------------------
}