<?php
$title = 'Create Project';
include "views/layouts/header.php";
include 'app/middlewares/auth.php';
include 'app/database/models/Project.php';
if($_SESSION['user']->is_admin!=1)
    {
      header("location:index.php");
    }
echo '<h1 class="text-center">Create Project</h1><table class="table">';
$status=['Not Active','Active'];
if (isset($_POST['add'])) {
    $project = new Project;
    $project->setEmployee_id($_SESSION['user']->id);
    $project->setName($_POST['name']);
    $project->setDescription($_POST['description']);
    $project->setStart_date($_POST['start_date']);
    $project->setEnd_date($_POST['end_date']); 
    $project->setStatus($_POST['status']);
    $add_val=$project->create();
    if($add_val)
    {
        header('location:project.php');
    }
}
        echo '<div class="row flex justify-content-center "><div class="col-6"><form method="Post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value=' . $Project["name"] . '>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="' . $Project["description"] . '">
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="' . $Project["start_date"] . '">
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="' . $Project["end_date"] . '">
        </div>
        <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" name="status" aria-label="Default select example" id="status">';
      for($i=0;$i < count($status);$i++)
      {
        if($i==$Project['status'])
        {
            echo '<option selected value='.$i.' >'.$status[$i].'</option>';
        }
        else
        {
            echo '<option value='.$i.' >'.$status[$i].'</option>';
        }
      }
      echo'</select></div>
      <div class="mb-3">
      <input type="submit" class="form-control my-1" value="Add Project" name="add" class="btn btn-outline-primary">
    </div>
      </form></div></div>';
include "views/layouts/footer.php";
?>