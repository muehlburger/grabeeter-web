<h2>Grabeeter for Developers</h2>
<p>Currently Grabeeter provides an API for exporting tweets of monitored users.</p>

<h3>Export Tweets of a certain user</h3>
<p>Just use this REST-style api as follows.</p>

<ul>
<li>http://www.grabeeter.dat/api/tweets/{twitter-username}.xml</li>
<li>http://www.grabeeter.dat/api/tweets/{twitter-username}.json</li>
</ul>

In the above uri the string {twitter-username} represents the Twitter username of the author
of the tweets. The Twitter username has to be monitored on Grabeeter otherwise you don't get returned
relevant results.

<h3>Example</h3>
<p>Suppose we want to access the tweets on Grabeeter of the Twitter user <?php echo link_to('hmuehlburger', 'http://twitter.com/hmuehlburger', array('target' => '_blank'))?>
 in XML and JSON. In order to do so we just use the following uri:
</p>

<ul>
<li><?php echo link_to('http://www.grabeeter.dat/api/tweets/hmuehlburger.xml', '@api_tweets?screen_name=hmuehlburger&sf_format=xml', array('target' => '_blank')) ?></li>
<li><?php echo link_to('http://www.grabeeter.dat/api/tweets/hmuehlburger.json', '@api_tweets?screen_name=hmuehlburger&sf_format=json', array('target' => '_blank')) ?></li>
</ul>

<p>Have fun! :-)</p>