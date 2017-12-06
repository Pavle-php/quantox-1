<?php 

class Login extends Controller
{

	public function index()
	{

		$this->redirect_if_logged_in();

		$login_failed = false;
		$registration_failed = false;
		$registration_succeeded = false;

		$status = "";

		if($_SERVER['REQUEST_METHOD'] === "POST")
		{
			//if there was login atempt
			if(isset($_POST['login']))
			{

				/*
				 * if email and password are set and not empty string, login process continues
				 * else login screen is shown with error message
				 */
				if(isset($_POST['email']) && isset($_POST['password']) && !empty(trim($_POST['email'])) && !empty(trim($_POST['password'])))
				{
					$email = trim($_POST['email']);
					$password = $_POST['password'];
					
					/*
					 * if credentials are correct, function returns user data
					 * else, it returns false
					 */
					$user_data = $this->model->getUser($email);


					/*
					 * if email and password match, user is redirected to results screen
					 * else Login screen is shown with error message
					 */
					if($user_data !== false && password_verify($password, $user_data->password))
					{
						$this->set_user_data($user_data);
						$location = URL_WITH_INDEX_FILE . 'results/index';
        				header('location: ' . $location);
        				exit();
					}
					else{
						$login_failed = true;
						$status = "Email or password is invalid!";
					}
				}
				else
				{
					$login_failed = true;
					$status = "Email or password is invalid!";
				}
				
			}

			//if there was registration atempt
			if(isset($_POST['register']))
			{

				if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['re_password']) && isset($_POST['name'])
					&& !empty(trim($_POST['email']))  && !empty(trim($_POST['password']))  && !empty(trim($_POST['re_password']))  && !empty(trim($_POST['name'])))
				{

					$email = $_POST['email'];
					$name = $_POST['name'];
					$password = $_POST['password'];
					$re_password = $_POST['re_password'];

					if($password === $re_password)
					{
						$email_exists = $this->model->emailExists($email);
						if($email_exists === false)
						{
							$user_created = $this->model->registerUser($name, $password, $email);
							if($user_created)
							{
								$registration_succeeded = true;
								$status = "User successfully registered!";
							}
							else
							{
								$registration_failed = true;
								$status = "Couldn't register user!";
							}
						}
						else
						{
							$registration_failed = true;
							$status = "Email is already registered!";
						}
					}
					else
					{
						$registration_failed = true;
						$status = "Passwords don't match!";
					}
					
				}
				else
				{
					$registration_failed = true;
					$status = "Email, password or name is invalid!";
				}
			}
		}
		require_once APP . 'views/login/index.php';
	}

	public function logout()
	{
        Session::_start();
        Session::_destroy();
        header('location: ' . URL_WITH_INDEX_FILE . 'login/index');
	}


}

?>