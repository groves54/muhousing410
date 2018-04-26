<?php
$con=mysqli_connect("127.0.0.1","root","root","test");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM users");

echo "<table>
<tr>
<th>Age</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['age'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>
