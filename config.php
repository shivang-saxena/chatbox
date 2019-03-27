
<?php // db.php
//starting the session
session_start();
// define global constants


define ('ROOT_PATH', realpath(dirname(__FILE__)));
define('BASE_URL', 'http://localhost:8000/MyWeb/blog/');


class db {
    // The database connection
    protected static $connection;

    /**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    protected function connect() {    
        // Try and connect to the database
        if(!isset(self::$connection)) {

            // Load configuration there are defined in config.php
            //require_once('app/config/config.php');
            // self::$connection = new mysqli('sql307.epizy.com','epiz_23271570','tz0MVGGp98HQO','epiz_23271570_livechatbox');
            self::$connection = new mysqli('localhost','root','','livechatbox2');
        }

        if(self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            echo 'Database Error Occured';
            return false;
        }
        return self::$connection;
    }



    /*
        Query the database

        @param $query The query string
        @return mixed The result of the mysqli::query() function
    */
    private function query($query) {
        // Connect to the database
        $connection = $this->connect();

        // Query the database
        $result = $connection->query($query);
        return $result;
    }

    /*
        Fetch rows from the database (SELECT query)

        @param $query The query string
        @return bool False on failure / array Database rows on success
    */
    public function select($query) {
        $result = $this->query($query);

        if($result === false) {
            return false;
        }

        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows; 
    }

    /*
        Insert rows into the database (Insert query)

        @param $query The query string
        @return bool False on failure / array Database rows on success
    */
    public function insertUpdateDelete($query) {
        $result = $this->query($query);

        if($result === false) {
            return false;
        }

        return true; 
    }

    public function numRows($query) {
        $result = $this->query($query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;   
    }
}
 
?>
