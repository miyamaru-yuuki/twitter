<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#nyuuryoku').hide();
            showToukou();

            $(document).on("click",".replybtn",function(){
                var toukouId = $(this).val();
                //toukouテーブルのデータを取得するAPI通信
                getToukou(toukouId);
                $('#nyuuryoku').show();
            });

            $('#ok').on('click', function() {
                $('#nyuuryoku').hide();
                var replycontent = $('#replycontent').val();
                var mototoukouId = $('#mototoukouId').val();
                var params = {
                    replycontent:replycontent,
                    mototoukouId:mototoukouId
                };
                reply(params);
            });

            function showToukou(){
                $.ajax({
                    url     : "/api/twitter",
                    type    : "GET",
                    async   : true,
                    data    : null,
                    dataType: "json",
                    success : function(json) {
                        json.toukouData.forEach(function(data){
                            $(".toukouList").append( '<div class="toukou"><div>' +data.name+ '(' +data.hi+ ')</div><div>' +data.contents+ '</div><div><button type="button" class="replybtn" value=' +data.toukouId+ '>返信</button></div></div>')
                            if(data.replyName) {
                                $(".toukouList").append('<div class="reply"><div>' + data.replyName + '(' + data.replyHi + ')</div><div>' + data.replyContents + '</div><div><button type="button" class="replybtn" value=' + data.replyToukouId + '>返信</button></div></div>')
                            }
                        });
                    },
                    error: function() {
                        alertError();
                    }
                });
            }

            function reply(params){
                $.ajax({
                    url     : "/api/twitter",
                    type    : "POST",
                    async   : true,
                    data    : params,
                    dataType: "json",
                    success : function(json) {
                        if(json.result){
                            $(".toukouList").empty();
                            showToukou();
                        }
                    },
                    error: function() {
                        alertError()
                    }
                });
            }

            function getToukou(toukouId){
                $.ajax({
                    url     : "/api/twitter/" +toukouId,
                    type    : "GET",
                    async   : true,
                    data    : null,
                    dataType: "json",
                    success : function(json) {
                        json.toukouList.forEach(function(data) {
                            $('#mototoukouId').val(data.toukouId);
                            $('.name').text(data.name);
                            $('#hi').text('(' +data.hi+ ')');
                            $('#contents').text(data.contents);
                        });
                    },
                    error: function() {
                        alertError()
                    }
                });
            }

            function alertError(){
                alert('http通信に失敗しました');
            }
        })
    </script>
    <title>トップ画面</title>
</head>
<body>
<p>ログインユーザー:{{$name}}</p>

<form action="/top" method="post">
    @csrf
    <p>投稿内容<p><textarea name="postcontents"></textarea></p></p>
    <input type="submit" value="ツイートする">
</form>

<h2>投稿一覧</h2>

<div class="toukouList">
</div>

<div id="nyuuryoku">
    <div><span class="name"></span><span id="hi"></span><br><span id="contents"></span></div>
    <div>{{$name}}の返信</div>
    <textarea rows="10" cols="60" id="replycontent"></textarea>
    <input type="hidden" value="" id="mototoukouId">
    <button type="button" id="ok">OK</button>
</div>

<h2>他のユーザー</h2>

<h3>ユーザー検索</h3>
<form action="/top" method="get">
    <input type="text" name="search" value="{{$search}}">
    <input type="submit" value="検索">
</form>
@foreach($userList as $user)
    <form action="/top" method="post">
        @csrf
        <input type="hidden" name="userId" value="{{$user->id}}">
        <div><span>{{$user->name}}</span><span><input type="submit" value="{{$user->val}}"></span><span>{{$user->status}}</span></div>
    </form>
@endforeach

</body>
</html>