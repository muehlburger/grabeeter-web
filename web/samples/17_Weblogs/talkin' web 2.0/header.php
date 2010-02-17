<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

     <head profile="http://gmpg.org/xfn/11">
	          <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	          <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>

	          <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->

	<style type="text/css" media="screen" />
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>

	          <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	          <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	          <link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

	          <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
     </head>
<body class="<?php classybody(); ?>">
     
    <div id="wrapper">
        <div id="header">
            <p id="skip"><a href="#body">Skip Navigation</a></p>
            <div id="rss">
                <dl>
                    <dt>RSS Feeds:</dt>
                    <dd><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>">Journal</a></dd>
                    <dd><a href="<?php bloginfo('comments_rss2_url'); ?>"  title="<?php _e('The latest comments to all posts in RSS'); ?>">Comments</a></dd>
                </dl>
            </div>
            <div id="search">
                <form action="<?php bloginfo('home'); ?>">
                    <p>
                        <label for="s">Search:</label>
                        <input type="text" name="s" id="s" size="15"/>
                        <button type="submit">Search</button>
                    </p>
                </form>
            </div>
            <h1 id="headline"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>

            <div id="navigation">
<ul>
	<?php 
	wp_list_pages('orderby=ID&title_li=&style=list'); ?> 
</ul>
            </div>
        </div>

<!-- end header -->
