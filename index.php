<?php
	require_once 'compressor.php';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CSS Compressor</title>
	<style type="text/css">
	body {
		font-family: calibri, arial, helvetica, sans-serif, verdana;
	}
	#fork {
		position:fixed;
		top:0;
		right:0
	}
	</style>
</head>
<body>
	<a href="" id="fork" title="Fork me on GitHub"><img src="fork.png" alt="Fork me on Github" title="fork me on github"/></a>
	<h1>CSS Compressor, made with PHP :)</h1>
	<ol>
		<li>Put your stylesheets in <strong>css</strong> folder;</li>
		<li>Select the stylesheet you want to merge;</li>
		<li>Click <strong>minify</strong> and watch the magic in css folder.</li>
	</ol>
	<form action="" method="post">
		<?php

		// Print all stylesheets not minified
		$files = array_slice(scandir('css/'),2);
		foreach ($files as $file) {
			if(strpos($file, 'min') === 0){
				continue;
			}
			echo '<div><input id="'.$file.'" type="checkbox" value="'.$file.'" name="files[]"><label for="'.$file.'">'.$file.'</label></div>';
		}		
?>	
		<input type="submit" value="Minify" name="minify">
	</form>
</body>
</html>