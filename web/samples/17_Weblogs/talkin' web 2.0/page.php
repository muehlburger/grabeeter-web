<?php
get_header();
?>
        <div id="body">
            <div id="content">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="entry" id="entry-<?php the_ID(); ?>">
	 <h3 class="storytitle"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
          <p class="date"><?php the_time('F j Y') ?></p>

	<ul class="meta"><li><?php _e("Filed under:"); ?> <?php the_category(',') ?></li><li>&#8212; <?php the_author() ?> <small>(<?php the_time() ?>)</small> <?php edit_post_link(__('edit')); ?></li></ul>


	<div class="exc">
<?php the_content('(Full article)'); ?>
	</div>

	<div class="feedback">
                    <ul class="meta">
		<?php wp_link_pages(); ?>
		<li class="comment"><?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?></li>
               </ul>
	</div>

</div>

<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php posts_nav_link(' &#8212; ', __('&laquo; Previous Page'), __('Next Page &raquo;')); ?>

<?php get_footer(); ?>
