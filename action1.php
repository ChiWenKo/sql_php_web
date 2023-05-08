<a href = "logout.php"><button>登出</button></a><p>
<a href = "action2.php"><button>加選</button></a>
<a href = "action4.php"><button>退選</button></a><p>

<?php
//學生個人資訊
	
		session_start(); //開始存取
		$student_id=$_SESSION["student_id"] ;
	
		$dbhost = '127.0.0.1';
		$dbuser = 'hj';
		$dbpass = 'test1234';
		$dbname = 'testdb';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection');
		mysqli_query($conn, "SET NAMES 'utf8'");
		mysqli_select_db($conn, $dbname);
		$sql = "SELECT distinct s_id, s_name,major,credits,s_grade
				FROM student 
				where s_id =".$student_id.";";
		$result = mysqli_query($conn, $sql) or die('MySQL query error');
		
		echo "個人資訊";	
		echo "<br><table border='1'><br>";
		echo "<tr> 
				<th> 學號 </th> 
				<th> 姓名 </th>
				<th> 科系 </th>
				<th> 年級 </th> 
				<th> 已選學分 </th> 
			<tr>";
		while($row = mysqli_fetch_array($result)){
			echo "<tr>";
			echo "<td>" .$row['s_id']."</td>";
			echo "<td>" .$row['s_name']."</td>";
			echo "<td>" .$row['major']."</td>";			
			echo "<td>" .$row['s_grade']."</td>";			
			echo "<td>" .$row['credits']."</td>";
			echo "<tr>";
		
		}
		echo "</table>";

		//查詢已選列表
		$sql = "SELECT distinct  c_id, c_name, required, c_credit, day, start_time,end_time 
				FROM enrollments 
				where s_id =".$student_id.";";
		$result = mysqli_query($conn, $sql) or die('MySQL query error');
		
		echo "<br>學號",$student_id." 's 的課表<br>";	
		echo "<table border='1'><br>";
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
