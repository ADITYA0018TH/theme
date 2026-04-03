<?php
/**
 * Template Name: Checkout Page
 */

get_header(); ?>

    <!-- Hero Section -->
    <section class="relative h-[45vh] min-h-[300px] flex items-center justify-center overflow-hidden" data-stellar-background-ratio="0.5">
      <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[20s] hover:scale-110" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_4.jpg');"></div>
      <div class="absolute inset-0 bg-black/60"></div>
      
      <div class="w-full relative z-10 px-4">
        <div class="max-w-3xl mx-auto text-center">
          <h1 class="text-4xl md:text-6xl font-heading text-white mb-4 tracking-tight drop-shadow-lg">
            Finalize <span class="text-primary italic">Order</span>
          </h1>
          <nav class="flex justify-center items-center space-x-2 text-white/80 font-sans text-sm uppercase tracking-widest">
            <a href="<?php echo home_url('/'); ?>" class="hover:text-primary transition-colors flex items-center group">
              Menu 
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <span class="text-white/40">/</span>
            <span class="text-primary font-bold">Checkout</span>
          </nav>
        </div>
      </div>
    </section>

    <!-- Checkout Content -->
    <section class="py-20 bg-[#f7f7f7] min-h-[600px]">
      <div class="container px-4">
        <div class="max-w-2xl mx-auto">
          <div class="bg-white rounded-2xl shadow-premium p-8 md:p-12 animate-fade-in border border-gray-100/50">
            <div class="checkout-wrapper">
              <?php echo do_shortcode('[woocommerce_checkout]'); ?>
            </div>
          </div>
          
          <!-- Security Badge -->
          <div class="mt-8 flex items-center justify-center space-x-2 text-gray-400 text-sm font-sans uppercase tracking-widest opacity-60">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            <span>Secure Table Service Payment</span>
          </div>
        </div>
      </div>
    </section>

<?php get_footer(); ?>
