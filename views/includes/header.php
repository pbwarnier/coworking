<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
	<meta charset="utf-8">
	<meta name="author" content="Pierre-Baptiste Warnier">
	<meta name="description" content="<?= $description; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="" type="image/gif">
	<?php if (!empty($_SESSION['user']) && $filename != 'introduction') : ?>
		<link rel="stylesheet" type="text/css" href="/assets/css/navbar.css">
	<?php endif; ?>
	<link rel="stylesheet" type="text/css" href="/assets/css/<?= $filename ?>.css">
	<link rel="stylesheet" type="text/css" href="/assets/libraries/bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/libraries/font-awesome-pro-5.13.0/css/all.css">
	<?php if ($filename == 'introduction' || $filename == 'dashboard') : // insert datepicker css ?>
		<link rel="stylesheet" type="text/css" href="/assets/libraries/calendar/css/bootstrap-datepicker.min.css">
	<?php endif; ?>
	<?php if ($filename == 'dashboard') : // insert timepicker css ?>
		<link rel="stylesheet" type="text/css" href="/assets/libraries/time/css/bootstrap-datetimepicker.min.css">
	<?php endif; ?>
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<?php if ($filename == 'news' || $filename == 'post' || $filename == 'dashboard' || $filename == 'profil' || $filename == 'my_account' || $filename == 'members' || $filename == 'parameters') : // insert dropdown js ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<?php endif; ?>
	<script type="text/javascript" src="/assets/libraries/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
	<?php if ($filename == 'introduction' || $filename == 'dashboard') : // insert datepicker js and langage ?>
		<script type="text/javascript" src="/assets/libraries/calendar/js/bootstrap-datepicker.min.js"></script>
		<script type="text/javascript" src="/assets/libraries/calendar/locales/bootstrap-datepicker.fr.min.js"></script>
	<?php endif; ?>
	<?php if ($filename == 'dashboard') : // insert timepicker js and langage ?>
		<script type="text/javascript" src="/assets/libraries/time/moment-with-locales.js"></script>
		<script type="text/javascript" src="/assets/libraries/time/js/bootstrap-datetimepicker.min.js"></script>
	<?php endif; ?>
	<script type="text/javascript" src="/assets/js/navbar.js"></script>
	<script type="text/javascript" src="/assets/js/<?= $filename ?>.js"></script>
</head>
<body>