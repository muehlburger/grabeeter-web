<h2>What do you want to find?</h2>

<div class="search">
<form action="<?php echo url_for('@tweet_search') ?>" method="get">
  <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="query" />
  <input type="hidden" name="screen_name" value="<?php echo $sf_request->getParameter('screen_name') ?>" id="screen_name" />
  <img id="loader" src="/images/loader.gif" style="vertical-align: middle; display: none"/>
  <input type="submit" value="search" />
  <div class="help">Enter some keywords (eg. web, eLearning, ...)</div>
</form>
</div>