<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package irc
 */

?>
	<footer>
		<div class="credits-wrapper wrapper">
			<div class="footer-left">
				<p class="copyright">
					&copy; <?php echo date('Y'); ?>. <?php echo bloginfo('name' ); ?>. All Rights Reserved.
				</p>
			</div>
			<div class="footer-right">
				<p><?php _e('Design by ', 'espial'); ?><a href="http://baytek.ca" title="Ottawa Web Design">baytek</a></p>
			</div>
		</div>
	</footer>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
