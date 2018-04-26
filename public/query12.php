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

		$sql = "SELECT hallName, AVG(CAST(roomRent AS DECIMAL(12,2))) as avg, MIN(CAST(roomRent AS DECIMAL(12,2))) as min, MAX(CAST(roomRent AS DECIMAL(12,2))) as max
				   FROM rooms
				   JOIN halls on rooms.hallID = halls.ID
				   GROUP by hallName";	


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
					<th>Residence Hall</th>
					<th>Average Rent</th>
					<th>Minimum Rent</th>
					<th>Maximum Rent</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["hallName"]); ?></td>
				<td><?php echo escape($row["avg"]); ?></td>
				<td><?php echo escape($row["min"]); ?></td>
				<td><?php echo escape($row["max"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['location']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>Display rent statistics</h2>

<form method="post">
	<input type="submit" name="submit" value="View Results">
</form>
<br><br><br><br><br>
<a href="index.php">Back to home</a>
</div>
<?php require "templates/footer.php"; ?>