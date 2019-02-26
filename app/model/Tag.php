<?php

class Tag
{
       public static function view($id)
    {
        $db = Db::connect();
        $statement = $db->prepare("select * from tasksTags where tasks=$id");
        $statement->bindValue('id',$id);
        $statement->execute();
        return $statement->fetchAll();
    }
}