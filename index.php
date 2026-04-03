<?php
/**
 * Main Template File
 */

get_header(); ?>

<?php
// Default to the menu template content if no other page is assigned.
// In a real WP setup, the user would set the Menu Page as the static front page.
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
        else :
            // Fallback: If no posts or specific content, redirect or show menu content.
            include( get_template_directory() . '/template-menu.php' );
        endif;
        ?>
    </main>
</div>

<?php get_footer(); ?>
