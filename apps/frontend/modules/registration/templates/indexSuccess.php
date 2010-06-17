<h2>Tell us your Username</h2>
<p>Here you can register your Twitter username. Registering your username enables you to 
use Grabeeter. We cannot grab your tweets without knowing your username.</p>
<form action="<?php echo url_for('@registration') ?>" method="POST">
	<?php echo $form ?>
	<input type="submit" value="Submit" />
</form>
