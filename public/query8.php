<?php

if (isset($_POST['submit'])) {
	try {	
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT *
				   FROM students 
				   WHERE status = 'waiting'";	


		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php require "templates/header.php"; ?>
<?php  
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>MU ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Status</th>
					<th>Date Of Birth</th>
					<th>Gender</th>
					<th>Year</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Street</th>
					<th>City</th>
					<th>Zip</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["fName"]); ?></td>
				<td><?php echo escape($row["lName"]); ?></td>
				<td><?php echo escape($row["status"]); ?></td>
				<td><?php echo escape($row["dob"]); ?></td>
				<td><?php echo escape($row["gender"]); ?></td>
				<td><?php echo escape($row["year"]); ?></td>
				<td><?php echo escape($row["phone"]); ?></td>
				<td><?php echo escape($row["email"]); ?></td>
				<td><?php echo escape($row["street"]); ?></td>
				<td><?php echo escape($row["city"]); ?></td>
				<td><?php echo escape($row["zip"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>List all students on waiting list</h2>

<form method="post">
	<input type="submit" name="submit" value="View Results">
</form>
<br><br><br><br><br>
<a href="index.php">Back to home</a>
<?php require "templates/footer.php"; ?>