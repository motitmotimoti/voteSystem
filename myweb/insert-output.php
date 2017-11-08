<html>
  <head>
    <title>投票システム</title>
  </head>
  <body>
    <?php
       include ('./detail.php');
       
       $pdo = new PDO('mysql:host=localhost;dbname=vote_sample;charset=utf8','media','mediauser');
       
       $sql = $pdo -> prepare('insert into graphic values(null,now(),?,?,?)');
    print("a\n");
    
    $err = array();
    
    if(empty($_POST['gp1'])) {
    $err['gp1'] = '１位を投票してください。';
    }
    if(empty($_POST['gp2'])) {
    $err['gp2'] = '２位を投票してください。';
    } 
    if(empty($_POST['gp3'])) {
    $err['gp3'] = '３位を投票してください。';
    }
    if($_POST['gp1'] == $_POST['gp2'] || $_POST['gp1'] == $_POST['gp3'] || $_POST['gp2'] == $_POST['gp3']){
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
    echo $err['gp_all'];
    }
    
    }else
    if ($sql -> execute(
    [$person[$_POST['gp1']],$person[$_POST['gp2']],$person[$_POST['gp3']]]
    ))
    {
    echo '投票しました。';
    }else{
    echo '投票に失敗しました。';
    }
    ?>
    

    <p>
      <button onclick="history.back()">戻る</button>
      <button onclick="location.href='result.php'">結果</button>
      <button type="button" onclick="location.href='serch.php'">編集</button>
    </p>
  </body>
</html>

    
