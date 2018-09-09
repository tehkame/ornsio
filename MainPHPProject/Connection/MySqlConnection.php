<?php

/**
 * Establishes a connection to our MySQL database
 *
 * Connection details are included in the class
 *
 * @version 1.0
 * @author Julian.Kruup
 */
class MySqlConnection
{

    private $connection;

    public function __construct()
    {
        $server     = "159.65.134.137";
       //$server     = "localhost";
        $user       = "kame";
        $password   = "shinobi43188";
        $database   = "ornsio";
        $this->connection = new mysqli($server,$user,$password,$database);
    }

    /**
     * Executes a raw query to the MySql database
     * @param string $q the query string
     * @return mixed an associative array containing the query results
     */
    public function GetLastId()
    {
        return $this->connection->insert_id;
    }


    public function Query($q)
    {
        return $this->connection->query($q);
    }

    /**
     * Gets an entire table from the MySql database
     * @param string $t the name of the table
     * @return mixed an associative array containing the table data
     */
    public function SelectTable($t,$w)
    {
        return $this->connection->query("SELECT * FROM ".$t." WHERE " .$w);
    }

    public function SelectPoints($t=null)
    {
        $sql = "SELECT points.*, alias, icon, member, collection FROM points JOIN pointtypes ON pointtypes.id = points.type";
        if (isset($t)){$sql = $sql." WHERE type=1";}
        return $this->connection->query($sql);
    }

    public function SelectOptions($table,$cols,$where)
    {
        return $this->connection->query("SELECT $cols FROM $table WHERE $where");
    }

    public function InsertRow($t, $f, $v)
    {
        $this->connection->query("INSERT INTO $t ($f) VALUES ($v)");
    }

    public function InsertRespond($t, $f, $v)
    {
        $this->connection->query("INSERT INTO $t ($f) VALUES ($v)");
        return $this->connection->insert_id;
    }

    /**
     * Closes the active connection to MySql
     */
    public function Close()
    {
        $this->connection->close();
    }

}