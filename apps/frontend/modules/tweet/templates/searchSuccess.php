<h2>Search in your Tweets</h2>

<div class="search">
<form action="<?php echo url_for('@tweet_search') ?>" method="get">
  <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
  <img id="loader" src="../images/loader.gif" style="vertical-align: middle; display: none"/>
  <input type="submit" value="search" />
  <div class="help">Enter some keywords (eg. web, eLearning, ...)</div>
</form>
</div>

<h3>List of Tweets</h3>
<?php include_partial('tweet/list', array('tweets' => $tweets))?>
