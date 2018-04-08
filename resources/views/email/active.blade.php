<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>激活页面</title>
</head>
<body>
    <p>亲爱的{{ $user->email }}感谢您注册我们的网站，请在24小时内<a href="http://www.lar199.com/active?id={{ $user->id }}&token={{ $user->token }}">激活</a>您的账号，你有激活账号才可以登录.
    注：第一次测试 麻烦各位！！</p>

</body>
</html>