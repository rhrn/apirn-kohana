<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php echo $title ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width, height=device-height, maximum-scale=1.0, minimum-scale=1.0">

  <link rel="stylesheet" href="/static/css/bootstrap.min.css">
  <link rel="stylesheet" href="/static/css/bootstrap-responsive.min.css">

</head>

<body>

	<div class="container-fluid">

		<div class="row-fluid">
			<div class="span12">
      </div>
		</div>

		<div class="row-fluid">

			<div class="span4">
        <!-- <a id="logo" href="/"><img src="/static/img/logo.png" alt=""></a> -->
      </div>

      <?php echo $view ?>

		</div>

    <div class="row-fluid">
      <div class="span4">
      </div>
    </div>

	</div>

  <script src="/static/js/libs/json2.js"></script>
  <script src="/static/js/libs/jquery.min.js"></script>
  <script src="/static/js/libs/underscore.min.js"></script>
  <script src="/static/js/libs/backbone.min.js"></script>
  <script src="/static/js/libs/bootstrap.min.js"></script>
  <script src="/static/js/libs/amplify.store.js"></script>
  <script src="/static/js/apps/init.js"></script>
  <?php if (!empty($scripts)): ?><?php foreach ($scripts as $script): ?>
  <script src="<?php echo $script['src'] ?>"></script>
  <?php endforeach ?><?php endif ?>

</body>

</html>
