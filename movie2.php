<!DOCTYPE html>
<head>
<title>Rate your favorite movie</title>

<link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>


</head>

<html>


<body>


<div class="container">

<div class="row">

<div class="col-md-2"> </div>


<div class="col-md-5" style="background:#2b1b17;color:white">
<?php
function get_movie_information($name)
{
    $url = "http://www.omdbapi.com/?t=".urlencode($name); 
    // send request 
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $curlData = curl_exec($curl);
    curl_close($curl);

    return json_decode($curlData, true);
}
$arr = get_movie_information($_POST["name"]);

       
 	echo "<br>"; 
	$poster = $arr['Poster'];
	echo '<img src="' . $poster . '">';
	echo "<br>";


        echo $arr['Title'];
	echo "<br>";
	echo $arr['Year'];
	echo "<br>";
	echo $arr['Rated'];
	echo "<br>";
	echo $arr['Genre'];
	echo "<br>";

	echo $arr['Plot'];
	echo "<br>";
       
	
	




?>

</div>

</div>

</div>


<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</body>




</html>
