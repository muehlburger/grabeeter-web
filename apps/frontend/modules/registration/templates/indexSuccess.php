<h2>Tell us your Username</h2>
<p>Here you can register your Twitter username. Registering your username enables you to 
use Grabeeter. We cannot grab your tweets without knowing your username.</p>
<p>After the registration it my last some time until you show up on Grabeeter. This is normal and 
we are working on improving this behaviour.</p>
<div>
<form action="<?php echo url_for('@registration') ?>" method="POST">
	<?php echo $form ?>
	<input type="submit" value="Submit" />
</form>
</div>