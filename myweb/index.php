<!DOCTYPE HTML>
<html lang="ja">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <title>投票システム</title>
  </head>
  <body>
    <form method="post" action="insert-output.php">
      グラフィックの１〜３位を選んでください。<br>
      <?php

	 include('./detail.php');
	
	 
	 
	 for ($h=1;$h<4;$h++){
			print ("<p>");
			print"$h 位\n";
			print("<br>");
			for($i=0;$i<count($person);$i++) {
			 print"<input type='radio'name='gp$h' value='$i'>{$person[$i]}<br>\n";
					 }
					 }
					 ?>
			<br>
			<input type="submit" name="submit" value="投票"><br>
			
    </form>
    <button onclick="location.href='result.php'">今までの投票結果を見る</button>
  </body>
</html>

    
