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
		<h1 id="logo"><a href="<?php echo url_for('homepage') ?>"><?php include_slot('title', 'Grabeeter - Search your Tweets') ?></a></h1>
  </div>
  <div id="navbar" class="grid_16">
        <ul> 
			<li><a href="<?php echo url_for('homepage') ?>">Home</a></li>
			<li><a href="<?php echo url_for('@tweet') ?>">Tweets</a></li>
			<li><a href="<?php echo url_for('tweet_search') ?>">Search Tweets</a></li>
			<li><a href="<?php echo url_for('user') ?>">Users</a></li>
			<li><a href="#">FAQ</a></li>
			<li><a href="#">User Guide</a></li> 
		</ul>
	</div>
    <div id="sidebar1" class="grid_5">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <div id="col1" class="grid_2 alpha">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
        <div id="col2" class="grid_3 omega">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
    </div>
     	<div id="content" class="grid_6">
	    Search:<form action="#" method="get" enctype="text/plain"><input type="text" name="username" value="<?php if (isset($_POST['username'])) { echo $username; } ?>" size="20" maxlength="20"></form>
       <?php echo $sf_content ?>
    </div>
    <div id="sidebar3" class="grid_5">
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    <div id="col1" class="grid_3 alpha">Add your twitter username:<form action="#" method="get" enctype="text/plain"><input type="text" name="username" value="<?php if (isset($_POST['username'])) { echo $username; } ?>" size="20" maxlength="20"></form></div>
    <div id="col2" class="grid_2 omega">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>        
        
    </div>
	<div id="footer" class="grid_16">
    	<p>&copy; 2010 Social Learning - Graz University of Technology | Terms of Usage | Privacy Policy</p>
    </div><!-- end footer -->    
  </div> 
  </body>
</html>
