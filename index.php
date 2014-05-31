<?php

	if(isset($_POST["from"]) && isset($_POST["to"])) {

		for($comic = $_POST["from"]; $comic <= $_POST["to"]; $comic++) {

			$location = "http://explosm.net/comics/" . $comic . "/";

			$ch = cURL_init();
			$timeout = 5;

			cURL_setOpt($ch, CURLOPT_URL, $location);
			cURL_setOpt($ch, CURLOPT_RETURNTRANSFER, 1);
			cURL_setOpt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

			$html = cURL_exec($ch);
			cURL_close($ch);

			$dom = new DOMDocument();
			@$dom->loadHTML($html);

			foreach($dom->getElementsByTagName("img") as $link){
				if(strpos($link->getAttribute("src"), "Comics/") !== false){
					echo "<img src='" . $link->getAttribute("src") . "'><br><br>";
				}
			}

		}

	} else { ?>

	<form method="post">
		From: <input type="text" name="from" value="3000"><br>
		To: <input type="text" name="to" value="3010"><br>
		<input type="submit"><br>
	</form>

<?php } ?>