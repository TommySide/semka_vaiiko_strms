<?php
include "Product.php";
include "Dbh.class.php";
class Streamer extends Dbh
{
    protected $id, $popis, $smallpopis, $name;

    /**
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function loadStreamer() {
        $sql = "SELECT * FROM streamer WHERE id_streamer=?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$this->id])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: streamer.php?error=doesntexist");
            exit();
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->popis = $result[0]["popis"];
        $this->smallpopis = $result[0]["smallpopis"];
        $this->name = $result[0]["name"];
        $stmt = null;
        return true;
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
            header("Location: streamer.php?user=".$this->id."&error=noproducts");
            exit();
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS, Product::class);
    }

    public function getPoints() {
        $sql = "SELECT points FROM points WHERE id_user=? AND id_streamer=?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$_SESSION["uId"], $this->id])) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
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
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPopis()
    {
        return $this->popis;
    }

    /**
     * @return mixed
     */
    public function getSmallpopis()
    {
        return $this->smallpopis;
    }


}