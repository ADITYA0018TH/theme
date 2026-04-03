<?php
/**
 * Generic Page Template
 */

get_header(); ?>

    <!-- Hero Section (Subtle) -->
    <section class="relative h-[30vh] min-h-[250px] flex items-center justify-center overflow-hidden" data-stellar-background-ratio="0.5">
      <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[20s] hover:scale-110" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_4.jpg');"></div>
      <div class="absolute inset-0 bg-black/60"></div>
      
      <div class="container relative z-10 px-4">
        <div class="max-w-3xl mx-auto text-center">
          <h1 class="text-4xl md:text-5xl font-heading text-white mb-2 tracking-tight drop-shadow-lg">
            <?php the_title(); ?>
          </h1>
        </div>
      </div>
    </section>

    <!-- Page Content -->
    <section class="py-16 bg-[#f7f7f7] min-h-[600px]">
      <div class="container px-4">
        <div class="max-w-3xl mx-auto">
          <div class="bg-white rounded-2xl shadow-premium p-8 md:p-12 animate-fade-in border border-gray-100/50">
            <div class="page-wrapper">
              <?php
              while ( have_posts() ) :
                  the_post();
                  the_content();
              endwhile;
              ?>
            </div>
          </div>
          
          <!-- Subtle Brand Indication -->
          <div class="mt-0 flex items-center justify-center space-x-2 text-gray-400 text-sm font-sans uppercase tracking-widest opacity-40">
            <span>Powered by The Crimson Vine</span>
          </div>
        </div>
      </div>
    </section>

<?php get_footer(); ?>
