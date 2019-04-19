<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>LOGIN PAGE</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  </head>
  <body>
    <div class="container">
        <div class="page-header">
          <h1 align="center">Welcome to CSC 4370 Chatroom</h1>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title" align="center">Login to Chat</h3>
            </div>
            <div class="panel-body">
                <form action="login.php" method="post" class="form-horizontal">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="username">Username:</label>
                    <div class="col-sm-10">
                        <input type="text" name="user"> <br>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password:</label>
                    <div class="col-sm-10">
                      <input type="password" name="pwd"> <br>
                    </div>
                  </div>
                  <div class="form-group" align="center">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" name="login" class="btn btn-primary" value="Login" />
                      <br />
                      <a href="register.php"><input type="button" name="register" class="btn btn-primary btn-link" value="Register" /></a>
                      <a href="forgot.php"><input type="button" name="forgot" class="btn btn-primary btn-link" value="Forgot the Password?" /></a>
                    </div>
                  </div>
                </form>
              </div>
          </div>
      </div>
      <?php
          session_start();

          include("config.php");

          if(isset($_POST['login'])){
              if ($_POST["user"]==""||$_POST['pwd']==""){
                echo('<div class="alert alert-danger alert-dismissible" role="alert">Fields cannot be empty.
                          <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      </div>');
              } else {
                  $username = $_POST["user"];
                  $password = $_POST["pwd"];

                  $sql = "SELECT name FROM user_login WHERE username = '$username' AND pwd1 = '$password'";

                  $result = $conn->query($sql);

                  if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        //Session variable is global so it can reused in another page after the function session_start()
                        $_SESSION["mainName"] = $row["name"];
                        header("location: welcome.php");
                    }
                  } else {
                    echo '<div class="alert alert-danger alert-dismissible" role="alert">Oops! Username or Password is Invalid!
                              <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          </div>';
                  }
              }
          }

      ?>

  </body>
</html>
