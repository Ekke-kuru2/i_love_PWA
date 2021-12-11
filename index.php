<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

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
	if($title==""){$title=h($url);}
}else{
    //エラー処理
    echo '<script>location.href="./about.html"</script>';
	
}
?>

<link rel="manifest" href=<?php
$manifest=base64_encode('{"short_name": "'.$title.'","name": "'.$title.'","display": "standalone","start_url": "index.html","icons": [{"src": "icon.png","sizes": "192x192","type": "image/png"}]}');
echo '"data:application/json;base64,'.$manifest.'"';
?>>
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
<div id="notice"></div>
<iframe sandbox="allow-same-origin allow-forms allow-scripts" src=<?php echo $url;?> frameborder="no"></iframe>

</body>
</html>
