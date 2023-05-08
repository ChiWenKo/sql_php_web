退選系統<p>
<a href="action1.php"><button>查看課表</button></a>

<a href = "logout.php"><button>登出</button></a></p>

<form name="table4" method="post" action="action5.php">
請輸入想退選的課程代號: <input name ="drop_c_id">
<input type="submit" value="退選">
</form>

<?php
	if (isset($_GET['status'])) {
		if($_GET['status'] === 'compulsory'){
			echo '<p>必修課程不可退選 !</p>';//必修課程不可退選
		}
		if($_GET['status'] === 'less than 9'){
			echo '<p>低於9學分不可退選 !</p>';//低於9學分不可退選
		}
		if($_GET['status'] === 'unselected'){
			echo '<p>退選成功 !</p>';//退選成功
		}
		
		
	}
	//課程退選
	session_start();
		$student_id=$_SESSION["student_id"] ;
	
		$dbhost = '127.0.0.1';
		$dbuser = 'hj';
		$dbpass = 'test1234';
		$dbname = 'testdb';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
		mysqli_query($conn, "SET NAMES 'utf8'");
		mysqli_select_db($conn, $dbname);
		$sql = "SELECT distinct  c_id, c_name, required, c_credit, day, start_time,end_time 
				FROM enrollments 
				where s_id =".$student_id.";";
		$result = mysqli_query($conn, $sql) or die('MySQL query error');
		
		echo "Student ",$student_id." 's enrollments";	
		echo "<table border='1'>";
		echo "<tr> 
				<th> 選課代號 </th> 
				<th> 課程名稱 </th>
				<th> 必選修 </th>
				<th> 學分數 </th> 
				<th> 上課日 </th> 
				<th> 上課 </th> 
				<th> 下課 </th>
			<tr>";
		while($row = mysqli_fetch_array($result)){
			echo "<tr>";
			echo "<td>" .$row['c_id']."</td>";
			echo "<td>" .$row['c_name']."</td>";
			echo "<td>" .$row['required']."</td>";
			echo "<td>" .$row['c_credit']."</td>";
			echo "<td>" .$row['day']."</td>";
			echo "<td>" .$row['start_time']."</td>";
			echo "<td>" .$row['end_time']."</td>";
			echo "<tr>";
		
		}
		echo "</table>";
		
?>
