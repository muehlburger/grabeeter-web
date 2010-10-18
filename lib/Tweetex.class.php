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

	/**
	 *
	 * @flatten multi-dimensional array
	 *
	 * @param array $array
	 *
	 * @return array
	 *
	 */
	public static function array_flatten(array $array){
		$ret_array = array();
		foreach(new RecursiveIteratorIterator(new RecursiveArrayIterator($array)) as $value)
		{
			$ret_array[] = $value;
		}
		return $ret_array;
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