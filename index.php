

<!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="assets//bootstrap/js/jquery.min.js">
     <link rel="stylesheet" href="assets/bootstrap/js/bootstrap.min.js">

     <title>Home</title>
     <style media="screen">

     body{

       background-image: url("assets/images/grad.jpg");
       background-size: cover;

     }

     div.container{
       margin-top: 30px;
     }

     </style>



   </head>
   <body>

<div class="container-fluid col-lg-12">

     <div class="container bg-light  col-6 bg-white rounded shadow-5-strong p-5">

      <form action="login.php" method="post">
          <div class="form-group mt-5">
            <div class="text-uppercase mx-auto font-weight-bold display-4">
                             Welcome 

                    </div>

            <label for="roll" class="mt-5 font-weight-bold">Username: </label>
            <input class="form-control" type="text" name="username" value="">

            <label for="pwd" class="font-weight-bold">Password: </label>
            <input class="form-control" type="password" name="pwd" value="">

          </div>

          <div class="form-group form-check">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="remember" value="">Remember me
          </label>
          </div>

          <button class="btn btn-primary btn-block font-weight-bold" type="submit" name="done">Login</button>
          </form>

     </div>
   </div>


   </body>
 </html>
