<?php 
require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(10);

$t->comment('::slugify()');
$t->is(Tweetex::slugify('Tweetex'), 'tweetex', '::slugify() converts all characters to lower case');
$t->is(Tweetex::slugify('Tweetex Info'), 'tweetex-info', '::slugify() replaces a white space by a -');
$t->is(Tweetex::slugify('tweetex    info'), 'tweetex-info', '::slugify() replaces several white spaces by a single -');
$t->is(Tweetex::slugify('  tweetex'), 'tweetex', '::slugify() removes space - at the beginning of a string');
$t->is(Tweetex::slugify('tweetex  '), 'tweetex', '::slugify() removes space - at the end of a string');
$t->is(Tweetex::slugify('paris,france'), 'paris-france', '::slugify() replaces non-ASCII characters by a -');
$t->is(Tweetex::slugify(''), 'n-a', '::slugify() converts the empty string to n-a');
$t->is(Tweetex::slugify('   -    '), 'n-a', '::slugify() converts a string that only contains non-ASCII characters to n-a');
$t->is(Tweetex::slugify('Développeur Web'), 'developpeur-web', '::slugify() removes accents');
$t->is(Tweetex::slugify('Herbert Mühlburger'), 'herbert-muehlburger', '::slugify() removes German Umlaute');