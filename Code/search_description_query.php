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
	$description = filter_input(INPUT_POST, 'description');
	if($query = "SELECT vehicle.VehicleID, vehicle.Description , 
					(
					CASE
					WHEN EXISTS (SELECT NULL FROM vrentalinfo WHERE vrentalinfo.Vehicle = CONCAT('\"','$description','\"'))
					THEN CONCAT( '$', FORMAT( (AVG(vrentalinfo.OrderAmount/vrentalinfo.TotalDays)), 2 ) )
					ELSE 'Non-Applicable'
					END)
					AS Average_Daily_Price
				 FROM vehicle, vrentalinfo
				 WHERE vehicle.Description = CONCAT('\"','$description','\"') AND vrentalinfo.Vehicle = CONCAT('\"','$description','\"')
				 GROUP BY vehicle.VehicleID;
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
		    $stmt->execute(array(':description' => $description ));  
		    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    echo "<table border=1>
			<tr>
				<th>VIN</th>
				<th>Vehicle Description</th>
				<th>Average Daily Price</th>
			</tr>";
			foreach($rows as $row){
				echo "<tr>
					<td>".$row["VehicleID"]."</td>
					<td>".$row["Description"]."</td>
					<td>".$row["Average_Daily_Price"]."</td>
				</tr>";
       		}
            echo "</table>";
			echo "Total number of Rows: ",$stmt->rowCount();
		}

	}
}
		
?>