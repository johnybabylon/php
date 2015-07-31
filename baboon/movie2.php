<!DOCTYPE html>
<head>
<title>Rate your favorite movie</title>

<link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
<link rel='stylesheet' type='text/css' href='stylesheet.css'>


</head>




<body>

<header class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <nav>
          <ul class="nav navbar-nav navbar-left">
	    <li><a href="index.php">Home</a></li>
	 </ul>

          <form class="navbar-form navbar-right" role="search" Method='post' Action='movie2.php'>
	    <div class="form-group">
                <input type='text' name='name' class="form-control" placeholder="Search Movie..." required>
            </div>
	  </form>
	  

          <ul class="nav navbar-nav navbar-right">
 

            <li><a href="index.php">Log In</a></li>
            <li><a href="index.php">Sign Up</a></li>

		
          </ul>
        </nav>
      </div>
    </header>
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



<form Id='Form' Method='post' Action='movie2.php'>

<input type="submit" value="Add Movie" name="submit">

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





<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</body>




</html>
