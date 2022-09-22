<?php
$title = 'Update Task';
include "views/layouts/header.php";
include 'app/middlewares/auth.php';
include 'app/database/models/Project.php';
include 'app/database/models/Task.php';
include 'app/database/models/User.php';
if($_SESSION['user']->is_admin!=1)
    {
      header("location:index.php");
    }
echo '<h1 class="text-center">Update Task</h1><table class="table">';
$status = ['Not Active', 'Active'];

if (isset($_POST['update'])) {
    // print_r($_POST);die;
    $task = new Task;
    $task->setId($_GET['tn']);
    $task->setEmployee_id($_POST['employee_id']);
    $task->setName($_POST['name']);
    $task->setDescription($_POST['description']);
    $task->setStart_date($_POST['start_date']);
    $task->setEnd_date($_POST['end_date']);
    $task->setStatus($_POST['status']);
    $task->setProject_id($_POST['project_id']);
    $add_val = $task->update();
    if ($add_val) {
        header('location:stask.php');
    }
}
if (isset($_GET['tn'])) {
    $task = new Task;
    $task->setId($_GET['tn']);
    $Task = $task->read()->fetch_assoc();
    if ($Task) {
        echo '<div class="row flex justify-content-center ">
<div class="col-6">
    <form method="Post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="' . $Task["name"] . '">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="' . $Task["description"] . '">
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="' . $Task["start_date"] . '">
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="' . $Task["end_date"] . '">
                </div>
                <div class="mb-3">
                <label for="employee_email" class="form-label">Employee Email</label>
                <select class="form-select" name="employee_id" aria-label="Default select example" id="employee_email">';
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
                <select class="form-select" name="project_id" aria-label="Default select example" id="Project_name">';
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
            <select class="form-select" name="status" aria-label="Default select example" id="status">';
            for ($i = 0; $i < count($status); $i++) {
                if ($i == $Task['status']) {
                    echo '<option selected value=' . $i . ' >' . $status[$i] . '</option>';
                } else {
                    echo '<option value=' . $i . ' >' . $status[$i] . '</option>';
                }
            }
            echo '</select></div>
            <div class="mb-3">
            <input type="submit" class="form-control my-1" value="Update Task" name="update" class="btn btn-outline-primary">
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
