<?php
session_start(); // セッションを開始

// ここにすでに他のインクルードがあるので、セッションの初期化を追加
include('./dbconfig.php');
include('./getdatas.php');
include('./header.php');
?>

<div class="detailImageBox">
  <div class="detailImage">
    <img src="./images/<?php echo $data['image']['Image_name']; ?>" alt="投稿画像">
    <div class="detailImagButton">

      <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
        <!-- 管理者のみ表示される更新・削除ボタン -->
        <button class="updateButton" onclick="location.href='./postImageForm.php?id=<?php echo $_GET['id']; ?>';">更新</button>
        <button class="deleteButton" onclick="location.href='./delete.php?id=<?php echo $_GET['id']; ?>';">削除</button>
      <?php endif; ?>

    </div>
    <button onclick="location.href='./index.php';">戻る</button>
  </div>
  <div class="comment">
    <p class="commentTitle">コメント</p>
    <ul>
      <?php for($i=0; $i<$countComment; $i++) { ?>
        <li><?php echo $data['comments'][$i]['comment']; ?></li>
      <?php } ?>
    </ul>
    <div class="submitComment">
      <form action="./comment.php?image_id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
        <textarea name="comment" id="comment" cols="40" rows="10"></textarea>
        <button type="submit" name="submit">送信</button>
      </form>
    </div>
  </div>
</div>
