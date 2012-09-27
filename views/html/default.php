<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php echo $title ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/static/css/bootstrap.min.css">
  <link rel="stylesheet" href="/static/css/bootstrap-responsive.min.css">

	<?php if (!empty($styles)): ?><?php foreach ($styles as $style): ?>
	<link rel="stylesheet" href="<?php echo $style['href'] ?>">
	<?php endforeach ?><?php endif ?>

  <script src="/static/js/libs/modernizr-2.5.3.custom.js"></script>

</head>

<body>

	<div class="container-fluid">
			<ul class="nav nav-pills">
			</ul>
		<?php echo $view ?>
	</div>
	<script src="/static/js/libs/json2.js"></script>
	<script src="/static/js/libs/jquery-1.7.2.min.js"></script>
	<script src="/static/js/libs/underscore-1.3.3.min.js"></script>
	<script src="/static/js/libs/backbone-min.js"></script>
	<script src="/static/js/libs/amplify.store.js"></script>
	<script src="/static/js/libs/bootstrap.min.js"></script>
	<?php if (!empty($scripts)): ?><?php foreach ($scripts as $script): ?>
	<script src="<?php echo $script['src'] ?>"></script>
	<?php endforeach ?><?php endif ?>

</body>

</html>
