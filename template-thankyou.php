<?php
/**
 * Template Name: Thank You Page
 */

get_header(); ?>

    <!-- Hero Section -->
    <section class="relative h-[45vh] min-h-[300px] flex items-center justify-center overflow-hidden" data-stellar-background-ratio="0.5">
      <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[20s] hover:scale-110" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_4.jpg');"></div>
      <div class="absolute inset-0 bg-black/60"></div>
      
      <div class="container relative z-10 px-4">
        <div class="max-w-3xl mx-auto text-center animate-fade-in-up">
          <h1 class="text-4xl md:text-6xl font-heading text-white mb-4 tracking-tight drop-shadow-lg">
            Order <span class="text-primary italic">Confirmed!</span>
          </h1>
          <nav class="flex justify-center items-center space-x-2 text-white/80 font-sans text-sm uppercase tracking-widest">
            <a href="<?php echo home_url('/'); ?>" class="hover:text-primary transition-colors flex items-center group">
              Back to Menu 
              <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
          </nav>
        </div>
      </div>
    </section>

    <!-- Content Section -->
    <section class="py-24 bg-bone">
      <div class="container px-4 mx-auto">
        <div class="max-w-2xl mx-auto text-center">
          <div class="inline-flex items-center justify-center w-24 h-24 bg-green-100 rounded-full mb-8 animate-[bounce_2s_infinite]">
            <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
          
          <h2 class="text-3xl md:text-5xl font-heading text-ony-900 mb-6 tracking-tight">
            Thanks for ordering!
          </h2>
          
          <p class="text-lg text-gray-600 mb-10 leading-relaxed font-sans max-w-lg mx-auto">
            Your order has been received and is being prepared with care. We will serve you at your table shortly. 
            <span class="block mt-2 font-medium text-primary italic">Sit back and enjoy the atmosphere.</span>
          </p>
          
          <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?php echo home_url('/'); ?>" 
               class="group relative inline-flex items-center justify-center px-10 py-4 font-heading font-bold text-white transition-all duration-300 ease-in-out bg-primary hover:bg-primary-dark rounded-xl shadow-glow hover:shadow-xl hover:-translate-y-1 w-full sm:w-auto overflow-hidden">
               <span class="relative z-10">Order More Delight</span>
               <div class="absolute inset-x-0 bottom-0 h-1 bg-white/20 transform scale-x-0 group-hover:scale-x-full transition-transform origin-left"></div>
            </a>
          </div>
          
          <!-- Decorative element -->
          <div class="mt-20 flex justify-center space-x-4 opacity-20">
            <div class="w-2 h-2 rounded-full bg-primary"></div>
            <div class="w-2 h-2 rounded-full bg-primary"></div>
            <div class="w-2 h-2 rounded-full bg-primary"></div>
          </div>
        </div>
      </div>
    </section>

<?php get_footer(); ?>
