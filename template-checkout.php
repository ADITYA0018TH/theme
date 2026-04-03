<?php
/**
 * Template Name: Checkout Page
 */

get_header(); ?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_4.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">Checkout</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo home_url('/'); ?>">Menu <i class="ion-ios-arrow-forward"></i></a></span> <span>Checkout <i class="ion-ios-arrow-forward"></i></span></p>
          </div>
        </div>
      </div>
    </section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10">
					<div class="checkout-wrapper">
						<?php echo do_shortcode('[woocommerce_checkout]'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
