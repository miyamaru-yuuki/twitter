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

            function showGame(){
                $.ajax({
                    url     : "/api/game/",
                    type    : "GET",
                    async   : true,
                    data    : null,
                    dataType: "json",
                    success : function(json) {
                        //成功時の処理
                        json.gameData.forEach(function(data){
                            $("#gname").append( '<tr><td>' +'<a href="' +data.gid +'" class="gname">'+data.gname+ '</a></td><td>' +'<a href="' +data.gid +'" class="del">削除</a></td><td>' +'<a href="' +data.gid +'" class="edit">変更</a></td></tr>')
                        });
                    },
                    error: function() {
                        alertError()
                    }
                });
            }

            function addGame(params){
                $.ajax({
                    url     : "/api/game",
                    type    : "POST",
                    async   : true,
                    data    : params,
                    dataType: "json",
                    success : function(json) {
                        //成功時の処理
                        if(json.result){
                            $("#gname").empty();
                            showGame();
                            $("#fm1 input[name]").val('');
                        }
                    },
                    error: function() {
                        alertError()
                    }
                });
            }

            function editGame(params){
                params['_method'] = 'PUT';
                $.ajax({
                    url     : "/api/game/" + params.gid,
                    type    : "POST",
                    async   : true,
                    data    : params,
                    dataType: "json",
                    success : function(json) {
                        //成功時の処理
                        if(json.result){
                            $("#gname").empty();
                            showGame();
                            $("#fm1 input[name]").val('');
                            $("#submit").val('追加');
                            $("#gid").val(0);
                        }
                    },
                    error: function() {
                        alertError()
                    }
                });
            }

            function deleteGame(gid){
                $.ajax({
                    url: "/api/game/" + gid,
                    type: "POST",
                    async: true,
                    data: {"gid": gid, "_method": "DELETE"},
                    dataType: "json",
                    success: function (json) {
                        //成功時の処理
                        if (json.result) {
                            $("#gname").empty();
                            showGame();
                        }
                    },
                    error: function () {
                        alertError()
                    }
                });
            }

            function showGameSingle(obj){
                $.ajax({
                    url: "/api/game/" + obj.gid,
                    type: "GET",
                    async: true,
                    data: null,
                    dataType: "json",
                    success: obj.out,
                    error: function () {
                        alertError()
                    }
                });
            }

            function alertError(){
                alert('http通信に失敗しました');
            }

            // showGame();

            $(document).on("click",".gname",function(){
                var gid = $(this).attr("href");
                showGameSingle({gid:gid,
                    out:function (json){
                        $("#gnametd").text(json.gameData.gname)
                        $("#playersnumbermintd").text(json.gameData.playersnumbermin)
                        $("#playersnumbermaxtd").text(json.gameData.playersnumbermax)
                        $("#playtimetd").text(json.gameData.playtime)
                        $("#recommendedagetd").text(json.gameData.recommendedage)
                    }}
                );
                return false;
            });

            $(document).on("click",".edit",function(){
                var gid = $(this).attr("href");
                showGameSingle({gid:gid,
                    out:function(json){
                        $("#gid").val(json.gameData.gid)
                        $("[name=gname]").val(json.gameData.gname)
                        $("[name=playersnumbermin]").val(json.gameData.playersnumbermin)
                        $("[name=playersnumbermax]").val(json.gameData.playersnumbermax)
                        $("[name=playtime]").val(json.gameData.playtime)
                        $("[name=recommendedage]").val(json.gameData.recommendedage)

                        $("#submit").val('変更');
                    }}
                );
                return false;
            });

            $(document).on("click",".del",function(){
                var gid = $(this).attr("href");
                if(!confirm('本当に削除しますか？')) {
                    return false;
                }
                deleteGame(gid)
                return false;
            });

            $('#fm1').submit(function(){

                var params = {
                    gid:$("#gid").val(),
                    gname:$("[name=gname]").val(),
                    playersnumbermin:$("[name=playersnumbermin]").val(),
                    playersnumbermax:$("[name=playersnumbermax]").val(),
                    playtime:$("[name=playtime]").val(),
                    recommendedage:$("[name=recommendedage]").val()
                };

                if(params.gid !== "0"){
                    editGame(params)
                }else{
                    addGame(params)
                }
                return false;
            });

            $(document).on("click",".login",function(){
                var email = $("#email").val();
                var password = $("#password").val();
                console.log(email);

                $.ajax({
                    url     : "/api/login",
                    type    : "POST",
                    async   : true,
                    data    : {"email":email,"password":password},
                    dataType: "json",
                    success : function(json) {
                        //成功時の処理
                        if(json.result){
                            console.log(json.result);
                        }
                    },
                    error: function() {
                        alertError()
                    }
                });
            });
            //     var zip = $("*[name=zip]").val();
            //     $.ajax({
            //         url     : "https://zipcloud.ibsnet.co.jp/api/search",
            //         type    : "GET",
            //         async   : true,
            //         data    : {"zipcode": zip},
            //         dataType: "json",
            //         success : function(json) {
            //             //成功時の処理
            //             console.log(json);
            //             // json.gameData.forEach(function(data){
            //             //     $("#gname").append( '<tr><td>' +'<a href="' +data.gid +'" class="gname">'+data.gname+ '</a></td><td>' +'<a href="' +data.gid +'" class="del">削除</a></td><td>' +'<a href="' +data.gid +'" class="edit">変更</a></td></tr>')
            //             // });
            //         },
            //         error: function() {
            //             alertError()
            //         }
            //     });
            //     return false;
            // });

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
</div>
</body>
</html>

