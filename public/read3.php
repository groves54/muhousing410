<?php
$con=mysqli_connect("127.0.0.1","root","root","test");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM users");


mysqli_close($con);
?>


<html>
<head>
	<style type="text/css">
  #customers {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
  }

  #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
  }

  #customers tr:nth-child(even){background-color: #f2f2f2;}

  #customers tr:hover {background-color: #ddd;}

  #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #4CAF50;
      color: white;
  }
	</style>
</head>
<body>
	<h1>Query 1</h1>
	<table id="customers">
		<th>
			<tr>
				<th>Age</th>
			</tr>
		</th>
		<tbody>
		<?php
		while ($row = mysqli_fetch_array($query))
		{
			echo '<tr>
					<td>'.$row['age'].'</td>
  				</tr>';
  		}
      echo "</table>";
      ?>
  		</tbody>
  </body>
  </html>
