<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes">
    <title>ゲーム管理Git</title>
    <style>
    </style>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){

            $(document).on("click",".login",function(){
                var email = $("#email").val();
                var password = $("#password").val();

                $.ajax({
                    url     : "/api/login",
                    type    : "POST",
                    async   : true,
                    data    : {"email":email,"password":password},
                    dataType: "json",
                    success : function(json) {
                        //成功時の処理
                        if(json.ret){
                            localStorage.setItem('api_token', json.ret);
                            window.location.href ="{{ route("top.index") }}?api_token=" +localStorage.getItem('api_token');
                        }
                    },
                    error: function() {
                        console.log('error');
                    }
                });
            });

            // function showTop(){
            //     $.ajax({
            //         url     : "/top",
            //         type    : "GET",
            //         async   : true,
            //         data    : null,
            //         dataType: "json",
            //         success : function(json) {
            //             //成功時の処理
            //             console.log('json');
            //         },
            //         error: function() {
            //             console.log('error');
            //         }
            //     });
            // }
        })
    </script>
</head>
<body>
<header>
    <h1>ログイン</h1>
</header>
<nav>
</nav>
<main>
    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    </div>
    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
        <input id="password" type="password" name="password" required autocomplete="current-password">
    </div>
    <div class="form-group row">
        <input type="button" value="ログイン" class="login">
    </div>
</main>
<footer>
</footer>
</body>
</html>

