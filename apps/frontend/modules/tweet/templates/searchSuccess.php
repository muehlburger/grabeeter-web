<h2>Search in your Tweets</h2>
<form action="<?php echo url_for('@tweet_search') ?>" method="get">
  <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
  <input type="submit" value="search" />
  <div class="help">Enter some keywords (eg. web, eLearning, ...)</div>
</form>

<h3>List of Tweets</h3>
<?php include_partial('tweet/list', array('tweets' => $tweets))?>
