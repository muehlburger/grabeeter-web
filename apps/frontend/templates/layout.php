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
    <div id="wrapper">
      <div id="header">
		<h1 id="headline"><a href="<?php echo url_for('homepage') ?>"><?php include_slot('title', 'Grabeeter - Search your Tweets') ?></a></h1>
            <ul id="nav"> 
				<li class="current"><a href="<?php echo url_for('homepage') ?>">Home</a></li> 
				<li>
					<a href="<?php echo url_for('@tweet') ?>">Tweets</a>
					<ul>
						<li><a href="<?php echo url_for('tweet_search') ?>">Search Tweets</a></li>
					</ul>
				</li>
			    <li>
			    	<a href="<?php echo url_for('user') ?>">Users</a>
			    </li>
			    <!--
			    <li>
					<a href="#">API</a>
					<ul>
						<li><a href="<?php echo url_for(array('sf_route' => 'api_tweets', 'username' => 'hmuehlburger', 'sf_format' => 'xml')) ?>">List Tweets</a></li>
						<li><a href="<?php echo url_for(array('sf_route' => 'api_search', 'q' => 'hmuehlburger', 'sf_format' => 'xml')) ?>">Search Query</a></li>
					</ul>
				</li>
		    <li><a href="<?php echo url_for('source') ?>">Sources</a></li>
				<li><a href="<?php echo url_for('geolocation') ?>">Geo Locations</a></li> 

				<li><a href="<?php echo url_for('@homepage') ?>">About</a></li> 
				<li><a href="<?php echo url_for('@homepage') ?>">Contact Us</a></li>
			-->
		  </ul>	 
	</div>
    <div id="body">
    
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
      <p>&copy 2010 Graz University of Technology | Menu by <a href="http://www.webdesignerwall.com/">WDW</a>, <a href="http://www.webdesignerwall.com/demo/css3-dropdown-menu/">E</a></p>
    </div>
    </div>
  </body>
</html>
