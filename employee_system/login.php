<?php
$title='Login Page';
include "views/layouts/header.php";
include 'app/middlewares/guest.php';
include_once 'app/database/models/User.php';
include_once 'app/request/loginRequest.php';
include_once "app/mail/mail.php";
include_once "app/request/registerRequest.php";
define('verifeid', 1);
// print_r($_POST);die;
if (isset($_POST['login'])) {
    $errors = [];
    // email validation
    $emailValidation = new registerRequest;
    $emailValidation->setEmail($_POST['email']);
    $emailValidationResult = $emailValidation->emailValidation();
    // password validaiton
    $passwordValidation = new loginRequest;
    $passwordValidation->setPassword($_POST['password']);
    $passwordValidationResult = $passwordValidation->passwordValidation();
    // if validation => success
    if (empty($passwordValidationResult) and empty($emailValidationResult)) {
      // check on db
      $UserData = new User;
      $UserData->setPassword($_POST['password']);
      $UserData->setEmail($_POST['email']);
      $loginResult = $UserData->login();
      // if the attempt was correct
      if ($loginResult) {
        
        // check on status
        $user = $loginResult->fetch_object();
        // if ($user->verified_at == '') {
        if ($user->status != verifeid) {
          // send mail
          // $subject = "Voluntary-Verification-Code";
          // $body = "<p>Hello {$user->name}</p><p> Your Verification Code is:<b>$user->code</b></p><p>Thank You.</p>";
          // $newMail = new mail($_POST['email'], $subject, $body);
        //   $subject = "Login Verification";
        //   $body = "<p>اهلا {$user->name}</p><p> كود التفعيل هو:<b>$user->code</b></p><p>شكراً.</p>";
        //   $newMail = new mail($_POST['email'], $subject, $body);
        //   $mailResult = $newMail->sendMail();
        //   if ($mailResult) {
        //     $_SESSION['email'] = $_POST['email'];
        //     header('location:check-code.php?page=login');
        //     die;
        //   } else {
        //     // $errors['failed-email']  = "<div c lass='alert alert-danger'> Try To Verify You Account Later </div>";
        //     $errors['failed-email']  = "<div class='flex' style='color:red;font-size:16px'>حاول تاكيد ملكية الايميل في وقت اخر</div>";
        //   }
        echo "not auth";die;
        } 
        // else if ($user->status != verifeid) {
        //   $errors['admin-acceptance'] = "<div class='flex' style='color:red;font-size:16px;text-align:center'>انتظر حتي يتم قبولك عن طريق ادمن الموقع</div>";
        // }
        else {
          // goto to home with session data
          $_SESSION['user'] = $user;
          header('location:index.php');
          die;
        }
      } else {
        $errors['wrong-attempt'] = "<div class='alert alert-danger'> Failed Attempt </div>";
      }
    }
  }
?>
<div class="row bg-danger p-3 border border-5 border-success">
<h1 class="col-12 text-center border border-dark border-5">Login</h1>
</div>
<div class="row ">
    <div class="col-3"></div>
    <div class="col-6 p-3 border border-1 my-5">
    <?php
    if (isset($errors)) {
      foreach ($errors as $key => $value) {
        echo $value;
      }
    }
    // if (isset($_GET['wait'])) {
    //   echo $_GET['wait'];
    // }
    if (isset($_SESSION['wait'])) {
      echo $_SESSION['wait'];
      unset($_SESSION['wait']);
    }
    // if (isset($errors['admin-acceptance'])) {
    //   echo $errors['admin-acceptance'];
    // } 
    ?>
    <form method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    
  </div>
  <?php
          if (!empty($emailValidationResult)) {
            foreach ($emailValidationResult as $key => $value) {
              echo $value;
            }
          }
          ?>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <?php
          if (!empty($passwordValidationResult)) {
            foreach ($passwordValidationResult as $key => $value) {
              echo $value;
            }
          }

          ?>
  <input type="submit" name="login" value="Submit" class="btn btn-primary">
</form> 
    </div>
</div>
<?php
include "views/layouts/footer.php";
?>