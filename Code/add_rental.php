
<html>

	<head>
		<title> CAR RENTAL </title>
	</head>
	<body style="background-color:lightsteelblue;">
		<center>
		<form method="post" action="add_rental_query.php">
			<legend> <b> ENTER RENTAL INFO </b> </legend>
			<label id="label1" for="CustID"> Customer ID </label> </br>
			<input type="text" name="CustID" placeholder="Eg: 265" > </br>
			<label id="label10" for="Type"> Vehicle Type : Compact = 1, Medium = 2, Large = 3, SUV = 4, Truck = 5, VAN = 7 </label> </br>
			<input type="text" name="Type" placeholder="Eg: 6" > </br>
			<label id="label10" for="Category"> Category : BASIC = 0, LUXURY = 1 </label> </br>
			<input type="text" name="Category" placeholder="Eg: 1" > </br>
			<label id="label4" for="StartDate"> Rental Start Date </label> </br>
			<input type="text" name="StartDate" placeholder="Eg: 2020-08-25" > </br>
			<label id="label5" for="RentalType"> Rental Type. Daily = 1, Weekly = 7 </label> </br>
			<input type="text" name="RentalType" placeholder="Eg: 7" > </br>
			<label id="label6" for="Qty"> Rental Type Quantity : AS PER THE RENTAL TYPE </label> </br>
			<input type="text" name="Qty" placeholder="Eg: 3" > </br>
			<label id="label9" for="PaymentDate"> Payment Date. Enter NULL if paying LATER </label> </br>
			<input type="text" name="PaymentDate" placeholder="Eg: 2020-08-25" > </br>
			<input id="button" type="submit" name="submit">  
		</form>
		</center>
	</body>
</html>