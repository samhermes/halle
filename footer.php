<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Harper
 */

?>

	</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">

		</div>
	</footer>
</div>

<?php wp_footer(); ?>

<script>
var stickyElements = document.getElementsByClassName('stick');

for (var i = stickyElements.length - 1; i >= 0; i--) {
	Stickyfill.add(stickyElements[i]);
}
</script>

</body>
</html>
