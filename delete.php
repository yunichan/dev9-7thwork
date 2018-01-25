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
            $stmt = $pdo->prepare('SELECT * FROM css_t WHERE id ="' . $id . '"');
            $stmt->execute();
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
    html,body{
        width: 100%;
        height: 100%;
        font-family: Roboto,Arial,sans-serif;
        scroll-behavior: smooth;
        margin:0;
        color:#929292;
        display:flex;
        justify-content:center;
        align-items:center;
        flex-direction:column;
        background-image:url(img2.jpg);
        background-size:cover;
    }
    #disp{
        width: 100vw;
        display:flex;
        flex-direction:row;
        flex-wrap:wrap;
        justify-content:center;
    }
    #disp_title{
        width: 100vw;
        display:flex;
        flex-direction:row;
        flex-wrap:wrap;
        justify-content:center; 
        margin-top:1vh;       
    }
    #comnt{
        display:flex;
        justify-content:center;
        align-items:center;
        color:#fff;
    }
    a{
        text-decoration:none;
    }
    #elem{
        width: 30vw;
        height: 200px;
        background:#ffa5a5a5;
        display:flex;
        justify-content:flex-end;
        align-items:center;
        padding:1%;
        flex-direction:column;
        position:relative;
    }
    #elem_t{
        width: 30vw;
        height: 200px;
        background:#e7dbff8c;
        display:flex;
        justify-content:flex-end;
        align-items:center;
        padding:1%;
        flex-direction:column;
    }
    #css_t{
        width: 30vw;
        height: 200px;
        background:#a8e8f9a7;
        display:flex;
        justify-content:flex-end;
        align-items:center;
        padding:1%;
        flex-direction:column;
        /* border: 5px solid #fff; */
        /* border-radius:10px; */
    }
    #elem_text{
        width: 30vw;
        height: 200px;
        overflow:auto;
        padding:1%;
    }
    #css_text{
        width: 30vw;
        height: 200px;
        overflow:auto;
        padding:1%;
    }

    #sbmt{
        width:30vw;
        height:7vh;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:100px;
        color:#fff;
        background:#ca5069;
        border:none;
        margin:auto;
        margin-top:2vh;
    }


</style>
</head>
<body>
<div id="comnt">削除しますか？</div>
<div id="disp_title">
        <div id="elem" style='height:5vh; color:#fff; background:#e48280; justify-content:center'>result</div>
        <div id="elem_text" style='height:5vh; justify-content:center; align-items:center; display:flex; color:#fff; background:#9581bd; '>html</div>
        <div id="css_text" style='height:5vh; justify-content:center; align-items:center; display:flex; color:#fff; background:#6baec1;'>css</div>
</div>
<form action="delete1.php" method="post">

    <?php while($result = $stmt->fetch(PDO::FETCH_ASSOC)){ ?>
        
        <div id="disp">
        <div id=elem>
            <?php echo $result['element'];?>
        </div>
        <div id="elem_t">
            <pre id=elem_text>
                <?php
                $new = htmlspecialchars($result['element'], ENT_QUOTES);        
                echo $new
                ?>
            </pre>
        </div>
        <div id="css_t">
            <pre id=css_text>
                <?php echo $result['css'];?>
            </pre>
        </div>
        <input type="submit" value="DELETE" id=sbmt>
        <input type="hidden" name="id" value="<?=$result['id']?>">
    </form>
    </dev>
    <?php }
    }
}
} 

?>



</body>
</html>