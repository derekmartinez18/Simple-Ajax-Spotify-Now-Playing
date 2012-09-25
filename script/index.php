<!DOCTYPE html>
<html>
  <head>
    <title>-</title>
     <link href="css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
  	<div class="container">
    <div class="content"><center><div style="padding-top:120px;"><p><small>Loading...</small><br/><img src="./img/ajax/ajax-loader6.gif"/></p></div></center></div>
</div>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
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
    </script>
  </body>
</html>