<?php 
//PDOでデータベース接続
try {
	$pdo = new PDO('mysql:host=localhost;dbname=desing_db;charset=utf8','root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}

// 実行したいSQL文（最新順番3つ取得）
// $sql = 'SELECT*FROM css_t ORDER BY date DESC LIMIT 5';
$sql = 'SELECT*FROM css_t ORDER BY date';


//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$flag = $stmt->execute(); 


if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
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
        -webkit-transition: all .5s ease;
        -moz-transition: all .5s ease;
        transition: all .5s ease;
    }
    #regist:hover{
        background:#d83a74;
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
        -webkit-transition: all .5s ease;
        -moz-transition: all .5s ease;
        transition: all .5s ease;
    }
    #sbmt:hover{
        background:#50b3ca;
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
        position:relative;
    }
    #elem_t{
        width: 30vw;
        height: 200px;
        border: 5px solid #fff;
        background:#e7dbff;
        display:flex;
        justify-content:flex-end;
        align-items:center;
        padding:1%;
        border-radius:10px;
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
        border: 5px solid #fff;
        border-radius:10px;
    }
    .edit{
        display:flex;
        justify-content:center;
        align-items:center;
    }
    #delete_btn, #eleUp_btn, #cssUp_btn{
        color:#fff;
    }
    #delete_btn:hover{
        color:#c16565;
    }
    #eleUp_btn:hover{
        color:#8d70ad;
    }
    #cssUp_btn:hover{
        color:#7096ad;
    }
    #update,#delete{
        display:flex;
        justify-content:center;
        align-items:center;
        height: 5vh;
    }

    #elem_text{
        width: 30vw;
        height: 200px;
        background:#e7dbff;
        overflow:auto;
        padding:1%;
        border-radius:10px;
    }
    #css_text{
        width: 30vw;
        height: 200px;
        background:none;
        overflow:auto;
        border-radius:10px;
        padding:1%;
    }

    #disp_update{
        /* display:none; */
        width: 30vw;
        height:100vh;
    }


    

</style>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="top">
        <div id="toptext">animation memo</div>
        <!-- <img src="img1.jpg" alt="" id="topimg"> -->
    </div>


    <div class="container">
        <h1 id=regist>登録</h1>
        <form action="insert.php" method="post">
            <label for="title">html</label>
            <textarea type="element" name="element" id="element" style="resize:none" placeholder="<div class='test'>test</div>"></textarea>
            <label for="title">ccs</label>
            <textarea name="css" id="css" cols="30" rows="10" class="uk-textarea" style="resize:none" placeholder=".test{&#13;&#10;color:#000;&#13;&#10;}"></textarea>
            <input type="submit" value="regist" id=sbmt>
        </form>    
    </div>

    <div id="disp_title">
        <div id="elem" style='height:5vh; color:#fff; background:#e48280; justify-content:center'>result</div>
        <div id="elem_text" style='height:5vh; justify-content:center; align-items:center; display:flex; color:#fff; background:#9581bd;border: 5px solid #fff; '>html</div>
        <div id="css_text" style='height:5vh; justify-content:center; align-items:center; display:flex; color:#fff; background:#6baec1;border: 5px solid #fff;'>css</div>
    </div>
    <div id="disp">
        <?php
        //登録されたテキストをcssファイルに書き出し
        $file_name = './style.css';
        if(file_exists($file_name)){
            unlink($file_name);
        }
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
            //先頭の空白をトリミング
            $css = ltrim($result['css']);
            $file = fopen($file_name,"a");	// ファイル読み込み
            flock($file, LOCK_EX);			// ファイルロック
            fwrite($file, $css."\n");       // "\n"は改行コード
            flock($file, LOCK_UN);			// ファイルロック解除
            fclose($file);
            ?>
        <div id=elem>
            <?php echo $result['element'];?>
            <div class="edit">
                <form action="delete.php" method="post" style='display:flex;'>
                    <div id="delete"><input type="submit" value="Delete" id="delete_btn"></div>
                    <input type="hidden" name="id" value="<?=$result['id']?>">
                </form>
            </div>
        </div>
        <div id="elem_t">
            <pre id=elem_text>
                <?php
                $new = htmlspecialchars($result['element'], ENT_QUOTES);        
                echo $new
                ?>
            </pre>
            <div class="edit">
                <form action="update_ele.php" method="post" style='display:flex;'>
                    <div id="update"><input type="submit" value="Update" id="eleUp_btn"></div>
                    <input type="hidden" name="id" value="<?=$result['id']?>">
                </form>
            </div>
        </div>
        <div id="css_t">
            <pre id=css_text>
                <?php echo $css?>
            </pre>
            <div class="edit">
                <form action="update_css.php" method="post" style='display:flex;'>
                    <div id="update"><input type="submit" value="Update" id="cssUp_btn"></div>
                    <input type="hidden" name="id" value="<?=$result['id']?>">
                </form>
            </div>  
        </div>
        <?php }?>
    </div>
    
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>

$(function(){
    $("#regist").click(function(){
        $("#regist").hide();
        $("form").fadeIn('1000');
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
?>