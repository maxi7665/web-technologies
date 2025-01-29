<html>

<head>
	
</head>
<body>

	<h1>Выпуски</h1>

	<ul>

	<?php

		$servername = "localhost";
		$username = "root";
		$password = "qwsxza";
		$dbname = "web";

		$conn = new mysqli($servername, $username, $password, $dbname);		

		$sql = "SELECT * FROM releases order by code desc";
		$result = $conn->query($sql);

		while ($row = $result->fetch_assoc()) 
		{
			echo "<li>".$row["code"]."</li>";
		}	
	?>
	
	</ul>

</body>
</html>