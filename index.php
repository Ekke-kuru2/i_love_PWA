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
    echo '<script>var s=10;setInterval(()=>{s=s-1;document.getElementById("notice").innerHTML="エラーが発生しました。"+s+"秒でホームページに遷移します。";if(s<=0){location.href="./about.html"}},1000);</script>';
	
}
?>

<link rel="manifest" href="data:application/json;base64,eyJzaG9ydF9uYW1lIjogIlBXQSIsIm5hbWUiOiAiUFdBIiwiZGlzcGxheSI6ICJzdGFuZGFsb25lIiwic3RhcnRfdXJsIjogImluZGV4Lmh0bWwiLCJpY29ucyI6IFt7InNyYyI6ImltYWdlcy9hcHAtaWNvbi0xOTIucG5nIiwic2l6ZXMiOiAiMTkyeDE5MiIsInR5cGUiOiAiaW1hZ2UvcG5nIn1dfQ==">
<title><?php 
if ($title==""){echo h($url);}
else{echo $title;}?></title>
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
<div id="notice"></div>
<!--<iframe sandbox="allow-same-origin allow-forms allow-scripts" src="https://biology-manabiya.net/" frameborder="no"></iframe>-->

</body>
</html>
