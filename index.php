<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>お問い合わせフォーム</title>
  <link rel="stylesheet" href="Mystyle.css">
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>
  <header>
    <div id="h">
      <p class="title">Y</p>
      <a href="" class="closebut">☓</a>
    </div>
  </header><!--ここまでがheader-->
  <main>

    <form action="sent.php" method="post" name="form" id="form">
      <div id="form-title"><!--フォームタイトルなど-->
        <p class="t">お問い合わせフォーム</p>
        <div class="t0">
          <ul>
            <li>※個人情報の取り扱いについて</li>
          </ul>
          <p class="t1">ご入力いただきましたお客様の個人情報は、本お問い合わせに関する回答以外の目的には利用いたしません。<br></p>
          <p class="t2"><span id="Required">(必須)</span>は必須入力項目です。</p>
        </div>
      </div>

      <div id="form-item"><!--フォームの内容-->

        <div id="form-mail"><!--メールアドレス-->
          <p class="mtitle">ご返信先メールアドレス</p>
          <div class="main">
            <p>メールアドレス <span id="Required">(必須)</span></p>
            <input type="text" name="Mail" autocomplete="off" id="Mail">
          </div>
          <div class="sub">
            <p>再入力</p><!--メールアドレス再入力-->
            <input type="text" name="ReMail" autocomplete="off" id="ReMail">
          </div>
        </div>

        <div id="form-name"><!--名前-->
          <p>氏名<span id="Required">(必須)</span></p>
          <input type="text" name="Name" autocomplete="off" id="Name">

        </div>

        <div id="form-age"><!--年齢-->
          <p>年齢</p>
          <select name="Age" id="Age">
            <option value="">選択してください</option>
            <?php for ($i=6; $i <= 100; $i++) {
              echo "<option value=$i>$i</option>" ;
            } ?>
          </select>
        </div>

        <div id="form-PhoneNum"><!--電話番号-->
          <p>ご連絡先電話番号</p>
          <input type="tel" name="PhoneNum" value="" autocomplete="off" id="PhoneNum">
        </div>

        <div id="form-types"><!--問い合わせ種類-->
          <p>お問い合わせの種類 <span id="Required">(必須)</span></p>
          <?php
          $types=array("料金に関するお問い合わせ","サービスに関するお問い合わせ","ご意見、ご要望","その他お問い合わせ");
          ?>
          <select name="Types" id="Types">
            <option value = "">選択してください</option>
            <?php
            foreach($types as $type){
              echo "<option value=$type>$type</option>" ;
            }
            ?>
          </select>
        </div>
        <div id="form-content">
          <p>お問い合わせの内容<span id="Required">(必須)</span></p>
          <h1>200文字まで</h1>
          <textarea name="Content" maxlength="200" id="Content"></textarea>
        </div>
        <!--  <input type="submit" value="確認" id="but1"> -->
        <button type="submit" id="but1">確認</button>
      </div>

    </form><!--ここまでがform-->


  </main><!--ここまでがmain-->
  <footer></footer>

  <script>


$('.closebut').click(function(){
  window.close();
});



  $('#but1').click(function(event){
    event.preventDefault();

    //formデータの取得
    var Mail = $('#Mail').val();
    var ReMail = $('#ReMail').val();
    var Name = $('#Name').val();

    //選択されたvalue属性値を取り出す
    var Age = $('#Age').val();
    //選択されている表示文字列を取り出す
    var AgeT = $('#Age option:selected').text();

    var PhoneNum = $('#PhoneNum').val();
    //選択されたvalue属性値を取り出す
    var Types = $('#Types').val();
    //選択されている表示文字列を取り出す
    var TypesT = $('#Types option:selected').text();

    var Content = $('#Content').val();

    $.ajax({
      async: false,
      url:'/sent.php',
      dataType:'json',
      type:'POST',
      data:{
        Mail:Mail,
        ReMail:ReMail,
        Name:Name,
        Age:Age,
        PhoneNum:PhoneNum,
        Types:TypesT,
        Content:Content
      }
    })
    .done(function(data){
      if(data.Name === "ナナチ"){
        if(data.Status === false){
          alert(data.Message);
        }else if(data.Status === true){
          $('#form').submit();
        }
      }
    }).fail(function(xmlhttprequest, textStatus, errorThrown){
      console.log(textStatus)
      alert('error');
    });

    $('form')[0].reset();
    $("html,body").animate({scrollTop:0},{duration:120});

  });


  </script>
</body>
</html>
