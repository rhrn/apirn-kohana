<!DOCTYPE html>
<html lang="en">

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

  <script data-main="/static/js/config" src="/static/js/libs/require-2.0.2.min.js"></script>

</head>

<body>

  <div class="navbar">
    <div class="navbar-inner">
      <div class="container">
        <ul class="nav nav-pills">
          <li><a href="/admin/users">Users</a></li>
        </ul>
      </div>
    </div>
  </div>

	<div class="container-fluid">
		<?php echo $view ?>
	</div>

</body>

</html>
