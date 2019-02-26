<?php

class AdminController
{

    public function login()
    {
        $view = new View();
        $view->render('login', [
            "message" => ""
        ]);
    }



    public function authorize()
    {
        //ne dostaju kontrole
        $db = Db::connect();
        $statement = $db->prepare("select id, concat(firstName, ' ', lastName) as name, password from users where email=:email");
        $statement->bindValue('email', Request::post("email"));
        $statement->execute();

        if($statement->rowCount()>0){
            $user = $statement->fetch();
            if(password_verify(Request::post("password"), $user->password)){
                unset($user->password);
                Session::getInstance()->login($user);
                $this->index();
            }else{
                $view = new View();
                $view->render('login',["message"=>"Neispravna kombinacija korisničko ime i lozinka"]);
            }
        }else{
            $view = new View();
            $view->render('login',["message"=>"Neispravan email"]);
        }
    }

    public function logout()
    {
        Session::getInstance()->logout();
        $this->index();
    }

    public function json()
    {
        $posts = Post::all();
       //print_r($posts);
        echo json_encode($posts);
    }

    public function index()
    {
        //$posts = Post::all();
        $view = new View();
        $view->render('index', [
            //posts" => $posts
        ]);
    }

    public function userslist()
    {
        $db = Db::connect();
        $stmt = $db->query("select * from users")->fetchAll();
        //$stmt -> execute();
        //var_dump($stmt);
        $view = new View();
        $view->render('users/userlist',["message"=>$stmt]);
    }



    public function control()
    {
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
        }
        return true;
    }
}