<?php
    // open mysql connection
    require_once('db.php');

    // Change directory to the json files and loop through the files
    chdir('data/files/');
    $files = glob("*.json");
    $computer = 'computer';
    $application   = 'application';

    // loop through the files
    foreach($files as $json){
      if (strpos($json, $computer)) {
          echo $json . " " . $computer . "<br />";
          // read json file
          $cfilename = $json;
          $cjson = file_get_contents($cfilename);

          //convert json object to php associative array
          $cdata = json_decode($cjson, true);

          //loop through the array of computer data
          foreach ($cdata as $crow) {
              // get the computer usage details
              $hostname = $crow['hostname'];
              $duration = $crow['duration'];
              $datetimeadded = $crow['datetimeadded'];
              $id = $crow['id'];
              $status = $crow['status'];
              // Prepare the insert sql statement to the computer table and excute.
              $sql = "INSERT INTO computer(hostname, duration, datetimeadded, id, cstatus) VALUES ('$hostname', '$duration', '$datetimeadded', '$id', '$status')";
              $result = mysqli_multi_query($con, $sql);
              if ($result) {
                echo "New records created successfully <br>";
              } 
              else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
              }
          }
          // Delete the jsone file after the data is imported.
          if ($result) {
            unlink($cfilename);
          }

      } else {
          echo $json . " " . $application . "<br />";
          // read json file
          $filename = $json;
          $ajson = file_get_contents($filename);

          //convert json object to php associative array
          $data = json_decode($ajson, true);

          // loop through the array of application data
          foreach ($data as $row) {
              // get the application usage details
              $hostname = $row['hostname'];
              $duration = $row['duration'];
              $datetimeadded = $row['datetimeadded'];
              $id = $row['id'];
              $app = $row['app'];
              $title = $row['title'];

              // Prepare the insert sql statement to the application table and excute.
              $sql = "INSERT INTO application(hostname, duration, datetimeadded, id, app, title) VALUES ('$hostname', '$duration', '$datetimeadded', '$id', '$app', '$title')";
              $result = mysqli_multi_query($con, $sql);
              if ($result) {
                echo "New records created successfully <br>";
              } 
              else {
                echo "Error: " . $result . "<br>" . mysqli_error($con);
              }
          }
          // Delete the jsone file after the data is imported.
          if ($result) {
            unlink($filename);
          }
      }
    }
    
    //close connection
    mysqli_close($con);
?>