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
	$VIN = filter_input(INPUT_POST, 'VIN');
	$Description = filter_input(INPUT_POST, 'Description');
	$Year = filter_input(INPUT_POST, 'Year');
	$Type = filter_input(INPUT_POST, 'Type');
	$Category = filter_input(INPUT_POST, 'Category');
	$query = "INSERT INTO vehicle (VehicleID, Description, Year, Type, Category) VALUES ('$VIN', CONCAT('\"','$Description','\"'), '$Year', '$Type' , '$Category')" ;
	if ($conn->query($query))
	{
		echo "New vehicle added sucessfully.";
	}
	else
	{
		echo "Failed to add vehicle. Error: \n". $query."\n";
		foreach ($conn->errorInfo() as $error) {
			echo $error."\t"; 	
		} 
	}
}

?>