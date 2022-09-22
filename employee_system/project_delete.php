<?php
session_start();
include 'app/middlewares/auth.php';
include 'app/database/models/Project.php';
if($_SESSION['user']->is_admin!=1)
    {
      header("location:index.php");
    }
if(isset($_GET['pn']))
{
    $project= new Project;
    $project->setId($_GET['pn']);
    if($project->read())
    {
        $project->delete();
        header('location: project.php');
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