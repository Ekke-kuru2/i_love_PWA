<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="manifest" href="manifest.json">-->
<?php
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
$url = $_GET['url'];

if($data = file_get_contents(h($url))){
	$html = mb_convert_encoding($data, "utf-8", "auto");
	preg_match('/<title>(.*?)<\/title>/', $html, $result);

	$title = h($result[1]);
}else{
    //エラー処理
    if(count($http_response_header) > 0){
        //「$http_response_header[0]」にはステータスコードがセットされている
        $status_code = explode(' ', $http_response_header[0]);  //「$status_code[1]」にステータスコードの数字だけが入る
 
        //エラーの判別
        switch($status_code[1]){
            //404エラーの場合
            case 404:
                echo '<script>window.alert("指定したページが見つかりませんでした")</script>';
				header('Location: ./about.html');
                //break;
            //500エラーの場合
            case 500:
                echo '<script>window.alert("指定したページがあるサーバーにエラーがあります")</script>';
				//header('Location: ./about.html');
                break;
            //その他のエラーの場合
            default:
                echo '<script>window.alert("何らかのエラーによって指定したページのデータを取得できませんでした")</script>';
				//header('Location: ./about.html');
        }
    }else{
        //タイムアウトの場合 or 存在しないドメインだった場合
        echo '<script>window.alert("タイムエラー or URLが間違っています")</script>';
		//header('Location: ./about.html');
    }
	
}
?>
<link rel="manifest" href="data:application/json;base64,eyJzaG9ydF9uYW1lIjogIlBXQSIsIm5hbWUiOiAiUFdBIiwiZGlzcGxheSI6ICJzdGFuZGFsb25lIiwic3RhcnRfdXJsIjogImluZGV4Lmh0bWwiLCJpY29ucyI6IFt7InNyYyI6ImltYWdlcy9hcHAtaWNvbi0xOTIucG5nIiwic2l6ZXMiOiAiMTkyeDE5MiIsInR5cGUiOiAiaW1hZ2UvcG5nIn1dfQ==">
<title><?php echo $title;?></title>
<style>
	body{
		width:100%;
		height:100vh;
		margin:0;
		padding:0;
	}
	iframe{
		width:100%;
		height:100%;
		margin:0;
		padding:0;
	}
</style>
</head>
<body>
<?php echo '<h1>ははは</h1>'; ?>
<!--<iframe sandbox="allow-same-origin allow-forms allow-scripts" src="https://biology-manabiya.net/" frameborder="no"></iframe>-->

</body>
</html>
