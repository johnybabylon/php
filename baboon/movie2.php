<!DOCTYPE html>

<html lang="en" dir="ltr">


<head>
<title>Rate your favorite movie</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">



<link rel='stylesheet' type='text/css' href='stylesheet.css'>

	


<script type="text/javascript" src="jquery.rateit.min.js"></script>


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

<header class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <nav>
          <ul class="nav navbar-nav navbar-left">
	    <li><a href="index.php">Home</a></li>
	 </ul>
	
          <ul class="nav navbar-nav navbar-right">
	

         <li> <form class="navbar-form navbar-right" role="search" Method='post' Action='movie2.php'>
	    <div class="form-group">
                <input type='text' name='name' class="form-control" placeholder="Search Movie..." required>
            </div>
	  </form>
	 </li>
	  

 

            <li><a href="index.php">Log In</a></li>
            <li><a href="index.php">Sign Up</a></li>

		
          </ul>
        </nav>
      </div>
    </header>

<div class="container">

<div class="row">

<div class="col-md-2"> </div>


<div class="col-md-5" style="background:black;color:white">

<?php

// code to curl OMDB website 
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

// take name from previous page, search and then assign returned json value into an array
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
      
    
        

// assign variables the value from array data obtained from curling the OMDB API
        $title = $arr['Title'];
	$year =  $arr['Year'];
	$rated = $arr['Rated'];
	$plot =  $arr['Plot'];
	$poster= $arr['Poster'];


	//now put these variables into a function that assigns turns them global

//	function global_variables() {
//		$GLOBALS['title'] = $GLOBALS['title'];
//		$GLOBALS['year'] = $GLOBALS['year'];
//		$GLOBALS['rated'] = $GLOBALS['rated'];
//		$GLOBALS['plot'] = $GLOBALS['plot'];
//	}

	
//	echo $title;
//	echo $year;
//	echo $rated;
//	echo $plot;

 
?>


<div id="jRate" style="height:10px;width: 10px;"></div>
</br>
<div id="php-data"></div>
</br>

    







<form Id='Form' Method='post' Action='movie2.php'>

<input type="submit" value="Rate Movie" name="submit" style="color:black">

<input type="hidden" value="<?php echo $title;?>" name="title">
<input type="hidden" value="<?php echo $year;?>" name="year">
<input type="hidden" value="<?php echo $rated;?>" name="rated">
<input type="hidden" value="<?php echo $plot;?>" name="plot">
<input type="hidden" value="<?php echo $poster;?>" name="poster">



</form>

<?php

$hostname='127.0.0.1';
$username='root';
$password='gatesjobs';


//$title = $arr['Title'];
//$year = $arr['Year'];
//$rated = $arr['Rated'];
//$plot = $arr['Plot'];

if(isset($_POST['submit'])){


try{

       
    $db = new PDO("mysql:host=$hostname;dbname=baboon", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	




    $stmt = $db->prepare("INSERT INTO movies(title, year, rated, plot, poster) VALUES(:title, :year, :rated, :plot, :poster)");

	$title  = $_POST['title'];
	$year   = $_POST['year'];
	$rated  = $_POST['rated'];
	$plot   = $_POST['plot'];
	$poster = $_POST['poster'];

    $stmt->execute(array(':title' => $title, ':year' => $year, ':rated' => $rated, ':plot' => $plot, ':poster' => $poster));
    
     echo "Movie added!";

  } catch(PDOException $e){
      echo "Error: " . $e->getMessage();
    }

}
    



?>


</div>

</div>

</div>








</body>




</html>
