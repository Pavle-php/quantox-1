<?php

class Results extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->must_be_logged_in();
    }
    
    public function index()
    {
        
        //retrieve user
        $user = $this->get_user();
        //retrieve user id
        $user_id = $user->id;
        //retrieve username
        $username = $user->name;

        if($_SERVER['REQUEST_METHOD'] === "POST")
        {
            $users = $this->model->filterUsers($_POST['search_term']);
        }
        else{
            $users = $this->model->getAllUsers();
        }

        //load view
        require_once APP . 'views/results/index.php';
    }
}
