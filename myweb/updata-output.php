<html>
  <head>
    <title>投票システム</title>
  </head>
  <body>
    <?php
       $date = $_POST['vote_date'];
       $date = str_replace("-","",$date);
       //echo $date;

       
       
       
       $pdo = new PDO ('mysql:host=localhost;dbname=vote_sample;charset=utf8','media','mediauser');
       $sql = $pdo -> prepare('update graphic set vote_date=?, first=?, second=?, third=? where id=?');
    $err = array();

 function h($str){
    return htmlspecialchars($str);
    }
    
  
    if($_REQUEST['first'] == $_REQUEST['second'] || $_REQUEST['first'] == $_REQUEST['third'] || $_REQUEST['second'] == $_REQUEST['third']){
    $err['gp_all'] = '１人に重複して投票できません。';
    }

    if(count($err) >= 1){
    if(isset($err['gp1'])){
    echo $err['gp1'].'</br>';
    }
    if(isset($err['gp2'])){
    echo $err['gp2'].'</br>';
    }
     if(isset($err['gp3'])){
    echo $err['gp3'].'</br>';
    }
    if(isset($err['gp_all'])){
    echo $err['gp_all'].'</br>';
    }
    }else
    if ($sql -> execute(
    [$_POST['vote_date'],h($_POST['first']),h($_POST['second']),h($_POST['third']),$_POST['id']]
    ))
    {
    echo '更新しました。';
    }else{
    echo '更新に失敗しました。';
    }
    ?>
     <p>
      <button onclick="history.back()">戻る</button>
      <?php
	 $location = "location.href='result.php'";
	 print"<input type='button' value='一覧に戻る' onclick=$location>";
	 ?>
    </p>
  </body>
</html>
