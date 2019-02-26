<?php
/**
 * Created by PhpStorm.
 * User: matej
 * Date: 22.02.19.
 * Time: 18:52
 */
class Task
{
    public static function read()
    {
        $db = Db::connect();
        $stmt = $db->prepare("select * from tasks");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function view($id)
    {
        $db = Db::connect();
        $statement = $db->prepare("select * from tasks where id=$id");
        $statement->bindValue('id',$id);
        $statement->execute();
        return $statement->fetch();
    }

    public static function findUser(){
        $db = Db::connect();
        $statement = $db->prepare("select email from users");
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function findCurrentUser($id){
        $db = Db::connect();
        $statement = $db->prepare("select email from users where id=:id");
        $statement->bindValue('id', $id );
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function findTasks($id){
        $db = Db::connect();
        $statement = $db->prepare("select * from tasks where users=:id");
        $statement->bindValue('id',$id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function delete($id)
    {
        $db = Db::connect();
        $statement = $db->prepare("delete from tasks where id=:id");
        $statement->bindValue('id',$id);
        $statement->execute();
    }

    public static function publicTags()
    {
        $db = Db::connect();
        $statement = $db->prepare("select * from tasks where taskStatus=:taskStatus");
        $statement->bindValue('taskStatus',"finished");
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function publicTagsCount()
    {
        $db = Db::connect();
        $statement = $db->prepare("SELECT COUNT(*) FROM tasks WHERE taskStatus = :taskStatus;");
        $statement->bindValue('taskStatus',"finished");
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function search()
    {
        $db = Db::connect();
        $statement = $db->prepare("select * from tasks where taskName=:taskName");
        $statement->bindValue('taskName',Request::post("taskName"));
        $statement->execute();
        $row=$statement->rowCount();
        if ($row<=0){
            return "0 tasks found!";
        }else{
        return $statement->fetchAll();
        }
    }

}