<?php
require_once('db.php');
try{

  $db=getDb();
  $stt=$db->prepare("INSERT INTO form(Mail,Name,Age,PhoneNum,Types,Content) VALUES(:Mail, :Name, :Age, :PhoneNum, :Types, :Content)");
  $stt->bindValue(':Mail', $_POST['Mail']);
  $stt->bindValue(':Name', $_POST['Name']);
  if($_POST['Age'] == ""){
    $stt->bindValue(':Age', $_POST['Age'], PDO::PARAM_NULL);
  }else{
    $stt->bindValue(':Age', $_POST['Age']);
  }
  $stt->bindValue(':PhoneNum', $_POST['PhoneNum']);
  $stt->bindValue(':Types', $_POST['Types']);
  $stt->bindValue(':Content', $_POST['Content']);

  $stt->execute();
  $db=NULL;
}catch(PDOException $e){
   die("んなぁ...　残酷だなぁ...:{$e->getMessage()}");
}


?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>お問い合わせありがとう御座います</title>
    <link rel="stylesheet" href="post.css">
  </head>
  <body>
    <header>
    </header>
    <main>
        <img src="_DSC05.JPG" class="pic">
        <p>お問い合わせありがとうございました。</p>
      </div>
    </div>
    </main>
    <footer></footer>
  </body>
</html>
