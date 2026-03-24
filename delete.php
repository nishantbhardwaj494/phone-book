<!DOCTYPE html>
<html>
<head>
	
	<title>Delete Contact</title>
</head>
<body>
	<h1>Delete Contact</h1>
	<?php

	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$database = 'pb';

	$conn = new mysqli($host,$user,$pass,$database);

	if($conn->connect_error)
	{
		die ("Could not connect:".$conn ->connect_error);
	}
	else
	{
		echo "Connected successfully";
	}
	function deleteContact($conn,$id)
	{
		$sql = "DELETE FROM contacts "."WHERE id =$id";

		if($conn->query($sql) === TRUE)
		{
			echo "<p>Contact deleted " ."successfully!</p>";
		}
		else
		{
			echo "Error:".$sql."<br>".$conn->error;
		}
	}

		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(isset($_POST['contacts']))
			{
				$contactsToDelete= $_POST['contacts'];

				foreach ($contactsToDelete as $contactId)
				 {
					deleteContact($conn,$contactId);
				 }
			}
			else
			{
				echo "<p>No Contacts"."selected for deletion.</p>";
			}
		}

	$sql = "SELECT id,name,"."phone from contacts";

	$result = $conn->query($sql);

	if($result ->num_rows > 0)
	{
		?>
		<form method = "POST" action="<?php echo $_SERVER['PHP_SELF'];?> ">
			<?php
			while($row = $result ->fetch_assoc())
			{
				$contactId = $row['id'];
				$contactName = $row['name'];
				$contactPhone =$row['phone'];
				?>
				<input type="checkbox" name="contacts[]"
				value = "<?php echo $contactId;?>">
				<?php
				echo $contactName;
				?>
				<?php
				echo $contactPhone
			?><br>

			<?php
		}
		?>

		
		
		<br>
		<input type="submit" value = "Confirm delete">
		</form>

		<?php
	}

	


	else
	{
		echo"<p> No contacts found". "in the phone booj.</p>";
	}
	$conn ->close();
	?>
	<br>
	<a href="Phonebook.html">Back to phone book</a>


</body>
</html>