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
	$Name = filter_input(INPUT_POST, 'Name');
	$Return_Date = filter_input(INPUT_POST, 'Return_Date');
	if ($query = "SELECT customers.Name, 
					CASE
					WHEN PaymentDate = 'NULL' THEN TotalAmount
					ELSE 0
					END AS Balance_Due
				  FROM customers, rental
				  WHERE rental.ReturnDate = '$Return_Date' AND customers.Name = '$Name' 
				  AND customers.CustID = rental.CustID AND rental.VehicleID = '$VIN';")
	{
		if($query==null)
		{
			echo "No Record Found";
			die();    
		}    
		else
		{  
			$stmt = $conn->prepare($query);
			$stmt->execute(array(':Name' => $Name ));  
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo "<table border=1>
			<tr>
				<th>Customer Name</th>
				<th>Remaining Balance</th>
			</tr>";
			foreach($rows as $row){
				echo "<tr>
					<td>".$row["Name"]."</td>
					<td>$".$row["Balance_Due"]."</td>
				</tr>";

       		}
            echo "</table>";
			
			$update_query = "UPDATE rental
							 SET rental.PaymentDate = CURDATE(), Returned = 1
							 WHERE rental.ReturnDate = '$Return_Date' AND rental.VehicleID = '$VIN' 
								AND  rental.CustID IN
									(SELECT customers.CustID
									 FROM customers
									 WHERE customers.Name = '$Name') " ;				 
							 
							 
			if ($conn->query($update_query))
			{
				echo "\n";
				echo "\n";
				echo "\nCustomer Information Updated. \n";
			}
			else
			{
				echo "Failed to Update. ERROR: \n". $query."\n";
				foreach ($conn->errorInfo() as $error) {
					echo $error."\t"; 	
				} 
			}
			
		}
	}
	
}

?>