<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Module-Based Validation Messages
    |--------------------------------------------------------------------------
    |
    | Error messages organized by module/endpoint for better management
    |
    */

    'modules' => [
        'service-list' => [
            'session_id' => [
                'required' => 'Session ID is required to access service list.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to retrieve service list.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'main_brand_id' => [
                'required' => 'Brand selection is required.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'language_id' => [
                'required' => 'Language selection is required.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'page' => [
                'integer' => 'Page number must be a valid number.',
                'min' => 'Page number must be at least 1.',
            ],
            'per_page' => [
                'integer' => 'Items per page must be a valid number.',
                'min' => 'Items per page must be at least 1.',
                'max' => 'Items per page cannot exceed 100.',
            ],
        ],
        'appointment-service-list' => [
            'session_id' => [
                'required' => 'Session ID is required to access appointment service list.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to retrieve appointment service list.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'main_brand_id' => [
                'required' => 'Brand selection is required for appointment services.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for appointment services.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'page' => [
                'integer' => 'Page number must be a valid number.',
                'min' => 'Page number must be at least 1.',
            ],
            'per_page' => [
                'integer' => 'Items per page must be a valid number.',
                'min' => 'Items per page must be at least 1.',
                'max' => 'Items per page cannot exceed 100.',
            ],
        ],
        'appointment-location-list' => [
            'session_id' => [
                'required' => 'Session ID is required to access appointment location list.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to retrieve appointment location list.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'main_brand_id' => [
                'required' => 'Brand selection is required for appointment locations.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for appointment locations.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'page' => [
                'integer' => 'Page number must be a valid number.',
                'min' => 'Page number must be at least 1.',
            ],
            'per_page' => [
                'integer' => 'Items per page must be a valid number.',
                'min' => 'Items per page must be at least 1.',
                'max' => 'Items per page cannot exceed 100.',
            ],
        ],
        'book-an-appointment-list' => [
            'session_id' => [
                'required' => 'Session ID is required to retrieve appointment list.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to retrieve appointment list.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for appointment list.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'upcoming_appointment' => [
                'integer' => 'Upcoming appointment filter must be 0 or 1.',
                'in' => 'Invalid upcoming appointment value. Must be 0 (All) or 1 (Upcoming only).',
            ],
            'page' => [
                'integer' => 'Page number must be a valid number.',
                'min' => 'Page number must be at least 1.',
            ],
            'per_page' => [
                'integer' => 'Items per page must be a valid number.',
                'min' => 'Items per page must be at least 1.',
                'max' => 'Items per page cannot exceed 100.',
            ],
            'display_message' => 'Appointment list retrieved successfully.',
        ],
        'appointment-history' => [
            'session_id' => [
                'required' => 'Session ID is required to retrieve appointment history.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to retrieve appointment history.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for appointment history.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'page' => [
                'integer' => 'Page number must be a valid number.',
                'min' => 'Page number must be at least 1.',
            ],
            'per_page' => [
                'integer' => 'Items per page must be a valid number.',
                'min' => 'Items per page must be at least 1.',
                'max' => 'Items per page cannot exceed 100.',
            ],
            'display_message' => 'Appointment history retrieved successfully.',
        ],
        'emergency-call' => [
            'session_id' => [
                'required' => 'Session ID is required to submit an emergency call request.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to submit an emergency call request.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'main_brand_id' => [
                'required' => 'Brand selection is required for emergency call request.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'date' => [
                'required' => 'Date is required for emergency call request.',
                'date' => 'Please enter a valid date.',
                'date_format' => 'Date must be in the format YYYY-MM-DD.',
            ],
            'time' => [
                'required' => 'Time is required for emergency call request.',
                'date_format' => 'Time must be in the format HH:mm (24-hour format).',
            ],
            'latitude' => [
                'required' => 'Latitude is required for emergency call request.',
                'numeric' => 'Latitude must be a valid number.',
                'between' => 'Latitude must be between -90 and 90 degrees.',
            ],
            'longitude' => [
                'required' => 'Longitude is required for emergency call request.',
                'numeric' => 'Longitude must be a valid number.',
                'between' => 'Longitude must be between -180 and 180 degrees.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for emergency call request.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'display_message' => 'Emergency call request submitted successfully. We will contact you soon.',
        ],
        'callback-request' => [
            'session_id' => [
                'required' => 'Session ID is required to submit a callback request.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to submit a callback request.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'main_brand_id' => [
                'required' => 'Brand selection is required for callback request.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'date' => [
                'required' => 'Date is required for callback request.',
                'date' => 'Please enter a valid date.',
                'date_format' => 'Date must be in the format YYYY-MM-DD.',
            ],
            'time' => [
                'required' => 'Time is required for callback request.',
                'date_format' => 'Time must be in the format HH:mm (24-hour format).',
            ],
            'language_id' => [
                'required' => 'Language selection is required for callback request.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'display_message' => 'Callback request submitted successfully. We will contact you soon.',
        ],
        'customer-register' => [
            'username' => [
                'required' => 'Username is required for registration.',
                'string' => 'Username must be a valid string.',
                'max' => 'Username cannot exceed :max characters.',
            ],
            'mobile_number' => [
                'required' => 'Mobile number is required for registration.',
                'string' => 'Mobile number must be a valid string.',
                'regex' => 'Mobile number must be in Dubai/UAE format: 5 followed by 8 digits (e.g., 512345678) or 9715 followed by 8 digits (e.g., 971512345678).',
                'unique' => 'This mobile number is already registered. Please use a different number.',
            ],
            'email' => [
                'required' => 'Email address is required for registration.',
                'email' => 'Please enter a valid email address.',
                'unique' => 'This email address is already registered. Please use a different email.',
            ],
            'car_registration_number' => [
                'required' => 'Car registration number is required for registration.',
                'string' => 'Car registration number must be a valid string.',
                'max' => 'Car registration number cannot exceed :max characters.',
            ],
            'reg_chasis_number' => [
                'required' => 'Chassis number is required for registration.',
                'string' => 'Chassis number must be a valid string.',
                'unique' => 'This chassis number is already registered. Please use a different chassis number.',
                'max' => 'Chassis number cannot exceed :max characters.',
            ],
            'reg_brand_id' => [
                'required' => 'Brand selection is required for registration.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'reg_model_id' => [
                'required' => 'Model ID is required for registration.',
                'integer' => 'Model ID must be a valid number.',
                'min' => 'Model ID must be greater than 0.',
            ],
            'device_type' => [
                'required' => 'Device type is required for registration.',
                'integer' => 'Device type must be a valid number.',
                'in' => 'Invalid device type selected. Must be 1 (Android) or 2 (iOS).',
            ],
            'device_id' => [
                'required' => 'Device ID is required for registration.',
                'string' => 'Device ID must be a valid string.',
                'max' => 'Device ID cannot exceed :max characters.',
            ],
            'latitude' => [
                'required' => 'Latitude is required for registration.',
                'numeric' => 'Latitude must be a valid number.',
                'between' => 'Latitude must be between -90 and 90 degrees.',
            ],
            'longitude' => [
                'required' => 'Longitude is required for registration.',
                'numeric' => 'Longitude must be a valid number.',
                'between' => 'Longitude must be between -180 and 180 degrees.',
            ],
            'device_token' => [
                'required' => 'Device token is required for registration.',
                'string' => 'Device token must be a valid string.',
            ],
            'category_dropdown' => [
                'required' => 'Category selection is required for registration.',
                'string' => 'Category must be a valid string.',
                'in' => 'Invalid category selected. Must be one of: AUH, DXB, SHJ, AJMAN, RAK, UAQ, FUJ.',
            ],
            'category_number' => [
                'required' => 'Category number is required for registration.',
                'string' => 'Category number must be a valid string.',
            ],
            'image' => [
                'image' => 'Profile image must be a valid image file.',
                'mimes' => 'Invalid file type for profile image. Allowed types: JPEG, JPG, PNG, GIF.',
                'max' => 'Profile image size exceeds maximum allowed size of 5MB.',
            ],
            'language_id' => [
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'display_message' => 'Registration completed successfully. Welcome!',
        ],
        'customer-notifications' => [
            'session_id' => [
                'required' => 'Session ID is required to retrieve notifications.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to retrieve notifications.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'status' => [
                'integer' => 'Status must be a valid number (0 for unread, 1 for read).',
                'in' => 'Invalid status selected. Must be 0 (unread) or 1 (read).',
            ],
            'page' => [
                'integer' => 'Page number must be a valid number.',
                'min' => 'Page number must be at least 1.',
            ],
            'per_page' => [
                'integer' => 'Items per page must be a valid number.',
                'min' => 'Items per page must be at least 1.',
                'max' => 'Items per page cannot exceed 100.',
            ],
            'display_message' => 'Notifications retrieved successfully.',
        ],
        'customer-notifications-send' => [
            'session_id' => [
                'required' => 'Session ID is required to send notifications.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to send notifications.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'device_token' => [
                'required' => 'Device token is required to send notifications.',
                'string' => 'Device token must be a valid string.',
                'max' => 'Device token cannot exceed :max characters.',
            ],
            'title' => [
                'required' => 'Notification title is required.',
                'string' => 'Notification title must be a valid string.',
                'max' => 'Notification title cannot exceed :max characters.',
            ],
            'description' => [
                'required' => 'Notification description is required.',
                'string' => 'Notification description must be a valid string.',
                'max' => 'Notification description cannot exceed :max characters.',
            ],
            'main_brand_id' => [
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'main_model_id' => [
                'integer' => 'Model ID must be a valid number.',
                'min' => 'Model ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'display_message' => 'Notification sent successfully.',
        ],
        'service-package-enquiry' => [
            'session_id' => [
                'required' => 'Session ID is required to submit service package enquiry.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to submit service package enquiry.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'service_package_id' => [
                'required' => 'Service package selection is required.',
                'integer' => 'Service package ID must be a valid number.',
                'min' => 'Service package ID must be greater than 0.',
            ],
            'customer_vehicle_id' => [
                'required' => 'Customer vehicle selection is required.',
                'integer' => 'Customer vehicle ID must be a valid number.',
                'min' => 'Customer vehicle ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'display_message' => 'Service package enquiry submitted successfully. Thank you for your interest.',
        ],
        'customer-notifications-mark-as-read' => [
            'session_id' => [
                'required' => 'Session ID is required to mark notifications as read.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to mark notifications as read.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'notification_ids' => [
                'array' => 'Notification IDs must be an array.',
            ],
            'notification_id' => [
                'integer' => 'Notification ID must be a valid number.',
                'min' => 'Notification ID must be greater than 0.',
            ],
            'display_message' => 'Notifications marked as read successfully.',
        ],
        'customer' => [
            'email' => [
                'required' => 'Email address is required.',
                'email' => 'Please enter a valid email address.',
                'unique' => 'This email address is already registered.',
            ],
            'name' => [
                'required' => 'Name is required.',
                'string' => 'Name must be a valid text.',
                'max' => 'Name cannot exceed :max characters.',
            ],
            'mobile_number' => [
                'required' => 'Mobile number is required.',
                'string' => 'Mobile number must be a valid text.',
            ],
        ],
        'reschedule-appointment' => [
            'session_id' => [
                'required' => 'Session ID is required to reschedule an appointment.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to reschedule an appointment.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'appointment_id' => [
                'required' => 'Appointment ID is required to reschedule.',
                'integer' => 'Appointment ID must be a valid number.',
                'min' => 'Appointment ID must be greater than 0.',
            ],
            'appointment_date' => [
                'required' => 'Appointment date is required for rescheduling.',
                'date' => 'Please enter a valid appointment date.',
                'date_format' => 'Appointment date must be in YYYY-MM-DD format.',
                'after' => 'Appointment date cannot be in the past.',
            ],
            'appointment_time' => [
                'required' => 'Appointment time is required for rescheduling.',
                'date_format' => 'Appointment time must be in HH:MM format (24-hour).',
            ],
            'language_id' => [
                'required' => 'Language selection is required.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'display_message' => 'Appointment rescheduled successfully.',
        ],
        'cancel-appointment' => [
            'session_id' => [
                'required' => 'Session ID is required to cancel an appointment.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to cancel an appointment.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'appointment_id' => [
                'required' => 'Appointment ID is required to cancel.',
                'integer' => 'Appointment ID must be a valid number.',
                'min' => 'Appointment ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'display_message' => 'Appointment cancelled successfully.',
            'already_cancelled' => 'This appointment has already been cancelled.',
            'invalid_ownership' => 'Appointment not found or does not belong to this customer.',
            'cancel_failed' => 'Failed to cancel appointment. Please try again later.',
        ],
        'all-showroom-list' => [
            'main_brand_id' => [
                'required' => 'Brand selection is required to view showrooms.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'language_id' => [
                'required' => 'Language selection is required.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'page' => [
                'integer' => 'Page number must be a valid number.',
                'min' => 'Page number must be at least 1.',
            ],
            'per_page' => [
                'integer' => 'Items per page must be a valid number.',
                'min' => 'Items per page must be at least 1.',
                'max' => 'Items per page cannot exceed :max.',
            ],
            'display_message' => 'Showroom list retrieved successfully.',
        ],
        'appointment' => [
            'session_id' => [
                'required' => 'Session ID is required to book an appointment.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to book an appointment.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'main_brand_id' => [
                'required' => 'Brand selection is required for appointment booking.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'car_model' => [
                'required' => 'Car model is required.',
                'string' => 'Car model must be a valid text.',
                'max' => 'Car model cannot exceed :max characters.',
            ],
            'location_id' => [
                'required' => 'Location selection is required.',
                'integer' => 'Location ID must be a valid number.',
                'in' => 'Invalid location selected. Please select a valid location.',
            ],
            'customer_first_name' => [
                'required' => 'First name is required.',
                'string' => 'First name must be a valid text.',
                'max' => 'First name cannot exceed :max characters.',
            ],
            'mobile_number' => [
                'required' => 'Mobile number is required.',
                'string' => 'Mobile number must be a valid text.',
                'max' => 'Mobile number cannot exceed :max characters.',
            ],
            'email' => [
                'required' => 'Email address is required.',
                'email' => 'Please enter a valid email address.',
                'max' => 'Email address cannot exceed :max characters.',
            ],
            'appointment_date' => [
                'required' => 'Appointment date is required.',
                'date' => 'Please enter a valid appointment date.',
                'after' => 'Appointment date must be after today.',
            ],
            'appointment_time' => [
                'required' => 'Appointment time is required.',
                'date_format' => 'Appointment time must be in valid format (HH:mm).',
            ],
            'service_needed_id' => [
                'required' => 'Service selection is required.',
                'integer' => 'Service ID must be a valid number.',
                'in' => 'Invalid service selected. Please select a valid service.',
            ],
            'car_required' => [
                'required' => 'Car requirement selection is required.',
                'integer' => 'Car requirement must be 0 or 1.',
                'in' => 'Invalid car requirement value. Must be 0 (No) or 1 (Yes).',
            ],
            'pickup_required' => [
                'required' => 'Pickup requirement selection is required.',
                'integer' => 'Pickup requirement must be 0 or 1.',
                'in' => 'Invalid pickup requirement value. Must be 0 (No) or 1 (Yes).',
            ],
            'language_id' => [
                'required' => 'Language selection is required.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'chassis_number' => [
                'string' => 'Chassis number must be a valid text.',
                'max' => 'Chassis number cannot exceed :max characters.',
            ],
            'car_model_version_id' => [
                'integer' => 'Car model version ID must be a valid number.',
            ],
        ],
        'track-service-list' => [
            'session_id' => [
                'required' => 'Session ID is required to track service list.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to track service list.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for tracking service list.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'page' => [
                'integer' => 'Page number must be a valid number.',
                'min' => 'Page number must be at least 1.',
            ],
            'per_page' => [
                'integer' => 'Items per page must be a valid number.',
                'min' => 'Items per page must be at least 1.',
                'max' => 'Items per page cannot exceed 100.',
            ],
        ],
        'car-accessories' => [
            'session_id' => [
                'required' => 'Session ID is required to access car accessories.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to access car accessories.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'main_brand_id' => [
                'required' => 'Brand selection is required for car accessories.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'model_id' => [
                'required' => 'Model ID is required for car accessories.',
                'integer' => 'Model ID must be a valid number.',
                'min' => 'Model ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for car accessories.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'page' => [
                'integer' => 'Page number must be a valid number.',
                'min' => 'Page number must be at least 1.',
            ],
            'per_page' => [
                'integer' => 'Items per page must be a valid number.',
                'min' => 'Items per page must be at least 1.',
                'max' => 'Items per page cannot exceed 100.',
            ],
        ],
        'car-accessories-enquiry' => [
            'session_id' => [
                'required' => 'Session ID is required to submit accessories enquiry.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to submit accessories enquiry.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'accessories_id' => [
                'required' => 'Accessory ID is required to submit enquiry.',
                'integer' => 'Accessory ID must be a valid number.',
                'min' => 'Accessory ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for accessories enquiry.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
        ],
        'car-accessories-pay-now' => [
            'session_id' => [
                'required' => 'Session ID is required to process payment for accessories.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to process payment for accessories.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'accessories_id' => [
                'required' => 'Accessory ID is required to process payment.',
                'integer' => 'Accessory ID must be a valid number.',
                'min' => 'Accessory ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for accessories payment.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
        ],
        'insurance-request' => [
            'session_id' => [
                'required' => 'Session ID is required to submit insurance request.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to submit insurance request.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'customer_vehicle_id' => [
                'required' => 'Customer vehicle ID is required to submit insurance request.',
                'integer' => 'Customer vehicle ID must be a valid number.',
                'min' => 'Customer vehicle ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for insurance request.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
        ],
        'onboarding-screens' => [
            'session_id' => [
                'required' => 'Session ID is required to access onboarding screens.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to access onboarding screens.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'promo_type' => [
                'required' => 'Promo type is required for onboarding screens.',
                'integer' => 'Promo type must be a valid number.',
                'in' => 'Invalid promo type selected. Please select a valid promo type (1 or 2).',
            ],
            'brand_id' => [
                'required' => 'Brand selection is required for onboarding screens.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for onboarding screens.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
        ],
        'onboarding-screens-like' => [
            'session_id' => [
                'required' => 'Session ID is required to like onboarding screen.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to like onboarding screen.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'promo_type' => [
                'required' => 'Promo type is required for onboarding screen like.',
                'integer' => 'Promo type must be a valid number.',
                'in' => 'Invalid promo type selected. Please select a valid promo type (1 or 2).',
            ],
            'onboarding_screen_id' => [
                'required' => 'Onboarding screen ID is required to like.',
                'integer' => 'Onboarding screen ID must be a valid number.',
                'min' => 'Onboarding screen ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for onboarding screen like.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
        ],
        'news-promo' => [
            'session_id' => [
                'required' => 'Session ID is required to retrieve news and promotions.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to retrieve news and promotions.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'promo_type' => [
                'required' => 'Promo type is required to retrieve news and promotions.',
                'integer' => 'Promo type must be a valid number.',
                'in' => 'Invalid promo type selected. Must be 1 (News) or 2 (Promotions).',
            ],
            'brand_id' => [
                'required' => 'Brand selection is required to retrieve news and promotions.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for news and promotions.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'display_message' => 'News and promotions retrieved successfully.',
        ],
        'news-promo-avail-offer' => [
            'session_id' => [
                'required' => 'Session ID is required to avail offer.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to avail offer.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'news_promo_id' => [
                'required' => 'News/Promo ID is required to avail offer.',
                'integer' => 'News/Promo ID must be a valid number.',
                'min' => 'News/Promo ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for avail offer request.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
        ],
        'corporate-solutions' => [
            'session_id' => [
                'required' => 'Session ID is required to access corporate solutions.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to access corporate solutions.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'brand_id' => [
                'required' => 'Brand selection is required for corporate solutions.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for corporate solutions.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
        ],
        'car-model-list' => [
            'session_id' => [
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required to retrieve car model list.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'main_brand_id' => [
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'car_owned_type' => [
                'integer' => 'Car owned type must be a valid number (0 or 1).',
                'in' => 'Invalid car owned type selected. Must be 0 (New Car) or 1 (Pre-owned Car).',
            ],
            'page' => [
                'integer' => 'Page number must be a valid number.',
                'min' => 'Page number must be at least 1.',
            ],
            'per_page' => [
                'integer' => 'Items per page must be a valid number.',
                'min' => 'Items per page must be at least 1.',
                'max' => 'Items per page cannot exceed 100.',
            ],
        ],
        'save-car-pickup' => [
            'session_id' => [
                'required' => 'Session ID is required to save car pickup request.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to save car pickup request.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'case_id' => [
                'required' => 'Case type is required for car pickup request.',
                'integer' => 'Case type must be a valid number (0 or 1).',
                'in' => 'Invalid case type selected. Must be 0 (Normal) or 1 (Regular).',
            ],
            'rent_car' => [
                'required' => 'Rent car option is required for car pickup request.',
                'string' => 'Rent car option must be a valid string.',
                'in' => 'Invalid rent car option selected. Must be "Yes" or "No".',
            ],
            'name' => [
                'required' => 'Name is required for car pickup request.',
                'string' => 'Name must be a valid string.',
                'max' => 'Name cannot exceed :max characters.',
            ],
            'mobile' => [
                'required' => 'Mobile number is required for car pickup request.',
                'string' => 'Mobile number must be a valid string.',
                'max' => 'Mobile number cannot exceed :max characters.',
            ],
            'email' => [
                'required' => 'Email address is required for car pickup request.',
                'email' => 'Please enter a valid email address for car pickup request.',
                'max' => 'Email address cannot exceed :max characters.',
            ],
            'address' => [
                'required' => 'Address is required for car pickup request.',
                'string' => 'Address must be a valid string.',
                'max' => 'Address cannot exceed :max characters.',
            ],
            'car_delivery_location' => [
                'required' => 'Car delivery location is required for car pickup request.',
                'string' => 'Car delivery location must be a valid string.',
                'max' => 'Car delivery location cannot exceed :max characters.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for car pickup request.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
        ],
        'add-car' => [
            'session_id' => [
                'required' => 'Session ID is required to add a car.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to add a car.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'car_registration_number' => [
                'required' => 'Car registration number is required.',
                'string' => 'Car registration number must be a valid string.',
                'max' => 'Car registration number cannot exceed :max characters.',
            ],
            'reg_brand_id' => [
                'required' => 'Brand selection is required.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'reg_model_id' => [
                'required' => 'Model selection is required.',
                'integer' => 'Model ID must be a valid number.',
                'min' => 'Model ID must be greater than 0.',
            ],
            'version_id' => [
                'required' => 'Version selection is required.',
                'integer' => 'Version ID must be a valid number.',
                'min' => 'Version ID must be greater than 0.',
            ],
            'reg_chasis_number' => [
                'required' => 'Chassis number is required.',
                'string' => 'Chassis number must be a valid string.',
                'max' => 'Chassis number cannot exceed :max characters.',
            ],
            'mileage_kms' => [
                'required' => 'Mileage is required.',
                'string' => 'Mileage must be a valid string.',
                'max' => 'Mileage cannot exceed :max characters.',
            ],
            'insurance_date' => [
                'required' => 'Insurance date is required.',
                'date_format' => 'Insurance date must be a valid date (YYYY-MM-DD).',
            ],
            'service_due_date' => [
                'required' => 'Service due date is required.',
                'date_format' => 'Service due date must be a valid date (YYYY-MM-DD).',
            ],
            'category_dropdown' => [
                'required' => 'Category is required.',
                'string' => 'Category must be a valid string.',
                'in' => 'Invalid category selected. Please select a valid category (AUH, DXB, SHJ, AJMAN, RAK, UAQ, FUJ).',
            ],
            'category_number' => [
                'required' => 'Category number is required.',
                'string' => 'Category number must be a valid string.',
                'max' => 'Category number cannot exceed :max characters.',
            ],
            'language_id' => [
                'required' => 'Language selection is required.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'image' => [
                'image' => 'Car image must be a valid image file.',
                'mimes' => 'Invalid image file type. Allowed types: JPEG, JPG, PNG, GIF.',
                'max' => 'Image size exceeds maximum allowed size of 5MB.',
            ],
        ],
        'car-search' => [
            'session_id' => [
                'required' => 'Session ID is required to perform search.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to perform search.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'query' => [
                'required' => 'Search query is required.',
                'string' => 'Search query must be a valid string.',
                'min' => 'Search query must be at least :min characters.',
                'max' => 'Search query cannot exceed :max characters.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for search.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'page' => [
                'integer' => 'Page number must be a valid number.',
                'min' => 'Page number must be at least 1.',
            ],
            'per_page' => [
                'integer' => 'Items per page must be a valid number.',
                'min' => 'Items per page must be at least 1.',
                'max' => 'Items per page cannot exceed 100.',
            ],
        ],
        'corporate-solutions-enquiry' => [
            'session_id' => [
                'required' => 'Session ID is required to submit corporate solutions enquiry.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to submit corporate solutions enquiry.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'main_brand_id' => [
                'required' => 'Brand selection is required for corporate solutions enquiry.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'corporate_solutions_title' => [
                'required' => 'Corporate solutions title is required.',
                'string' => 'Corporate solutions title must be a valid string.',
                'max' => 'Corporate solutions title cannot exceed :max characters.',
            ],
            'first_name' => [
                'required' => 'First name is required for corporate solutions enquiry.',
                'string' => 'First name must be a valid string.',
                'max' => 'First name cannot exceed :max characters.',
            ],
            'last_name' => [
                'required' => 'Last name is required for corporate solutions enquiry.',
                'string' => 'Last name must be a valid string.',
                'max' => 'Last name cannot exceed :max characters.',
            ],
            'email' => [
                'required' => 'Email address is required for corporate solutions enquiry.',
                'email' => 'Please enter a valid email address for corporate solutions enquiry.',
                'max' => 'Email address cannot exceed :max characters.',
            ],
            'mobile_number' => [
                'required' => 'Mobile number is required for corporate solutions enquiry.',
                'string' => 'Mobile number must be a valid string.',
                'max' => 'Mobile number cannot exceed :max characters.',
            ],
            'leasing_options_required' => [
                'required' => 'Leasing options selection is required.',
                'integer' => 'Leasing options must be a valid number (0 or 1).',
                'in' => 'Invalid leasing options value. Must be 0 (No) or 1 (Yes).',
            ],
            'language_id' => [
                'required' => 'Language selection is required for corporate solutions enquiry.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
        ],
        'remove-car' => [
            'session_id' => [
                'required' => 'Session ID is required to remove a car.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to remove a car.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'customer_vehicles_id' => [
                'required' => 'Customer vehicle ID is required to remove a car.',
                'integer' => 'Customer vehicle ID must be a valid number.',
                'min' => 'Customer vehicle ID must be greater than 0.',
            ],
            'language_id' => [
                'required' => 'Language selection is required to remove a car.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
        ],
        'edit-car' => [
            'session_id' => [
                'required' => 'Session ID is required to edit car details.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to edit car details.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'customer_vehicles_id' => [
                'required' => 'Customer vehicle ID is required to edit car details.',
                'integer' => 'Customer vehicle ID must be a valid number.',
                'min' => 'Customer vehicle ID must be greater than 0.',
            ],
            'car_registration_number' => [
                'required' => 'Car registration number is required.',
                'string' => 'Car registration number must be a valid string.',
                'max' => 'Car registration number cannot exceed :max characters.',
            ],
            'reg_brand_id' => [
                'required' => 'Brand selection is required.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'reg_model_id' => [
                'required' => 'Model selection is required.',
                'integer' => 'Model ID must be a valid number.',
                'min' => 'Model ID must be greater than 0.',
            ],
            'version_id' => [
                'required' => 'Version selection is required.',
                'integer' => 'Version ID must be a valid number.',
                'min' => 'Version ID must be greater than 0.',
            ],
            'reg_chasis_number' => [
                'required' => 'Chassis number is required.',
                'string' => 'Chassis number must be a valid string.',
                'max' => 'Chassis number cannot exceed :max characters.',
            ],
            'mileage_kms' => [
                'required' => 'Mileage is required.',
                'string' => 'Mileage must be a valid string.',
                'max' => 'Mileage cannot exceed :max characters.',
            ],
            'insurance_date' => [
                'required' => 'Insurance date is required.',
                'date_format' => 'Insurance date must be a valid date (YYYY-MM-DD).',
            ],
            'service_due_date' => [
                'required' => 'Service due date is required.',
                'date_format' => 'Service due date must be a valid date (YYYY-MM-DD).',
            ],
            'language_id' => [
                'required' => 'Language selection is required.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'image' => [
                'image' => 'Car image must be a valid image file.',
                'mimes' => 'Invalid image file type. Allowed types: JPEG, JPG, PNG, GIF.',
                'max' => 'Image size exceeds maximum allowed size of 5MB.',
            ],
        ],
        'save-trade-in-family-car' => [
            'session_id' => [
                'required' => 'Session ID is required to submit trade-in family car request.',
                'string' => 'Session ID must be a valid string.',
                'max' => 'Session ID cannot exceed :max characters.',
            ],
            'customer_id' => [
                'required' => 'Customer ID is required to submit trade-in family car request.',
                'integer' => 'Customer ID must be a valid number.',
                'min' => 'Customer ID must be greater than 0.',
            ],
            'main_brand_id' => [
                'required' => 'Brand selection is required for trade-in family car request.',
                'integer' => 'Brand ID must be a valid number.',
                'in' => 'Invalid brand ID selected. Please select a valid brand.',
            ],
            'model_id' => [
                'required' => 'Model selection is required for trade-in family car request.',
                'integer' => 'Model ID must be a valid number.',
                'min' => 'Model ID must be greater than 0.',
            ],
            'car_owned_type' => [
                'required' => 'Car owned type is required for trade-in family car request.',
                'integer' => 'Car owned type must be a valid number (0 for new, 1 for pre-owned).',
                'in' => 'Invalid car owned type selected. Must be 0 (New) or 1 (Pre-owned).',
            ],
            'customer_name' => [
                'required' => 'Customer name is required for trade-in family car request.',
                'string' => 'Customer name must be a valid string.',
                'max' => 'Customer name cannot exceed :max characters.',
            ],
            'customer_mobile_number' => [
                'required' => 'Mobile number is required for trade-in family car request.',
                'string' => 'Mobile number must be a valid string.',
                'max' => 'Mobile number cannot exceed :max characters.',
            ],
            'customer_email' => [
                'required' => 'Email address is required for trade-in family car request.',
                'email' => 'Please enter a valid email address for trade-in family car request.',
                'max' => 'Email address cannot exceed :max characters.',
            ],
            'language_id' => [
                'required' => 'Language selection is required for trade-in family car request.',
                'integer' => 'Language ID must be a valid number.',
                'in' => 'Invalid language ID selected. Please select a valid language.',
            ],
            'trade_in_image' => [
                'image' => 'Trade-in image must be a valid image file.',
                'mimes' => 'Invalid image file type. Allowed types: JPEG, JPG, PNG, GIF.',
                'max' => 'Image size exceeds maximum allowed size of 5MB.',
            ],
            'customer_vehicles_id' => [
                'integer' => 'Customer vehicle ID must be a valid number.',
                'min' => 'Customer vehicle ID must be greater than 0.',
            ],
            'mileage' => [
                'string' => 'Mileage must be a valid string.',
                'max' => 'Mileage cannot exceed :max characters.',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'email' => [
            'required' => 'Email address is required.',
            'email' => 'Please enter a valid email address.',
            'unique' => 'This email address is already registered.',
        ],
        'name' => [
            'required' => 'Name is required.',
            'string' => 'Name must be a valid text.',
            'max' => 'Name cannot exceed :max characters.',
        ],
        'mobile' => [
            'required' => 'Mobile number is required.',
            'string' => 'Mobile number must be a valid text.',
            'max' => 'Mobile number cannot exceed :max characters.',
        ],
        'mobile_number' => [
            'required' => 'Mobile number is required.',
            'string' => 'Mobile number must be a valid text.',
        ],
        'phone' => [
            'required' => 'Phone number is required.',
            'string' => 'Phone number must be a valid text.',
        ],
        'password' => [
            'required' => 'Password is required.',
            'min' => 'Password must be at least :min characters.',
            'confirmed' => 'Password confirmation does not match.',
        ],
        'car_registration_number' => [
            'required' => 'Car registration number is required.',
            'string' => 'Car registration number must be a valid text.',
        ],
        'chassis_number' => [
            'required' => 'Chassis number is required.',
            'string' => 'Chassis number must be a valid text.',
        ],
        'brand' => [
            'required' => 'Brand selection is required.',
            'exists' => 'Selected brand is invalid.',
        ],
        'model' => [
            'required' => 'Model selection is required.',
            'exists' => 'Selected model is invalid.',
        ],
        'version' => [
            'required' => 'Version selection is required.',
            'exists' => 'Selected version is invalid.',
        ],
        'city' => [
            'required' => 'City selection is required.',
            'exists' => 'Selected city is invalid.',
        ],
        'location' => [
            'required' => 'Location selection is required.',
            'exists' => 'Selected location is invalid.',
        ],
        'date' => [
            'required' => 'Date is required.',
            'date' => 'Please enter a valid date.',
        ],
        'time' => [
            'required' => 'Time is required.',
        ],
        'service' => [
            'required' => 'Service selection is required.',
            'exists' => 'Selected service is invalid.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'email' => 'email address',
        'name' => 'name',
        'mobile' => 'mobile number',
        'mobile_number' => 'mobile number',
        'phone' => 'phone number',
        'password' => 'password',
        'password_confirmation' => 'password confirmation',
        'car_registration_number' => 'car registration number',
        'chassis_number' => 'chassis number',
        'brand' => 'brand',
        'model' => 'model',
        'version' => 'version',
        'city' => 'city',
        'location' => 'location',
        'date' => 'date',
        'time' => 'time',
        'service' => 'service',
        'first_name' => 'first name',
        'last_name' => 'last name',
        'surname' => 'surname',
        'title' => 'title',
        'address' => 'address',
        'latitude' => 'latitude',
        'longitude' => 'longitude',
        'image' => 'image',
        'file' => 'file',
        'description' => 'description',
        'status' => 'status',
        'category' => 'category',
        'mileage' => 'mileage',
        'insurance_date' => 'insurance date',
        'service_due_date' => 'service due date',
        'session_id' => 'session ID',
        'customer_id' => 'customer ID',
        'main_brand_id' => 'brand ID',
        'language_id' => 'language ID',
        'page' => 'page',
        'per_page' => 'items per page',
    ],

];
