<?php

class dbh
{

    protected function connect() {
        try {
            $username = "root";
            $password = "dtb456";
            $dbname = "strm";
            $dbh = new PDO('mysql:dbname='.$dbname.';host=localhost', $username, $password);
            return $dbh;
        }
        catch (PDOException $e) {
            print "Error!: ". $e->getMessage()."<br/>";
            die();
        }
    }
}