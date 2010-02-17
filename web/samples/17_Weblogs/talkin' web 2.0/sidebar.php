
<!-- begin sidebar -->
<div id="sidebar">
     <div class="section">
                             <h3>Latest <em>5 Posts</em></h3>
                        <ul class="date">
                    	<?php wp_get_archives('type=postbypost&limit=20&format=custom&before=<li>&after=</li>'); ?>
                        </ul>
     </div>

     <div class="section about">
                    <h3>About</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed do eiusmod.  <a class="more">Find out more</a></p>
     </div>

<?php
      	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

                <div class="section">
                    <div class="column">
                        <h3>Browse <em>by Topic</em></h3>
                        <ul class="tag">
                    	<?php wp_list_categories('orderby=name&title_li=&show_count=1'); ?> 
                            <li class="lastchild"><a>Layout</a></li>
                        </ul>
                    </div>
                    <div class="column">
                        <h3>Browse <em>by Date</em></h3>
                        <ul class="date">
                    	<?php wp_get_archives('type=monthly&title_li=&show_post_count=1'); ?> 
                        </ul>

                    </div>
                </div>
                <div class="section">
                    <img src="wp-content/themes/web20/images/dummy_googleads.gif" alt="Placeholder">
                </div>

                <div class="section">
                    <div class="column">
                        <h3>Site <em>Options</em></h3>
                        <ul class="tag">
                    	<?php wp_list_pages('title_li='); ?> 
                        </ul>
                    </div>
                    <div class="column">
                    	<?php wp_list_bookmarks('title_li=&title_before=<h3>&title_after=</h3>&category_before=&category_after='); ?> 
                    </div>
                </div>
                
                <div class="section">
                    <div class="column">
                        <h3>Meta <em>Info</em></h3>
                        <ul class="tag">
		<?php wp_register(); ?>
		<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
		<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
		<li class="lastchild"><?php wp_loginout(); ?></li>
                        </ul>
                    </div>
                    <div class="column">
                        <h3>Meta <em>Data</em></h3>
                        <ul class="date">
		<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>'); ?></a></li>
		<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
		<?php wp_meta(); ?>
		<li class="lastchild"><a href="http://wordpress.org/" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.'); ?>"><abbr title="WordPress">WP</abbr></a></li>
                        </ul>
                    </div>
                </div>

<?php endif; ?>


            </div>
<!-- end sidebar -->
