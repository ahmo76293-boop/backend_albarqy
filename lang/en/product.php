<?php

return [

    // Success Messages
    'created' => 'Product created successfully.',
    'updated' => 'Product updated successfully.',
    'deleted' => 'Product deleted successfully.',

    // Validation
    'name_en_required' => 'The English name is required.',
    'name_ar_required' => 'The Arabic name is required.',

    'name_en_unique' => 'The English name has already been taken.',
    'name_ar_unique' => 'The Arabic name has already been taken.',

    'unique_number_required' => 'The product number is required.',
    'unique_number_unique' => 'The product number has already been taken.',

    'barcode_required' => 'The barcode is required.',
    'barcode_unique' => 'The barcode has already been taken.',

    'category_required' => 'The category is required.',
    'category_exists' => 'The selected category is invalid.',

    'images_array' => 'Images must be an array.',
    'image_image' => 'Each file must be an image.',
    'image_mimes' => 'Images must be JPG, JPEG, PNG or WEBP.',
    'image_max' => 'Each image must not exceed 2 MB.',

    'units_required' => 'At least one unit is required.',
    'units_array' => 'Units must be an array.',

    'unit_required' => 'The unit is required.',
    'unit_exists' => 'The selected unit is invalid.',

    'quantity_required' => 'The quantity is required.',
    'quantity_integer' => 'The quantity must be an integer.',
    'quantity_min' => 'The quantity must be at least 1.',
];
