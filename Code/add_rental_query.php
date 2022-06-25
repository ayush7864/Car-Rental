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
	$CustID = filter_input(INPUT_POST, 'CustID');
	$Type = filter_input(INPUT_POST, 'Type');
	$Category = filter_input(INPUT_POST, 'Category');
	$StartDate = filter_input(INPUT_POST, 'StartDate');
	$RentalType = filter_input(INPUT_POST, 'RentalType');
	$Qty = filter_input(INPUT_POST, 'Qty');
	$ReturnDate = 0000-00-00;
	$PaymentDate = filter_input(INPUT_POST, 'PaymentDate');
	$query = "INSERT INTO rental (CustID,  StartDate, RentalType, Qty, 
	                              ReturnDate, PaymentDate, VehicleID, OrderDate, TotalAmount, Returned) 
								  VALUES ('$CustID', '$StartDate', '$RentalType', '$Qty',
										  (
											SELECT DATE_ADD('$StartDate', INTERVAL ('$RentalType'*'$Qty') DAY) AS '$ReturnDate'
										  ), '$PaymentDate', 
										  (
											SELECT vehicle.VehicleID
											FROM vehicle
											WHERE Type = $Type AND Category = $Category AND VehicleID IN
											(SELECT vehicle.VehicleID
											FROM vehicle
                                            LEFT JOIN rental AS RENT ON vehicle.VehicleID = RENT.VehicleID
											WHERE RENT.VehicleID is NULL
											)
											UNION
											SELECT DISTINCT RENT2.VehicleID
											FROM rental AS RENT2, vehicle
											WHERE RENT2.VehicleID = vehicle.VehicleID AND Type = $Type AND Category = $Category AND 												
													RENT2.VehicleID NOT IN
											(
											SELECT RENT3.VehicleID
											FROM rental AS RENT3
											WHERE (StartDate >= '$StartDate' AND StartDate <= '$ReturnDate') OR 															
													(ReturnDate >= '$StartDate' AND ReturnDate <= '$ReturnDate')
											)
											GROUP BY vehicle.vehicleID
											LIMIT 1
										  ), CURDATE(), 
										  (
										    SELECT 
											CASE 
											WHEN $RentalType = 1 THEN (Daily*$Qty)
											ELSE (Weekly*$Qty)
											END AS TotalAmount
											FROM rate
											WHERE Type = $Type AND Category = $Category
										  ), 
										  (
										    SELECT
											CASE
											WHEN '$PaymentDate' = 'NULL' THEN 0
											ELSE 1
											END AS Ret
										  )
										 );" ;
	if ($conn->query($query))
	{
		echo "New rental added sucessfully.";
	}
	else
	{
		echo "Failed to ADD new Rental. Error: \n". $query."\n";
		foreach ($conn->errorInfo() as $error) {
			echo $error."\t"; 	
		} 
	}
}


?>