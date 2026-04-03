jQuery(document).ready(function($) {
    function openCartDrawer() {
        $('#side-cart').addClass('open');
        $('.cart-overlay').fadeIn();
    }

    function setStepperQuantity($stepper, quantity) {
        $stepper.attr('data-quantity', quantity);
        $stepper.find('.menu-qty-value').text(quantity);
        $stepper.find('.menu-qty-decrease').prop('disabled', quantity <= 0);
    }

    function syncStepperState() {
        $('.menu-quantity-stepper').each(function() {
            const $stepper = $(this);
            const quantity = parseInt($stepper.attr('data-quantity'), 10) || 0;
            setStepperQuantity($stepper, quantity);
        });
    }

    // Increment quantity using WooCommerce AJAX
    $(document).on('click', '.menu-qty-increase', function() {
        const $stepper = $(this).closest('.menu-quantity-stepper');
        const productId = $stepper.data('product-id');
        const currentQuantity = parseInt($stepper.attr('data-quantity'), 10) || 0;

        $stepper.addClass('is-loading');

        $.ajax({
            type: 'POST',
            url: kusinaData.ajax_url,
            data: {
                action: 'kusina_update_cart_quantity',
                product_id: productId,
                delta: 1
            },
            success: function(response) {
                if (response.success) {
                    const nextQuantity = response.data && typeof response.data.quantity !== 'undefined'
                        ? parseInt(response.data.quantity, 10) || 0
                        : currentQuantity + 1;
                    setStepperQuantity($stepper, nextQuantity);
                    fetchCartState();
                    openCartDrawer();
                }
            },
            complete: function() {
                $stepper.removeClass('is-loading');
            }
        });
    });

    // Decrement quantity using WooCommerce AJAX
    $(document).on('click', '.menu-qty-decrease', function() {
        const $stepper = $(this).closest('.menu-quantity-stepper');
        const productId = $stepper.data('product-id');
        const currentQuantity = parseInt($stepper.attr('data-quantity'), 10) || 0;

        if (currentQuantity <= 0) {
            return;
        }

        $stepper.addClass('is-loading');

        $.ajax({
            type: 'POST',
            url: kusinaData.ajax_url,
            data: {
                action: 'kusina_update_cart_quantity',
                product_id: productId,
                delta: -1
            },
            success: function(response) {
                if (response.success) {
                    const nextQuantity = response.data && typeof response.data.quantity !== 'undefined'
                        ? parseInt(response.data.quantity, 10) || 0
                        : Math.max(0, currentQuantity - 1);
                    setStepperQuantity($stepper, nextQuantity);
                    fetchCartState();
                    openCartDrawer();
                }
            },
            complete: function() {
                $stepper.removeClass('is-loading');
            }
        });
    });

    function updateCartUIFromFragments(fragments) {
        // Here we can use WooCommerce fragments to update the UI
        // But since we want to maintain the custom side cart UI, we'll fetch the cart via AJAX
        fetchCartState();
    }

    function fetchCartState() {
        // For a deep integration, we'd add an AJAX endpoint in functions.php to return cart items
        // For now, let's update the frontend UI based on the cart content.
        $.ajax({
            type: 'GET',
            url: kusinaData.ajax_url,
            data: { action: 'get_cart_contents' }, // We'll need to define this in functions.php
            success: function(response) {
                if (response.success) {
                    renderCart(response.data.items, response.data.total, response.data.count);
                }
            }
        });
    }

    function renderCart(items, total, count) {
        const $cartContainer = $('.cart-items');
        const $cartCount = $('.cart-count');
        const $cartTotal = $('.cart-total');

        $cartContainer.empty();
        if (items.length === 0) {
            $cartContainer.append('<div class="text-center py-5"><i class="icon-shopping-basket mb-3 d-block" style="font-size: 40px; color: #eee;"></i><p class="empty-cart-msg" style="font-family: \'Manrope\', sans-serif;">Your cart is empty.</p></div>');
            $cartCount.text('0');
            $cartTotal.text('₹0.00');
            return;
        }

        items.forEach((item) => {
            const itemPriceRaw = item.price.toString().replace(/[^0-9.]/g, '');
            const itemPrice = parseFloat(itemPriceRaw) || 0;

            const itemHTML = `
                <div class="cart-item d-flex align-items-center mb-4 pb-3" style="border-bottom: 1px solid #f8f8f8;">
                    <div class="item-img mr-3" style="flex-shrink: 0;">
                        <img src="${item.image}" alt="${item.name}" style="width: 65px; height: 65px; object-fit: cover; border-radius: 10px;">
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mb-1" style="font-family: 'Epilogue', sans-serif; font-weight: 700; color: #1a1c1c;">${item.name}</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <span style="font-family: 'Manrope', sans-serif; font-size: 14px; color: #f96d00; font-weight: 600;">₹${itemPrice.toFixed(2)} × ${item.quantity}</span>
                            <button class="btn remove-item-wc p-0" data-cart-item-key="${item.key}" style="color: #ccc; font-size: 20px;">&times;</button>
                        </div>
                    </div>
                </div>
            `;
            $cartContainer.append(itemHTML);
        });

        $cartCount.text(count);
        const totalNum = parseFloat(total) || 0;
        $cartTotal.text('₹' + totalNum.toFixed(2));

        $('.menu-quantity-stepper').each(function() {
            const $stepper = $(this);
            const productId = parseInt($stepper.data('product-id'), 10);
            const item = items.find((cartItem) => parseInt(cartItem.product_id, 10) === productId);
            setStepperQuantity($stepper, item ? item.quantity : 0);
        });
    }

    // Toggle Cart Drawer
    $('#cart-trigger').on('click', function(e) {
        e.preventDefault();
        openCartDrawer();
        fetchCartState(); // Refresh cart on open
    });

    $('#close-cart, .cart-overlay').on('click', function(e) {
        e.preventDefault();
        $('#side-cart').removeClass('open');
        $('.cart-overlay').fadeOut();
    });

    // Remove item from WC cart
    $(document).on('click', '.remove-item-wc', function() {
        const cartItemKey = $(this).data('cart-item-key');
        $.ajax({
            type: 'POST',
            url: kusinaData.ajax_url,
            data: {
                action: 'remove_item_from_cart',
                cart_item_key: cartItemKey
            },
            success: function() {
                fetchCartState();
                openCartDrawer();
            }
        });
    });

    // Initial Load
    syncStepperState();
    fetchCartState();
});
