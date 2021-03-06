<?php
//Create       : 18.5.22
//Modify       : 18.5.26
//Student Name : Lim JunSu
//Student Num  : 2010111661
//Description  : convert mysql data to json format
 
//When using, input db id, db pw.
$servername="localhost";
$username="ossp";
$password="ossp";
$dbName="APInfo";

//create connection
$conn=new mysqli($servername, $username, $password, $dbName);

//check connection
if($conn->connect_error)
{
	die("Connection failed: " . $conn->connect_error);
}

mysqli_set_charset($conn, "utf8");

//query
$sql_query="SELECT * FROM APInfo_db";
$result=$conn->query($sql_query);

$data = array();
//echo "$result->num_rows"; test code..

if($result->num_rows > 0)
{
	//convert data to json format
	while($row=$result->fetch_assoc())
	{
//		echo "info: " . $row["info"]. "  mac: " . $row["mac"]. "<br>"; test code ..
		array_push($data,
			array('info'=>$row["info"],
			'mac'=>$row["mac"]));
	}
}else
{
	echo "0 results";
}

//JSON Format print
header('Content-Type: application/json; charset=utf8');
$json=json_encode(array("APInfo"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
echo $json;

$conn->close();

?>
