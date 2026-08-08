<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Offer Validation Messages
    |--------------------------------------------------------------------------
    */

    // Title
    'title_en_string' => 'The English title must be a string.',
    'title_en_max' => 'The English title may not exceed 255 characters.',

    'title_ar_string' => 'The Arabic title must be a string.',
    'title_ar_max' => 'The Arabic title may not exceed 255 characters.',


    // Description
    'description_en_string' => 'The English description must be a string.',
    'description_ar_string' => 'The Arabic description must be a string.',


    // Image
    'image_image' => 'The offer image must be a valid image.',
    'image_mimes' => 'The offer image must be a JPG, JPEG, PNG, or WEBP file.',
    'image_max' => 'The offer image may not exceed 2MB.',


    // Products
    'products_required' => 'At least one product is required.',
    'products_array' => 'Products must be an array.',
    'products_min' => 'At least one product must be selected.',

    'product_id_required' => 'The product ID is required.',
    'product_id_integer' => 'The product ID must be an integer.',
    'product_id_exists' => 'The selected product is invalid.',

    'unit_id_required' => 'The unit ID is required.',
    'unit_id_integer' => 'The unit ID must be an integer.',
    'unit_id_exists' => 'The selected unit is invalid.',


    // Type
    'type_required' => 'The offer type is required.',
    'type_in' => 'The offer type must be fixed, percentage, or gift.',


    // Value
    'value_required' => 'The offer value is required for fixed and percentage offers.',
    'value_numeric' => 'The offer value must be a number.',
    'value_min' => 'The offer value must be greater than or equal to 0.',


    // Gift Offer
    'buy_quantity_required' => 'The buy quantity is required for gift offers.',
    'buy_quantity_integer' => 'The buy quantity must be an integer.',
    'buy_quantity_min' => 'The buy quantity must be at least 1.',

    'gift_product_id_required' => 'The gift product ID is required for gift offers.',
    'gift_product_id_integer' => 'The gift product ID must be an integer.',
    'gift_product_id_exists' => 'The selected gift product is invalid.',

    'gift_unit_id_required' => 'The gift unit ID is required for gift offers.',
    'gift_unit_id_integer' => 'The gift unit ID must be an integer.',
    'gift_unit_id_exists' => 'The selected gift unit is invalid.',

    'gift_quantity_required' => 'The gift quantity is required for gift offers.',
    'gift_quantity_integer' => 'The gift quantity must be an integer.',
    'gift_quantity_min' => 'The gift quantity must be at least 1.',


    // Dates
    'start_date_required' => 'The start date is required.',
    'start_date_date' => 'The start date must be a valid date.',

    'end_date_required' => 'The end date is required.',
    'end_date_date' => 'The end date must be a valid date.',
    'end_date_after' => 'The end date must be after or equal to the start date.',


    // Status
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

    'invalid_product_unit' => 'The selected product and unit combination is invalid.',
];
