<html>
<head>
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> -->
	<meta charset="utf-8">
	<title>Crawler</title>
</head>
<body>
	<table>
		<tr>
			<td>編號</td>
			<td>國家</td>
			<td>人口</td>
		</tr>	

	<?php
		$url="https://www.worldometers.info/world-population/population-by-country/";
		$html = file_get_contents($url);
		$dom = new DOMDocument();
		@$dom->loadHTML($html);
		$dom->preserveWhiteSpace = false;

		$tables = $dom->getElementsByTagName('table');
		$count = 0;
		foreach($tables as $table)	{
			$tds = $table->getElementsByTagName('td');
			$i = 0;
			foreach($tds as $td){
				$i++;
				switch($i){
					case 1:
						echo "<tr>";
						echo "<td>" . ($count + 1) . "</td>";
						break;
					case 2:
						echo "<td>" . trim($td->nodeValue) . "</td>";
						break;
					case 3:
						echo "<td>" . str_replace(",", "", trim($td->nodeValue)) . "</td>";
						echo "</tr>";
						break;
					defualt:break;
				}
				if($i % 12 ==0){
					$i = 0;
					$count++;
				}
			}
			if($count == 233) break;
		}

	?>
	</table>	
</body>
</html>