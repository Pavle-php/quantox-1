<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>
<!DOCTYPE html>
<html>
<head>
	<title>Quantox Test</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo URL; ?>public/img/favicon.png"/>

	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/login/index.css"/>

	<?php if($login_failed || $registration_failed || $registration_succeeded){ ?>
	<script>	
	    function closebtn(event){
	        var div = event.target.parentElement;
	        div.style.opacity = "0";
	        setTimeout(function(){ div.style.display = "none"; }, 300);
	    }
	</script>
	<?php } ?>
</head>
<body>

	<input type="checkbox" id="form-switch" <?php echo ($registration_failed || $registration_succeeded) ? "checked='checked'" : ""; ?> />

	<form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<fieldset>
			<legend>SIGN IN</legend>
			<input type="email" placeholder="Enter email" name="email" autocomplete="off" required />
			<input type="password" placeholder="Enter Password" name="password" autocomplete="off" required />
			<button type="submit" name="login">Sign In</button>
			<label class="switch" for="form-switch"><span>Don't have an account? Register</span></label>
			<?php if($login_failed){ ?>
			<div class="alert error">
				<span class="closebtn" onclick="closebtn(event)">&times;</span>  
				<strong>Error!</strong> <?php echo $status; ?>
			</div>
			<?php } ?>
		</fieldset>
	</form>

	<form id="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<fieldset>
			<legend>REGISTER</legend>
			<input type="text" placeholder="Enter name" name="name" required>
			<input type="email" placeholder="Enter email" name="email" autocomplete="off" required />
			<input type="password" placeholder="Enter Password" name="password" required>
			<input type="password" placeholder="Repeat Password" name="re_password" required>
			<button type="submit" name="register">Register</button>
			<label class="switch" for="form-switch"><span>Already Member? Sign In Now...</span></label>
			<?php if($registration_failed){ ?>
			<div class="alert error">
				<span class="closebtn" onclick="closebtn(event)">&times;</span>  
				<strong>Error!</strong> <?php echo $status; ?>
			</div>
			<?php } else if($registration_succeeded){?>
			<div class="alert success">
				<span class="closebtn" onclick="closebtn(event)">&times;</span>  
				<strong>Success!</strong> <?php echo $status; ?>
			</div>
			<?php } ?>
		</fieldset>
	</form>

</body>
</html>