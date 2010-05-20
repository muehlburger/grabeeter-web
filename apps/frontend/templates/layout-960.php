<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php include_slot('title', 'Grabeeter - Grab and Search your Tweets') ?></title>
    <?php use_javascript('jquery-1.4.2.min.js') ?>
    <?php use_javascript('search.js') ?>
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>
  <div id="container" class="container_12">
  <div id="header" class="grid_12">
		<h1 id="logo"><a href="<?php echo url_for('homepage') ?>"><?php include_slot('title', 'Grabeeter - Search your Tweets') ?></a></h1>
  </div>
  <div id="navbar" class="grid_12">
        <ul> 
			<li><a href="<?php echo url_for('homepage') ?>">Home</a></li>
			<li><a href="<?php echo url_for('@tweet') ?>">Tweets</a></li>
			<li><a href="<?php echo url_for('tweet_search') ?>">Search Tweets</a></li>
			<li><a href="<?php echo url_for('user') ?>">Users</a></li>
			<li><a href="#">FAQ</a></li>
			<li><a href="#">User Guide</a></li> 
		</ul>
	</div>
	
	<div id="content" class="grid_12">
        <?php echo $sf_content ?>
    </div>
    <div id="sidebar2" class="grid_6">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <div id="col1" class="grid_3 alpha">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
        <div id="col2" class="grid_3 omega">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
    </div>
     <div id="sidebar2" class="grid_6">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <div id="col1" class="grid_3 alpha">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
        <div id="col2" class="grid_3 omega">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
    </div>
	<div id="footer" class="grid_12">
    	<p>&copy; 2010 Social Learning - Graz University of Technology | Terms of Usage | Privacy Policy</p>
    </div><!-- end footer -->    
  </div> 
  </body>
</html>
