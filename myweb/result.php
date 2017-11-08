<html>
  <head>
    <title>投票システム</title>
  </head>
  <body>
    <h1>投票結果</h1>
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

	 function h($str){
	 return htmlspecialchars($str);
	 }

	 foreach($pdo->query('select * from graphic') as $row){
      echo'<tr>';
	echo'<td>',h($row['id']),'</td>';
	echo'<td>',h($row['vote_date']),'</td>';
	echo'<td>',h($row['first']),'</td>';
	echo'<td>',h($row['second']),'</td>';
	echo'<td>',h($row['third']),'</td>';
	echo'</tr>';
      echo"\n";
      }

      ?>

    </table>
    <button onclick="location.href='serch.php'">編集</button>
    <button onclick="location.href='delete-input.php'">削除</button>
    <button onclick="location.href='vote.php'">投票画面へ</button>
  </body>
</html>

	
	
