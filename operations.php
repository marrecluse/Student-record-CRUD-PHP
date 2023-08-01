<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Operations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/js/jquery.min.js">
    <link rel="stylesheet" href="assets/bootstrap/js/bootstrap.min.js">

    <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
      <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

      <style media="screen">
        div{

          margin-top: 100px;

        }

        body{

          background-image: url("assets/images/grad.jpg");
          background-size: cover;

        }


      </style>





  </head>
  <body>

    <div class="container col-lg-6 mt-5 mb-5 bg- rounded shadow">
      <h2 class="font-bold text-white" >What you would like to do?</h2>

      <form class="form-group" action="insert.php" method="post">
      <button class="btn btn-block btn-outline-primary bg-dark text-white" type="submit" name="insert">INSERT DATA</button>
      </form>

      <form class="form-group" action="display.php" method="post">
      <button  class="btn btn-block bg-dark text-white btn-outline-primary" type="submit" name="display">DISPLAY DATA</button>
      </form>

    </div>


  </body>
</html>
