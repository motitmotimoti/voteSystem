<html>
  <head>
    <title>投票システム</title>
  </head>
  <body>

    <?php
       $pdo = new PDO('mysql:host=localhost;dbname=vote_sample;charset=utf8','media','mediauser');
       $spl = $pdo -> prepare('delete from graphic where id=?');

    if($spl -> execute([$_GET['id']]))
    {
    echo '削除しました。';
    }else{
    echo '削除に失敗しました。';
    }

    ?>

    <p>
      <button onclick="location.href='delete-input.php'">戻る</button>
    </p>

  </body>
</html>
