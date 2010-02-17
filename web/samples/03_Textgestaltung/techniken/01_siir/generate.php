<?php

class siir {
	/* Required image elements */
	var $h;
	var $padding;
	var $bgcolor;
	var $transparentbg;
	var $font_color;
	var $shadow_color;
	var $font_file;
	var $font_size;
	var $antialias;
	var $text;

	/* RGB color arrays */
	var $imColor;
	var $imFontColor;
	var $imShadowColor;

	/* Image dip */
	var $dip;

	/* Cache variables */
	var $cacheFile;
	var $cacheId;
	var $cacheFormat = "png"; 
	var $cacheDir = "./cache/"; 
	var $cacheURL;
	var $cacheLife = 259200; // Lifespan of a cached image

	/* The image */
	var $im;

	// SIIR class constructor
	function siir() {
		$this->h = $_REQUEST[h];
		$this->padding = $_REQUEST[padding];
		$this->bgcolor = $_REQUEST[bgcolor];
		$this->transparentbg = $_REQUEST[transparentbg];
		$this->font_color = $_REQUEST[font_color];
		$this->shadow_color = $_REQUEST[shadow_color];
		$this->font_file = $_REQUEST[font_file];
		$this->font_size = $_REQUEST[font_size];
		$this->antialias = $_REQUEST[antialias];
		$this->text = $_REQUEST[text];
		$this->text = stripslashes($this->text);
	 	$this->text = html_entity_decode($this->text);

		/* Determine cache settings */
		$this->generateCacheId();
		$this->cacheURL = $this->cacheDir.$this->cacheID.".".$this->cacheFormat;
	
		/* Check if file has previously been cached */
		if (file_exists($this->cacheURL)) {
			$this->cacheImageLink();
		} else {
			/* Create RGB color arrays */
			$this->imColor = @$this->hex2Int($this->bgcolor);
			$this->imFontColor = @$this->hex2Int($this->font_color);
			if ($this->shadow_color)
				$this->imShadowColor = @$this->hex2Int($this->shadow_color);

			/* Determine image box measurements */
			$box = imagettfbbox(($this->font_size/81*64), 0, $this->font_file, $this->text);
			$width = $box[4]-$box[6];

			/* Create the base image */
			$this->im = imageCreate(($width+($this->padding*2)),$this->h);

			/* Allocate RGB colors */
			$this->imColor = @imageColorAllocate($this->im, $this->imColor['r'], $this->imColor['g'], $this->imColor['b']);
			$this->imFontColor = @imageColorAllocate($this->im, $this->imFontColor['r'], $this->imFontColor['g'], $this->imFontColor['b']);
			
			if ($this->imShadowColor)
				$this->imShadowColor = @imageColorAllocate($this->im, $this->imShadowColor['r'], $this->imShadowColor['g'], $this->imShadowColor['b']);

			/* Determine image 'dip' */
			$this->dip = $this->getDip($this->font_file,$this->font_size);

			/* Transparent background? */
			if ($this->transparentbg == 1)
				ImageColorTransparent($this->im,$this->imColor);

			if (!$this->antialias)
				$this->imFontColor = "-".$this->imFontColor;
				$this->imShadowColor = "-".$this->imShadowColor;

			/* Create text shadow */
			if ($this->imShadowColor != "")
				imageTTFText($this->im,($this->font_size/81*64),0,(($this->padding/2)+1),(($this->font_size-$this->dip)+2),$this->imShadowColor,$this->font_file,$this->text);

			/* Create truetype text */
			imageTTFText($this->im,($this->font_size/81*64),0,($this->padding/2),(($this->font_size-$this->dip)+1),$this->imFontColor,$this->font_file,$this->text);

			/* Cache and display the image */
			$this->cacheImage();

			/* Make sure the cache is relatively clean */
			$this->cacheCleaner();

		}
	}

	// Cache and display the image
	function cacheImage() {
		$this->cacheFile = fopen($this->cacheURL,"wb");
		ob_end_clean();
		ob_start(); 

		$func = "Image".strtoupper($this->cacheFormat);
		$func($this->im);
		ImageDestroy($this->im);

		fwrite($this->cacheFile,ob_get_contents());
		fclose($this->cacheFile);

		return $this->im;

		flush();
		ob_flush();
		ob_end_clean();
	}

	// Display a previously cached image
	function cacheImageLink() {
		header("Content-Type: image/png");
		header("Content-Length: " . filesize($this->cacheURL));
		readfile($this->cacheURL);
	}

	// Clear the cache of old unviewed images
	function cacheCleaner() {
		$handle = opendir($this->cacheDir);
		while ($this->cacheFile = readdir($handle)) {
			if (time()-fileatime($this->cacheDir.$this->cacheFile)>$this->cacheLife)
				unlink($this->cacheDir.$this->cacheFile);
		}
	}

	// Convert a hexidecimal color string to an RGB array
	function hex2Int($hex) {
 		return array( 'r' => hexdec(substr($hex, 0, 2)), // 1st pair of digits
		'g' => hexdec(substr($hex, 2, 2)), // 2nd pair
		'b' => hexdec(substr($hex, 4, 2)) // 3rd pair
		);
	}

	// Determine image 'dip'
	function getDip($font,$size) {
		$test_chars = 'abcdefghijklmnopqrstuvwxyz'.
		'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.
		'1234567890'.
		'!@#$%^&*()\'"\\/;.,`~<>[]{}-+_-=';
		$box = @ImageTTFBBox($size,0,$font,$test_chars) ;
		return $box[3] ;
	}


	// Create cache file id
	function generateCacheId() {
		$this->cacheID=md5(serialize($this->h.
		$this->padding.
		$this->bgcolor.
		$this->transparentbg.
		$this->font_color.
		$this->shadow_color.
		$this->font_file.
		$this->font_size.
		$this->antialias.
		$this->text));
	}

}

// Initialize SIIR class
if ($_REQUEST[action] == 'display')
	$siir = new siir();

?>