<?php
class Tweetex {

	/**
	 *
	 * Extracts usernames which are in the text of a tweet
	 * @param string $text
	 */
	public static function extractMentionedScreennames($tweet) {
		return Twitter_Extractor::extractMentionedScreennames($tweet);
	}
	
	public static function array_flatten($array, $return) {
		for($x = 0; $x < count($array); $x++) {
			if(is_array($array[$x])) {
				$return = array_flatten($array[$x], $return);
			} else {
				if($array[$x]) {
					$return[] = $array[$x];
				}
			}
		}
		return $return;
	}

	public static function generateLink($text) {

		return $text;
	}

	public static function slugify($text)
	{
			
		// replace non letter or digits by -
		$text = preg_replace('#[^\\pL\d]+#u', '-', $text);

		// trim
		$text = trim($text, '-');

		// transliterate
		if (function_exists('iconv'))
		{
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		}

		// lowercase
		$text = strtolower($text);

		// remove unwanted characters
		$text = preg_replace('#[^-\w]+#', '', $text);

		if (empty($text))
		{
			return 'n-a';
		}

		return $text;
	}

}