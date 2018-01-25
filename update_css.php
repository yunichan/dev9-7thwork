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
    html,body{
        width: 100%;
        height: 100%;
        font-family: Roboto,Arial,sans-serif;
        scroll-behavior: smooth;
        margin:0;
        color:#929292;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        
    }
    #top{
        width: 100vw;
        height:100vh;
        background-image:url(img1.jpg);
        background-size:cover;
        animation: big 10s ease infinite;
    }
    @keyframes big{
        0%{
            transform: scale(1) translateY(0);
        }
        50%{
            transform: scale(1.03);
        }
        0%{
            transform: scale(1);
        }
    }
    #toptext{
        text-align: center;
        margin-top: 6%;
        color: #fff;
        font-family: serif;
        width: 100%;
        position: absolute;
        z-index: 10;
        font-size: 50px;
    }

    .container{
        width: 100%;
        height: 17vh;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:3vh;
        flex-direction:column;
    }
    #regist{
        width:30vw;
        height:7vh;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:100px;
        color:#fff;
        background:#a76b9a;
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

    form{
        display:none;
        flex-direction:column;
        width:60%;
        margin:auto;
        text-align:center;
    }
    ::placeholder{
        color:#c1c1c1;
    }
    label[for=title]{
        text-align:left;
        height:6vh;
        display:flex;
        align-items:flex-end;
        margin-bottom:1vh;
    }
    input[type=submit]{
        margin-top:2vh;
        color:#929292;
        background:none;
        border:none;
    }
    label,input{
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    textarea{
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-color: #fff;
        color: #929292);
        
    }
    
    ul{
        width: 100%;
        height: 100%;
    }
    li{
        width: 100%;
        display: flex;
        background:#333333;
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
    .content{
        width: 70%;
        height: 100px;
        overflow: auto;
        background: #ffbbbb;
    }
    
    #input{
        width: 100%;
        height: 100px;
        background: #ff8888;
        z-index: 10;
    }
    
    #elem{
        width: 30vw;
        height: 200px;
        border: 5px solid #fff;
        background:#ffa5a5a5;
        display:flex;
        justify-content:flex-end;
        align-items:center;
        padding:1%;
        border-radius:10px;
        flex-direction:column;
    }
    #edit{
        display:flex;
        justify-content:center;
        align-items:center;
    }
    #update,#delete{
        display:flex;
        justify-content:center;
        align-items:center;
        width: 10vw;
        height: 5vh;
    }
    #elem_text{
        width: 30vw;
        height: 200px;
        border: 5px solid #fff;
        background:#e7dbff;
        overflow:auto;
        padding:1%;
        border-radius:10px;
    }
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

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>

$(function(){
    $("#regist").click(function(){
        $("#regist").hide();
        $("form").show();
        $("form").css({'display':'flex'});
        $(".container").css({'height':'100vh'});
        $(".container").css({'background-image':'url(img0.jpg)'});
        $(".container").css({'background-size':'cover'});
    });
});




</script>

</body>
</html>
<?php
        }
    }
}
?> 