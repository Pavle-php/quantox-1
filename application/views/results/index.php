<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>
<!DOCTYPE html>
<html>
	<head>
	<title>Quantox Test</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/results/index.css">

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo URL; ?>public/img/favicon.png"/>
</head>
<body>

	<div class="tab">
		<a id="logout" class="tablinks" href="<?php echo URL_WITH_INDEX_FILE; ?>login/logout">Logout</a>
	</div>

	<div id="pending" class="tabcontent">
		<h1>Welcome, <?php echo $user->name; ?></h1>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
			<input type="text" class="search" id="search-pending" value="<?php echo @$_POST['search_term']; ?>" name="search_term" placeholder="Search for users..." title="Type in a name" style="background-image: url('<?php echo URL; ?>public/img/searchicon.png');">
			<button type="submit" id="submit">Search</button>
		</form>
			<table id="table-pending" class="table">
				<thead>
					<tr class="header">
						<th style="width:6%;">№</th>
						<th style="width:28%;">Name</th>
						<th style="width:28%;">Email</th>
					</tr>
				</thead>
				
				<tbody>
					<?php foreach ($users as $key => $user) { ?>
					<tr class="row">
						<td><?php echo $key + 1; ?></td>
						<td><?php echo $user->name; ?></td>
						<td><?php echo $user->email; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
	</div>

	</body>
</html>