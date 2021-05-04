<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
    </script>
    <title>ログイン画面</title>
</head>
<body>
    <form action="/top" method="post">
        @csrf
        <input type="text" name="address">
        <input type="text" name="password">
        <input type="submit" value="ログイン">
    </form>
</body>
</html>