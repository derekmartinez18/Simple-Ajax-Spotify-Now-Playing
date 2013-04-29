AJAX and Last.FM powered Spotify plugin
==================

This is a simple plugin created to display what you are currently listening to on Spotify (www.spotify.com) using Last.FM (www.last.fm). 

Getting Started
--------------

**This plugin requires the following:**
- Last.FM Account with registered API
- Website with PHP
- Spotify Account (any type)
- Spotify client scrobbling to Last.FM

Jquery/Ajax
--------------

**You need this code and call it when document loads**

	function get_spotify() {
		$.ajax({
			type: 'POST',
			url: './last.fm.php',
			data: { request: 'true' },
			success: function(reply) {
				$('.now-playing').html("<p>" + reply +" on Spotify</p>");
			}
		});
	}
	
*You can create your own if you want, this was something I wrote quickly*

Configuring
--------------
**Last.FM.php**

**$user = "your last.fm username here";**
	
kind of explains it self, in the qoutes add your last.fm username.

**$key = "your api key here";**
	
again, self explained you'll get a key from Last.FM API place it here.

**$short_titles = false;**
	
If true will trim certain additional text

Updates
--------------
[4/29] 
- Added trimming of useless text like "Album Version", "Explicit Version", "Live" and "(blah blah blah)"
- Cleaned Code