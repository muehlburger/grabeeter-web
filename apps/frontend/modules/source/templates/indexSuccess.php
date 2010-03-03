<h1>Tweet sources List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Label</th>
      <th>Url</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($pager->getResults() as $tweet_source): ?>
    <tr>
      <td><a href="<?php echo url_for('source_edit', $tweet_source) ?>"><?php echo $tweet_source->getId() ?></a></td>
      <td><?php echo $tweet_source->getLabel() ?></td>
      <td><?php echo $tweet_source->getUrl() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php if ($pager->haveToPaginate()): ?>
<ul id="pagination-flickr">
  <?php if($pager->getPage() == 1): ?>
  	<li class="previous-off">&lt; Previous</li>
  <?php else: ?>
 	 <li class="previous"><a href="<?php echo url_for('source') ?>?page=<?php echo $pager->getFirstPage() ?>">&laquo; First page</a></li>
 	 <li class="previous"><a href="<?php echo url_for('source') ?>?page=<?php echo $pager->getPreviousPage() ?>"><img src="/images/previous.png" title="Previous page" alt="Previous page"/></a></li>
  <?php endif; ?>
 
  <?php foreach ($pager->getLinks() as $page): ?>
	<?php if ($page == $pager->getPage()): ?>
      <li class="active"><?php echo $page ?></li>
	<?php else: ?>
	  <li><a href="<?php echo url_for('source') ?>?page=<?php echo $page ?>"><?php echo $page ?></a></li>
	<?php endif; ?>
<?php endforeach; ?>

  <?php if($pager->getPage() == $pager->getLastPage()): ?>
  	<li class="next-off">Next &gt;</li>
  <?php else: ?>
  <li class="next"><a href="<?php echo url_for('source') ?>?page=<?php echo $pager->getNextPage() ?>"><img src="/images/next.png" title="Next page" alt="Next page"/></a></li>
  <li class="next"><a href="<?php echo url_for('source') ?>?page=<?php echo $pager->getLastPage() ?>">Last page &raquo;</a></li>
  <?php endif; ?>
</ul>
<?php endif; ?>
