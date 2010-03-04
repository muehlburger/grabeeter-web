<h3>List of Tweets</h3>
<p>
<strong><?php echo count($pager) ?></strong> available tweets
  <?php if ($pager->haveToPaginate()): ?>
    - currently watching at page <strong><?php echo $pager->getPage() ?></strong> (out of <?php echo $pager->getLastPage() ?> pages)
  <?php endif; ?>
</p>

<?php include_partial('tweet/list', array('tweets' => $pager->getResults())) ?>
<!-- 
<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>User</th>
      <th>Source</th>
      <th>Geolocation</th>
      <th>In reply to user</th>
      <th>In reply to status</th>
      <th>Tweet created at</th>
      <th>Tweet twitter</th>
      <th>Text</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
	<?php foreach ($pager->getResults() as $tweet): ?>
    <tr>
      <td><a href="<?php echo url_for('tweet_show', $tweet) ?>"><?php echo $tweet->getId() ?></a></td>
      <td><?php echo $tweet->getUserId() ?></td>
      <td><?php echo $tweet->getSourceId() ?></td>
      <td><?php echo $tweet->getGeolocationId() ?></td>
      <td><?php echo $tweet->getInReplyToUserId() ?></td>
      <td><?php echo $tweet->getInReplyToStatusId() ?></td>
      <td><?php echo $tweet->getTweetCreatedAt() ?></td>
      <td><?php echo $tweet->getTweetTwitterId() ?></td>
      <td><?php echo $tweet->getText() ?></td>
      <td><?php echo $tweet->getCreatedAt() ?></td>
      <td><?php echo $tweet->getUpdatedAt() ?></td>
    </tr>
    <?php $twitterUser = $tweet->getTweetUser()?>
    <?php endforeach; ?>
  </tbody>
</table>
 -->


<?php if ($pager->haveToPaginate()): ?>
<ul id="pagination-flickr">
  <?php if($pager->getPage() == 1): ?>
  	<li class="previous-off">&lt; Previous</li>
  <?php else: ?>
 	 <li class="previous"><a href="<?php echo url_for('tweet') ?>?page=<?php echo $pager->getFirstPage() ?>&n=<?php echo $twitterUser ?>">&laquo; First page</a></li>
 	 <li class="previous"><a href="<?php echo url_for('tweet') ?>?page=<?php echo $pager->getPreviousPage() ?>&n=<?php echo $twitterUser ?>"><img src="/images/previous.png" title="Previous page" alt="Previous page"/></a></li>
  <?php endif; ?>
 
  <?php foreach ($pager->getLinks() as $page): ?>
	<?php if ($page == $pager->getPage()): ?>
      <li class="active"><?php echo $page ?></li>
	<?php else: ?>
	  <li><a href="<?php echo url_for('tweet') ?>?page=<?php echo $page ?>&n=<?php echo $twitterUser ?>"><?php echo $page ?></a></li>
	<?php endif; ?>
<?php endforeach; ?>

  <?php if($pager->getPage() == $pager->getLastPage()): ?>
  	<li class="next-off">Next &gt;</li>
  <?php else: ?>
  <li class="next"><a href="<?php echo url_for('tweet') ?>?page=<?php echo $pager->getNextPage() ?>&n=<?php echo $twitterUser ?>"><img src="/images/next.png" title="Next page" alt="Next page"/></a></li>
  <li class="next"><a href="<?php echo url_for('tweet') ?>?page=<?php echo $pager->getLastPage() ?>&n=<?php echo $twitterUser ?>">Last page &raquo;</a></li>
  <?php endif; ?>
</ul>
<?php endif; ?>