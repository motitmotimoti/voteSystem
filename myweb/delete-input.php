<html>
  <head>
    <title>投票システム</title>
  </head>
  <body>
    <h1><font color="RED">このページでは削除を行います</font></h1>
    <table>
      <tr>
	<th>投票番号</th>
	<th>投票日</th>
	<th>１位</th>
	<th>２位</th>
	<th>３位</th>
      </tr>

      <?php
	 $pdo = new PDO('mysql:host=localhost;dbname=vote_sample;charset=utf8','media','mediauser');
	 foreach($pdo -> query('select * from graphic') as $row){

      echo '<tr>';
	echo'<td>',$row['id'],'</td>';
	echo'<td>',$row['vote_date'],'</td>';
	echo'<td>',$row['first'],'</td>';
	echo'<td>',$row['second'],'</td>';
	echo'<td>',$row['third'],'</td>';
	echo'<td>';
	  echo'<a href="delete-output.php?id=',$row['id'],'">削除</a>';
	  echo'</td>';
	echo'</tr>';
      echo"\n";
      }
      ?>
    </table>
    <p>
      <button onclick="location.href='result.php'">投票結果画面へ</button>
    </p>
    
  </body>
</html>

