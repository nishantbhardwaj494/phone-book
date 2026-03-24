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

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$selectedContactId = $_POST['id'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];

	$sql = "UPDATE contacts SET name='$name',"." phone='$phone' WHERE id=$selectedContactId";

	if($conn->query($sql) === TRUE)
	{
		echo "<p>Contact updated</p>";
	}
	else
	{
		echo " Error: " .$sql. "<br>" .$conn->error;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	
	<title>Update Contact</title>
</head>
<body>''
	<h1>Update Contact</h1>

	<form method="POst" action="<?php echo $_SERVER['PHP_SELF'];?>">
		<label for="id">Select Contact:</label>
		<select name ="id" id = "id">
			<?php
			while ($row = $result->fetch_assoc())
			{
				$contactId = $row['id'];
				$contactName = $row['name'];
				$contactPhone = $row['phone'];
				echo "<option value = '$contactId'
				data-phone ='$contactPhone'>$contactName</option>";
			}
			?>
		</select>
		<br>
	

		<?php if($result->num_rows > 0):?>
			<label for="name">Name:</label>
			<input type="text" name="name" id ="name" readonly><br>

			<label for="phone">Phone:</label>
			<input type="text" name="phone" id ="phone" readonly><br>

			<input type="submit" value="Save">
		<?php else:?>
			
			<p> No contacts found in the phone book.</p>
		<?php endif;?>

	</form>

	<script>
		var contactSelect = document.getElementById('id');
		var nameInput = document.getElementById('name');
		var phoneInput = document.getElementById('phone');

		contactSelect.addEventListener('change',
			function()
			{
				var selectedContact = contactSelect.options[contactSelect.selectedIndex];
				nameInput.value = selectedContact.text;
				phoneInput.value= selectedContact.getAttribute('data-phone');
				nameInput.removeAttribute('readonly');
				phoneInput.removeAttribute(readonly);
			

			}
			);
		</script>

		<br>
		<a href="Phonebook.html">Back to Phone Book</a>

		

</body>
</html>
<?php
$conn->close();
?>

