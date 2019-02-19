<?php

class UserController
{
    public function prepareedit()
    {
        /*$db = Db::connect();
        $stmt = $db->prepare("select * from users where id=:id");
        $stmt -> bindValue('id',Request::post("id"));
        $stmt-> execute();
        $user = $stmt->fetch();
        var_dump( $user->firstName);*/
        $view = new View();
        $view->render('users/edit',["message"=>""]);
    }

    public function edit($id)
    {
        if(Request::post("password")!==Request::post("confirmpassword")){
            $view = new View();
            $view->render('users/edit',["message"=>"passwords are not equal"]);
        }else{
            $control=$this->control();
            if($control===true){

                    $db = Db::connect();
                    $stmt = $db->prepare("update users set firstName = :firstName, lastName = :lastName, password = :password where id = :id");
                    $stmt ->bindValue('firstName', Request::post("firstName"));
                    $stmt ->bindValue('lastName', Request::post("lastName"));
                    $stmt ->bindValue('password', password_hash(Request::post("password"), PASSWORD_DEFAULT));
                    $stmt ->bindValue('id',$id);
                    $stmt ->execute();
                    Session::getInstance()->logout();
                    $view = new View();
                    $view ->render('login',["message"=>"please login again"]);
            }else{
                $view = new View();
                $view->render('users/edit',["message"=>$control]);
            }
        }
    }

    public function control()
    {/*
        if(Request::post("firstName")===""){
            return "First name is mandatory!";
        }
        if(Request::post("lastName")===""){
            return "Last name is mandatory!";
        }
        if(Request::post("email")===""){
            return "Email name is mandatory!";
        }
        if(Request::post("password")===""){
            return "Password is mandatory!";
        }
        if(strlen(Request::post("firstName"))<1 || strlen(Request::post("firstName"))>30){
            return "First name is too short or too long!";
        }
        $db = Db::connect();
        $statement = $db->prepare("select count(id) from users where email=:email and id<>:id");
        $statement->execute(["email"=>Request::post("email"), "id" => Request::post("id")]);
        $total = $statement->fetchColumn();
        if($total>0){
            return "Email already exists!";
        }*/
        return true;
    }

    public function index()
    {

        $posts = Post::all();
        $view = new View();
        $view->render('index', [
            "posts" => $posts
        ]);
    }
}