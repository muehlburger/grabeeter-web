<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="shortcut icon" href="/favicon.ico" />
<?php include_stylesheets() ?>
<?php include_javascripts() ?>
</head>
<body>
<?php if ($sf_user->isAuthenticated()): ?>
<div id="menu">
<ul>
	<li><?php echo link_to('Tweets', 'tweet') ?></li>
	<li><?php echo link_to('Twitter Users', 'tweet_user') ?></li>
	<li><?php echo link_to('Backend Users', 'sf_guard_user') ?></li>
	<li><?php echo link_to('Groups', 'sf_guard_group') ?></li>
	<li><?php echo link_to('Permissions', 'sf_guard_permission') ?></li>
	<li><?php echo link_to('Logout', 'sf_guard_signout') ?></li>
</ul>
</div>
<?php endif ?>

<?php echo $sf_content ?>
</body>
</html>
