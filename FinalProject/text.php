
  <?php
      include("config.php");

      $sql = "SELECT user FROM user_session WHERE status = 0";
      $result = $conn->query($sql);
    //  $nameList = array();
      if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["user"] . "</li>";
        }
      }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }


  ?>
