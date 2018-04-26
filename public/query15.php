<?php


if (isset($_POST['submit'])) {
	try {	
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT parkings.parkingName, count(vehicles.ID) as totalCars
				  FROM parkings
				  JOIN vehicles ON parkings.ID = vehicles.parkingID
				  WHERE parkings.parkingName = :parking";


			$parking = $_POST['parking'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':parking', $parking, PDO::PARAM_STR);
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
					<th>Parking Lot</th>
					<th>Total Number of Cars</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["parkingName"]); ?></td>
				<td><?php echo escape($row["totalCars"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['parking']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>Please enter Parking Lot name to get number of registered cars</h2>

<form method="post">
	<label for="parking">Parking Lot</label>
	<input type="text" id="parking" name="parking">
	<input type="submit" name="submit" value="View Results">
</form>
<br><br><br><br><br>
<a href="index.php">Back to home</a>
</div>
<?php require "templates/footer.php"; ?>