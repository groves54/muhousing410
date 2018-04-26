<?php

/**
 * Function to query information based on 
 * a parameter: in this case, location.
 *
 */

if (isset($_POST['submit'])) {
	try {	
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT leases.ID AS leaseNum, leases.leaseStart, leases.leaseEnd, leases.leaseCity, leases.leaseStreet, leases.leaseZip, students.ID AS muNum, students.fName, students.lName
				   FROM students, leases
				   WHERE  leases.studentID = students.ID";


		$statement = $connection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php require "templates/header.php"; ?>
<div class = "container">
<?php  
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>Lease Number</th>
					<th>Lease Start</th>
					<th>Lease End</th>
					<th>City</th>
					<th>Street</th>
					<th>Zip Code</th>
					<th>MU ID</th>
					<th>First Name</th>
					<th>Last Name</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["leaseNum"]); ?></td>
				<td><?php echo escape($row["leaseStart"]); ?></td>
				<td><?php echo escape($row["leaseStart"]); ?></td>
				<td><?php echo escape($row["leaseCity"]); ?></td>
				<td><?php echo escape($row["leaseStreet"]); ?></td>
				<td><?php echo escape($row["leaseZip"]); ?></td>
				<td><?php echo escape($row["muNum"]); ?></td>
				<td><?php echo escape($row["fName"]); ?></td>
				<td><?php echo escape($row["lName"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>Find all leases and student information</h2>

<form method="post">
	<input type="submit" name="submit" value="View Results">
</form>
<br><br><br><br><br>
<a href="index.php">Back to home</a>
</div>
<?php require "templates/footer.php"; ?>