<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title><?php include_slot('title', 'Twitarch - save and export your tweets') ?></title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="wrapper">
      <div id="header">
        <p id="skip"><a href="#body">Skip Navigation</a></p>
        <div id="rss">
        	 <dl>
			 <dt>RSS Feeds:</dt>
               <dd><a href="#" title="Syndicate your tweets using RSS">Tweets</a></dd>
               <dd><a href="#" title="The latest added users in RSS">Users</a></dd>
             </dl>
		</div>
        <div id="search">
        	<form action="#">
                    <p>
                        <label for="twitterUsername">Twitter Username:</label>
                        <input type="text" name="twitterUsername" id="s" size="15"/>
                        <button type="submit">Download Tweets</button>
                    </p>
                </form>
		</div>
		<h1 id="headline"><a href="<?php echo url_for('@homepage') ?>">Twitarch</a></h1>
        <div id="navigation">
        <ul>
          <li><a href="<?php echo url_for('@homepage') ?>">Home</a></li>
          <li><a href="<?php echo url_for('tweet/index') ?>">Tweets</a></li>
          <li><a href="<?php echo url_for('user/index') ?>">Users</a></li>
          <li><a href="<?php echo url_for('geolocation/index') ?>">Geo Locations</a></li>
          <li><a href="<?php echo url_for('user/searchTweets') ?>">Search Tweets</a></li>
        </ul>
        </div>
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
      <div id="sidebar">
       <!-- <div class="section about">
        	<h3>About</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor 
            	incididunt ut labore et dolore magna aliqua. Sed do eiusmod.  
            	<br /><a href="#" class="more">Find out more</a>
            </p>
     	</div>
     	<div class="section">
                    <div class="column">
                        <h3>Browse <em>by Topic</em></h3>
                        <ul class="tag">
                    		<li><a href="#">Design</a></li>
                    		<li><a href="#">JavaFX</a></li>
                    		<li><a href="#">JavaScript</a></li>
                    		<li><a href="#">e-Learning</a></li>
                    		<li><a href="#">Twitter</a></li>
                            <li class="lastchild"><a href="#">Layout</a></li>
                        </ul>
                    </div>
                    <div class="column">
                        <h3>Browse <em>by Date</em></h3>
                        <ul class="date">
                        	<li><a href="#">November 2010</a></li>
                        	<li><a href="#">December 2010</a></li>
                    		<li><a href="#">Januray 2010</a></li>
                    		<li><a href="#">February 2010</a></li>
                    		<li><a href="#">March 2010</a></li> 
                        </ul>
                    </div>
		</div>
		<div class="section">
			<img src="images/dummy_googleads.gif" alt="Placeholder Image" />
		</div>
		-->
      </div>
    </div>
    <div id="footer"></div>
    </div>
  </body>
</html>
