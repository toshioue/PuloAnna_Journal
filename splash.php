<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Pulo Anna's Journal</title>

    <link rel="icon" type="image/png" href="img/icon.png">

  <!--Bootsrap/JS dependencies-->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/js/popper.min.js"></script>
  <script src="bootstrap/js/jquery-slim.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="ajax.js"></script> <!--this is for quotes API in ajax.js -->

  <!--Lato font -->
  <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

  </head>
  <body>
    <div id="splash" class="container text-center centered" style="background-image: url(img/notebook.png); background-position: center; background-size:cover;">
      <h1 class="display-2 text-white">Welcome to Pulo Anna's Journal </h1>
      <a href="index.php" class=" mt-4 btn-color btn btn-lg btn-block rounded-3">Get Started</a>

    </div>

  <script>
  $("#splash").hide();
  $( "#splash" ).fadeTo(2000, 1);

  </script>

  </body>
</html>
