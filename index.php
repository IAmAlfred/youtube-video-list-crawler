<html>

<!-- by: Rad from any.TV Cebu -->
<head>
	<title>
		Youtube Crawler
	</title>
</head>

<body>
	<h1>YT Crawler</h1>
	<p>To separate links, place a semi-colon.</p>
	<form action='index.php' method="post">
		<input type="text" name="links" size="40">
		<input type="submit" value="Submit">
	</form>
	<table cellpadding="0" cellspacing="0" width="100%">
		<tr style="background-color:grey;">
			<td valign="middle" width="30%" style="text-align:center;">Title:</td>
			<td valign="middle" width="8.75%" style="text-align:center;">Video Views:</td>
			<td valign="middle" width="8.75%" style="text-align:center;">Likes:</td>
			<td valign="middle" width="8.75%" style="text-align:center;">Dislikes:</td>
			<td valign="middle" width="8.75%" style="text-align:center;">Comment Count:</td>
			<td valign="middle" width="8.75%" style="text-align:center;">Uploader:</td>
			<td valign="middle" width="8.75%" style="text-align:center;">Subscribers:</td>
			<td valign="middle" width="8.75%" style="text-align:center;">Video Count:</td>
			<td valign="middle" width="8.75%" style="text-align:center;">Channel Published:</td>
		</tr>
		<?php
		$r=0;
		$result=array();
		if(! empty($_POST)!=NULL){
			$links=$_POST['links'];
			if(substr_count($links, '; ') > 0){exit();}
			if($links!=""){
				$links3 = str_replace(" ",";", $links);
				$links2 = explode(";",$links3);
				$e=count($links2);
				for($d=0;$d<$e;$d++){
					$a = explode("http://www.youtube.com/watch?v=", $links2[$d]);
			//echo "<br>".$a[1]."<br>";
					if ($links2[$d]==NULL){exit();}
					$c="http://gdata.youtube.com/feeds/api/videos/".$a[1]."?v=2";
			//echo $c."<br>";
					$xml= simplexml_load_file($c);
					$authorname=(string)$xml->author->name;
					$f="http://gdata.youtube.com/feeds/api/users/".$authorname;
					$xml_user= simplexml_load_file($f);
					$namespaces = $xml->getNamespaces(true);
					$namespaces_user = $xml_user->getNamespaces(true);

					$vidtitle=(string)$xml->title;
					echo "<tr><td style='border-bottom:solid 1px #B4B5B0;'>".$vidtitle;

					$stats = $xml->children($namespaces['yt'])->statistics;
					$viewCount = $stats->attributes()->viewCount;
					echo "</td><td style='border-bottom:solid 1px #B4B5B0; border-left: solid 1px #B4B5B0; text-align:center;'>".$viewCount;

					$rate = $xml->children($namespaces['yt'])->rating;
					if($rate!=NULL){
						$numLikes = $rate->attributes()->numLikes;
						echo "</td><td style='border-bottom:solid 1px #B4B5B0; border-left: solid 1px #B4B5B0; text-align:center;'>".$numLikes;
					}
					else{
						echo "</td><td style='border-bottom:solid 1px #B4B5B0; border-left: solid 1px #B4B5B0; text-align:center;'>disabled.";
					}

					if($rate!=NULL){
						$numDislikes = $rate->attributes()->numDislikes;
						echo "</td><td style='border-bottom:solid 1px #B4B5B0; border-left: solid 1px #B4B5B0; text-align:center;'>".$numDislikes;
					}
					else{
						echo "</td><td style='border-bottom:solid 1px #B4B5B0; border-left: solid 1px #B4B5B0; text-align:center;'>disabled";
					}

					$feedlink = $xml->children($namespaces['gd'])->comments->feedLink;
					if($feedlink!=NULL){
						$countHint = $feedlink->attributes()->countHint;
						echo "</td><td style='border-bottom:solid 1px #B4B5B0; border-left: solid 1px #B4B5B0; text-align:center;'>".$countHint;
					}
					else{
						echo "</td><td style='border-bottom:solid 1px #B4B5B0; border-left: solid 1px #B4B5B0; text-align:center;'>disabled";
					}

					echo "</td><td style='border-bottom:solid 1px #B4B5B0; border-left: solid 1px #B4B5B0; text-align:center;'>".$authorname;

					$subcount = $xml_user->children($namespaces_user['yt'])->statistics;
					$subscribers = $subcount->attributes()->subscriberCount;
					echo "</td><td style='border-bottom:solid 1px #B4B5B0; border-left: solid 1px #B4B5B0; text-align:center;'>".$subscribers;


					$tuv = $subcount->attributes()->totalUploadViews;
					echo "</td><td style='border-bottom:solid 1px #B4B5B0; border-left: solid 1px #B4B5B0; text-align:center;'>".$tuv;

					$published = $xml_user->published;
					$published_date = explode("T", $published);
					echo "</td><td style='border-bottom:solid 1px #B4B5B0; border-left: solid 1px #B4B5B0; text-align:center;'>".$published_date[0]."</td></tr>";
				}
			}
		}
		?>
	</table>
</body>

</html>