<?php

/**
 * Validation Helper Class
 * 
 * This class provides centralized validation helper functions
 * for consistent validation across the application.
 */

class ValidationHelper
{
    /**
     * Get validation error message
     * 
     * @param string $key
     * @param array $replace
     * @return string
     */
    public static function getErrorMessage($key, $replace = [])
    {
        return trans("validation.{$key}", $replace);
    }

    /**
     * Format validation errors for API response
     * 
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return array
     */
    public static function formatValidationErrors($validator)
    {
        $errors = $validator->errors()->toArray();
        $formatted = [];

        foreach ($errors as $field => $messages) {
            $formatted[$field] = is_array($messages) ? $messages[0] : $messages;
        }

        return [
            'status' => '0',
            'response_message' => 'validation_error',
            'display_message' => 'Validation failed',
            'errors' => $formatted
        ];
    }

    /**
     * Get custom validation message
     * 
     * @param string $attribute
     * @param string $rule
     * @param array $parameters
     * @return string
     */
    public static function getCustomMessage($attribute, $rule, $parameters = [])
    {
        $key = "validation.custom.{$attribute}.{$rule}";
        
        if (trans($key) !== $key) {
            return trans($key, $parameters);
        }

        return trans("validation.{$rule}", array_merge(['attribute' => $attribute], $parameters));
    }

    /**
     * Validate and return formatted response
     * 
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @return array|null
     */
    public static function validate($data, $rules, $messages = [])
    {
        $validator = \Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return self::formatValidationErrors($validator);
        }

        return null;
    }

    /**
     * Get attribute name for validation
     * 
     * @param string $attribute
     * @return string
     */
    public static function getAttributeName($attribute)
    {
        $attributes = trans('validation.attributes');
        
        if (isset($attributes[$attribute])) {
            return $attributes[$attribute];
        }

        return str_replace('_', ' ', ucwords($attribute, '_'));
    }

    /**
     * Common validation rules
     * 
     * @return array
     */
    public static function getCommonRules()
    {
        return [
            'required' => 'required',
            'email' => 'email',
            'numeric' => 'numeric',
            'string' => 'string',
            'min' => 'min:3',
            'max' => 'max:255',
            'unique' => 'unique',
            'exists' => 'exists',
            'date' => 'date',
            'image' => 'image',
            'mimes' => 'mimes:jpeg,jpg,png,gif',
            'size' => 'size',
        ];
    }

    /**
     * Get validation rules for common fields
     * 
     * @param string $field
     * @return array
     */
    public static function getFieldRules($field)
    {
        $rules = [
            'email' => ['required', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'date' => ['required', 'date'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:2048'],
        ];

        return $rules[$field] ?? [];
    }
}

