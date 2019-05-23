<?php
/**
 * Template Name: Map
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

wp_enqueue_style('leaflet-css', 'https://unpkg.com/leaflet@1.5.1/dist/leaflet.css');
wp_enqueue_script('leaflet-js', 'https://unpkg.com/leaflet@1.5.1/dist/leaflet.js');
wp_enqueue_script('leaflet-greyscale', get_template_directory_uri() . '/js/TileLayer.Grayscale.js');

get_header();
?>

<style>
</style>

<div class="wrapper" id="map-wrapper">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if ($content = trim(get_the_content())): ?>
				<div id="map-text">
					<h4><?php the_title(); ?></h4>
					<?php echo $content; ?>
				</div>
			<?php endif; ?>
		<?php endwhile; endif; ?>
	<div id="blog-map"></div>
</div><!-- #map-wrapper -->

<script>
	function popup(post) {
		var html = "<div  class=\"map-popup\">";
		if (post.thumb) {
			html += "<a class=\"map-popup-thumb\" href=\"" + post.url + "\">";
			html += "<img alt=\"" + post.title + "\" src=\"" + post.thumb + "\" width=\"300\" height=\"auto\"/>";
			html += "</a>";
		}
		html += "<a href=\"" + post.url + "\">" + post.title + "</a>";
		html += "</div>";
		return html;
	}

	// Initialise a map with the zoom control on the top right
	var map = L.map('blog-map', { zoomControl: false });
	L.control.zoom({ position: 'topright' }).addTo(map);

	// Add greyscale tile layer
	L.tileLayer.grayscale('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	// Custom icon
	var baseIcon = L.icon({
		iconUrl: "<?php echo get_template_directory_uri() . '/img/map-marker.png'; ?>",
		iconSize: [30, 43],
		iconAnchor: [16,44],
		popupAnchor: [1, -35]
	});

	// Fetch data from the 'blog_geo_posts' action and place points on the map
	fetch(Ajax.ajaxurl + "?action=blog_geo_posts", { credentials: 'include'})
		.then(function(r) { return r.json(); })
		.then(function(data) {
			data.forEach(function (post) {
				L.marker(post.geo, {icon: baseIcon})
					.addTo(map)
					.bindPopup(popup(post));
			});

			if (data.length > 1) {
				map.fitBounds(data.map(p => p.geo), {
					maxZoom: 7
				});
			} else {
				// Default to Central Europe
				map.setView([54.5,15.2], 4);
			}
		});

</script>
<?php get_footer(); ?>
