<?php
// Account & API Account Information
$user = "your last.fm username here"; // <---- Your username goes here
$key = "your api key here"; //<-- Your API key goes here
// The URL of the request to API Service
$url = "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=$user&api_key=$key&format=json";
// Enable Shortening
$short_titles = false;
// Setup cURL for request
$ch = curl_init( $url );
// Options for cURL
$options = array(
	CURLOPT_RETURNTRANSFER => true
	);
curl_setopt_array($ch, $options);
// Execute cURL and save return to $json
$json = curl_exec($ch);
// Close the connection
curl_close($ch);
// Decode JSON response to array.
$data = json_decode($json,true);
// Get only the latest track information
$last = $data['recenttracks']['track'][0];
// Is now playing attribute present?
if (isset($last['@attr']['nowplaying'])) {
	// Echo now playing information.
	$output = "I am currently listening to " . $last['name'] . ' by ' . $last['artist']['#text'] . " on Spotify.";
	if ($short_titles) {
		$output = sTrim($output);
	}
	echo trim($output);
} else {
	// Collect info on when this was last played and get the current UNIX time.
	$played = $last['date']['uts']; $now = time();
	// Get the difference
	$diff = abs($now - $played);
	// format hours
	$hours = intval(intval($diff) / 3600); 
	// format minutes
	$minutes = intval(($diff / 60) % 60);
	// IF hours is empty(equal to zero) 
	if (!empty($hours)) {
		if ($hours > 24) // Is it more than 1 day?
			$time = "over a day ago";
		else
			$time = $hours . " hours and " . $minutes . " minutes ago.";
	} else
		$time = $minutes . " minutes ago";
	$output = "I last listened to " . $last['name'] . ' by ' . $last['artist']['#text'] . " $time on Spotify";
	if ($short_titles) {
		$output = sTrim($output);
	}
	echo trim($output);
}
exit();

function sTrim($output) {
	$output = preg_replace("/- Live/i", "", $output);
	$output = preg_replace("/- Album Version Explicit/i", "", $output);
	$output = preg_replace("/- Explicit Album Version/i", "", $output);
	$output = preg_replace("/- Explicit Version/i", "", $output);
	$output = preg_replace("/- Album Version/i", "", $output);
	$output = preg_replace("/\\[(.*?)\]/i", "", $output);
	$output = preg_replace("/\\((.*?)\)/i", "", $output);
	return $output;
}
?>