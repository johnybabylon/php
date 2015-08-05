<!DOCTYPE html>

<html lang="en" dir="ltr">


<head>
<title>Rate your favorite movie</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<script src="jRate.js"></script>

	<script type="text/javascript">
		$(function () {
			var that = this;
			var toolitup = $("#jRate").jRate({
				rating: 1,
				strokeColor: 'black',
				width: 20,
				height: 20,
				precision: 0.5,
				minSelected: 1,
				onChange: function(rating) {
					console.log("OnChange: Rating: "+rating);
					var value = rating;
					$.post("data.php", {phpvalue: value}, function(data) {
					  $('div#php-data').text(data); });
					
				},
				onSet: function(rating) {
					console.log("OnSet: Rating: "+rating);
				}
			});
			
			$('#btn-click').on('click', function() {
				toolitup.setRating(0);				
			});
			
		});
	</script>
	
	

</head>

<body>

	<h1>jRate Demo Page</h1>
	<div id="jRate" style="height:10px;width: 10px;"></div>
	<button id="btn-click" style="margin:0 500px;">Reset Me</button>
	
<div id="php-data"></div>


</body>

