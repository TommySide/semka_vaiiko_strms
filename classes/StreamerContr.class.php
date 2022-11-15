<?php
include "Streamer.php";
include "Product.php";
include "Dbh.class.php";
class StreamerContr extends Dbh
{
    private $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function loadStreamer()
    {
        $sql = "SELECT * FROM streamer WHERE id_streamer=?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->id])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: store.php?error=doesntexist");
            exit();
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS, Streamer::class);

    }

    public function getProducts() {
        $sql = "SELECT * FROM produkty WHERE id_streamer=?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->id])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: store.php?user=".$this->id."&error=noproducts");
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS, Product::class);
    }

    public function getPoints() {
        $sql = "SELECT points FROM points WHERE id_user=? AND id_streamer=?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$_SESSION["uId"], $this->id])) {
            $stmt = null;
            header("Location: index.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() == 0) {
            return 0;
        }

        return $stmt->fetchColumn(0);
    }

    public function isManagement() {
        $sql = "SELECT permission FROM managestreamer WHERE id_streamer=? AND id_user=?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->id, $_SESSION["uId"]])) {
            $stmt = null;
            header("Location: index.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    public function pridajBody($body, $komu)
    {
        $sql = "UPDATE points SET points = points + ? WHERE id_streamer=? AND id_user=?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$body, $this->id, $komu])) {
            $stmt = null;
            header("Location: store.php?user=".$this->id."&error=stmtfail");
            exit();
        }
        $stmt = null;
        header("Location: store.php?user=".$this->id."&success=pointsadded");
        exit();
    }

}