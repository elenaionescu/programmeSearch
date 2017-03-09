<?php
require_once('src/programmes.php');
header('Content-type: text/html; charset=utf-8');
mb_http_output('UTF-8');

?>
<!DOCTYPE html>
<html>
<head>
    <title>BBC radio - Programmes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="BBC iPlayer Radio">
    <meta name="keywords" content="BBC, iPlayer Radio, Radio">

    <link rel="stylesheet" href="public/css/style.css">

  <!-- Include Jquery library-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <!-- Include bootstrap CDN-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" crossorigin="anonymous"></script>

   <link rel="stylesheet" type="text/css" href="public/css/style.css">
   <script src="public/js/script.js"></script>
   <script src="public/js/autocomplete.js"></script>
</head>
<body>

<header>
  <div class='container'>
     <img src='http://static.bbci.co.uk/frameworks/barlesque/3.20.0/orb/4/img/bbc-blocks-light.png' />
  </div>
</header>

  <div id='secondary_menu'>
      <div class='container'>
          <img src='http://www.hamilton.bham.sch.uk/images/pic%20links/iplayerradio.png' class='img-responsive'>
      </div>
   </div>
  <div class='container' id='main_content'>

     <h1 class='page_title'>Search Programmes</h1>
     <div class='search'>
         <form method="post">
         	<input id="search_input" class="search_input_class" type="search" placeholder="Search for a programme title" name="q">
         	<button class="search_button" type="submit" name='search_submit' value='search_submit'>
        </form>
     </div>
	 <datalist id="programmelist"></datalist>
       <div id="loading-image"> <img src='http://gora.se/wp-content/themes/gora/imgs/ajax-loader.gif' /> </div>
       <div id='returned_result'> </div>
      <?php include('src/display.php');?>

  </div>

 <footer>
    <div class='container'>
     </div>
 </footer>

</body>
</html>