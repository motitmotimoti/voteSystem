<html>
  <head>
    <title>投票システム</title>
  </head>
  <body>
    <table>
      <tr>
	<th>投票番号</th>
	<th>投票日</th>
	<th>１位</th>
	<th>２位</th>
	<th>３位</th>
      </tr>

      <?php
	 $errormsg = array ();
	 

	 if(empty($_POST['kw']) && empty($_POST['num'])){
	 $errormsg = '投票番号、投票日のどちらかを入力してください';
	 $flag = FALSE;
	 echo "<FONT COLOR='RED'>$errormsg</FONT>" .'</br>';
	 }
	
      
	 print($_POST['kw']);
	 
	 if(isset($_POST['kw'])){
	 $date = $_POST['kw'];
	 }else{
	 $date = null;
	 }
	 print($date);
	 

	  if(isset($_GET['date'])){
	 $date = $_GET['date'];
	 }else{
	 $date = null;
	 }
	 
	 

	 
	 if(isset($_POST['num'])){
	 $num = $_POST['num'];
	 }else{
	 $num = null;
	 }
	 

	 
	 
	 $pdo = new PDO('mysql:host=localhost;dbname=vote_sample;charset=utf8','media','mediauser');
	 $sql = $pdo -> prepare('select * from graphic where id=? or vote_date=?');
      
      $sql -> execute([$num,$date]);

      

      foreach($sql->fetchAll () as $row){
      echo '<tr>';
	echo'<td>',$row['id'],'</td>';
	echo'<td>',$row['vote_date'],'</td>';
	echo'<td>',$row['first'],'</td>';
	echo'<td>',$row['second'],'</td>';
	echo'<td>',$row['third'],'</td>';
	echo'</tr>';
      echo"\n";
      }

      if(empty($row['id']) && empty($row['vote_date'])){
      echo '<font color="RED">投票データが存在しません。</font>';
      }


      
      ?>

    </table>
    <p>
      <button type="button" onclick="location.href='serch.php'">検索に戻る</button>
      <?php
	 $location = "location.href='updata.php?kw=$date&kw1=$num'";
	 print"<input type='button' value='投票内容の変更' onclick=$location>";
	 ?>
  </body>
</html>

	  
	
