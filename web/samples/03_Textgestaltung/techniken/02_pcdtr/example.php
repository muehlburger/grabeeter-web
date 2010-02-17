<?

session_start();
$heading_css = 'headings.css';

function getheadings($buffer) {
	global $heading_css;
	
	$tags = array('<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>');
	$pattern = '/(<\/?(?: .*|h1|h2|h3|h4|h5|h6)>)/ims';
	
	if (!is_array($_SESSION['pcdtr']) || $_GET['debug']) {
		if (is_readable($heading_css)) {
			$style_array = file($heading_css);
		
			if (is_array($style_array)) {
				foreach ($style_array as $k => $prop) {
					if (in_array('<'.trim(str_replace('{', '', $prop)).'>', $tags)) {
						$curr = trim(str_replace('{', '', $prop));
					} else {
						$dets = explode(':', $prop);
						if ($curr && $dets[0] && $dets[1]) {
							$_SESSION['pcdtr'][$curr][trim($dets[0])] = trim(str_replace('pt', '', str_replace('}', '', str_replace(';', '', $dets[1]))));
						}
					}
				}
			}
		} 
	}

	$html_array = preg_split ($pattern, trim ($buffer), -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
	
	if (is_array($html_array)) {
		foreach ($html_array as $k => $html) {
			if (in_array($html, $tags)) {
				$next_k = $k + 1;
				$clean_tag = str_replace('>', '', str_replace('<', '', $html));
				
				$page .= '<'.$clean_tag.' style="background-image:url(image.php?text='.urlencode(strip_tags($html_array[$next_k])).'&amp;tag='.$clean_tag.');">';
			} else {
				$page .= $html;
			}
		}
	}
	
	return $page;
}

ob_start("getheadings");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
     <head>
          <title>PHP + CSS Dynamic Text Replacement (P+C DTR)</title>
          <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
          <link href="site-styles.css" rel="stylesheet" type="text/css" />
          <link href="print.css" rel="stylesheet" type="text/css" media="print" />
          <link href="headings.css" rel="stylesheet" type="text/css" media="screen, projection" />
     </head>
<body>
	<h1>PHP + CSS Dynamic Text Replacement</h1>
	<h2>P+C DTR Notes</h2>
	<p>There are a couple things to keep in mind when using this method. If you find a solution to these problems or an entirely new &amp; improved replacement method, <a href="http://www.artypapers.com/about/rmcox.php">please let me know</a>.</p>
	<h3>Things You Can't Do</h3>
	<ol>
		<li>You can't give your headings an id or class or any other attributes</li>
		<li>You can't have any tags nested in your heading -- all tags will be striped</li>
		<li>You can't have long heading text -- there is no word-wrapping</li>
		<li>You can't change the heading styles from page to page on the same site</li>
	</ol>
	<h3>On Printing</h3>
	<p>P+C DTR uses a print style guide that resets the text indent setting and the heading style sheet does not have the print media type, so it won't be used at all.  This works great UNLESS the browser is set to print background images then it looks like crap.  Keep that in mind.</p>
	<h4>Another Sub Heading</h4>
	<h5>And Another Still...</h5>
	<h6>End of the line</h6>

</body>
</html>
<?

ob_end_flush();

?>