<?php
$title = 'Create Task';
include "views/layouts/header.php";
include 'app/middlewares/auth.php';
include 'app/database/models/Project.php';
include 'app/database/models/Task.php';
include 'app/database/models/User.php';
if($_SESSION['user']->is_admin!=1)
    {
      header("location:index.php");
    }
echo '<h1 class="text-center">Create Task</h1><table class="table">';
$status = ['Not Active', 'Active'];
if (isset($_POST['add'])) {
    // print_r($_POST);die;
    $task = new Task;
    $task->setEmployee_id($_POST['employee_id']);
    $task->setName($_POST['name']);
    $task->setDescription($_POST['description']);
    $task->setStart_date($_POST['start_date']);
    $task->setEnd_date($_POST['end_date']);
    $task->setStatus($_POST['status']);
    $task->setProject_id($_POST['project_id']);
    $add_val = $task->create();
    if ($add_val) {
        header('location:stask.php');
    }
}
echo '<div class="row flex justify-content-center ">
<div class="col-6">
    <form method="Post">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date">
                </div>
                <div class="mb-3">
                <label for="employee_email" class="form-label">Employee Email</label>
                <select class="form-select" name="employee_id" aria-label="Default select example" id="employee_email">';
                $user = new User;
                $Users=$user->read();
                foreach ($Users as $User) {
                    if($User['is_admin']==0)
                    {
                        echo '<option value=' .$User['id']. ' >' . $User['email'] . '</option>';
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
                        echo '<option value=' .$Project['id']. ' >' . $Project['name'] . '</option>';
                    }
                        
                }
                echo '</select></div>
                <div class="mb-3">
                <label for="status" class="form-label">Status</label>
            <select class="form-select" name="status" aria-label="Default select example" id="status">';
            for ($i = 0; $i < count($status); $i++) {
                if ($i == $Project['status']) {
                    echo '<option selected value=' . $i . ' >' . $status[$i] . '</option>';
                } else {
                    echo '<option value=' . $i . ' >' . $status[$i] . '</option>';
                }
            }
            echo '</select></div>
            <div class="mb-3">
            <input type="submit" class="form-control my-1" value="Add Task" name="add" class="btn btn-outline-primary">
            </div>
    </form>
    </div>
    </div>';
include "views/layouts/footer.php";
