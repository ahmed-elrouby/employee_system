<?php
$title = 'Employee Tasks';
include "views/layouts/header.php";
include 'app/middlewares/auth.php';
include 'app/database/models/Project.php';
include 'app/database/models/Task.php';
include 'app/database/models/User.php';
if($_SESSION['user']->is_admin==1)
    {
      header("location:index.php");
    }
$task = new Task;
$task->setEmployee_id($_SESSION['user']->id);
$Tasks = $task->read();
$project = new Project;
$user = new User;
$counter = 1;
echo '<h1 class="text-center">Employee List of Tasks</h1><table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Name</th>
    <th scope="col">Description</th>
    <th scope="col">Employee Task</th>
    <th scope="col">Start Date</th>
    <th scope="col">End Date</th>
    <th scope="col">Project</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
</thead>';
foreach ($Tasks as $Task) {
    $user->setId($Task["employee_id"]);
    $userEmail = $user->read()->fetch_object()->email;
    $project->setId($Task["project_id"]);
    $projectName = $project->read()->fetch_object()->name;
    echo '<tbody>
<tr>
  <th class="col" scope="row">' . $counter . '</th>
  <td class="col">' . $Task["name"] . '</td>
  <td class="col">' . $Task["description"] . '</td>
  <td class="col text-center">';
    if (empty($Task["empolyee_task"])) {
        echo "-";
    } else {
        echo $Task["empolyee_task"];
    }
    echo '</td>
  <td class="col">' . $Task["start_date"] . '</td>
  <td class="col">' . $Task["end_date"] . '</td>
  <td class="col">' . $projectName . '</td>
  <td class="col">';
    if ($Task["status"] == 0) {
        echo "Not Compeleted";
    } else {
        echo "Compeleted";
    }
    echo '</td>';
    if ($Task["status"] == 0) {
        echo'<td class="col"><a class="btn btn-secondary" href="etask_create.php?tn=' . $Task["id"] . '">Submit Task</a></td>';
    }
    else
    {
        echo'<td class="col"><a class="btn btn-danger" disabled>Submit Task</a></td>';
    }

echo'</tr>
</tbody>';
    $counter++;
}
echo '</table>';
include "views/layouts/footer.php";
