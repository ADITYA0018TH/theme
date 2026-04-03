<?php
/**
 * Template Name: Thank You Page
 */

get_header(); ?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_4.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">Order Confirmed!</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="<?php echo home_url('/'); ?>">Back to Menu <i class="ion-ios-arrow-forward"></i></a></span></p>
          </div>
        </div>
      </div>
    </section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="icon-check_circle" style="font-size: 80px; color: #28a745;"></span>
                    <h2 class="mb-4">Thanks for ordering!</h2>
                    <p>Your order has been received and is being prepared. We will serve you at your table shortly.</p>
                    <a href="<?php echo home_url('/'); ?>" class="btn btn-primary py-3 px-5 mt-4">Order More</a>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
