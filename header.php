<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    
	  <nav class="navbar navbar-expand-lg ftco_navbar bg-transparent ftco-navbar-light" id="ftco-navbar">
	    <div class="container mx-auto">
	      <a class="navbar-brand" href="<?php echo esc_url( home_url( '/menu' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	        	<li class="nav-item"><a href="<?php echo esc_url( home_url( '/menu' ) ); ?>" class="nav-link">Menu</a></li>
	        	<li class="nav-item">
                    <a href="/cart" class="nav-link" id="cart-trigger">
                        <span class="icon-shopping-cart"></span> 
                        Cart (<span class="cart-count">0</span>)
                    </a>
                </li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
