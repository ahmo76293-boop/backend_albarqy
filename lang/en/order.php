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

    'delivery_driver_required' => 'The delivery driver is required.',
    'delivery_driver_integer' => 'The delivery driver ID must be an integer.',
    'delivery_driver_not_found' => 'The selected delivery driver does not exist or is invalid.',
    'delivery_driver_assigned' => 'Delivery driver assigned successfully.',
    'invalid_delivery_driver' => 'The selected delivery driver is invalid or inactive.',
    'delivery_notes_string' => 'Delivery notes must be a string.',
    'delivery_notes_max' => 'Delivery notes may not exceed 1000 characters.',

    'invalid_delivery_status' => 'The delivery can only be completed for shipped orders.',
    'delivery_completed' => 'Order delivered successfully.',
    'delivery_complete_failed' => 'Failed to complete the delivery.',
    'invalid_product_unit' => 'The selected unit does not belong to the selected product.',

    'payment_status_required' => 'The payment status is required.',
    'invalid_payment_status' => 'The payment status is invalid.',

];
