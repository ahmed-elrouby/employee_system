<?php
$title = 'Submit Task';
include "views/layouts/header.php";
include 'app/middlewares/auth.php';
include 'app/database/models/Project.php';
include 'app/database/models/Task.php';
include 'app/database/models/User.php';
if($_SESSION['user']->is_admin==1)
    {
      header("location:index.php");
    }
echo '<h1 class="text-center">Submit Task</h1><table class="table">';
$status = ['Not Compeleted', 'Compeleted'];

if (isset($_POST['submitTask'])) {
    $task = new Task;
    $task->setId($_GET['tn']);
    $task->setEmpolyee_task($_POST['employee_task']);
    $task->setStatus(1);
    $add_val = $task->Submit_task();
    if ($add_val) {
        header('location:etask.php');
    }
}
if (isset($_GET['tn'])) {
    $task = new Task;
    $task->setId($_GET['tn']);
    $Task = $task->read()->fetch_assoc();
    if ($Task) {
        if($Task['status']!=0)
        {
            header("location: etask.php");
        }
        echo '<div class="row flex justify-content-center ">
<div class="col-6">
    <form method="Post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="' . $Task["name"] . '" disabled>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="' . $Task["description"] . '" disabled>
                </div>
                <div class="mb-3">
                    <label for="employee_task" class="form-label">Employee Note Of Submit</label>
                    <input type="text" class="form-control" id="employee_task" name="employee_task" value="' . $Task["employee_task"] . '" >
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="' . $Task["start_date"] . '" disabled>
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="' . $Task["end_date"] . '" disabled>
                </div>
                <div class="mb-3">
                <label for="employee_email" class="form-label">Employee Email</label>
                <select class="form-select" name="employee_id" aria-label="Default select example" id="employee_email" disabled>';
                $user = new User;
                $Users=$user->read();
                foreach ($Users as $User) {
                    if($User['is_admin']==0)
                    {
                        if($Task['employee_id']==$User['id'])
                        {
                            echo '<option selected value=' .$User['id']. ' >' . $User['email'] . '</option>';
                        }
                        else
                        {
                            echo '<option value=' .$User['id']. ' >' . $User['email'] . '</option>';
                        }
                        
                    }
                        
                }
                echo '</select></div>
                <div class="mb-3">
                <label for="Project_name" class="form-label">Project Name</label>
                <select class="form-select" name="project_id" aria-label="Default select example" id="Project_name" disabled>';
                $project = new Project;
                $Projects=$project->read();
                foreach ($Projects as $Project) {
                    if($Project['status']!=0)
                    {
                        if($Task['project_id']==$Project['id'])
                        {
                            echo '<option selected value=' .$Project['id']. ' >' . $Project['name'] . '</option>';
                        }
                        else
                        {
                            echo '<option value=' .$Project['id']. ' >' . $Project['name'] . '</option>';
                        }
                        
                    }
                        
                }
                echo '</select></div>
                <div class="mb-3">
                <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" aria-label="Default select example" id="status" disabled>';
            for ($i = 0; $i < count($status); $i++) {
                if ($i == $Task['status']) {
                    echo '<option selected value=' . $i . ' >' . $status[$i] . '</option>';
                } else {
                    echo '<option value=' . $i . ' >' . $status[$i] . '</option>';
                }
            }
            echo '</select></div>
            <div class="mb-3">
            <input type="submit" class="form-control my-1" value="Submit Task" name="submitTask" class="btn btn-outline-primary">
            </div>
    </form>
    </div>
    </div>';
    } else {
        header('location:views/errors/404.php');
    }
} else {
    header('location:views/errors/404.php');
}
include "views/layouts/footer.php";
