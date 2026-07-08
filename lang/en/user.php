<?php

return [

    // Success Messages
    'updated' => 'User updated successfully.',
    'deleted' => 'User deleted successfully.',
    'update_failed' => 'Failed to update user.',
    'cannot_delete_self' => 'You cannot delete your own account.',
    'store_not_allowed' => 'Users are created through the registration endpoint.',

    // Validation
    'name_required' => 'The name is required.',
    'name_string' => 'The name must be a string.',
    'name_max' => 'The name may not be greater than 255 characters.',

    'email_required' => 'The email is required.',
    'email_email' => 'The email must be a valid email address.',
    'email_max' => 'The email may not be greater than 255 characters.',
    'email_unique' => 'This email has already been taken.',

    'role_required' => 'The role is required.',
    'role_in' => 'The selected role is invalid.',

    'is_active_required' => 'The account status is required.',
    'is_active_boolean' => 'The account status must be true or false.',
];
