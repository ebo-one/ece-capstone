<?php
//Connect to the database
require ('../../ext_includes/capstone2.inc.php');
$db = mysqli_connect($host, $user_name, $password, $db);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Fetch album data.
$album_id = $_GET['id'];
$query = "select artist, title, year, shape
from records
where album_id = " . $album_id;
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E's Blue Note Record Collection - About</title>
  <link rel="stylesheet" href="../css/app.css" />
  <link rel="stylesheet" href="../css/styles.css" />
  <link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
  <script src="../bower_components/modernizr/modernizr.js"></script>
</head>
<body>
<div class="row fullWidth">
  <div class="large-12 columns">
    <nav class="top-bar navBar" data-topbar>
      <ul class="title-area">  
        <li class="name">
          <h1>
            <a href="#">
            E's Blue Notes
            </a>
          </h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
      </ul>

      <section class="top-bar-section">
        <ul class="right">
          <li><a href="../index.html">Intro</a></li>
          <li><a href="../about.html">About</a></li>
          <li><a href="../selling.php">Selling</a></li>
          <li><a href="../buying.html">Buying</a></li>
          <li><a href="../contact.html">Contact</a></li>
        </ul>
      </section>
    </nav>
  </div>
</div>

<div class="row">
  <div class="small-12 columns">
  	<form method="POST" action="add_rec.php"> 
  <div class="row">
    <div class="small-12 large-6 columns">
      <label>Artist
        <input type="text" name="artist" id="artist" placeholder="Artist Name" />
      </label>
    </div>
    <div class="small-12 large-6 columns">
      <label>Album
        <input type="text" name="title" id="title" placeholder="Album Title" />
      </label>
    </div>
  </div>

  <div class="row">
    <div class="small-4 columns">
      <label>Year
        <input type="text" name="year" id="year" placeholder="Release Year" />
      </label>
    </div>
    <div class="small-4 columns">
      <label>Price
        <input type="text" name="price" id="price" placeholder="Price" />
      </label>
    </div>
    <div class="small-4 columns">
      <label>Condition
        <input type="text" name="shape" id="shape" placeholder="Album Condition" />
      </label>
    </div>
  </div>

  <div class="row">
    <div class="small-12 columns">
      <a href="#" class="button radius" id="addAlbum">Submit</a>
    </div>
  </div>
  </form>
  </div>
</div>

<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<script src="../bower_components/foundation/js/foundation.min.js"></script>
<script src="../js/app.js"></script>
<script>
$(document).ready(function() {
  $("#addAlbum").click(function() {
    var artist = $("#artist").val();
    var title = $("#title").val();
    var year = $("#year").val();
    var price = $("#price").val();
    var pricePattern = new RegExp (/^([1-9]{1}[\d]{0,2}(\,[\d]{3})*(\.[\d]{0,2})?|[1-9]{1}[\d]{0,}(\.[\d]{0,2})?|0(\.[\d]{0,2})?|(\.[\d]{1,2})?)$/)
    var priceResult = price.match(pricePattern);
    var shape = $("#shape").val();

    if (artist, title, year, price, shape == "") {
      alert("Please fill out all fields.");
    }
    else if (year < 1939 || year > 2014)  {
      alert("Invalid year for Blue Note Records. Please try again.");
    }
    else if (year.length !== 4 || isNaN(year)) {
      alert("Invalid year. Please try again.");
    }
    else if (priceResult == null) {
      alert("Invalid price. Please try again.");
    }
    else if (shape !== "NM" && shape !== "E" && shape !== "VG" && shape !== "G" && shape !== "F" && shape !== "P") {
      alert("Condition can only be NM, E, VG, G, F, or P (Case-sensitive). Please try again.");
    } 
    else {
      $("form").submit();
    }
  });
});
</script>
</body>
</html>