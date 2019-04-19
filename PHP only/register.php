<!DOCTYPE html>
<html>
<header>
<title>REGISTER PAGE</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</header>

<body>
  <div class="container">
      <div class="page-header">
        <h1 align="center">Welcome to CSC 4370 Chatroom</h1>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title" align="center">Register An Account</h3>
        </div>
        <div class="panel-body">
            <form action="register.php" method="post" class="form-horizontal">
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="username">Enter Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" pattern=".{3,}" title="Must contain at least 3 or more characters" required/> <br>
                    </div>
                  </div>
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
                    <label class="control-label col-sm-2" for="password1">Enter Password:</label>
                      <div class="col-sm-10">
                        <input id="pwd1" type="password" name="pwd1" pattern=".{3,}" title="Must contain at least 3 or more characters" required/><br>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="password2">Re-type Password:</label>
                      <div class="col-sm-10">
                        <input id="pwd2" type="password" name="pwd2" pattern=".{3,}" title="Must contain at least 3 or more characters" required/><br>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="question">Security Question:</label>
                        <div class="col-sm-10">
                            <select name="question">
                              <option value="1">Where are you from?</option>
                              <option value="2">What is your favorite animal?</option>
                              <option value="3">What is your car's brand?</option>
                            </select><br>`
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
                      <input type="submit" name="register" class="btn btn-primary" value="Register" />
                      <br />
                      <a href="login.php"><input type="button" name="login" class="btn btn-primary btn-link" value="Login" /></a>
                    </div>
                  </div>
              </form>
          </div>
        </div>
    </div>
    <?php
      include("config.php");

      if(isset($_POST['register'])){
          if ($_POST['pwd1']!= $_POST['pwd2'])
          {
              echo("<div class='alert alert-danger alert-dismissible' role='alert'>Oops! Password did not match! Try again.
                      <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    </div>");
          }
          else if ($_POST['pwd']==""|| $_POST['pwd2']==""||$_POST["user"]==""||$_POST["name"]==""||$answer = $_POST["answer"]==""){
              echo("<div class='alert alert-danger alert-dismissible' role='alert' >Fields cannot be empty.
                      <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    </div");
          }else{
                $name = $_POST["name"];
                $email = $_POST["email"];
                $user = $_POST["user"];
                $pwd1 = $_POST["pwd1"];
                $pwd2 = $_POST["pwd2"];
                $question = $_POST["question"];
                $answer = $_POST["answer"];

                $sql = "INSERT INTO user_login (name, email, username, pwd1, pwd2, question, answer) VALUES ('$name','$email','$user','$pwd','$pwd2', $question, '$answer')";

                if ($conn -> query($sql) === TRUE){
                  echo "<div class='alert alert-success alert-dismissible' role='alert'>Register Complete.
                            <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        </div>";
                } else {
                  echo "<div class='alert alert-danger alert-dismissible' role='alert' >Error: " . $sql . "
                          <a href='' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        </div><br>" . $conn->error;
                }
          }
      }
      $conn->close();
    ?>



</body>
</html>
