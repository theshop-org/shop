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

 $addresses = get_field("addresses", "option");
 $contact_us_phone = get_field("contact_us_phone", "option");
 $contact_us_email = get_field("contact_us_email", "option");
 $socials = get_field("socials", "option");
 $subscribe_form = get_field("subscribe_form", "option");
 $subscribe_title = get_field("subscribe_title", "option");
 $copyright_text = get_field("copyright_text", "option");
 $footer_menu = get_field("footer_menu", "option");

?>
	<div class="masonry-layout">1</div>
	<footer id="footer" class="footer">
		<div class="footer__container">
			<div class="footer__top">
				<?php if(!empty($addresses)): ?>
					<div class="footer__top--section">
						<h4 class="footer__top--title">
							ADDRESSES
						</h4>
						<?php foreach($addresses as $address): ?>
							<div class="footer__top--content">
								<div class="footer__top--city">
									<?php echo $address['city']; ?>
								</div>
								<a href="<?php echo $address['link']; ?>" class="footer__top--address">
									<?php echo $address['address']; ?>
								</a>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<div class="footer__top--section">
					<h4 class="footer__top--title">
						CONTACT US
					</h4>
					<div class="footer__top--content">
						<a href="tel:<?php echo $contact_us_phone; ?>" class="footer__top--phone">
							<?php echo $contact_us_phone; ?>
						</a>
						<a href="mailto:<?php echo $contact_us_email; ?>" class="footer__top--email">
							<?php echo $contact_us_email; ?>
						</a>
					</div>
				</div>
				<?php if(!empty($socials)): ?>
					<div class="footer__top--section">
						<h4 class="footer__top--title">
							FOLLOW US
						</h4>
						<div class="footer__top--content">
							<?php foreach($socials as $social): ?>
								<a href="<?php echo $social['social_media_url']; ?>" class="footer__top--phone">
									<?php echo $social['social_media']; ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
				<?php if($subscribe_form): ?>
					<div class="footer__top--section section-newsletter">
						<h4 class="footer__top--title">
							<?php echo $subscribe_title ?>
						</h4>
						<div class="footer__top--content">
							<?php echo do_shortcode($subscribe_form) ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="accordion accordion-flush footer-accordions" id="accordionFlushExample">
					<?php if(!empty($addresses)): ?>
						<div class="accordion-item">
							<h2 class="accordion-header" id="flush-headingOne">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
									ADDRESSES
								</button>
							</h2>
							<div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
								<div class="accordion-body">
								<?php foreach($addresses as $address): ?>
									<div class="footer__top--content">
										<div class="footer__top--city">
											<?php echo $address['city']; ?>
										</div>
										<a href="<?php echo $address['link']; ?>" class="footer__top--address">
											<?php echo $address['address']; ?>
										</a>
									</div>
								<?php endforeach; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
					<div class="accordion-item">
						<h2 class="accordion-header" id="flush-headingTwo">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
							CONTACT US
						</button>
						</h2>
						<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
							<div class="accordion-body">
								<div class="footer__top--content">
									<a href="tel:<?php echo $contact_us_phone; ?>" class="footer__top--phone">
										<?php echo $contact_us_phone; ?>
									</a>
									<a href="mailto:<?php echo $contact_us_email; ?>" class="footer__top--email">
										<?php echo $contact_us_email; ?>
									</a>
								</div>
							</div>
						</div>
					</div>
					
					<?php if($subscribe_form): ?>
						<div class="accordion-item">
							<h2 class="accordion-header" id="flush-headingThree">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
									FOLLOW US
								</button>
							</h2>
							<div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
								<div class="accordion-body d-flex flex-column">
									<?php foreach($socials as $social): ?>
										<a href="<?php echo $social['social_media_url']; ?>" class="footer__top--phone">
											<?php echo $social['social_media']; ?>
										</a>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					<?php endif; ?>
					</div>
			</div>
			<div class="footer__bottom">
				<div class="footer__bottom--copy">
					<p class="product-of-georgia" >Product of georgia</p>
					<img class="product-of-georgia-flag"  src="https://theshopag.com/wp-content/uploads/2024/08/Flag_of_Georgia-1.png" />
					<!-- <?php echo $copyright_text ?> -->
				</div>
				<div class="footer__bottom--menu">
					<?php if(!empty($footer_menu)): ?>
						<p class="the-shop-footer-text-copyright">© 2024 THE SHOP</p>
						<?php foreach($footer_menu as $item): ?>
							<?php if(isset($item['link']['url'])): ?>
								<a href="<?php echo $item['link']['url'] ?>" target="<?php echo $item['link']['target'] ?>">
									<?php echo $item['link']['title']; ?>
								</a>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</footer>


</div>

<?php wp_footer(); ?>

</body>
</html>
