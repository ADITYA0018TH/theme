<?php
/**
 * Template Name: Menu Page
 */

get_header(); ?>

    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_4.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-2 bread">Our Menu</h1>
          </div>
        </div>
      </div>
    </section>

	<section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-7 text-center heading-section ftco-animate">
          	<span class="subheading">Specialties</span>
            <h2 class="mb-4">Explore Our Dishes</h2>
          </div>
        </div>

            <?php
            $categories = get_terms(
                array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => true,
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                )
            );
            ?>

            <?php if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) : ?>
                <ul class="nav nav-pills menu-category-tabs justify-content-center" role="tablist">
                    <?php foreach ( $categories as $index => $category ) : ?>
                        <li class="nav-item" role="presentation">
                            <a
                                class="nav-link <?php echo 0 === $index ? 'active' : ''; ?>"
                                id="<?php echo esc_attr( $category->slug ); ?>-tab"
                                data-toggle="pill"
                                href="#<?php echo esc_attr( $category->slug ); ?>"
                                role="tab"
                                aria-controls="<?php echo esc_attr( $category->slug ); ?>"
                                aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
                            >
                                <?php echo esc_html( $category->name ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <div class="tab-content menu-category-content">
                    <?php foreach ( $categories as $index => $category ) :
                        $products = new WP_Query(
                            array(
                                'post_type'      => 'product',
                                'posts_per_page' => -1,
                                'orderby'        => 'menu_order title',
                                'order'          => 'ASC',
                                'tax_query'      => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field'    => 'term_id',
                                        'terms'    => $category->term_id,
                                    ),
                                ),
                            )
                        );
                        ?>
                        <div class="tab-pane fade <?php echo 0 === $index ? 'show active' : ''; ?>" id="<?php echo esc_attr( $category->slug ); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr( $category->slug ); ?>-tab">
                            <div class="row justify-content-center">
                                <div class="col-lg-10">
                                    <div class="heading-menu text-center ftco-animate mb-4">
                                        <h3><?php echo esc_html( $category->name ); ?></h3>
                                    </div>

                                    <?php if ( $products->have_posts() ) : ?>
                                        <?php while ( $products->have_posts() ) : $products->the_post();
                                            global $product;
                                            $image_url = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
                                            ?>
                                            <div class="menus d-flex ftco-animate">
                                                <div class="menu-img img" style="background-image: url(<?php echo esc_url( $image_url ); ?>);"></div>
                                                <div class="text">
                                                    <div class="d-flex">
                                                        <div class="one-half">
                                                            <h3><?php the_title(); ?></h3>
                                                        </div>
                                                        <div class="one-forth">
                                                            <span class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
                                                        </div>
                                                    </div>
                                                    <p><?php the_excerpt(); ?></p>
                                                    <button class="add-to-cart-btn mt-2"
                                                            data-product-id="<?php the_ID(); ?>"
                                                            data-name="<?php the_title(); ?>"
                                                            data-price="<?php echo esc_attr( $product->get_price() ); ?>"
                                                            data-image="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ); ?>">
                                                        Add to Cart
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endwhile; wp_reset_postdata(); ?>
                                    <?php else : ?>
                                        <p class="text-center">No dishes found in <?php echo esc_html( $category->name ); ?>.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="text-center">No product categories found.</p>
            <?php endif; ?>
    	</div>
    </section>

<?php get_footer(); ?>
