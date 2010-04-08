<?php 
include(dirname(__FILE__).'/../../bootstrap/Doctrine.php');

$t = new lime_test(1);

$t->comment('->getTextSlug()');
$tweet = Doctrine_Core::getTable('Tweet')->createQuery()->fetchOne();
$t->is($tweet->getTextSlug(), Tweetex::slugify($tweet->getText()), '->getTextSlug() return the slug for the tweet text');