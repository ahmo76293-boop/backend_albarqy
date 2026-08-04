<?php

return [

    'created' => 'Coupon created successfully.',
    'updated' => 'Coupon updated successfully.',
    'deleted' => 'Coupon deleted successfully.',

    'create_failed' => 'Failed to create coupon.',
    'update_failed' => 'Failed to update coupon.',
    'delete_failed' => 'Failed to delete coupon.',

    'code_required' => 'Coupon code is required.',
    'code_string' => 'Coupon code must be a string.',
    'code_max' => 'Coupon code may not be greater than 50 characters.',
    'code_unique' => 'This coupon code already exists.',

    'type_required' => 'Coupon type is required.',
    'type_in' => 'Coupon type must be fixed or percentage.',

    'value_required' => 'Coupon value is required.',
    'value_numeric' => 'Coupon value must be a number.',
    'value_min' => 'Coupon value must be at least 0.',

    'minimum_order_amount_numeric' => 'Minimum order amount must be a number.',
    'minimum_order_amount_min' => 'Minimum order amount must be at least 0.',

    'usage_limit_integer' => 'Usage limit must be an integer.',
    'usage_limit_min' => 'Usage limit must be at least 1.',

    'start_date_required' => 'Start date is required.',
    'start_date_date' => 'Start date is invalid.',

    'end_date_required' => 'End date is required.',
    'end_date_date' => 'End date is invalid.',
    'end_date_after_or_equal' => 'End date must be after or equal to the start date.',

    'is_active_required' => 'Status is required.',
    'is_active_boolean' => 'Status must be true or false.',

    'invalid' => 'The coupon code is invalid.',
    'expired' => 'The coupon has expired.',
    'inactive' => 'The coupon is inactive.',
    'limit_reached' => 'This coupon has reached its usage limit.',
    'minimum_order' => 'The minimum order amount for this coupon has not been reached.',

    'subtotal_invalid' => 'The order subtotal is not enough to use this coupon.',
    'valid' => 'Coupon is valid.',
];
