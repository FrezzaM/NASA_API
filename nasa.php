<?php

$todaysDate = date("Y-m-d");
$sevenDaysAgo = date('Y-m-d', strtotime('-6 days'));

if (!$urlContents = @file_get_contents("https://api.nasa.gov/planetary/apod?start_date=".$sevenDaysAgo."&api_key=eTA0IfKg7oy8Cx41GHeAsA1fc6ep4t2nkyMBgisM")) {
      $error = error_get_last();
      // echo "HTTP request failed. Error was: " . $error['message'];
} else {
      $dataArray = json_decode($urlContents, true);
}

// print_r($dataArray);
 ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Google fonts -->
  <link href="https://fonts.googleapis.com/css?family=Audiowide|Montserrat&display=swap" rel="stylesheet">
  <!-- My CSS -->
  <link rel="stylesheet" href="css/stylesN.css">
  <title>Images from Space</title>
  <link rel="icon" href="faviconN.ico">
</head>

<body>
<div class="top_container">
  <h1>Space Images of the Week</h1>
  <h5>Retrieved from NASA using their APOD API</h5>
</div>

<div class="container">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
    </ol>
    <div class="carousel-inner">

    <?php
      if($urlContents === false){
        echo '<h3>Unable to connect to the NASA website at this time. Please try again later.</h3>';
      }
      else{
        for ($i = 6; $i >= 0; $i--) {

          if ($i===6){
            echo '<div class="carousel-item active">';
          }
          else{
            echo '<div class="carousel-item">';
          }
          echo '<div class="row">';
          echo '<div class="col-sm-6 display">';
          if ($dataArray[$i]['media_type']==="video"){
            echo '<iframe width="420" height="315"';
            echo 'src="'.$dataArray[$i]['url'].'">';
            echo '</iframe>';
          }
          else{
              echo '<a href="'.$dataArray[$i]['url'].'"><img src="'.$dataArray[$i]['url'].'" alt="image from space" style="width:100%;"></a>';
          }

          if (trim($dataArray[$i]['copyright'], " ") !== ""){
            echo '<br />';
            echo '<p><em>Image Credit & Copyright: '.$dataArray[$i]['copyright'].'</em></p>';
          }
          echo '</div>';

          echo '<div class="col-sm-6 description">';
          echo '<h4>'.$dataArray[$i]['title'].'</h4>';
          echo '<h6>'.$dataArray[$i]['date'].'</h6>';
          echo '<p>'.$dataArray[$i]['explanation'].'</p>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
      }
    ?>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
