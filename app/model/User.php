<?php

class user
{
    public static function find($id)
    {
        $db = Db::connect();
        $statement = $db->prepare("select * from users where id=:id");
        $statement->execute(["id"=>$id]);
        return $statement->fetch();
    }

    public static function update($id)
    {
        var_dump(intval($id));
        $db = Db::connect();
        $statement = $db->prepare("UPDATE users SET firstName=:firstName,lastName=:lastName,email=:email,password=:password where id=:id ");
        $infodata = self::infodata();
        $infodata["id"]=intval($id);
        var_dump($_POST)."<br />";
        var_dump($infodata)."<br />";
        $statement->execute($infodata);
        //$this->index();
    }
    private static function infodata(){
        return [
            "firstName"=>Request::post("firstName"),
            "lastName"=>Request::post("lastName"),
            "email"=>Request::post("email"),
            "password"=>password_hash(Request::post("password"), PASSWORD_DEFAULT),
        ];
    }

    public static function read()
    {
        $db = Db::connect();
        $stmt = $db->prepare("select id, firstName, lastName, email from users");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function findEmail($id)
    {
        $db = Db::connect();
        $statement = $db->prepare("select firstName, lastName, email from users where id=:id");
        $statement->bindValue('id',$id);
        $statement->execute();
        return $statement->fetch();
    }

    public static function delete($id)
    {
        $db = Db::connect();
        $statement = $db->prepare("delete from users where id=:id");
        $statement->bindValue('id',$id);
        $statement->execute();
    }

}