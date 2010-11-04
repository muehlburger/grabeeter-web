<?php
class Tweetex {

	/**
	 *
	 * Saves the username in the dedicated <code>usernames</code> and <code>newUsers</code> file.
	 * @param string $username
	 */
	public static function registerUsername($username) {

		// Remove spaces in username
		$username = preg_replace('/\s+/', '', $username);
		$filepath = sfConfig::get('sf_data_dir').'/'.sfConfig::get('app_username_file');
		$newUsers = sfConfig::get('sf_data_dir').'/newUsers';

		$storedUsernames = file_get_contents($filepath);
		$explodedStoredUsernames = explode("\n", $storedUsernames);

		if(!in_array($username, $explodedStoredUsernames)) {
			$username = $username . "\n";
			$fileContent = $username . $storedUsernames;

			$bytesStored = file_put_contents($filepath, $fileContent);
			$bytesNewUsers = file_put_contents($newUsers, $username, FILE_APPEND);
		}

	}
	/**
	 *
	 * Extracts usernames which are in the text of a tweet
	 * @param string $text
	 */
	public static function extractMentionedScreennames($tweets) {

		$usernames = array();
		foreach ($tweets as $tweet) {
			$screenNames = Twitter_Extractor::extractMentionedScreennames($tweet);
			if($screenNames  != null) {
				$usernames[] = $screenNames;
			}
		}

		$flattenedScreennames = array();
		$flattenedScreennames = Tweetex::array_flatten($usernames);

		$uniqueScreennames = array();
		foreach ($flattenedScreennames as $name) {
			if(!in_array($name, $uniqueScreennames)) {
				$uniqueScreennames[] = $name;
			}
		}

		return $uniqueScreennames;
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