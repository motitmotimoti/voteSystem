<html>
  <head>
    <title>投票システム</title>
  </head>
  <body>
    過去の投票を検索します。<br><br>
    <form action="serch-output.php" method="post">
      投票番号：<input type="text" size="4" name="num"><br>
      投票日　：<input type="text" size="8" name="kw">(<font color='red'>yyyymmdd</font>の形で記入してください)<br>
      <input type="submit" value="検索">
    </form>
    
    <button onclick="location.href='result.php'">投票結果へ</button>

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
    
  </body>
</html>
