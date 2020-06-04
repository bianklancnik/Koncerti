<?php

require_once "BazaInit.php";

class KonBaza {
    public static function newuser($name, $surname, $username, $pass) {
        $db = Baza::getInstance();

        $statement = $db->prepare("INSERT INTO uporabniki (ime, priimek, uporabnisko_ime, geslo)
            VALUES (:ime, :priimek, :uporabnisko, :geslo)");
        $statement->bindParam(":ime", $name);
        $statement->bindParam(":priimek", $surname);
        $statement->bindParam(":uporabnisko", $username);
        $statement->bindParam(":geslo", $pass);
        $statement->execute();
    }
    public static function checkuser($name){
        $db = Baza::getInstance();

        $statement = $db->prepare("SELECT COUNT(*) as stevilo FROM uporabniki WHERE uporabnisko_ime = :ime");
        $statement->bindParam(":ime", $name);
        $statement->execute();

        return $statement->fetch();
    }
    public static function login($username){
        $db = Baza::getInstance();

        $statement = $db->prepare("SELECT id, geslo, admin FROM uporabniki WHERE uporabnisko_ime = :ime");
        $statement->bindParam(":ime", $username);
        $statement->execute();

        return $statement->fetchAll();
    }
    public static function profilEdit($id){
        $db = Baza::getInstance();

        $statement = $db->prepare("SELECT * FROM uporabniki WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();

        return $statement->fetchAll();
    }
    public static function preberiVse(){
        $db = Baza::getInstance();

        $statement = $db->prepare("SELECT k.id as id, k.ime as ime, datum, cena, z.ime as zvrst, kr.ime as kraj FROM koncerti k INNER JOIN zvrsti z ON z.id=k.zvrst_id INNER JOIN kraji kr ON kr.id=k.kraj_id ");
        $statement->execute();

        return $statement->fetchAll();
    }
    public static function orderZvrst(){
        $db = Baza::getInstance();

        $statement = $db->prepare("SELECT k.id as id, k.ime as ime, datum, cena, z.ime as zvrst, kr.ime as kraj FROM koncerti k INNER JOIN zvrsti z ON z.id=k.zvrst_id INNER JOIN kraji kr ON kr.id=k.kraj_id ORDER BY z.ime");
        $statement->execute();

        return $statement->fetchAll();
    }
    public static function orderKraj(){
        $db = Baza::getInstance();

        $statement = $db->prepare("SELECT k.id as id, k.ime as ime, datum, cena, z.ime as zvrst, kr.ime as kraj FROM koncerti k INNER JOIN zvrsti z ON z.id=k.zvrst_id INNER JOIN kraji kr ON kr.id=k.kraj_id ORDER BY kr.ime");
        $statement->execute();

        return $statement->fetchAll();
    }
    public static function preberi($id){
        $db = Baza::getInstance();

        $statement = $db->prepare("SELECT k.id as id, k.ime as ime, datum, cena, z.ime as zvrst, kr.ime as kraj, k.opis as opis FROM koncerti k INNER JOIN zvrsti z ON z.id=k.zvrst_id INNER JOIN kraji kr ON kr.id=k.kraj_id WHERE k.id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();

        return $statement->fetch();
    }
    public static function karta($stevilo, $k_id, $u_id){
        $db = Baza::getInstance();

        $statement = $db->prepare("INSERT INTO karte (koncert_id, uporabnik_id, stevilo) VALUES (:k_id, :u_id, :stevilo)");
        $statement->bindParam(":k_id", $k_id);
        $statement->bindParam(":u_id", $u_id);
        $statement->bindParam(":stevilo", $stevilo);
        $statement->execute();
    }
    public static function preberiRezervacije($id){
        $db = Baza::getInstance();

        $statement = $db->prepare("SELECT ka.id as id, stevilo, k.ime as ime, k.cena as cena, k.datum as datum FROM karte ka INNER JOIN koncerti k ON k.id=ka.koncert_id WHERE ka.uporabnik_id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();

        return $statement->fetchAll();
    }
    public static function getZvrsti(){
        $db = Baza::getInstance();

        $statement = $db->prepare("SELECT ime FROM zvrsti");
        $statement->execute();

        return $statement->fetchAll();
    }
    public static function getKraji(){
        $db = Baza::getInstance();

        $statement = $db->prepare("SELECT ime FROM kraji");
        $statement->execute();

        return $statement->fetchAll();
    }
    public static function dodaj($ime, $datum, $cena, $opis, $zvrst, $kraj){
        $db = Baza::getInstance();

        $statement = $db->prepare("INSERT INTO koncerti (ime, datum, cena, opis, kraj_id, zvrst_id) VALUES (:ime, :datum, :cena, :opis, (SELECT id FROM kraji WHERE ime = :kraj), (SELECT id FROM zvrsti WHERE ime = :zvrst)) ");
        $statement->bindParam(":ime", htmlspecialchars($ime));
        $statement->bindParam(":datum", htmlspecialchars($datum));
        $statement->bindParam(":cena", $cena);
        $statement->bindParam(":opis", htmlspecialchars($opis));
        $statement->bindParam(":kraj", $kraj);
        $statement->bindParam(":zvrst", $zvrst);
        $statement->execute();
    }
    public static function uredi($id, $ime, $datum, $cena, $opis, $zvrst, $kraj){
        $db = Baza::getInstance();

        $statement = $db->prepare("UPDATE koncerti SET ime = :ime, datum = :datum, cena = :cena, opis = :opis, kraj_id = (SELECT id FROM kraji WHERE ime = :kraj), zvrst_id = (SELECT id FROM zvrsti WHERE ime = :zvrst) WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->bindParam(":ime", htmlspecialchars($ime));
        $statement->bindParam(":datum", htmlspecialchars($datum));
        $statement->bindParam(":cena", $cena);
        $statement->bindParam(":opis", htmlspecialchars($opis));
        $statement->bindParam(":kraj", $kraj);
        $statement->bindParam(":zvrst", $zvrst);
        $statement->execute();
    }
    public static function izbrisi($id){
        $db = Baza::getInstance();

        $statement = $db->prepare("DELETE FROM karte WHERE koncert_id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();

        $statement = $db->prepare("DELETE FROM koncerti WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
    }
    public static function izbrisiRezervacijo($id){
        $db = Baza::getInstance();

        $statement = $db->prepare("DELETE FROM karte WHERE id = :id");
        $statement->bindParam(":id", $id);
        $statement->execute();
    }
}