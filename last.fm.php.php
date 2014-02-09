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
$options = array(
	CURLOPT_RETURNTRANSFER => true
	);
curl_setopt_array($ch, $options);

// Execute cURL
$json = curl_exec($ch);
curl_close($ch);
$data = json_decode($json,true);

// Get only the latest track information
$last = $data['recenttracks']['track'][0];

// Is now playing attribute present?
if (isset($last['@attr']['nowplaying'])) {

	$output = "I am currently listening to " . $last['name'] . ' by ' . $last['artist']['#text'] . " on Spotify.";

	if ($short_titles) {
		$output = sTrim($output);
	}

	echo trim($output);
} else {
	$played = $last['date']['uts']; $now = time();
	$diff = abs($now - $played);

	// Time formatting
	$hours = intval(intval($diff) / 3600); 
	$minutes = intval(($diff / 60) % 60);

	// String formatting based on time
	if (!empty($hours)) {
		if ($hours > 24)
			$time = "over a day ago";
		else
			$time = $hours . " hours and " . $minutes . " minutes ago";
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