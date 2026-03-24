<!DOCTYPE html>
<html>
<head>
	
	<title>Add Contact</title>
</head>
<body>
	<h1> Add Contact</h1>
	<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$database = 'pb';

	$conn = mysqli_connect($host,$user,$pass,$database);

if(!$conn)
{
	die('could not connect');
}

echo 'Connected successfully<br>';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$name = $_POST['name'];
	$phone =$_POST['phone'];

	$sql = "INSERT INTO contacts"."(name,phone) VALUES ('$name','$phone')";

	if( mysqli_query($conn,$sql))
       {
	     echo "<br>Contact updated ";
       }
   else
   {
	  echo "Error".mysqli_error($conn);
   }


}
?>
<form method = "POST"
 action="<?php echo $_SERVER['PHP_SELF'];?>">
 <labelfor="name">Name:</label>
 	<input type="text" name="name" id="name" required><br><head>
 		<labelfor="phone">Phone:</label>
 			<input type="text" name="phone" id = "phone" required><br>

 			<input type="submit" value="Add Contact">
 		</labelfor="phone">
 	</form>
 	<br>
 	<a href = "Phonebook.html">Back to Phone Bok</a>
 	</head>

 

</body>
</html>

