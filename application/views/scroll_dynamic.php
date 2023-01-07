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

		.post_data {
			padding: 24px;
			border: 1px solid #f9f9f9;
			border-radius: 5px;
			margin-bottom: 24px;
			box-shadow: 10px 10px 5px #eeeeee;
		}
	</style>
</head>

<body>
	<div class="content-wrapper">
		<div class="container">
			<div class="jumbotron text-center py-3">
				<h1>Infinite scroll Ajax call from database</h1>
				<p class="lead">Stay on the one page with infinite scrolling and fetching with Ajax.</p>
				<p>Keep on scrolling...</p>
			</div>
			<div id="load_data"></div>
			<div id="load_data_message"></div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js'></script>

	<script>
		$(document).ready(function() {

			var limit = 7;
			var start = 0;
			var action = 'inactive';

			function load_data(limit, start) {
				$.ajax({
					url: "<?php echo base_url('Scroll/fetch'); ?>",
					method: "POST",
					data: {
						limit: limit,
						start: start
					},
					success: function(data) {
						if (data == '') {
							$('#load_data_message').html('<h3>No More Result Found</h3>');
							action = 'active';
						} else {
							$('#load_data').append(data);
							$('#load_data_message').html("");
							action = 'inactive';
						}
					}
				})
			}

			if (action == 'inactive') {
				action = 'active';
				load_data(limit, start);
			}

			$(window).scroll(function() {
				if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
					action = 'active';
					start = start + limit;
					setTimeout(function() {
						load_data(limit, start);
					}, 100);
				}
			});
		});
	</script>
</body>

</html>
