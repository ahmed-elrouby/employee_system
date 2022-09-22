<?php
$title='View Project';
include "views/layouts/header.php";
include 'app/middlewares/auth.php';
include 'app/database/models/Project.php';
if($_SESSION['user']->is_admin!=1)
    {
      header("location:index.php");
    }
echo '<h1 class="text-center">View Project</h1><table class="table">';
if(isset($_GET['pn']))
{
    $project= new Project;
    $project->setId($_GET['pn']);
    $Project=$project->read()->fetch_assoc();
    if($Project)
    {
        echo'<div class="row flex justify-content-center "><div class="col-6"><form>
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input class="form-control" value='.$Project["name"].' disabled>
          <label class="form-label">Description</label>
          <input class="form-control" value="'.$Project["description"].'" disabled>
          <label class="form-label">Start Date</label>
          <input class="form-control" value='.$Project["start_date"].' disabled>
          <label class="form-label">End Date</label>
          <input class="form-control" value='.$Project["end_date"].' disabled>
          <label class="form-label">Status</label>
          <input class="form-control" value="';
          if($Project["status"]==0)
          {
            echo "Not Active";
          }
          else
          {
            echo "Active";
          }
          echo'" disabled>
        </div>
      </form></div></div>';
        // $project->delete();
        // header('location: project.php');
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
include "views/layouts/footer.php";
?>

