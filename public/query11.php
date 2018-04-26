<?php

if (isset($_POST['submit'])) {
	try {	
		require "../config.php";
		require "../common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT students.ID, students.fName, students.lName, advisors.advisorFname, advisors.advisorLname, advisors.advisorPhone
					FROM advisors
					JOIN students on advisors.ID = students.advisorID
					WHERE students.ID = :student";


			$student = $_POST['student'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':student', $student, PDO::PARAM_STR);
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
					<th>Advisor First Name</th>
					<th>Advisor Last Name</th>
					<th>Advisor Phone Number</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["ID"]); ?></td>
				<td><?php echo escape($row["fName"]); ?></td>
				<td><?php echo escape($row["lName"]); ?></td>
				<td><?php echo escape($row["advisorFname"]); ?></td>
				<td><?php echo escape($row["advisorLname"]); ?></td>
				<td><?php echo escape($row["advisorPhone"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['student']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>Please enter MU ID (901) to find thier advisor</h2>

<form method="post">
	<label for="student">MU ID</label>
	<input type="text" id="student" name="student">
	<input type="submit" name="submit" value="View Results">
</form>
<br><br><br><br><br>
<a href="index.php">Back to home</a>
</div>
<?php require "templates/footer.php"; ?>