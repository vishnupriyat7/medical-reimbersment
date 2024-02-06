<?php
  require "db_connection.php";
  if($con) {
    $name = ucwords($_GET["name"]);
    // $packing = strtoupper($_GET["packing"]);
    $generic_name = ucwords($_GET["generic_name"]);
    // $suppliers_name = $_GET["suppliers_name"];

    // $query = "SELECT * FROM medicines WHERE UPPER(NAME) = '".strtoupper($name)."' AND UPPER(PACKING) = '".strtoupper($packing)."' AND UPPER(SUPPLIER_NAME) = '".strtoupper($suppliers_name)."'";
    // $query = "SELECT * FROM medicines WHERE UPPER(NAME) = '".strtoupper($name)."' AND UPPER(GENERIC_NAME) = '".strtoupper($generic_name)."'";
    $query = "SELECT * FROM medicines WHERE CONVERT(NAME USING utf8mb4) LIKE '%$name%' AND CONVERT(GENERIC_NAME USING utf8mb4) LIKE '%$generic_name%'";
    // var_dump($query);

    $result = mysqli_query($con, $query);
    // var_dump($result);
    $row = mysqli_fetch_array($result);
    // var_dump($row);
    if($row)
      echo "Medicine $name with $generic_name already exists !..";
    else {
      $query = "INSERT INTO medicines (NAME, GENERIC_NAME) VALUES('$name','$generic_name')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$name added...";
  		else
  			echo "Failed to add $name!";
    }
  }
?>
