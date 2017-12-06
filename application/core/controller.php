<?php

/**
 * This is the "base controller class". All other "real" controllers extend this class.
 */
class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var null Model
     */
    public $model = null;

    /**
     * Constructor. Whenever a controller is created, open a database connection and load model.
     */
    function __construct()
    {
        $this->openDatabaseConnection();
        $this->loadModel();
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);

        //UTF-8 encoding queries
        $this->db->exec("SET NAMES 'utf8'");
        $this->db->exec("SET CHARACTER SET utf8");
        $this->db->exec("SET COLLATION_CONNECTION='utf8_unicode_ci'");
    }

    /**
     * Loads the User model
     */
    private function loadModel()
    {
        require_once APP . '/model/User.php';
        // create new "model" (and pass the database connection)
        $this->model = new User($this->db);
    }

    public function is_logged_in()
    {
        Session::_start();
        return isset($_SESSION['user']);
    }

    //checks if user is logged in
    //if so, redirects to results/index
    public function redirect_if_logged_in()
    {
        Session::_start();
        if(isset($_SESSION['user']))
        {
            header('location: ' . URL_WITH_INDEX_FILE . 'results/index');
            exit();
        }
    }

    //checks if user is logged in
    //if not, redirects to login page
    public function must_be_logged_in()
    {
        Session::_start();
        if(!isset($_SESSION['user']))
        {
            Session::_destroy();
            header('location: ' . URL_WITH_INDEX_FILE . 'login/index');
            exit();
        }
    }

    //sets user data in session
    public function set_user_data($user_data)
    {
        Session::_start();
        Session::_set($user_data->id, "user", "id");
        Session::_set($user_data->name, "user", "name");
        Session::_set($user_data->email, "user", "email");
    }

    //get User from session
    public function get_user()
    {
        Session::_start();
        return (object) Session::_get("user");

    }

    //get specific User data
    public function get_user_info($info)
    {
        Session::_start();
        return Session::_get("user", $info);
    }

    //prints session variable
    public function debugSession()
    {
        Session::_display();
    }
}
