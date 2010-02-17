<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <title>Twitarch - Export and save your tweets</title>
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
               <dd><a href="#" title="Syndicate this site using RSS">Tweets</a></dd>
               <dd><a href="#"  title="The latest comments to all posts in RSS">Users</a></dd>
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
        </ul>
        </div>
      </div>
    <div id="body">
      <div id="content">
        <?php echo $sf_content ?>
      </div>
      <div id="sidebar">
        <div class="section about"></div>
        <div class="section">
		  <div class="column"></div>
		  <div class="column"></div>
        </div>
        <div class="section"></div>
      </div>
    </div>
    <div id="footer"></div>
    </div>
  </body>
</html>
