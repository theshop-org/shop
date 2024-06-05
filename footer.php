<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

 $menus = ms_getMenuItemes();
 if(isset($menus['menu_id']['footer'])) {
	$footer_socials = get_field('social_links', 'nav_menu_' . $menus['menu_id']['footer']);
 }

?>
	<div class="masonry-layout">1</div>
	<footer id="footer" class="footer">
		<div class="footer__container">
			<div class="footer__left footer__flex">
 				<div class="footer__text">
				 	2024-2025 the Shop<br>
					 Powerhouse for ecommerce brands
				</div>
 				<div class="footer__credits">
					<a href="#">
 						Site credits
					</a>
				</div>
			</div>
 			<div class="footer__right">
 				<div class="footer__sign footer__flex">
					<div class="footer__sign--top">
						<span>
							Sign up for newsletter
						</span>
						<a href="mailto:youremail@website.com">
							youremail@website.com
						</a>
					</div>
					<div class="footer__sign--bottom">
						<a href="#">
							Submit
						</a>
					</div>
				</div>
				<div class="footer__socials footer__flex">
					<div class="footer__socials--top">
						Links:
					</div>
					<div class="footer__socials--bottom">
						<a href="#">
							Facebook
						</a>
						<a href="#">
							LinkedIn
						</a>
						<a href="#">
							Instagram
						</a>
					</div>
				</div>
				<div class="footer__contact footer__flex">
					<div class="footer__contact--top">
					Contact us
					</div>
					<div class="footer__contact--bottom">
						<a href="#">
						Terms & Conditions
						</a>
						<a href="#">
						Privacy policy
						</a>
					</div>
				</div>
			</div>
		</div>
		</div>
	</footer>


</div>

<?php wp_footer(); ?>

</body>
</html>
