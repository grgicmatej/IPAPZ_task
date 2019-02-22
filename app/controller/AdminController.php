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

    public function registration()
    {
        $view = new View();
        $view->render('registration',["message"=>""]);
    }

    public function register()
    {
        $db = Db::connect();
        $statement = $db->prepare("insert into users (firstName,lastName,email,password,profilePicture) values 
                                  (:firstName,:lastName,:email,:password,:profilePicture)");
        $statement->bindValue('firstName', Request::post("firstName"));
        $statement->bindValue('lastName', Request::post("lastName"));
        $statement->bindValue('email', Request::post("email"));
        $statement->bindValue('password', password_hash(Request::post("password"),PASSWORD_DEFAULT));
        $statement->bindValue('profilePicture','null'); // tu naknadno stavi putanju
        $statement->execute();

        Session::getInstance()->logout();
        $view = new View();
        $view->render('login',["message"=>""]);
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

    public function taskslist()
    {
        $view = new View();
        $view->render('tasks/taskslist',["message"=>""]);
    }

    public function newtaskprepare()
    {
        $view = new View();
        $view->render('tasks/newtask',["message"=>""]);
    }

    public function newtask()
    {
        $db = Db::connect();
        $statement = $db->prepare("insert into tasks (taskName, users, taskStartTime, taskEndTime, taskDescription, taskStatus, taskCategory) values 
                                  (:taskName,:users,:taskStartTime,:taskEndTime,:taskDescription,:taskStatus,:taskCategory)");
        $statement->bindValue('taskName', Request::post("taskName"));
        $statement->bindValue('users', Request::post("users"));
        $statement->bindValue('taskStartTime', Request::post("taskStartTime"));
        $statement->bindValue('taskEndTime',Request::post("taskEndTime"));
        $statement->bindValue('taskDescription', Request::post("taskDescription"));
        $statement->bindValue('taskStatus', Request::post("taskStatus"));
        $statement->bindValue('taskCategory', Request::post("taskCategory"));
        $statement->execute();
        $this->index();
        /*
        Session::getInstance()->logout();
        $view = new View();
        $view->render('login',["message"=>""]);
        */
        }

}