<?php 
require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(17);

$t->comment('::slugify()');
$t->is(Tweetex::slugify('Tweetex'), 'tweetex', '::slugify() converts all characters to lower case');
$t->is(Tweetex::slugify('Tweetex Info'), 'tweetex-info', '::slugify() replaces a white space by a -');
$t->is(Tweetex::slugify('tweetex    info'), 'tweetex-info', '::slugify() replaces several white spaces by a single -');
$t->is(Tweetex::slugify('  tweetex'), 'tweetex', '::slugify() removes space - at the beginning of a string');
$t->is(Tweetex::slugify('tweetex  '), 'tweetex', '::slugify() removes space - at the end of a string');
$t->is(Tweetex::slugify('graz,austria'), 'graz-austria', '::slugify() replaces non-ASCII characters by a -');
$t->is(Tweetex::slugify(''), 'n-a', '::slugify() converts the empty string to n-a');
$t->is(Tweetex::slugify('   -    '), 'n-a', '::slugify() converts a string that only contains non-ASCII characters to n-a');
$t->is(Tweetex::slugify('Développeur Web'), 'developpeur-web', '::slugify() removes accents');
$t->is(Tweetex::slugify('Herbert Mühlburger'), 'herbert-muehlburger', '::slugify() removes German Umlaute');
$t->is(Tweetex::extractMentionedScreennames("@hmuehlburger"), array('hmuehlburger'), '::extractMentionedScreennames() extracts 1 username');
$t->is(Tweetex::extractMentionedScreennames("@cathywonderful Thanks for the quick response. Dunno what's up with my e-mail. Looking forward to @campbeer #STOUTAPALOOZA!"), array('cathywonderful', 'campbeer'), '::extractMentionedScreennames() extracts 2 usernames');
$t->is(Tweetex::extractMentionedScreennames("@hmuehlburger @flowolf     @behi_at       @mebner Thanks for the quick response. Dunno what's up with my e-mail. Looking forward to @campbeer #STOUTAPALOOZA!"), array('hmuehlburger', 'flowolf', 'behi_at', 'mebner', 'campbeer'), '::extractMentionedScreennames() extracts more than 2 usernames');
$t->is(Tweetex::extractMentionedScreennames("just"), array(), '::extractMentionedScreennames() ignores tweets without usernames');
$t->is(Tweetex::extractMentionedScreennames("@William_Antonio: @richardbair:"), array('William_Antonio', 'richardbair'), '::extractMentionedScreennames() extracts usernames');
$t->is(Tweetex::extractMentionedScreennames("RT @behi_at: RT @phish108 JTEL Winter School 2010 is supporting next generation researcher of #stellarnet http://tinyurl.com/ydjylab"), array('behi_at', 'phish108'), '::extractMentionedScreennames() extracts usernames');
$t->is(Tweetex::extractMentionedScreennames("RT @mahara_project: RT @mjollnir trumpet tooting, mahara in today's berner zeitung: http://liip.to/Zi and english http://liip.to/Zk"), array('mahara_project', 'mjollnir'), '::extractMentionedScreennames() extracts usernames'); 