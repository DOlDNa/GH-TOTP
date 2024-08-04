<?php
# GitHub setup Key
$secret = 'XXXXXXXXXXXXXXX';
$time = 30;

$c = '';
for ($i = $j = $k = 0, $l = strlen($secret); $k < $l; ++$k)
{
	$i = $i << 5;
	$i = $i + ['A' => 0, 'B' => 1, 'C' => 2, 'D' => 3, 'E' => 4, 'F' => 5, 'G' => 6, 'H' => 7, 'I' => 8, 'J' => 9, 'K' => 10, 'L' => 11, 'M' => 12, 'N' => 13, 'O' => 14, 'P' => 15, 'Q' => 16, 'R' => 17, 'S' => 18, 'T' => 19, 'U' => 20, 'V' => 21, 'W' => 22, 'X' => 23, 'Y' => 24, 'Z' => 25, '2' => 26, '3' => 27, '4' => 28, '5' => 29, '6' => 30, '7' => 31][$secret[$k]];
	$j = $j + 5;
	if ($j >= 8)
	{
		$j = $j - 8;
		$c .= chr(($i & (0xFF << $j)) >> $j);
	}
}
$h = hash_hmac('sha1', pack('N*', 0). pack('N*', floor(microtime(true) / $time)), $c, true);
$o = ord($h[19]) & 0xf;
header('Refresh: '. $time)?>
<!doctype html>
<html lang=ja>
	<head>
		<meta charset=utf-8>
		<title>TOTP</title>
		<style>::-webkit-scrollbar{display:none}</style>
		<link rel=icon href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text x='50%' y='50%' style='dominant-baseline:central;font-size:5em;text-anchor:middle'>🗝</text></svg>">
	</head>
	<body onload="t.style.width='0px',s.select()" style="background:#222;line-height:100vh;margin:0;text-align:center">
		<div id=t style="background-color:#999;height:2px;position:static;transition:width <?=$time-1?>s linear 1s;width:100%"></div>
		<input id=s readonly style="color:#999;background:inherit;border:0;font-size:10rem;outline:0;text-align:center;width:6em" tabindex=1 type=text value="<?php printf('%06d', (((ord($h[$o + 0]) & 0x7f) << 24) | ((ord($h[$o + 1]) & 0xff) << 16) | ((ord($h[$o + 2]) & 0xff) << 8) | (ord($h[$o + 3]) & 0xff)) % pow(10, 6))?>">
	</body>
</html>
