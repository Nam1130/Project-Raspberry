<html>
<head>
  <title>PNV</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
 <style>
	.header{
		background: skyblue;
		height: 300px;
		}
	.title{
		text-align: center;
		font-size: 50px;
		padding-top: 70px;
		}
		h2{
			padding-top: 50px;
			text-align: center;
			}
 </style>
</head>


<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbName = "db";
	$conn = new mysqli($servername, $username, $password,$dbName );
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	
	if(isset($_GET['list_id'])){
		$sql = "UPDATE CheckOut SET Note=0 WHERE ID = ".$_GET['list_id'];
		$conn->query($sql);


	}
	if(isset($_GET['del_id'])){
		$sql = "DELETE FROM CheckOut WHERE ID = ".$_GET['del_id'];
		$conn->query($sql);
	}
	
?>
	<div class = "header">
		<div  class ="title">
			<p>Students Management</p>
			<p style="font-size: 70px;">PNV</p>
		</div>
		
	</div>
	<div class="container">
	  <h2>List time of students leaved the dorm after 9:30 pm</h2>            
	  <table class="table table-bordered" style ="margin: 40px">
		<thead>
		  <tr>
			<th>Date</th>
			<th>Time</th>
			<th>Note</th>
			<th>Delete</th>
		  </tr>
		</thead>
		<tbody>
			<?php
			$sql = "SELECT  ID, Date, Time, Note FROM CheckOut";
			$result = $conn->query($sql);
			$i =0;
			  while( $row = $result->fetch_assoc()){
			?>
				<tr>
					<td><?php echo $row["Date"]; ?></td>
					<td><?php echo $row["Time"]; ?></td>
					<td><?php if($row['Note']==1){
						?>
						<a class='btn btn-danger'  href="index.php?list_id=<?php echo $row["ID"]; ?>">Execute</a>
						<?php
							}else{
							?>
							<a  class='btn btn-success'>Executed</a>
							<?php
								
							}
							?>
						</td>
					
					<td>
						<a class='btn btn-danger' href="index.php?del_id= <?php echo $row["ID"]; ?>">Delete</a>
					</td>
				</tr>
			<?php
			$i++;
			}
			?>
		</tbody>
	  </table>
	 
	</div>


</html>
