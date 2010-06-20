<?php include_partial('tweet/search', array('screen_name' => $screenName, 'name' => $user->getName())) ?>

<?php if(count($tweets) == 0): ?>
<h3>0 Tweets found from <?php echo $user->getName() ?> matching: "<?php echo $query ?>"</h3>
<?php endif; ?>

<?php if(count($tweets) == 1): ?>
<h3>1 Tweet found from <?php echo $user->getName() ?> matching: "<?php echo $query ?>"</h3>
<?php endif; ?>

<?php if(count($tweets) > 1): ?>
<h3><?php echo count($tweets) ?> Tweets found from <?php echo $user->getName() ?> matching: "<?php echo $query ?>"</h3>
<?php endif; ?>

<?php include_partial('tweet/list', array('tweets' => $tweets))?>
