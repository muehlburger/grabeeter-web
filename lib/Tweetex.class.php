<?php
class Tweetex {

	/**
	 *
	 * Extracts usernames which are in the text of a tweet
	 * @param string $text
	 */
	static public function extractUsernames($text) {
		$usernames = array();

		// If text contains at least one whitespace
		if(preg_match("/[\s]+/", $text)) {
			$tokenizedText = explode(' ', $text, -1);
			foreach ($tokenizedText as $token) {
				$match = preg_match("/^@[\w]+/", $token);
				if($match) {
					$token = trim($token, '@');
					$usernames[] = $token;
				}
			}
		} else {
			// Text doesn't contain a whitespace
			$match = preg_match("/^@[\w]+/", $text);
			if($match) {
				$text = trim($text, '@');
				$usernames[] = $text;
			}
		}


		return $usernames;
	}

	static public function generateLink($text) {

		return $text;
	}

	static public function slugify($text)
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