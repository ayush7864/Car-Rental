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
	$Pdescription = filter_input(INPUT_POST, 'Pdescription');
	if($query = "SELECT vehicle.VehicleID AS VIN, vehicle.Description AS Vehicle_Description , 'Non-Applicable' AS Average_Daily_Price
				FROM vehicle
				WHERE VehicleID IN
					(SELECT vehicle.VehicleID
					FROM vehicle
					LEFT JOIN vrentalinfo ON vehicle.VehicleID = vrentalinfo.VIN
					WHERE vrentalinfo.VIN is NULL)
				UNION
				SELECT VIN, Vehicle AS Vehicle_Description , 
				CONCAT( '$', FORMAT( (AVG(OrderAmount/TotalDays)), 2 ) )
					AS Average_Daily_Price
				FROM vrentalinfo
				GROUP BY VIN
				ORDER BY CAST( REPLACE(REPLACE(REPLACE( Average_Daily_Price ,'.', ''), '$', ''), 'Non-Applicable', '000') AS SIGNED ) ASC;
				")  
	{    
		if($query==null)
		{
		    echo "No Such Record Found";
		    die();    
		}    
		else
		{  
			$stmt = $conn->prepare($query);
		    $stmt->execute(array(':Pdescription' => $Pdescription ));  
		    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    echo "<table border=1>
			<tr>
				<th>VIN</th>
				<th>Vehicle Description</th>
				<th>Average Daily Price</th>
			</tr>";
			foreach($rows as $row){
				echo "<tr>
					<td>".$row["VIN"]."</td>
					<td>".$row["Vehicle_Description"]."</td>
					<td>".$row["Average_Daily_Price"]."</td>
				</tr>";
       		}
            echo "</table>";
			echo "Total number of Rows: ",$stmt->rowCount();
		}

	}
}
		
?>