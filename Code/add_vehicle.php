
<html>

	<head>
		<title> CAR RENTAL </title>
	</head>
	<body style="background-color:lightsteelblue;">
		<center>
		<form method="post" action="add_vehicle_query.php">
			<legend> <b> ENTER VEHICLE INFO </b> </legend>
			<label id="label1" for="VIN"> Vehicle Identification Number. Length = 17 </label> </br>
			<input type="text" name="VIN" placeholder="Eg: 1V2F33G42TT34R143" > </br>
			<label id="label2" for="Description"> Vehicle Description </label> </br>
			<input type="text" name="Description" placeholder="Eg: Toyota Camry LE" > </br>
			<label id="label3" for="Year"> Vehicle Year </label> </br>
			<input type="text" name="Year" placeholder="Eg: 2014" > </br>
			<label id="label4" for="Type"> Type : 'Compact' = 1, 'Medium' = 2, 'Large' = 3, 'SUV' = 4, 'Truck' = 5, 'VAN' = 7  </label> </br>
			<input type="text" name="Type" placeholder="Eg: 5" > </br>
			<label id="label5" for="Category"> Category : 'BASIC' = 0, 'LUXURY' = 1 </label> </br>
			<input type="text" name="Category" placeholder="Eg: 0" > </br>
			<input id="button" type="submit" name="submit">  
		</form>
		</center>
	</body>
</html>