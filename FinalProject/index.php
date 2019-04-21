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

</header>

<style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;}
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
        <a href='logout.php'><input type='submit' id='logout' name='logout' value='Logout'></a>
				<h4><?php echo $_SESSION["name"]?>'s Available Chats:</h4>
				<form>
				<?php
					include("config.php");

					$sql = "SELECT user, name FROM user_session WHERE status = 0";
					$result = $conn->query($sql);
					//  $nameList = array();
					if ($result->num_rows > 0){
						while ($row = $result->fetch_assoc()) {
							echo "<input type='radio' ng-model='value' value='" . $row["user"] . "'>" . $row["name"] . "<br>";
						}
					}else {
						echo "No one is online.<br>" . $conn->error;
					}
				?>
				</form><br>
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search Blog..">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
			</div>
			<div class="col-sm-9">
				<div>
					<h1>Your chats:</h1>
					<div ng-repeat="message in messages">
						<strong>{{message.user.name}}:</strong>
						<span>{{message.data}}</span>
					</div>
					<form ng-submit="send()">
						<input ng-model="textbox">
					</form>
				</div>
			</div>
		</div>
	</div>



</body>

<footer class="container-fluid">
	<p>Footer Text</p>

</footer>

</html>
