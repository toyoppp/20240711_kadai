<?php
//1.  DB接続します
try {
  //ID:'root', Password: xamppは 空白 ''
  $pdo = new PDO('mysql:dbname=gs_db_class;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBConnectError:' . $e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_an_table");
$status = $stmt->execute();

//３．データ表示
if ($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:" . $error[2]);
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>フリーアンケート表示</title>
  <link rel="stylesheet" href="css/range.css">
  <link href="css/style.css" rel="stylesheet">
</head>

<body id="main">
  <header>
    <nav>
      <a href="index.php">データ登録</a>
    </nav>
  </header>

  <main>
    <div class="container">
      <h1>フリーアンケート一覧</h1>
      <div class="survey-list">
        <!-- PHP でデータを取得し、以下の形式で表示する -->

        <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)): ?> 
          <p> 
            <?= htmlspecialchars($result['date'], ENT_QUOTES, 'UTF-8') ?> : 
            <?= htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8') ?> - 
            <?= htmlspecialchars($result['content'], ENT_QUOTES, 'UTF-8') ?>
          </p>
        <?php endwhile; ?>



        <!-- 
             
              
        <div class="survey-card">
          <h2>山田 太郎</h2>
          <p class="email">yamada@example.com</p>
          <p class="content">アンケートの内容がここに表示されます。</p>
        </div>  -->
      </div>
    </div>
  </main>

</body>

</html>