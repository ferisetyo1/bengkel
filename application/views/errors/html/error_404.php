<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>404 - Mazer Admin Dashboard</title>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= config_item('base_url');?>assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?= config_item('base_url');?>assets/vendors/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" href="<?= config_item('base_url');?>assets/css/app.css">
	<link rel="stylesheet" href="<?= config_item('base_url');?>assets/css/pages/error.css">
</head>

<body>
	<div id="error">
		<div class="error-page container">
			<div class="col-md-8 col-12 offset-md-2">
				<img class="img-error" src="<?= config_item('base_url');?>assets/images/samples/error-404.png" alt="Not Found">
				<div class="text-center">
					<h1 class="error-title"><?php echo $heading; ?></h1>
					<p class='fs-5 text-gray-600'><?php echo $message; ?></p>
					<a href="<?= config_item('base_url');?>" class="btn btn-lg btn-outline-primary mt-3">Go Home</a>
				</div>
			</div>
		</div>
	</div>
</body>

</html>