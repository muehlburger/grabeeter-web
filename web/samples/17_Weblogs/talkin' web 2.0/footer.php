<!-- begin footer -->
</div>

<?php get_sidebar(); ?>

        <div id="footer">
            <p>Copyright 2007 <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>. <em>All rights reserved.</em></p>
               <p><small>Created by Vitaly Friedman, Wolfgang Bartelme. // <?php echo sprintf(__("Powered by <a href='http://wordpress.org/' title='%s'>WordPress</a>"), __("Powered by WordPress, state-of-the-art semantic personal publishing platform.")); ?>, <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds.</small></p>
            <ul>
                <li><a href="http://www.w3c.org?validate=<?php bloginfo('url'); ?>">XHTML</a></li>
                <li><a href="http://www.w3c.org?validate=<?php bloginfo('url'); ?>">CSS</a></li>
                <li><a href="http://www.w3c.org?validate=<?php bloginfo('url'); ?>">508</a></li>
            </ul>
        </div>


</div>

<?php wp_footer(); ?>

</div>

</body>
</html>