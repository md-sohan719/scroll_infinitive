<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Scroll Infitive Dynamic</title>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
	<style>
		body {
			background-color: #dbf6e9;
			color: #31326f;
		}

		.jumbotron {
			background-color: #ffdada;
			box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
		}

		.card {
			background-color: #9ddfd3;
			box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
		}
	</style>
</head>

<body>
	<div class="content-wrapper">
		<div class="container" style="margin-top: 1rem;">
			<div class="jumbotron text-center py-3">
				<h1>Infinite scroll Ajax call API</h1>
				<p class="lead">Stay on the one page with infinite scrolling and fetching with Ajax.</p>
				<p>Keep on scrolling...</p>
			</div>
			<div class="list text-center">

			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js'></script>
	<script>
		var currentscrollHeight = 0;
		var count = 0;

		jQuery(document).ready(function($) {
			for (var i = 0; i < 8; i++) {
				callData(count); //Call 8 times on page load
				count++;
			}
		});

		$(window).on("scroll", function() {
			const scrollHeight = $(document).height();
			const scrollPos = Math.floor($(window).height() + $(window).scrollTop());
			const isBottom = scrollHeight - 100 < scrollPos;

			if (isBottom && currentscrollHeight < scrollHeight) {
				//alert('calling...');
				for (var i = 0; i < 6; i++) {
					callData(count); //Once at bottom of page -> call 6 times
					count++;
				}
				currentscrollHeight = scrollHeight;
			}
		});


		function callData(counter) {
			$.ajax({
				type: "GET",
				url: "https://random-word.ryanrk.com/api/en/word/random",
				dataType: "json",
				success: function(result) {
					//alert(result[0]);
					$('<div class="card my-4 py-3"><h4 class="card-title">' + result[0] + '</h4><p>' + counter + '</p></div>').appendTo('.list');
				},
				error: function(result) {
					//alert("error");
					$('<div class="card my-4 py-3"><h4 class="card-title">API call failed</h4><p>' + counter + '</p></div>').appendTo('.list');
				}
			});
		}
	</script>
</body>

</html>
