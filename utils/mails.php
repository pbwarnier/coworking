<?php
	function sendmail($to, $subject, $text) {
		$header = "MIME-Version: 1.0\r\n";
		$header .= 'From:"Notification Coworking"<warnier.pb@gmail.com>'."\n";
		$header .= 'Content-Type:text/html, charset="utf-8"'."\n";
		$header .= 'content-Transfert-Encoding: 8bit';

		$message = '
		<html>
			<head>
				<meta charset="utf-8">
			</head>
			<body>
				<div align="center">
					Co\'working
				</div>
				<hr>
				<div>
					'.$text.'
				</div>
			</body>
		</html>
		';

		mail($to, $subject, $message, $header);
	}