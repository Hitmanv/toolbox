<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Admin Template">
    <meta name="keywords" content="admin dashboard, admin, flat, flat ui, ui kit, app, web app, responsive">
    <link rel="shortcut icon" href="img/ico/favicon.png">
    <title>Login</title>

    <link href="{{ config('toolbox.asset_path') }}/css/style.css" rel="stylesheet">
    <link href="{{ config('toolbox.asset_path') }}/css/style-responsive.css" rel="stylesheet">



</head>

<body class="login-body">

<div class="login-logo">
    <i class="fa fa-dollar"></i>
</div>

<h2 class="form-heading">后台登录</h2>
<div class="container log-row">
    <form class="form-signin" action="/admin/login" method="post">
        {!! csrf_field() !!}
        <div class="login-wrap">
            <input type="text" class="form-control" placeholder="用户名" autofocus name="name">
            <input type="password" class="form-control" placeholder="密码" name="password">
            <button class="btn btn-lg btn-success btn-block" type="submit">登录</button>
        </div>
    </form>
</div>


<!--jquery-1.10.2.min-->
<script src="{{ config('toolbox.asset_path') }}/js/jquery-1.11.1.min.js"></script>
<!--Bootstrap Js-->
<script src="{{ config('toolbox.asset_path') }}/js/bootstrap.min.js"></script>

</body>
</html>
