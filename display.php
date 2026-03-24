<?php
$host = 'localhost';
$user  ='root';
$pass = '';
$database = 'pb';

$conn = new mysqli($host,$user,$pass,$database);

if($conn->connect_error)
{
	die('Connection failed:' .$conn->connect_error);
}
$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);
?> 

<!DOCTYPE html>
<html>
<head>
	
	<title>Phone Book</title>
	<style>
		table 
		{
			border-collapse: collapse;
			width: 100%;
		}
		th,td 
		{
			border: 1ps solid black;
			padding: 8px;
		}
		th 
		{
			background-color #f2f2f2;
		}
	</style>
</head>
<body>
	<h1>Phone Book</h1>

	<table>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Phone</th>
		</tr>
		<?php
		if($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc())
			 {
				 $id = $row['id'];
				 $name = $row['name'];
				 $phone = $row['phone'];
				 echo "<tr>";
				 echo "<td>$id</td>";
				 echo "<td>$name</td>";
				 echo "<td>$phone</td>";
				 echo "</tr>";
			 }
		}
		else
		{
			echo "<tr><td colspan = '3'>
			No contacts found in phone book.</td></tr>";
		}
		?>

	</table>
	<br><a href = "Phonebook.html">Back to Phone Book</a>


</body> </html>
<?php
$conn->close();
?>