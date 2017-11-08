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
      if(isset($_GET['kw'])){
      $kw = $_GET['kw'];
      //echo $kw;
      }else{
      $kw = NULL;
      }

      
      if(isset($_GET['kw1'])){
      $kw1 = $_GET['kw1'];
      //echo $kw1;
      }else{
      $kw1 = NULL;
      }
      
      
      $pdo = new PDO('mysql:host=localhost;dbname=vote_sample;charset=utf8','media','mediauser');
      $sql = $pdo->prepare('select * from graphic where id=? or vote_date=?');
   $sql->execute([$kw1,$kw]);
   
   foreach($sql->fetchAll() as $row){
   echo '<tr><form action="updata-output.php" method="post">';
       echo '<input type="hidden" name="id" value="',$row['id'],'">';
       echo '<td>',$row['id'],'</td>';
       echo '<input type="hidden" name="vote_date" value="',$row['vote_date'],'">';
       echo '<td>',$row['vote_date'],'</td>';
       echo '<td>';
	 echo '<input type="text" name="first" value="',$row['first'], '">';
	 echo '</td>';
       echo '<td>';
	 echo '<input type="text" name="second" value="',$row['second'], '">';
	 echo '</td>';
       echo '<td>';
	 echo '<input type="text" name="third" value="',$row['third'], '">';
	 echo '</td>';
       echo '<td><input type="submit" value="更新"></td>';
       echo '</form></tr>';
   echo "\n";
   
   
   }
   
   
   ?>
   
   <h4><font color='red'>氏名と名前の間は１マス空けてください。</font></h4>
   
 </table>
 <?php
    include('./detail.php');
    print("<p>");
    print("[メンバー]");
    print("<br>");
    for($i=0;$i<count($person);$i++){
		  print($person[$i]);
		  print("<br>");
		  }
		  ?>
    </body>
</html>

