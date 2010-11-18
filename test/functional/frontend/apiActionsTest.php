<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());
$browser->loadData();
$browser->
  info('1 - Web service security')->
 
  info('  1.1 - A token is needed to access the service')->
  get('/api/foo/jobs.xml')->
  with('response')->isStatusCode(404)->
 
  info('  1.2 - An inactive account cannot access the web service')->
  get('/api/symfony/jobs.xml')->
  with('response')->isStatusCode(404)->
  end()
;
