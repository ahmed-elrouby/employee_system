<?php
session_start();
include 'app/middlewares/auth.php';
include 'app/database/models/Task.php';
if($_SESSION['user']->is_admin!=1)
    {
      header("location:index.php");
    }
if(isset($_GET['tn']))
{
    $task= new Task;
    $task->setId($_GET['tn']);
    if($task->read())
    {
        $task->delete();
        header('location: stask.php');
    }
    else
    {
        header('location:views/errors/404.php');    
    }
}
else
{
    header('location:views/errors/404.php');
}