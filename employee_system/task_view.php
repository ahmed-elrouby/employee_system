<?php
$title='View Task';
include "views/layouts/header.php";
include 'app/middlewares/auth.php';
include 'app/database/models/Task.php';
include 'app/database/models/Project.php';
include 'app/database/models/User.php';
if($_SESSION['user']->is_admin!=1)
    {
      header("location:index.php");
    }
echo '<h1 class="text-center">View Task</h1><table class="table">';
if(isset($_GET['tn']))
{
    $task= new Task;
    $task->setId($_GET['tn']);
    $Task=$task->read()->fetch_assoc();
    if($Task)
    {
        $user= new User;
        $user->setId($Task['employee_id']);
        $user_email=$user->read()->fetch_object()->email;
        $project= new Project;
        $project->setId($Task['project_id']);
        $project_name=$project->read()->fetch_object()->name;
        echo'<div class="row flex justify-content-center "><div class="col-6"><form>
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input class="form-control" value="'.$Task["name"].'" disabled>
          <label class="form-label">Description</label>
          <input class="form-control" value="'.$Task["description"].'" disabled>
          <label class="form-label">Start Date</label>
          <input class="form-control" value='.$Task["start_date"].' disabled>
          <label class="form-label">End Date</label>
          <input class="form-control" value='.$Task["end_date"].' disabled>
          <label class="form-label">Employee Email</label>
          <input class="form-control" value="';
          echo $user_email;
          echo'" disabled>
          <label class="form-label">Project Name</label>
          <input class="form-control" value="';
          echo $project_name;
          echo'" disabled>
          <label class="form-label">Status</label>
          <input class="form-control" value="';
          if($Task["status"]==0)
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

