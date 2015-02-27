<?php
/*
Template Name: Page dashboard
*/
?>
<?php get_header();?>

<section class="sc-header-sub">
		<div class="containerCentered">
				<div class="row">
					<h1 id="changingtext"><?php the_title(); ?></h1>
				</div>
		</div>
</section>
<div class="container box">

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
		<th class="_country">Country</th>
		<th class="_name">Name</th>
        <th>Scraper</th>
        <th>Created at</th>
		<th>Status</th>
	</tr>

<?php while ( have_rows('api') ) : the_row(); 
	$links = get_sub_field('link');
	$name_country = get_sub_field('name_country');
	$name = get_sub_field('name'); ?>
	
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
				$added = array();
				foreach ($resource->resource as $value) {
					if(!in_array((string) $value->label, $added)){
						echo '<tr>
							<td class="'.str_replace(' ', '', $name_country).'">'.$name_country.'</td>
							<td>'.$name.'</td>';
						echo '<td>' . $value->label . '</td>';
						echo '<td>' . $value->created_at . '</td>';
						$status = $value->status;
						$link = $value->attributes()->href;
						$link = str_replace("logs", "", $link);
						$links = str_replace("?sort=-updated_at", "", $links);
						echo '<td><a class="'. $status .'" target="_blank" href="' . $links . $link . '">' . $status . '</a></td></tr>';
						$added[] = (string) $value->label;
					}
				}
			}else echo '<tr><td class="'.str_replace(' ', '', $name_country).'">' . $name_country . '</td><td>' . $name . '</td><td></td><td></td><td class="fileerror">' . 'file error' . '</td></tr>';
			if ($resource->_meta->total == 0) {
				echo '<tr><td class="'.str_replace(' ', '', $name_country).'">' . $name_country . '</td><td>' . $name . '</td><td></td><td></td><td class="fileerror">' . ' no logs' . '</td></tr>';
			}
		?>

<?php endwhile; ?>
</table>

</div>
<?php get_footer();?>
