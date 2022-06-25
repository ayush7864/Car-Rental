
<html>

	<head>
		<title> CAR RENTAL</title>
	</head>
	<body style="background-color:lightsteelblue;">
		<center>
		<form method="post" action="pay_rental_query.php">
			<legend> <b> ENTER RENTAL INFO: </b> </legend>
			<label id="label1" for="Return_Date"> Return Date </label> </br>
			<input type="text" name="Return_Date" placeholder="Eg: 2020-02-07" > </br>
			<label id="label1" for="Name"> Name: Initial AND LastName </label> </br>
			<input type="text" name="Name" placeholder="Eg: A. Smith" > </br>
			<label id="label2" for="VIN"> Vehicle Identification Number. Length = 17 </label> </br>
			<input type="text" name="VIN" placeholder="Eg: 1T234UI567T8901B2" > </br>
			<input id="button" type="submit" name="submit">  
		</form>
		</center>
	</body>
</html>