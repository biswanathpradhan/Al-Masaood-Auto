<?php

$today = date("Y-m-d");
$abc= date("Y-m-d", strtotime( "$today -8 months"));


$servername = "localhost";
$username = "ama_AMA";
$password = "v4ZDT8{JN3]6";
$dbname = "ama_AMA";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `customer`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {	
    	$id = $row['id'];
    	$datem = date("Y-m-d", strtotime($row['created_at']));

    	echo($datem);
    	if($abc < $datem){
    		echo "active";
    		$conn->query("update `customer` SET `activefilter`='0'  where id='$id' ");
    		echo $id;
    	}else{
    		echo "Inactive";
    		$conn->query("update `customer` SET `activefilter`='1' where id='$id' ");

    		echo $id;
    	}

    }
} else {
  echo "0 results";
}
$sql = "SELECT * FROM `emergency_call_service`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 
  while($row = $result->fetch_assoc()) {	
    	$id = $row['id'];
    	$datem = date("Y-m-d", strtotime($row['created_at']));


    	echo($datem);
    	if($abc < $datem){
    		echo "active";
    		$conn->query("update `customer` SET `activefilter`='0'  where id='$id' ");
    		echo $id;
    	}

    }
} else {
  echo "0 results";
}
$sql = "SELECT * FROM `call_back_request`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {	
    	$id = $row['id'];
    	$datem = date("Y-m-d", strtotime($row['created_at']));


    	echo($datem);
    	if($abc < $datem){
    		echo "active";
    		$conn->query("update `customer` SET `activefilter`='0'  where id='$id' ");
    		echo $id;
    	}

    }
} else {
  echo "0 results";
}
$sql = "SELECT * FROM `car_pickup_request`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {	
    	$id = $row['id'];
    	$datem = date("Y-m-d", strtotime($row['created_at']));
     	echo($datem);
    	if($abc < $datem){
    		echo "active";
    		$conn->query("update `customer` SET `activefilter`='0'  where id='$id' ");
    		echo $id;
    	}

    }
} else {
  echo "0 results";
}
$sql = "SELECT * FROM `form_book_appointment`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
  while($row = $result->fetch_assoc()) {	
    	$id = $row['id'];
    	$datem = date("Y-m-d", strtotime($row['created_at']));
    	echo($datem);
    	if($abc < $datem){
    		echo "active";
    		$conn->query("update `customer` SET `activefilter`='0'  where id='$id' ");
    		echo $id;
    	}

    }
} else {
  echo "0 results";
}
$conn->close();


?>