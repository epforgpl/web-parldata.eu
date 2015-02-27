<?php
	$opts = array(
	'http'=>array(
		'method'=>"GET",
		'header'=>"Accept: application/xml"
	)
);
$context = stream_context_create($opts);
?>
<table border="1">
	<tr>
		<th>Country</th>
		<th>Name</th>
		<th>Scraper</th>
		<th>Last updated</th>
		<th>Status</th>
	</tr>

<?php while ( have_rows('api') ) : the_row(); 
	$links = get_sub_field('link');
	$name_country = get_sub_field('name_country');
	$name = get_sub_field('name'); ?>
	<tr>
		<td><?php echo $name_country; ?></td>
		<td><?php echo $name; ?></td>
		<?php
			$url = $links;
			$cacheName = $name . '.xml.cache';
			$ageInSeconds = 3600;
			if(!file_exists($cacheName) || filemtime($cacheName) > time() + $ageInSeconds) {
				$resource = file_get_contents($url, false, $context);
				file_put_contents('cache/' . $cacheName, $resource);
			}
			if ($resource) {
				$resource = simplexml_load_file('cache/' . $cacheName);
				$last = count($resource->resource)-1;
				$link = $resource->resource->attributes();
				$link = $link['href'];
				$link = str_replace("/logs", "", $link);
				echo '<td>' . $resource->resource[$last]->label . '</td>';
				echo '<td>' . $resource->resource[$last]->updated_at . '</td>';
				$status = $resource->resource[$last]->status;
				echo '<td><a class="'. $status .'" href="' . $links . $link . '">' . $status . '</a></td>';
			}else echo '<td></td><td></td><td class="fileerror">' . 'file error' . '</td>';

		?>
	</tr>
<?php endwhile; ?>
</table>
