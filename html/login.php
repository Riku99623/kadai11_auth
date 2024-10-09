
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./login.css">
</head>
<body>
    <form action="./login_act.php" method="post">
        <h2>LOGIN</h2>
        <label>ID</label>
        <input type="text" name="lid" placeholder="名前">
        <label>Password</label>
        <input type="password" name="lpw" placeholder="パスワード">

        <button type="submit">ログイン</button>

        アカウントをお持ちでない方は<a href="user.php">こちら</a>

       
    </form>
</body>
</html>