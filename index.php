<?php

	if(isset($_POST["from"]) && isset($_POST["to"])) {

		for($number = $_POST["from"]; $number <= $_POST["to"]; $number++) {

			$url = "http://explosm.net/comics/" . $number . "/";

			$ch = curl_init();
			$timeout = 5;

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

			$html = curl_exec($ch);
			curl_close($ch);

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