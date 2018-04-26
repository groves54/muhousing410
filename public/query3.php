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

		$sql = "SELECT *
					FROM leases
					WHERE  leaseDuration = 'summer'";


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
					<th>Lease Duration</th>
					<th>MU ID</th>
					<th>Room Identifier</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["leaseStart"]); ?></td>
				<td><?php echo escape($row["leaseStart"]); ?></td>
				<td><?php echo escape($row["leaseCity"]); ?></td>
				<td><?php echo escape($row["leaseStreet"]); ?></td>
				<td><?php echo escape($row["leaseZip"]); ?></td>
				<td><?php echo escape($row["leaseDuration"]); ?></td>
				<td><?php echo escape($row["studentID"]); ?></td>
				<td><?php echo escape($row["roomID"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>Find all leases that end in summer</h2>

<form method="post">
	<input type="submit" name="submit" value="View Results">
</form>
<br><br><br><br><br>
<a href="index.php">Back to home</a>
</div>
<?php require "templates/footer.php"; ?>