<?php
$title='Projects';
include "views/layouts/header.php";
include 'app/middlewares/auth.php';
include 'app/database/models/Project.php';
if($_SESSION['user']->is_admin!=1)
    {
      header("location:index.php");
    }
$project =new Project;
$Projects=$project->read();
$counter=1;
echo '<h1 class="text-center">List of Projects</h1><table class="table">
<thead>
  <tr>
    <th scope="col">#</th>
    <th scope="col">Name</th>
    <th scope="col">Description</th>
    <th scope="col">Start Date</th>
    <th scope="col">End Date</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
</thead>';
foreach($Projects as $Project)
{
    echo '<tbody>
<tr>
  <th class="col" scope="row">'.$counter.'</th>
  <td class="col">'.$Project["name"].'</td>
  <td class="col">'.$Project["description"].'</td>
  <td class="col">'.$Project["start_date"].'</td>
  <td class="col">'.$Project["end_date"].'</td>
  <td class="col">';
  if($Project["status"]==0)
  {
    echo "Not Active";
  }
  else
  {
    echo "Active";
  }
  echo'</td>
  <td class="col-3"><a class="btn btn-secondary" href="project_view.php?pn='.$Project["id"].'">View</a><a class="btn btn-primary" href="project_update.php?pn='.$Project["id"].'">Update</a><a class="btn btn-danger" href="project_delete.php?pn='.$Project["id"].'">Delete</a></td>
</tr>
</tbody>';
$counter++;
}
echo'</table>
<a class="btn btn-success" href="project_create.php"> Create Project</a>';
include "views/layouts/footer.php";
?>

