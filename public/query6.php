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

		$sql = "SELECT apartments.apartmentName, inspections.*
				   FROM apartments
				   JOIN inspections on inspections.apartmentID = apartments.ID
				   WHERE inspectionStatus = 'unsatisfactory'";


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
					<th>Apartment</th>
					<th>Inspection Date</th>
					<th>Inspection Status</th>
					<th>Inspection Comments</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["apartmentName"]); ?></td>
				<td><?php echo escape($row["inspectionDate"]); ?></td>
				<td><?php echo escape($row["inspectionStatus"]); ?></td>
				<td><?php echo escape($row["inspectionComment"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>Find all apartments that are unsatisfactory</h2>

<form method="post">
	<input type="submit" name="submit" value="View Results">
</form>
<br><br><br><br><br>
<a href="index.php">Back to home</a>
</div>
<?php require "templates/footer.php"; ?>