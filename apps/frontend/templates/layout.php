<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include_slot('title', 'Grabeeter - Grab and Search your Tweets') ?></title>

<?php include_javascripts() ?>
<?php include_stylesheets() ?>
<link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>
<div id="container" class="container_16">
<div id="header" class="grid_16">
<div class="grid_3 round alpha">
		<a href="<?php echo url_for('@homepage') ?>"><img alt="Grabeeter - Grab and Search your Tweets" title="Grabeeter - Grab and Search your Tweets" src="/images/logo.png" width="128px" height="128px" /></a>
</div>
<div id="logo" class="grid_6">
<h1><a href="<?php echo url_for('@homepage') ?>">Grabeeter</a></h1>
<h2><a href="<?php echo url_for('@homepage') ?>">Grab and Search your Tweets</a></h2>
</div>

<ul id="navbar" class="grid_7 omega round">
	<li><?php echo link_to('Search', '@user') ?></li>
	<li><?php echo link_to('Register', '@registration') ?></li>
	<li><?php echo link_to('API', '@help_api')?></li>
	<li><?php echo link_to('FAQs', '@help_faq')?></li>
	<li><?php echo link_to('Help', '@help_userguide')?></li>
</ul>
</div>
<!-- end header -->
<div id="content" class="grid_11 round">
<div><?php echo $sf_content ?></div>
</div>
<!-- end content -->
<div id="sidebar" class="grid_5 round">
<div>
<?php if(!include_slot('sidebar')): ?>
	<?php include_partial('help/sidebar') ?>
<?php endif; ?>
</div>
</div>
<!-- end sidebar -->
<div id="footer" class="grid_16 round">
<p>&copy; 2010 <?php echo link_to('Social Learning', 'http://portal.tugraz.at/portal/page/portal/TU_Graz/Studium_Lehre/tugnet_vl_start/tugnet_vl_elearning', array('target' => '_blank')) ?>
- <?php echo link_to('Graz University of Technology', 'http://www.tugraz.at', array('target' => '_blank')) ?>
<!-- | Terms of Usage | Privacy Policy --> | <?php echo link_to('Imprint', 'http://portal.tugraz.at/pls/portal/TU_GRAZ.PORTLET_PAGE_IMPRESSUM.show_page_imp?pPageId=1&pSiteId=75&pLanguage=d', array('target' => '_blank')) ?>| <a href="mailto:tugtc@tugraz.at">Contact</a></p>
</div>
<!-- end footer --></div>
<!-- end container -->
</body>
</html>
