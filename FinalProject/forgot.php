<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forgot Your Password?</title>]
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
          background-color: #1E90FF;
        }
        h1{
          color: white;
        }
    </style>

  </head>
  <body>
    <div class="container">
        <div class="page-header">
          <h1 align="center">Welcome to CSC 4370 Chatroom</h1>
        </div>


        <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title" align="center">Forgot Your Password?</h3>
          </div>
            <div class="panel-body">
              <form action="forgot.php" method="post" class="form-horizontal">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Email:</label>
                      <div class="col-sm-10">
                        <input type="text" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Must use a valid email" required/> <br>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="username">Enter Username:</label>
                      <div class="col-sm-10">
                        <input type="text" name="user" pattern=".{3,}" title="Must contain at least 3 or more characters" required/> <br>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="question">Security Question:</label>
                      <div class="col-sm-10">
                            <select name="question">
                                <option value="1">Where are you from?</option>
                                <option value="2">What is your favorite animal?</option>
                                <option value="3">What is your car's brand?</option>
                              </select><br>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="answer">Answer:</label>
                      <div class="col-sm-10">
                          <input type="text" name="answer" pattern=".{3,}" title="Must contain at least 3 or more characters" required/> <br>
                      </div>
                    </div>
                    <div class="form-group" align="center">
                      <div class="col-sm-offset-2 col-sm-10">
                          <input type="submit" name="forgot" class="btn btn-primary" value="Submit" data-toggle="modal" data-target="#pass" />
                          <br />
                          <a href="login.php"><input type="button" name="login" class="btn btn-primary btn-link" value="Login" /></a>
                        </div>
                      </div>
                </form>
            </div>
          </div>
      </div>
    <?php
        session_start();

        include("config.php");

        if(isset($_POST['forgot'])){
            if ($_POST["email"]==""||$_POST["user"]==""||$_POST['answer']==""){
              echo("<div class='alert alert-danger alert-dismissible' role='alert' >Fields cannot be empty.
                        <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    </div>");
            } else {
                $email = $_POST["email"];
                $username = $_POST["user"];
                $question = $_POST["question"];
                $answer = $_POST["answer"];

                $sql = "SELECT pwd1 FROM user_login WHERE email = '$email' AND username = '$username' AND question = $question AND answer = '$answer'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0){
                  while($row = $result->fetch_assoc()){
                      $yourpass = $row['pwd1'];
                  }
                  echo "<div class='alert alert-primary' role='alert' style='text-align:center'> $yourpass </div>";
                } else {
                  echo "<div class='alert alert-danger alert-dismissible' role='alert'>Field is Invalid!
                          <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        </div>";
                }
            }
      }
    ?>

  </body>
</html>
