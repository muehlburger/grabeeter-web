<h2>Grabeeter for Developers</h2>
<p>Currently Grabeeter provides an API for exporting tweets of monitored
users. This API is not restricted and can be used anonymously.</p>

<h3>Export Tweets of a certain user</h3>
<p>Just use this REST-style api as follows.</p>

<ul>
	<li>http://grabeeter.tugraz.at/api/tweets/{twitter-username}.xml</li>
	<li>http://grabeeter.tugraz.at/api/tweets/{twitter-username}.json</li>
</ul>

In the above uri the string {twitter-username} represents the Twitter
username of the author of the tweets. The Twitter username has to be
monitored on Grabeeter otherwise you don't get returned relevant
results.

<h3>Example</h3>
<p>Suppose we want to access the tweets on Grabeeter of the Twitter user
<?php echo link_to('hmuehlburger', 'http://twitter.com/hmuehlburger', array('target' => '_blank'))?>
 in XML and JSON. In order to do so we just use the following uri:</p>

<ul>
	<li><?php echo link_to('http://grabeeter.tugraz.at/api/tweets/hmuehlburger.xml', '@api_tweets?screen_name=hmuehlburger&sf_format=xml', array('target' => '_blank')) ?></li>
	<li><?php echo link_to('http://grabeeter.tugraz.at/api/tweets/hmuehlburger.json', '@api_tweets?screen_name=hmuehlburger&sf_format=json', array('target' => '_blank')) ?></li>
</ul>

<h3>Restricted API</h3>
<p>Grabeeter also provides a restricted API which can be used to register new users. In order
to use this API you have to <a href="<?php echo url_for('affiliate_new') ?>">request for an API token</a>. This token enables you to use the restricted API.</p>

<h4>Request for registering a new User on Grabeeter</h4>
In order to register a new user on Grabeeter using the API just make a request as follows:
<ul>
	<li>http://grabeeter.tugraz.at/api/{your-token}/register/{twitter-username-to-register}</li>
</ul>

<p>Have fun! :-)</p>
