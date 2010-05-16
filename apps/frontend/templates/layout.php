<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title><?php include_slot('title', 'Grabeeter - Search your Tweets') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_javascript('jquery-1.4.2.min.js') ?>
    <?php use_javascript('search.js') ?>
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
  <div id="container">
    <div id="header">
		<h1><a href="<?php echo url_for('homepage') ?>"><?php include_slot('title', 'Grabeeter - Search your Tweets') ?></a></h1>
	</div>
	<div id="navbar">
        <ul> 
			<li><a href="<?php echo url_for('homepage') ?>">Home</a></li>
			<li><a href="<?php echo url_for('@tweet') ?>">Tweets</a></li>
			<li><a href="<?php echo url_for('tweet_search') ?>">Search Tweets</a></li>
			<li><a href="<?php echo url_for('user') ?>">Users</a></li>
			<li><a href="#">FAQ</a></li>
			<li><a href="#">User Guide</a></li> 
		</ul>
	</div>
	
	<div id="content">	
    <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="flash_notice">
            <?php echo $sf_user->getFlash('notice') ?>
          </div>
        <?php endif; ?>
 
        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="flash_error">
            <?php echo $sf_user->getFlash('error') ?>
          </div>
        <?php endif; ?>
        
        <?php echo $sf_content ?>
	</div>
      
    <div id="sidebar">
    	<h2>Sidebar</h2>
    	<p>Lorem ipsum vix elit ... </p>
    	<h3>Überschrift (h3)</h3>
    	<ul>
    		<li><a href="#">Link 1</a></li>
    		<li><a href="#">Link 2</a></li>
    		<li><a href="#">Link 3</a></li>
    		<li><a href="#">Link 4</a></li>
    	</ul>
    </div>
    
    <div id="footer">
    	<p>&copy; 2010 Social Learning - Graz University of Technology | Terms of Usage | Privacy Policy</p>
    </div>
    </div>
  </body>
</html>
