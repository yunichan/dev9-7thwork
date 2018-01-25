<?php 
//PDOでデータベース接続
try {
	$pdo = new PDO('mysql:host=localhost;dbname=desing_db;charset=utf8','root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}


$sql = 'SELECT*FROM css_t ORDER BY date';

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$flag = $stmt->execute(); 

if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{


    if(empty($_POST)) {
        echo "<a href='top.php'>こちらのページからどうぞ</a>";
        exit();
    }else{
        if (!isset($_POST['id'])  || !is_numeric($_POST['id']) ){
            echo "IDエラー";
            exit();
        }else{
            //プリペアドステートメント
            $id = $_POST['id'];
            $stmt = $pdo->prepare("SELECT css FROM css_t WHERE id = '" . $id . "'");
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

?>


 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css">    
    <title>input</title>
    
<style>

    #css_text{
        width: 30vw;
        height: 200px;
        border: 5px solid #fff;
        background:#a8e8f9a7;
        overflow:auto;
        padding:1%;
        border-radius:10px;
    }

    #disp_update{
        /* display:none; */
        width: 30vw;
        height:100vh;
    }
    form{
        width:100vw;
        display:flex;
        justify-content:center;
        align-items:center;
    }
    #css_tarea{
        margin-top:2vh;
        width:50vw;
        height:80vh;
        color:#929292;
        background:#333;
        border:none;
        display:flex;
        justify-content:center;
        align-items:center;
        padding:2%;
    }
    html,body{
        width: 100%;
        height: 100%;
        font-family: Roboto,Arial,sans-serif;
        scroll-behavior: smooth;
        margin:0;
        color:#929292;
        display:flex;
        flex-direction:column;
        justify-content:center;
        align-items:center;
    }
    input[type=submit]{
        margin-top:2vh;
        color:#929292;
        background:none;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        transition: all 0.5s ease;
        padding:1%;
        border: 1px solid #fff;
    }
    input[type=submit]:hover{
        color:#fff;
        background:#80a7e2;
        border: 1px solid #80a7e2;
    }
    #disp_update{
        width: 30vw;
        height:100vh;
    }

    form{
        width:100vw;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
    }
    input[type=text]{
        margin-top:2vh;
        width:50vw;
        height:80vh;
        color:#929292;
        background:#333;
        border:none;
        padding:2%;
    }
    

</style>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<!-- 修正 -->
    <form action="update_css1.php" method="post" style='display:flex;'>
        <textarea name="css" id="css_tarea" cols="30" rows="10"><?php print_r($result['css']);?></textarea>
        <input type="hidden" name="id" value="<?=$id?>">
        <input type="submit" value="変更する">
    </form>



</body>
</html>
<?php
        }
    }
}
?> 