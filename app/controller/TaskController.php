<?php
/**
 * Created by PhpStorm.
 * User: matej
 * Date: 22.02.19.
 * Time: 18:49
 */
class TaskController
{
    public function index()
    {
        //$posts = Post::all();
        $view = new View();
        $view->render('index', [
            //posts" => $posts
        ]);
    }
    function indextask()
    {
        $view = new View();
        $view -> render('tasks/index',["tasks"=>Task::read()]);
    }
    public function newtaskprepare($id)
    {
        $view = new View();
        $view->render('tasks/newtask',["findUserEmail"=>Task::findUser(),"findCurrentUser"=>User::find($id)]);
    }

    public function newtask()
    {
        $db = Db::connect();
        $statement = $db->prepare("select id from users where email=:email");
        $statement->bindValue('email', Request::post("email"));
        $statement->execute();
        $id=$statement->fetch();

        //echo $id->id;

        $db = Db::connect();
        $statement = $db->prepare("insert into tasks (taskName, users, taskTimeNeed, taskEndTime, taskDescription, taskStatus, taskCategory) values 
                                  (:taskName,:users,:taskTimeNeed,:taskEndTime,:taskDescription,:taskStatus,:taskCategory)");
        $statement->bindValue('taskName', Request::post("taskName"));
        $statement->bindValue('users', $id->id);
        $statement->bindValue('taskTimeNeed', Request::post("taskTimeNeed"));
        $statement->bindValue('taskEndTime',Request::post("taskEndTime"));
        $statement->bindValue('taskDescription', Request::post("taskDescription"));
        $statement->bindValue('taskStatus', "in progress");
        $statement->bindValue('taskCategory', Request::post("taskCategory"));
        $statement->execute();
        $last_id = $db->lastInsertId();

        $tags=Request::post("tagName");
        $tagsReady = explode(" ", $tags);
        $i = 0;
        while($i < count($tagsReady)) {
            $db = Db::connect();
            $statement = $db->prepare("insert into tasksTags (tasks, tagName) values 
                                  (:tasks,:tagName)");
            $statement->bindValue('tasks',$last_id);
            $statement->bindValue('tagName', $tagsReady[$i]);
            $i++;
            $statement->execute();
        }
        $this->index();

    }

    public function taskslist()
    {
        $view = new View();
        $view->render('tasks/taskslist',["message"=>""]);
    }

    public function view($id)
    {
        $view = new View();
        $view->render('tasks/viewtask',["message"=>Task::view($id),"tags"=>Tag::view($id),"email"=>User::findEmail($id)]);
    }

    public function viewtest($id)
    {
        $view = new View();
        $view->render('',["message"=>Task::view($id)]);
    }

    public function delete($id)
    {
        Task::delete($id);
        $this->index();
    }

    public function publicTasks()
    {
        $view = new View();
        $view->render('tasks/tasks',["publicTags"=>Task::publicTags()]);
    }

    public function prepareedit($id)
    {
        $view = new View();
        $view->render('tasks/edit',["id"=>$id,"message"=>""]);
    }

    public function edit($id)
    {
        $controlStatus=$this->controlStatus();
        if ($controlStatus===true)
        {
            $db = Db::connect();
            $statement = $db->prepare("update tasks set taskStatus=:taskStatus where id = :id");
            $statement->bindValue('taskStatus', Request::post("taskStatus"));
            $statement->bindValue('id',$id);
            $statement->execute();

            $this->index();
        }else{
            $view = new View();
            $view->render('tasks/edit',["message"=>$controlStatus]);
        }

    }

    public function controlStatus()
    {
        if (Request::post("taskStatus") === "") {
            return "Status is mandatory!";
        }
        return true;
    }

    public function search()
    {
        $view = new View();
        $view->render('tasks/search',["message"=>Task::Search()]);
    }

    public function pdf($id)
    {
        $view = new View();
        $view->render('tasks/pdf',["message"=>Task::view($id),"tags"=>Tag::view($id),"email"=>User::findEmail($id)]);
    }
}