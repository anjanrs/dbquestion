<?php
declare(strict_types=1);

namespace App\Core;

/**
* Simple mysql db class for querying database;
*/
class Mysql 
{

    protected $conn;

    /**
    * constructor function from the class
    *
    * @param string $dbhost   hostname fo the mysql db server
    * @param string $dbuser   username for the mysql db server
    * @param string $dbpass   password for the mysql db server
    * @param string $dbname   database name to connect to
    * @param string $charset  charset to be used when sending data from and to database server
    * 
    * @return void
    */
    public function __construct(
        string $dbhost ,
        string $dbuser ,
        string $dbpass ,
        string $dbname ,
        string $charset = 'utf8') {
            $this->conn = new \mysqli($dbhost, $dbuser, $dbpass, $dbname);
        		if ($this->conn->connect_error) {
        			die('Failed to connect to MySQL - ' . $this->conn->connect_error);
        		}
        		$this->conn->set_charset($charset);
    }

    public function __destruct() 
    {
        $this->conn->close();
    }


    /**
    * Simply executes raw query with out any modification
    * @param string $query raw sql query to be exectued 
    * 
    * @return array array of record objects
    */
    public function executeRawQuery(string $query): array
    {
        $resultDataSet = array();
        $result = $this->conn->query($query);
        if ($result) {
            while ($row = $result->fetch_object()) {
                $resultDataSet[] = $row;
            }  
            $result->close();
        }
        return $resultDataSet;
    }

}
?>
