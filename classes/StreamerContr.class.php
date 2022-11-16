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
            header("Location: index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            return false;
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

    public function vytvorStreamProfil($array) {
        if (empty($array[0]) || empty($array[1]) || empty($array[2])) {
            header("Location: store.php?user=" . $this->id . "&error=emptyfields");
            exit();
        }

        $sql = "INSERT INTO streamer (name, popis, smallpopis, www, fb, discord, youtube, instagram, telegram, twitter)
                VALUES (?,?,?,?,?,?,?,?,?,?);";
        $stmt = $this->connect()->prepare($sql);
        print_r($array);
        if (!$stmt->execute($array)) {
            $stmt = null;
            header("Location: store.php?user=" . $this->id . "&error=stmtfail");
            exit();
        }

        $sql = "SELECT id_streamer name FROM streamer WHERE name=?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$array[0]])) {
            $stmt = null;
            header("Location: store.php?user=" . $this->id . "&error=stmtfail");
            exit();
        }
        $id_strm = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]["name"];

        $sql = "INSERT INTO managestreamer (id_streamer, id_user, permission)
                VALUES (?,?,?)";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$id_strm, $_SESSION["uId"], 10])) {
            $stmt = null;
            header("Location: store.php?user=" . $this->id . "&error=stmtfail");
            exit();
        }

        $sql = "UPDATE users SET hasStore=1;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute()) {
            $stmt = null;
            header("Location: store.php?user=" . $this->id . "&error=stmtfail");
            exit();
        }

        header("Location: profile.php?success=storecreated");
        exit();
    }

    public function pridajProdukt($produkt) {
        $sql = "INSERT INTO produkty (titul, popis, cena, pocet, id_streamer)
                VALUES (?,?,?,?,?);";
        $stmt = $this->connect()->prepare($sql);

        /** @var Product $produkt */
        if (!$stmt->execute([$produkt->titul, $produkt->popis, $produkt->cena, $produkt->pocet, $this->id])) {
            $stmt = null;
            header("Location: store.php?user=" . $this->id . "&error=stmtfail");
            exit();
        }

        header("Location: store.php?user=" . $this->id . "&success=added");
        exit();
    }

    public function vymazProdukt(mixed $id_prod) {
        $sql = "DELETE FROM produkty WHERE id_produkt=?;";
        $stmt = $this->connect()->prepare($sql);

        if (!$stmt->execute([$id_prod])) {
            $stmt = null;
            header("Location: store.php?user=" . $this->id . "&error=stmtfail");
            exit();
        }
        header("Location: store.php?user=" . $this->id . "&success=deleted&id=".$id_prod);
        exit();
    }

}