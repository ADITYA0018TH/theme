    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
          </div>
        </div>
      </div>
    </footer>
    
    <!-- Side Drawer Cart -->
    <div id="side-cart">
        <div class="cart-header">
            <h3>Your Order</h3>
            <a href="#" id="close-cart"><span class="ion-ios-close" style="font-size: 30px;"></span></a>
        </div>
        <div class="cart-items">
            <!-- Items will be injected by cart.js -->
            <p class="empty-cart-msg">Your cart is empty.</p>
        </div>
        <div class="cart-footer">
            <div class="d-flex justify-content-between mb-3">
                <strong>Total:</strong>
                <strong class="cart-total">$0.00</strong>
            </div>
            <a href="<?php echo esc_url( home_url( '/checkout' ) ); ?>" class="btn btn-primary btn-block py-3 rounded-2xl shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl" style="background-color: #ff7700; border-color: #ff7700; hover: background-color: #ffffffff; hover: border-color: #ff7700; color: #fff; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Proceed to Checkout</a>
        </div>
    </div>
    <div class="cart-overlay"></div>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>

    <?php wp_footer(); ?>
  </body>
</html>
