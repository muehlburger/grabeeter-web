<?php if ($pager->haveToPaginate()): ?>
<div id="pagination">
	<ul id="pagination-clean">
	  <?php if($pager->getPage() == 1): ?>
	  	<li class="previous-off"><img src="/images/previous.png" title="Previous page" alt="Previous page"/></li>
	  <?php else: ?>
	 	 <li class="previous"><a href="<?php echo url_for($urlFor) ?>?page=<?php echo $pager->getFirstPage() ?>">&laquo; First page</a></li>
	 	 <li class="previous"><a href="<?php echo url_for($urlFor) ?>?page=<?php echo $pager->getPreviousPage() ?>"><img src="/images/previous.png" title="Previous page" alt="Previous page"/></a></li>
	  <?php endif; ?>
	 
	  <?php foreach ($pager->getLinks() as $page): ?>
		<?php if ($page == $pager->getPage()): ?>
	      <li class="active"><?php echo $page ?></li>
		<?php else: ?>
		  <li><a href="<?php echo url_for($urlFor) ?>?page=<?php echo $page ?>"><?php echo $page ?></a></li>
		<?php endif; ?>
	<?php endforeach; ?>
	
	  <?php if($pager->getPage() == $pager->getLastPage()): ?>
	  	<li class="next-off">Next &gt;</li>
	  <?php else: ?>
	  <li class="next"><a href="<?php echo url_for($urlFor) ?>?page=<?php echo $pager->getNextPage() ?>"><img src="/images/next.png" title="Next page" alt="Next page"/></a></li>
	  <li class="next"><a href="<?php echo url_for($urlFor) ?>?page=<?php echo $pager->getLastPage() ?>">Last page &raquo;</a></li>
	  <?php endif; ?>
	</ul>
</div>
<?php endif; ?>