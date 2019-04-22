<!DOCTYPE html>
<html>
<header>
<title>Your Chatroom</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="bower_components/angular/angular.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<!-- includes -->
<script src="bower_components/angular/angular.js"></script>
<script src="bower_components/rltm/web/rltm.js"></script>
<script src="angular-chat.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</header>

<style>
    body {
        width: 100wh;
        height: 90vh;
        color: #fff;
        background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);
        background-size: 400% 400%;
        -webkit-animation: Gradient 15s ease infinite;
        -moz-animation: Gradient 15s ease infinite;
        animation: Gradient 15s ease infinite;
        }

        @-webkit-keyframes Gradient {
        0% {
        background-position: 0% 50%
        }
        50% {
        background-position: 100% 50%
        }
        100% {
        background-position: 0% 50%
        }
        }

        @-moz-keyframes Gradient {
        0% {
        background-position: 0% 50%
        }
        50% {
        background-position: 100% 50%
        }
        100% {
        background-position: 0% 50%
        }
        }

        @keyframes Gradient {
        0% {
        background-position: 0% 50%
        }
        50% {
        background-position: 100% 50%
        }
        100% {
        background-position: 0% 50%
        }
    }
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #1E90FF;
      height: 100%;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;}
    }

    /*style for active user and search engine */
    #thisInput {
        font-size: 16px; /* Increase font-size */
      }

      #thisTable {
        border-collapse: collapse; /* Collapse borders */
        border: 1px solid #ddd; /* Add a grey border */
        font-size: 14px; /* Increase font-size */
      }

      #thisTable th, #thisTable td {
        text-align: left; /* Left-align text */
        padding: 12px; /* Add padding */
      }

      #thisTable tr {
        /* Add a bottom border to all table rows */
        border-bottom: 1px solid #ddd;
      }

      #header, #thisTable tr:hover {
       background-color: #47b6ff;
      }
      #textBox{
        bottom:0;
        height:15%;
        position: fixed;
        outline:none;
        resize: none;

        border:none;
        border-bottom:#000 medium solid !important;

      }
</style>

<!-- configuration -->
<script>
var chat = angular.module( 'BasicChat', ['chat'] );
</script>

<script>
angular.module('chat').constant('config', {
    rltm: {
        service: "pubnub",
        config: {
            publishKey: "pub-c-3c829f8c-cc77-4208-9e9f-999406f2e05d",
            subscribeKey: "sub-c-12c91cc6-61fe-11e9-ae53-666e2ad6cdf0"
        }
    }
});
</script>

<!-- controller -->
<script>
chat.controller('chat', ['Messages', '$scope', function(Messages, $scope) {

	Messages.user({id:'<?php session_start(); include("config.php"); echo $_SESSION["user"]?>', name:'<?php echo $_SESSION["name"]?>'});
	$scope.sendTo = {userid:'', name:''};

    // Message Inbox
    $scope.messages = [];

    // Receive Messages
    Messages.receive(function(message, isPrivate) {
        $scope.messages.push(message);
    });

    // Send Messages
    $scope.send = function() {

        var message = {
            to: $scope.sendTo.userid, //Currently empty, but should be configured with an angular variable that holds the receivers user.id.
            data: $scope.textbox ,
            user: Messages.user()
        };

        Messages.send(message);

        $scope.messages.push(message);

    };

	$scope.value= '';

    $scope.$watch('value', function(value) {
       console.log(value);
	   $scope.sendTo.userid = value;
    });

}]);
</script>

<!-- view -->
<body>
	<?php
		if (empty($_SESSION['user'])) {
			header('Location: login.php');
			exit;
		}

	?>
	<div ng-app="BasicChat" ng-controller="chat" class="container-fluid">
		<div class="row content">
			<div class="col-sm-3 sidenav">
        <br>
        <a href='logout.php'><input type='submit' id='logout' name='logout' value='Logout'></a>
        <br>
        <h4><?php echo strtoupper($_SESSION["name"])?>'s Available Chats:</h4>

        <div class="input-group">
					<input type="text" id="thisInput" class="form-control" onkeyup="filter()" placeholder="Search..">

        </div>

        <script>
          function filter() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("thisInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("thisTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
              td = tr[i].getElementsByTagName("td")[0];
              if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = "";
                } else {
                  tr[i].style.display = "none";
                }
              }
            }
          }
          </script>


				<form>
				<?php
					include("config.php");
              echo "<table id='thisTable' class='table'>
                    <thead id='header' class='thead-light'>
                      <tr>
                        <th scope='col'></th>
                        <th scope='col'>Name</th>
                      </tr>
                    </thead>
                    <tbody>";
    					$sql = "SELECT user, name FROM user_session WHERE status = 0";
    					$result = $conn->query($sql);
    					//  $nameList = array();
    					if ($result->num_rows > 0){
    						while ($row = $result->fetch_assoc()) {
    							echo "<tr><th scope='row'><input type='radio' ng-model='value' value='" . $row["user"] . "'></th><td>" . $row["name"] . "</td></tr><br>";
    						}
    					}else {
    						echo "No one is online.<br>" . $conn->error;
    					}
              echo "</tbody>
                    </table>";
              session_start();
              if(isset($_SESSION["name"]))
              {
                   if((time() - $_SESSION['last_login_timestamp']) > 60) // 900 = 15 * 60
                   {
                        header("location:logout.php");
                   }
                   else
                   {
                        $_SESSION['last_login_timestamp'] = time();
                   }
              }
              else
              {
                   header('location:login.php');
              }

				?>
				</form><br>

			</div>
			<div class="col-sm-9">
				<div>
					<h1>CHAT HERE:</h1>
					<div ng-repeat="message in messages">
						<strong>{{message.user.name}}:</strong>
						<span>{{message.data}}</span>
					</div>
					<form ng-submit="send()">
            <div class="form-group">
						  <input class="form-control" ng-model="textbox" placeholder="Type your message here..." id="textBox" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
            </div>
	        </form>
				</div>
			</div>
		</div>
	</div>



</body>


</html>
