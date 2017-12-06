<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>
<!DOCTYPE html>
<html>
<head>
	<title>Error 404</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/error/index.css">

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo URL; ?>public/img/favicon.png"/>
</head>
<body>
	<div class="container">
	    <div class="error"><h1>404</h1></div>
	    <div class="error"><h2>Page Not Found</h2></div>
	    <div class="error"><a id="home" href="<?php echo URL_WITH_INDEX_FILE; ?>results/index">Take me home</a></div>
	</div>
</body>
</html>
