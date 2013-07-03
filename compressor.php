<?php
	/**
	  *	@param String with CSS
	  * @return String CSS minified
	  */
	function minify($content){
		$content = str_replace(array(' {',': ',', '), array('{',':',','), $content);
		preg_match_all("/([a-zA-z*#.]+.*{)|(\w+.*;)|(})/",$content,$minifier);
		$content = "";

		// put the relevant content in a single variable 
		foreach ($minifier[0] as $value) {
			$content .= $value;
		}

		return $content;
	}

	if(isset($_POST['minify'])){

		// merge css code
		if(!empty($_POST['files'])){
			$files = $_POST['files'];
			$filename = "";
			$contentFile = "";
			foreach ($files as $file) {
				$contentFile .= file_get_contents('css/'.$file);
				$filename .= str_replace('.css',"", $file);
			}
			$content = minify($contentFile);
			file_put_contents('css/min.'.$filename.".css", $content);
		}

		$files = array_slice(scandir('css'), 2);
		$contentAll = "";
		foreach ($files as $file) {
			// verify if file is a minified file
			if(strpos($file, 'min') !== false){
				continue;
			}
			$content = file_get_contents('css/'.$file);
			$contentAll .= $content;

			// minify the current file
			file_put_contents('css/min.'.$file, minify($content));
		}
		// merge all css files and minify
		file_put_contents('css/min.all.css',minify($contentAll));

		
	}