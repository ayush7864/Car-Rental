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
	$PName = filter_input(INPUT_POST, 'PName');
	if($query = "SELECT CustomerID, CustomerName, 
					SUM(RentalBalance) AS RemainingBalance 
				FROM vrentalinfo 
				WHERE CustomerName LIKE '%$PName%'
				GROUP BY CustomerID;
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
		    $stmt->execute(array(':PName' => $PName ));  
		    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		    echo "<table border=1>
			<tr>
				<th>Customer ID</th>
				<th>Customer Name</th>
				<th>Remaining Balance</th>
			</tr>";
			foreach($rows as $row){
				echo "<tr>
					<td>".$row["CustomerID"]."</td>
					<td>".$row["CustomerName"]."</td>
					<td>$".number_format($row["RemainingBalance"],2)."</td>
				</tr>";

       		}
            echo "</table>";
			echo "Total number of Rows: ",$stmt->rowCount();
		}

	}
}
		
?>