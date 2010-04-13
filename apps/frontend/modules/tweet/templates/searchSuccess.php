<h2>What do you want to find?</h2>

<div class="search">
<form action="<?php echo url_for('@tweet_search') ?>" method="get">
  <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
  <img id="loader" src="images/loader.gif" style="vertical-align: middle; display: none"/>
  <input type="submit" value="search" />
  <div class="help">Enter some keywords (eg. web, eLearning, ...)</div>
</form>
</div>

<h3>Try out our Grabeeter Client</h3>
<p>Grabeeter is a JavaFX application and enables you to search your tweets offline. You don't have to have an internet
connection to search in your tweets. </p> 
<a href="http://vlpc01.tugraz.at/projekte/herbert/tweetex/web/Grabeeter.jnlp" title="Grabeeter"><img src="images/jws-launch-button.jpg" title="Grabeeter Client" alt="Grabeeter Client" /></a>

<h3>Results</h3>
<?php include_partial('tweet/list', array('tweets' => $tweets))?>
