<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">
    <title>登録フォーム</title>
</head>

<style>


</style>

<body>

<div class="container">
    <h1>登録</h1>
    <form action="insert.php" method="post">
        <ul>
            <li class="form-item">
                <label for="title">タイトル</label>
                <input type="element" name="element" id="element" class="uk-input">
            </li>
            <li class="form-item">
                <label for="title">code</label>
                <textarea name="css" id="css" cols="30" rows="10" class="uk-textarea"></textarea>
                <label for="title">tag</label>
                <textarea name="tag" id="tag" cols="30" rows="1" class="uk-textarea"></textarea>
            </li>
        </ul>
        <input type="submit" value="送信">
    </form>    
</div>
</body>
</html>