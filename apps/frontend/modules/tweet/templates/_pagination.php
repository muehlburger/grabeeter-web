<?php if ($pager->haveToPaginate()): ?>
<div id="pagination">
	<ul id="pagination-clean">
	  <?php if($pager->getPage() == 1): ?>
	  	<li class="previous-off"><img src="/images/previous.png" title="Previous page" alt="Previous page"/></li>
	  <?php else: ?>
	 	 <li class="previous"><a href="<?php echo url_for('@tweet') ?>?page=<?php echo $pager->getFirstPage() ?>&screen_name=<?php echo $screen_name?>"><img src="/images/first.png" title="First page" alt="First page"/></a></li>
	 	 <li class="previous"><a href="<?php echo url_for('@tweet') ?>?page=<?php echo $pager->getPreviousPage() ?>&screen_name=<?php echo $screen_name?>"><img src="/images/previous.png" title="Previous page" alt="Previous page"/></a></li>
	  <?php endif; ?>
	 
	  <?php foreach ($pager->getLinks() as $page): ?>
		<?php if ($page == $pager->getPage()): ?>
	      <li class="active"><?php echo $page ?></li>
		<?php else: ?>
		  <li><a href="<?php echo url_for('@tweet') ?>?page=<?php echo $page ?>&screen_name=<?php echo $screen_name?>"><?php echo $page ?></a></li>
		<?php endif; ?>
	<?php endforeach; ?>
	
	  <?php if($pager->getPage() == $pager->getLastPage()): ?>
	  	<li class="next-off"><img src="/images/next.png" title="Next page" alt="Next page"/></li>
	  <?php else: ?>
	  <li class="next"><a href="<?php echo url_for('@tweet') ?>?page=<?php echo $pager->getNextPage() ?>&screen_name=<?php echo $screen_name?>"><img src="/images/next.png" title="Next page" alt="Next page"/></a></li>
	  <li class="next"><a href="<?php echo url_for('@tweet') ?>?page=<?php echo $pager->getLastPage() ?>&screen_name=<?php echo $screen_name?>"><img src="/images/last.png" title="Last page" alt="Last page"/></a></li>
	  <?php endif; ?>
	</ul>
</div>
<?php endif; ?>