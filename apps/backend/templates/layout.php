<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Grabeeter Admin Interface</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_stylesheet('admin.css') ?>
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="container">

<?php if ($sf_user->isAuthenticated()): ?>
<div id="menu">
<ul>
	<li><?php echo link_to('Affiliates', 'affiliate') ?> - <strong><?php echo Doctrine_Core::getTable('Affiliate')->countToBeActivated() ?></strong></li>
	<li><?php echo link_to('Tweet Management', 'tweet') ?></li>
	<li><?php echo link_to('Twitter Users', 'tweet_user') ?></li>
	<li><?php echo link_to('Backend Users', 'sf_guard_user') ?></li>
	<li><?php echo link_to('Groups', 'sf_guard_group') ?></li>
	<li><?php echo link_to('Permissions', 'sf_guard_permission') ?></li>
	<li><?php echo link_to('Logout', 'sf_guard_signout') ?></li>
	
</ul>
</div>
<?php endif ?>
<div id="content">
        <?php echo $sf_content ?>
      </div>
 
    </div>
  </body>
</html>
