<?php

$output = '';

$i = 0;
$j = 0;
while ($i <= 100)
{

$iz6 = zerofill($j, 6);
$iz6_plus1 = zerofill($j+1, 6);

$iz2 = zerofill($i, 2);
$iz2_plus1 = zerofill($i+1, 2);

$entry = <<<EOS

<annotation id="annotation_$iz6" type="text" style="highlightText" logable="false">
  <TEXT>
Hide this videobar</TEXT>
  <segment spaceRelative="annotation_$iz6_plus1">
    <movingRegion type="rect">
      <rectRegion x="6.56300" y="0.00000" w="20.00000" h="14.44400" t="never"/>
      <rectRegion x="6.56300" y="0.00000" w="20.00000" h="14.44400" t="never"/>
    </movingRegion>
  </segment>
  <appearance bgAlpha="0" textSize="3.9116" highlightFontColor="16777215"/>
  <trigger>
    <condition ref="annotation_$iz6_plus1" state="rollOver"/>
  </trigger>
</annotation>

<annotation id="annotation_$iz6_plus1" type="highlight" log_data="xble=1">
  <segment>
    <movingRegion type="rect">
      <rectRegion x="0.00000" y="0.00000" w="6.56300" h="14.44400" t="0:00:$iz2.0"/>
      <rectRegion x="0.00000" y="0.00000" w="6.56300" h="14.44400" t="0:00:$iz2_plus1.0"/>
    </movingRegion>
  </segment>
  <appearance bgColor="0" highlightWidth="0" borderAlpha="0.25"/>

  <action type="openUrl" trigger="click">
    <url target="current" value="http://www.youtube.com/watch?v=4Q6BCch1AjY&amp;list=PLj2WAaCF98rvTtLIydJFWDwyGMbGnCd7O&amp;t=${i}s"  link_class="1"/>
  </action>
</annotation>


EOS;

$output .= $entry;
$i++;
$j += 2;
}

$output = str_replace('<', '&lt;', str_replace('&', '&amp;', $output));


function zerofill($mStretch, $iLength = 2)
{
    $sPrintfString = '%0' . (int)$iLength . 's';
    return sprintf($sPrintfString, $mStretch);
}

?>
<html>

<!-- by: George from any.TV Manila -->
<head>
	<title>
		Create Annotation XML
	</title>
</head>

<body>
<!--
	<h1>Create Annotation XML</h1>
	<p>(Edit the PHP code and re-open this page to change the variables)</p>
-->

<pre>
<?php echo $output; ?>
</pre>

</body>
</html>