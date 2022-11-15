<?php

class Dbh
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

    public function getAllStreamers() {
        $sql = "SELECT * FROM streamer ORDER BY id_streamer";
        $stmt = $this->connect()->prepare($sql);
        if (!$stmt->execute()) {
            header("Location: index.php?error=stmtfail");
            exit();
        }
        include "classes/Streamer.php";
        return $stmt->fetchAll(PDO::FETCH_CLASS, Streamer::class);
    }
}