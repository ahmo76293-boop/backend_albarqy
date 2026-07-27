<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Messages
    |--------------------------------------------------------------------------
    */

    'location_required' => 'The location is required.',
    'location_exists' => 'The selected location is invalid.',

    'payment_method_required' => 'The payment method is required.',
    'payment_method_invalid' => 'The selected payment method is invalid.',

    'delivery_fee_numeric' => 'The delivery fee must be a number.',
    'delivery_fee_min' => 'The delivery fee must be at least 0.',

    'discount_numeric' => 'The discount must be a number.',
    'discount_min' => 'The discount must be at least 0.',

    'notes_max' => 'The notes may not be greater than 1000 characters.',

    'items_required' => 'At least one order item is required.',
    'items_array' => 'The items must be an array.',
    'items_min' => 'The order must contain at least one item.',

    'product_required' => 'The product is required.',
    'product_exists' => 'The selected product is invalid.',

    'unit_required' => 'The unit is required.',
    'unit_exists' => 'The selected unit is invalid.',

    'quantity_required' => 'The quantity is required.',
    'quantity_integer' => 'The quantity must be an integer.',
    'quantity_min' => 'The quantity must be at least 1.',

    /*
    |--------------------------------------------------------------------------
    | Controller Messages
    |--------------------------------------------------------------------------
    */

    'created' => 'Order created successfully.',
    'updated' => 'Order updated successfully.',
    'deleted' => 'Order deleted successfully.',

    'create_failed' => 'Failed to create order.',
    'update_failed' => 'Failed to update order.',
    'delete_failed' => 'Failed to delete order.',

    'status_updated' => 'Order status updated successfully.',

    'status_required' => 'The order status field is required.',
    'status_invalid' => 'The selected order status is invalid.',
];
