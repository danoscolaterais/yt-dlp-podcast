<?php
header('Content-type: text/xml');
$baseUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$output  = '<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:rawvoice="http://www.rawvoice.com/rawvoiceRssModule/" version="2.0">';
$output .= '<channel>';
$output .= '<title>YT-DLP Podcast</title>';
$output .= '<description>YT-DLP Podcast.</description>';
$output .= '<link>' . $baseUrl . '</link>';
$output .= '<image>';
$output .= 		'<url>' . $baseUrl . 'podcasts.jpg</url>';
$output .= 		'<title>YT-DLP Podcast</title>';
$output .= 		'<link>' . $baseUrl . '</link>';
$output .= '</image>';
$output .= '<itunes:image href="' . $baseUrl . 'podcasts.jpg"/>';

$files = glob("./data/*.info.json");
usort($files, function($a, $b) {
    return filemtime($b) - filemtime($a);
});

foreach($files as $file){

$filecontents = file_get_contents($file);
$json_a = json_decode($filecontents, true);

$link = $baseUrl . 'data/' . $json_a['id'] . ".m4a";
$m4afile = 'data/' . $json_a['id'] . ".m4a";

$pubDate = date("D, d M Y H:i:s \G\M\T", filectime($m4afile));

if (!file_exists('data/' . $json_a['id'] . ".m4a")) {
	continue;
} else {
	if (file_exists('data/' . $json_a['id'] . ".jpg")) {
	   	$image = $baseUrl . 'data/' . $json_a['id'] . ".jpg";
	} else {
	   	$image = $baseUrl . 'data/' . $json_a['id'] . ".webp";
	}

	$output .= '<item>';
	$output .= '<title>' . htmlspecialchars($json_a['channel'] . ' ► ' . $json_a['title']) . '</title>';
	$output .= '<description>' . htmlspecialchars($json_a['description']) . '</description>';
	$output .= '<link>' . $link . '</link>';
	$output .= '<guid>' . $link . '</guid>';
	$output .= '<enclosure url="' . $link . '" length="' . $json_a['filesize'] . '" type="audio/m4a"/>';
	$output .= '<pubDate>' . $pubDate . '</pubDate>';
	$output .= '<itunes:duration>' . $json_a['duration'] . '</itunes:duration>';
	$output .= '<itunes:image href="' . $image . '" />';
	$output .= '</item>';
	}
}

$output .= '</channel>';
$output .= '</rss>';

echo $output;
?>
