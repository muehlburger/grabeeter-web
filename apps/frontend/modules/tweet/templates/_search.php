<h2>Search Tweets from <?php echo $name ?></h2>
<div class="search">
<form action="<?php echo url_for('@tweet_search') ?>" method="POST">
  <label for="query">Enter your search query (web, elearning, ...):</label>
  <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="query" class="iround" />
  <input type="hidden" name="screen_name" value="<?php echo $screen_name ?>" id="screen_name" />
  <img id="loader" src="/images/loader.gif" style="vertical-align: middle; display: none"/>
  <input type="submit" value="search" id="search"/>
</form>
</div>