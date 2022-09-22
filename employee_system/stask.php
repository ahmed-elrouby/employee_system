<?php
$title='Tasks';
include "views/layouts/header.php";
include 'app/middlewares/auth.php';
include 'app/database/models/Project.php';
include 'app/database/models/Task.php';
include 'app/database/models/User.php';
if($_SESSION['user']->is_admin!=1)
    {
      header("location:index.php");
    }
$task =new Task;
$project =new Project;
$user =new User;
$Tasks=$task->read();
$counter=1;
echo '<h1 class="text-center">List of Tasks</h1><table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Name</th>
    <th scope="col">Description</th>
    <th scope="col">Start Date</th>
    <th scope="col">End Date</th>
    <th scope="col">Project</th>
    <th scope="col">Employee</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
</thead>';
foreach($Tasks as $Task)
{
    $user->setId($Task["employee_id"]);
    $userEmail=$user->read()->fetch_object()->email;
    $project->setId($Task["project_id"]);
    $projectName=$project->read()->fetch_object()->name;
    echo '<tbody>
<tr>
  <th class="col" scope="row">'.$counter.'</th>
  <td class="col">'.$Task["name"].'</td>
  <td class="col">'.$Task["description"].'</td>
  <td class="col">'.$Task["start_date"].'</td>
  <td class="col">'.$Task["end_date"].'</td>
  <td class="col">'.$projectName.'</td>
  <td class="col">'.$userEmail.'</td>
  <td class="col">';
  if($Task["status"]==0)
  {
    echo "Not Active";
  }
  else
  {
    echo "Active";
  }
  echo'</td>
  <td class="col-3"><a class="btn btn-secondary" href="task_view.php?tn='.$Task["id"].'">View</a><a class="btn btn-primary" href="task_update.php?tn='.$Task["id"].'">Update</a><a class="btn btn-danger" href="task_delete.php?tn='.$Task["id"].'">Delete</a></td>
</tr>
</tbody>';
$counter++;
}
echo'</table>
<a class="btn btn-success" href="task_create.php"> Create Task</a>';
include "views/layouts/footer.php";
?>

