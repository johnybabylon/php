<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Main</title>
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


    <div class="col-md-2"> 


<?php

	$hostname='127.0.0.1';
	$username='root';
	$password='gatesjobs';


	try {

		$db = new PDO("mysql:host=$hostname;dbname=baboon", $username, $password);

		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		

		
		$sql = "SELECT * FROM movies";


		foreach ($db->query($sql) as $row)
		{
                  echo "<div style='color: orange; background-color: #292828; border-style:hidden; padding: 25px'>";
		  echo '<img src="' . $row["poster"] . '" style="width:100px; height: 160px;" id="moviePic">';
		  echo "<br>";

		  echo $row["title"] ." ". $row["year"] ." ". $row["rated"] . "<br/>";
		  		  echo "</div>";
		  echo "</br>";
		}

		$db = null;

	}

	catch(PDOException $e)
	{
	echo $e->getMessage();
	}
?>
    </div>


  <div class="col-md-5">

<h1>Welcome to Main Page :)</h1>
  </div>
</div>
</div>


<br>
<form Id='Form' Method='post' Action='search.php'>
         
<input type="submit">
</form>


</body>

</html>
