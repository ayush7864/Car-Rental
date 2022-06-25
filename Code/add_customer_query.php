<?php


$host = "localhost:3306";
$dbusername = "root";
$dbpassword = "";
$dbname = "carrental";
$conn = new PDO('mysql:host='.$host.';dbname='.$dbname, $dbusername, $dbpassword);
if(!$conn) 
{  
	die("Connection failed");
}
else
{
	$name = filter_input(INPUT_POST, 'name');
	$phone_number = filter_input(INPUT_POST, 'phone_number');
	$query = "INSERT INTO customers (Name, Phone) VALUES ('$name', '$phone_number')" ;
	if ($conn->query($query))
	{
		echo "New customer added sucessfully.";
	}
	else
	{
		echo "Failed to ADD new Customer. Error: \n". $query."\n";
		foreach ($conn->errorInfo() as $error) {
			echo $error."\t"; 	
		} 
	}
}

?>