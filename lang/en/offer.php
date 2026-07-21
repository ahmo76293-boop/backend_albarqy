<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Messages
    |--------------------------------------------------------------------------
    */

    'product_unit_required' => 'The product unit is required.',
    'product_unit_exists' => 'The selected product unit is invalid.',

    'type_required' => 'The offer type is required.',
    'type_in' => 'The offer type must be either percentage or fixed.',

    'value_required' => 'The offer value is required.',
    'value_numeric' => 'The offer value must be a number.',
    'value_min' => 'The offer value must be greater than or equal to 0.',

    'start_date_required' => 'The start date is required.',
    'start_date_date' => 'The start date must be a valid date.',

    'end_date_required' => 'The end date is required.',
    'end_date_date' => 'The end date must be a valid date.',
    'end_date_after' => 'The end date must be after or equal to the start date.',

    'is_active_required' => 'The active status is required.',
    'is_active_boolean' => 'The active status must be true or false.',

    /*
    |--------------------------------------------------------------------------
    | Success Messages
    |--------------------------------------------------------------------------
    */

    'created' => 'Offer created successfully.',
    'updated' => 'Offer updated successfully.',
    'deleted' => 'Offer deleted successfully.',

    /*
    |--------------------------------------------------------------------------
    | Error Messages
    |--------------------------------------------------------------------------
    */

    'create_failed' => 'Failed to create offer.',
    'update_failed' => 'Failed to update offer.',
    'delete_failed' => 'Failed to delete offer.',

    'not_found' => 'Offer not found.',

    'invalid_product_unit' => 'The selected unit does not belong to the selected product.',
];
