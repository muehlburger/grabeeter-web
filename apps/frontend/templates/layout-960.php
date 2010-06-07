<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php include_slot('title', 'Grabeeter - Grab and Search your Tweets') ?></title>
    <?php use_javascript('jquery-1.4.2.min.js') ?>
    <?php use_javascript('search.js') ?>
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>
  <div id="container" class="container_16">
  <div id="header" class="grid_16">
		<h1 id="logo" class="grid_7 alpha"><a href="<?php echo url_for('homepage') ?>"><img alt="Grabeeter - Grab and Search your Tweets" src="/images/logo.png" width="128px" height="128px" /></a></h1>
        <ul id="navbar" class="grid_9 omega round"> 
			<li><a href="<?php echo url_for('@homepage') ?>">Home</a></li>
			<li><a href="<?php echo url_for('@registration') ?>">Register</a></li>
			<li><a href="<?php echo url_for('@tweet_search') ?>">Search</a></li>
			<li><a href="<?php echo url_for('@user') ?>">Users</a></li>
			<li><a href="#">FAQ</a></li>
			<li><a href="#">Guide</a></li> 
		</ul>
  </div><!-- end header -->
   	<div id="content" class="grid_11 round">
   	<div>
       <?php echo $sf_content ?>
    </div>
    </div><!-- end content -->
    <div id="sidebar" class="grid_5 round">
    	  <?php if(!include_slot('sidebar')): ?>
    	  <h2>Grabeeter</h2>
			  <p>Grabeeter - Grab and Search your Tweets</p>
		  <?php endif; ?>        
    </div>
	<div id="footer" class="grid_16 round">
    	<p>&copy; 2010 Social Learning - Graz University of Technology | Terms of Usage | Privacy Policy</p>
    </div><!-- end footer -->    
  </div> 
  </body>
</html>
