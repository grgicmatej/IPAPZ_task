<?php

class UserController
{
    public function prepareeditname()
    {
        $view = new View();
        $view->render('users/editname',["message"=>""]);
    }

    public function editname($id)
    {
        $controlname=$this->controlname();
        If($controlname===true){
        $db = Db::connect();
        $stmt = $db->prepare("update users set firstName = :firstName, lastName = :lastName where id = :id");
        $stmt ->bindValue('firstName', Request::post("firstName"));
        $stmt ->bindValue('lastName', Request::post("lastName"));
        $stmt ->bindValue('id',$id);
        $stmt ->execute();
        Session::getInstance()->logout();
        $view = new View();
        $view ->render('login',["message"=>"please login again"]);
        } else {
            $view = new View();
            $view ->render('users/editname',["message"=>$controlname]);
        }
    }

    public function prepareeditpassword()
    {
        $view = new View();
        $view->render('users/editpassword',["message"=>""]);
    }

    public function editpassword($id)
    {
        if(Request::post("password")===Request::post("confirmpassword")){
            $db = Db::connect();
            $stmt = $db->prepare("update users set password=:password where id = :id");
            $stmt ->bindValue('password', password_hash(Request::post("password"), PASSWORD_DEFAULT));
            $stmt ->bindValue('id',$id);
            $stmt ->execute();
            Session::getInstance()->logout();
            $view = new View();
            $view ->render('login',["message"=>"please login again"]);
        }else{
            $view = new View();
            $view ->render('users/editpassword',["message"=>"Passwords are not the same"]);
        }

    }

    public function registration()
    {
        $view = new View();
        $view->render('users/registration',["message"=>""]);
    }

    public function register()
    {
        $control=$this->control();
        if($control===true){


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
        }else{
            $view = new View();
            $view->render('users/registration',["message"=>$control]);
        }
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

    public function controlname()
    {
        if(Request::post("firstName")===""){
            return "First name is mandatory!";
        }
        if(Request::post("lastName")===""){
            return "Last name is mandatory!";
        }
        if(strlen(Request::post("firstName"))<1 || strlen(Request::post("firstName"))>30){
            return "First name is too short or too long!";
        }
        return true;
    }

    public function indexuser(){
        $view = new View();
        $view->render('users/index',["users"=>User::read()]);
    }

    public function index()
    {
        $view = new View();
        $view->render('index', []);
    }

    public function view($id)
    {
        $view = new View();
        $view->render('users/profile',["message"=>User::find($id),"tasks"=>Task::findTasks($id)]);
    }

    public function delete($id)
    {
        User::delete($id);
        $this->index();
    }
}