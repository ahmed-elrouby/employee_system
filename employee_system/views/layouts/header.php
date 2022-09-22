<?php
session_start();
echo '<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <!-- https://cdnjs.com/libraries/twitter-bootstrap/5.0.0-beta1 -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css"
    />

    <!-- Icons: https://getbootstrap.com/docs/5.0/extend/icons/ -->
    <!-- https://cdnjs.com/libraries/font-awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    />

    <title>'.$tilte.'</title>
  </head>
  <body class="container-fluid">
   ';
   if(isset($_SESSION['user']))
   {
    echo ' <div class="navbar navbar-dark bg-dark">
    <h2 class="col-1 text-danger ps-1">'.$_SESSION['user']->name.'</h2>
    <h2 class="col-3 text-danger ">'.$_SESSION['user']->email.'</h2>
    <h2 class="col-2 text-danger ps-1"><a class="text-decoration-none" href="index.php">Home</a></h2>';
    if($_SESSION['user']->is_admin==1)
    {
        echo '<h2 class="col-2 text-danger"><a class="text-decoration-none" href="project.php">Projects</a></h2>
        <h2 class="col-2 text-danger"><a class="text-decoration-none" href="stask.php">Tasks</a></h2>';
    }
    else
    {
        echo '<h2 class="col-2 text-danger"><a class="text-decoration-none" href="etask.php">Tasks</a></h2>';
    }
    echo'<h2 class="col-2 text-danger"><a class="text-decoration-none" href="logout.php">logout</a></h2>

</div>';
   }