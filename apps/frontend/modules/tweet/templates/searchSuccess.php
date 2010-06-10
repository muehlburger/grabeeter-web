<h2>What do you want to find?</h2>

<?php include_partial('tweet/search', array('screen_name' => $screenName)) ?>

<h3>Try out our Grabeeter Client</h3>
<p>Grabeeter is a JavaFX application and enables you to search your tweets offline. You don't have to have an internet
connection to search in your tweets. </p> 
<a href="http://vlpc01.tugraz.at/projekte/herbert/t/dist/Grabeeter.jnlp" title="Grabeeter"><img src="/images/jws-launch-button.gif" title="Grabeeter Client" alt="Grabeeter Client" /></a>
<br />
<a href="http://vlpc01.tugraz.at/projekte/herbert/t/dist/Grabeeter.html">Access Grabeeter Site</a>

<h3>Results</h3>
<?php include_partial('tweet/list', array('tweets' => $tweets))?>
