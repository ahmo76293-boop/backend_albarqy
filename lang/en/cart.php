<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    'product_required' => 'The product is required.',
    'product_exists' => 'The selected product is invalid.',

    'unit_required' => 'The unit is required.',
    'unit_exists' => 'The selected unit is invalid.',

    'quantity_required' => 'The quantity is required.',
    'quantity_integer' => 'The quantity must be an integer.',
    'quantity_min' => 'The quantity must be at least 1.',

    /*
    |--------------------------------------------------------------------------
    | Success Messages
    |--------------------------------------------------------------------------
    */

    'created' => 'Product added to cart successfully.',
    'updated' => 'Cart updated successfully.',
    'deleted' => 'Item removed from cart successfully.',
    'cleared' => 'Cart cleared successfully.',

    /*
    |--------------------------------------------------------------------------
    | Error Messages
    |--------------------------------------------------------------------------
    */

    'create_failed' => 'Failed to add product to cart.',
    'update_failed' => 'Failed to update cart.',
    'delete_failed' => 'Failed to remove item from cart.',
    'clear_failed' => 'Failed to clear cart.',

    'unit_not_found' => 'The selected unit does not belong to this product.',
    'cart_item_not_found' => 'Cart item not found.',
];
