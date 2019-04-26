<?php

ini_set("display_errors",1);
error_reporting(E_ALL);

function isAjax(){
  if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    return true;
  }else{
    return false;
  }
}

function check($data){

  if(!isset($data['Mail'], $data['ReMail'] , $data['Name'] , $data['Age'] ,
  $data['PhoneNum'] , $data['Types'] , $data['Content'] )){

    return array('Status' => false, 'Message' => "もう疲れた");

  }
  //データを変数に格納
  $Mail = $data['Mail'];
  $ReMail = $data['ReMail'];
  $Name = $data['Name'];
  $Age = $data['Age'];
  $PhoneNum = $data['PhoneNum'];
  $Types = $data['Types'];
  $Content = $data['Content'];
  $Message = "";
  $Status = true;


  //全体の入力確認
  if ( $Mail == NULL || $ReMail == NULL || $Name == NULL || $Types == NULL || $Content == NULL){
    $Message .= "必須項目が入力されていません。\n";
    $Status  = false;
  }

  //メールアドレス入力確認
  if($Mail == NULL){
    $Message .= "メールアドレスを入力してください。\n";
    $Status  = false;
  }

  //メールアドレス再入力確認
  if($ReMail == NULL){
    $Message .= "メールアドレス(再入力)は必須です。\n";
    $Status  = false;
  }

  //メールアドレスの形式確認
  if (preg_match("/^([a-zA-Z0-9_\-\.]+)\@([a-zA-Z0-9\-\]+).\([a-zA-Z0-9]{2,20})$/", $Mail)){
  }else{
    $Message .= "このメールアドレスは使用できません。\n";
    $Status = false;
  }

  //メールアドレスの整合性確認
  if ($Mail != $ReMail) {
    $Message .= "メールアドレスが一致しません。\n";
    $Status  = false;
  }
  //氏名のバリデーション処理
  if($Name == NULL){
    $Message .= "氏名を入力してください。\n";
    $Status  = false;
  }

  //電話番号の形式チェック
  if(preg_match("/^[0-9]{2,4}-[0-9]{2,9}-[0-9]{3,4}$/", $PhoneNum)){
    str_replace(array('-', 'ー'), '', $PhoneNum);
  }elseif (preg_match("/^[0-9]{10,11}$/",$PhoneNum)) {
  }elseif ($PhoneNum == NULL || $PhoneNum == ""){
  }else{
    $Message .= "この電話番号は使用できません。\n";
    $Status  = false;
  }

  //お問い合わせの種類の選択チェック
  if($Types == NULL){
    $Message .= "お問い合わせの種類を選択してください。\n";
    $Status  = false;
  }

  //お問い合わせ内容のバリデーション処理
  if($Content == NULL){
    $Message .= "お問い合わせ内容を入力してください。";
    $Status  = false;
  }

  return array('Status' => $Status, 'Message' => $Message , 'Name' => "ナナチ");
}

$data = array(
  'Mail' => $_POST['Mail'],
  'ReMail' => $_POST['ReMail'],
  'Name' => $_POST['Name'],
  'Age' => $_POST['Age'],
  'PhoneNum' => $_POST['PhoneNum'],
  'Types' => $_POST['Types'],
  'Content' => $_POST['Content'],
);

$success = check($data);

if(isAjax()){
  echo json_encode($success);
  exit ();
}


if($success['Status'] == false){
  header('location:index.php');
  exit ();
}


//データを変数に格納
$Mail = $_POST['Mail'];
$ReMail = $_POST['ReMail'];
$Name = $_POST['Name'];
$Age = $_POST['Age'];
$PhoneNum = $_POST['PhoneNum'];
$Types = $_POST['Types'];
$Content = $_POST['Content'];




?>
<!DOCTYPE html>
<html lang="ja" >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>お問い合わせ内容の確認</title>
  <link rel="stylesheet" href="sent.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>
  <header>
    <div id="h">
      <p class="title">Y</p>
    </div>
  </header><!---ここまでがheader-->
  <main>
    <form class="" action="post.php" method="post">

      <p class="check-message">ご入力内容の確認。</p>

      <div class="form-content">
        <p class="form-title">入力内容</p>
        <p >■　メールアドレス</p><!--メールアドレス-->
        <input type="text" name="Mail" autocomplete="off" class="form-item" style="display:none;" value="<?php echo $Mail; ?>">
        <?php echo $Mail; ?>

        <p>■　名前</p><!--名前-->
        <input type="text" name="Name" autocomplete="off" class="form-item" style="display:none;" value="<?php echo $Name; ?>">
        <?php echo $Name; ?>

        <p>■　年齢</p><!--年齢-->
        <input type="text" name="Age" autocomplete="off" class="form-item" style="display:none;" value="<?php echo $Age; ?>">
        <?php echo $Age; ?>

        <p>■　ご連絡先電話番号</p><!--電話番号-->
        <input type="text" name="PhoneNum" autocomplete="off" class="form-item" style="display:none;" value="<?php echo str_replace(array('-', 'ー'), '', $PhoneNum);?>">
        <?php echo str_replace(array('-', 'ー'), '', $PhoneNum); ?>

        <p>■　お問い合わせの種類</p><!--種類-->
        <input type="text" name="Types" autocomplete="off" class="form-item" style="display:none;" value="<?php echo $Types; ?>">
        <?php echo $Types; ?>

        <p>■　お問い合わせ内容</p><!--お問い合わせ内容-->
        <input type="text" name="Content" autocomplete="off" class="form-item" style="display:none;" value="<?php echo $Content; ?>">
        <?php echo $Content, '<br>'; ?>

        <input type="submit" value="確認して送信" align="right" id="sent">
      </div><!--ここまでが確認-->
    </form>
  </main><!--ここまでがmain-->
  <footer></footer><!--ここまでがfooter-->
  <script></script>
</body>
</html>
