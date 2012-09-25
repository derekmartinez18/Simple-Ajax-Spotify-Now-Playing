<!DOCTYPE html>
<html>
  <head>
    <title>-</title>
     <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  	<div class="container">
	<h2>What you need</h2>
	An account with Last.fm,<br/>
	Last.FM API Key (get here),<br/>
	A Spotify Account (any type),<br/>
	Minimal Knowledge of CSS/HTML,<br/>
	Website with Jquery enabled<br/>
	<h2>Setting up</h2>
	<p>Simply edit the last.fm.php and where you see 
	<pre>$user="" $key=""</pre>
	You add your username and your API key for last.fm (NOT Spotify)</p>
	Next you'll need a simple Ajax in jQuery to access this as so: 
	<pre>&lt;script&gt;
        $(document).ready(function(){
            $.ajax({
                type: 'POST',
                url: './last.fm.php',
                data: { request: 'true' },
                success: function(reply) {
                    $('.content').html(reply);
                }
            });
        });
    &lt;/script&gt;</pre>
	<p>Now, all you need is a div or span setup to hold the content once its ready. 
	<pre>&lt;div class="content"&gt;&lt;center&gt;&lt;div style="padding-top:120px;"&gt;&lt;p&gt;&lt;small&gt;Loading...&lt;/small&gt;&lt;br/&gt;&lt;img src="./img/ajax/ajax-loader6.gif"/&gt;&lt;/p&gt;&lt;/div&gt;&lt;/center&gt;&lt;/div&gt;</pre>
	</p>
	<p>In my example, I use an ajax loading gif to hold the place. This isn't really needed but can be used as a fancy placeholder.</p>
	<h2>How it works</h2>
	<p>You need to setup your Spotify account to "scrobble" to your last.fm account. This will share your activity to Last.FM. Once you do this, when someone loads your page, 
	a request is sent to the LastFM servers where it returns the latest played songs, the script will then determine if its now playing or recent.</p>
	<h2>Results</h2>
	<p>If you last listened to a track (not in private session) over a day ago:<br/>
	<em>I last listened to Strobe by deadmau5 over a day ago on Spotify</em><br/>
	If you last listened to a track less than a day ago, but not current:<br/>
	<em>I last listened to Strobe by deadmau5 3 hours and 25 minutes on Spotify.</em><br/>
	If you are currently listening to a track:<br/>
	<em>I am currently listening to Strobe by deadmau5 on Spotify.</em></p><br/>
  </body>
</html>