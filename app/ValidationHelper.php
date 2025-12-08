<?php

/**
 * Validation Helper Class
 * 
 * This class provides centralized validation helper functions
 * for consistent validation across the application.
 * All error messages are managed in resources/lang/en/validation.php
 */

    class ValidationHelper
    {
    /**
     * Get validation error message from module
     * 
     * @param string $module Module name (e.g., 'service-list', 'customer', 'appointment')
     * @param string $field Field name
     * @param string $rule Validation rule
     * @param array $replace Replacement values for placeholders
     * @return string
     */
    public static function getModuleMessage($module, $field, $rule, $replace = [])
    {
        $key = "validation.modules.{$module}.{$field}.{$rule}";
        $message = trans($key, $replace);
        
        // If module-specific message not found, try custom message
        if ($message === $key) {
            return self::getCustomMessage($field, $rule, $replace);
        }
        
        return $message;
    }

    /**
     * Get all validation messages for a module
     * 
     * @param string $module Module name
     * @return array
     */
    public static function getModuleMessages($module)
    {
        $messages = [];
        $moduleMessages = trans("validation.modules.{$module}", []);
        
        if (is_array($moduleMessages)) {
            foreach ($moduleMessages as $field => $rules) {
                if (is_array($rules)) {
                    foreach ($rules as $rule => $message) {
                        $messages["{$field}.{$rule}"] = $message;
                    }
                }
            }
        }
        
        return $messages;
    }

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
     * @param string|null $module Optional module name for module-specific formatting
     * @return array
     */
    public static function formatValidationErrors($validator, $module = null)
    {
        $errors = $validator->errors()->toArray();
        $formatted = [];
        $firstError = null;
        $firstField = null;

        foreach ($errors as $field => $messages) {
            $errorMessage = is_array($messages) ? $messages[0] : $messages;
            $formatted[$field] = $errorMessage;
            
            // Get the first error message for display
            if ($firstError === null) {
                $firstError = $errorMessage;
                $firstField = $field;
            }
        }

        // Use the first error as display message
        $displayMessage = $firstError ?: 'Validation failed';

        return [
            'status' => '0',
            'response_message' => 'validation_error',
            'display_message' => $displayMessage,
            'errors' => $formatted,
            'first_error_field' => $firstField
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

        // Get attribute name
        $attributeName = self::getAttributeName($attribute);
        
        return trans("validation.{$rule}", array_merge(['attribute' => $attributeName], $parameters));
    }

    /**
     * Validate and return formatted response
     * 
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param string|null $module Optional module name
     * @return array|null
     */
    public static function validate($data, $rules, $messages = [], $module = null)
    {
        $validator = \Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return self::formatValidationErrors($validator, $module);
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
     * Get validation rules and messages for a module
     * 
     * @param string $module Module name
     * @param array $rules Validation rules array
     * @return array Returns ['rules' => [...], 'messages' => [...]]
     */
    public static function getModuleValidation($module, $rules)
    {
        $messages = self::getModuleMessages($module);
        
        // Build messages array in Laravel format
        $formattedMessages = [];
        foreach ($rules as $field => $fieldRules) {
            if (is_string($fieldRules)) {
                $fieldRules = explode('|', $fieldRules);
            }
            
            foreach ($fieldRules as $rule) {
                $ruleName = null;
                
                // Handle Rule objects (like Rule::in())
                if (is_object($rule)) {
                    $className = get_class($rule);
                    
                    // Check for specific Rule types
                    if ($className === 'Illuminate\Validation\Rules\In' || 
                        strpos($className, 'Rules\\In') !== false) {
                        $ruleName = 'in';
                    } elseif ($className === 'Illuminate\Validation\Rules\NotIn' || 
                              strpos($className, 'Rules\\NotIn') !== false) {
                        $ruleName = 'not_in';
                    } elseif (method_exists($rule, '__toString')) {
                        $ruleString = (string) $rule;
                        $ruleName = explode(':', $ruleString)[0];
                    } else {
                        // Try to get rule name from class name
                        $parts = explode('\\', $className);
                        $ruleName = strtolower(end($parts));
                    }
                } elseif (is_string($rule)) {
                    $ruleName = explode(':', $rule)[0];
                } else {
                    continue;
                }
                
                if ($ruleName) {
                    $key = "{$field}.{$ruleName}";
                    
                    if (isset($messages[$key])) {
                        $formattedMessages[$key] = $messages[$key];
                    }
                }
            }
        }
        
        return [
            'rules' => $rules,
            'messages' => $formattedMessages
        ];
    }

    /**
     * Sanitize input data to prevent SQL injection
     * 
     * @param array $data
     * @param array $sanitizeRules Rules for sanitization ['field' => 'type']
     * @return array
     */
    public static function sanitizeInput($data, $sanitizeRules = [])
    {
        $sanitized = [];
        
        if (!is_array($data)) {
            return $sanitized;
        }
        
        foreach ($data as $key => $value) {
            // Handle null or empty values
            if ($value === null || $value === '') {
                $sanitized[$key] = $value;
                continue;
            }
            
            if (isset($sanitizeRules[$key])) {
                $type = $sanitizeRules[$key];
                
                switch ($type) {
                    case 'int':
                    case 'integer':
                        $sanitized[$key] = is_numeric($value) ? (int) $value : 0;
                        break;
                    case 'string':
                        $sanitized[$key] = is_string($value) ? trim(strip_tags($value)) : (string) $value;
                        break;
                    case 'float':
                        $sanitized[$key] = is_numeric($value) ? (float) $value : 0.0;
                        break;
                    case 'email':
                        $sanitized[$key] = is_string($value) ? filter_var(trim($value), FILTER_SANITIZE_EMAIL) : '';
                        break;
                    case 'url':
                        $sanitized[$key] = is_string($value) ? filter_var(trim($value), FILTER_SANITIZE_URL) : '';
                        break;
                    default:
                        $sanitized[$key] = is_string($value) ? trim($value) : $value;
                }
            } else {
                // Default sanitization: trim strings
                $sanitized[$key] = is_string($value) ? trim($value) : $value;
            }
        }
        
        return $sanitized;
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

    /**
     * Get validation rules for mobile number
     * 
     * @return array
     */
    public static function mobileNumber()
    {
        return ['required', 'string', 'max:20'];
    }

    /**
     * Get validation rules for OTP
     * 
     * @return array
     */
    public static function otp()
    {
        return ['required', 'string', 'size:4'];
    }

    /**
     * Get validation rules for session ID
     * 
     * @return array
     */
    public static function sessionId()
    {
        return ['required', 'string'];
    }

    /**
     * Get validation rules for customer ID
     * 
     * @return array
     */
    public static function customerId()
    {
        return ['required', 'integer'];
    }

    /**
     * Get validation rules for language ID
     * 
     * @param bool $required Whether the field is required
     * @return array
     */
    public static function languageId($required = true)
    {
        $rules = ['integer', \Illuminate\Validation\Rule::in([1, 2])];
        if ($required) {
            array_unshift($rules, 'required');
        } else {
            array_unshift($rules, 'nullable');
        }
        return $rules;
    }

    /**
     * Get validation rules for device type
     * 
     * @return array
     */
    public static function deviceType()
    {
        return ['required', 'integer', \Illuminate\Validation\Rule::in([1, 2])]; // 1 - IOS, 2 - Android
    }

    /**
     * Get validation rules for brand ID
     * 
     * @return array
     */
    public static function brandId()
    {
        return ['required', 'integer', \Illuminate\Validation\Rule::in([1, 2, 3])];
    }

    /**
     * Get validation rules for username
     * 
     * @return array
     */
    public static function username()
    {
        return ['nullable', 'string', 'max:255'];
    }

    /**
     * Get validation rules for image
     * 
     * @return array
     */
    public static function image()
    {
        return ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:2048'];
    }

    /**
     * Get validation rules for device token
     * 
     * @param bool $required Whether the field is required
     * @return array
     */
    public static function deviceToken($required = true)
    {
        $rules = ['string', 'max:255'];
        if ($required) {
            array_unshift($rules, 'required');
        } else {
            array_unshift($rules, 'nullable');
        }
        return $rules;
    }

    /**
     * Get validation rules for car owned type
     * 
     * @param bool $required Whether the field is required
     * @return array
     */
    public static function carOwnedType($required = true)
    {
        $rules = ['integer'];
        if ($required) {
            array_unshift($rules, 'required');
        } else {
            array_unshift($rules, 'nullable');
        }
        return $rules;
    }

    /**
     * Get validation rules for email
     * 
     * @param bool $required Whether the field is required
     * @return array
     */
    public static function email($required = true)
    {
        $rules = ['email', 'max:255'];
        if ($required) {
            array_unshift($rules, 'required');
        } else {
            array_unshift($rules, 'nullable');
        }
        return $rules;
    }

    /**
     * Get error messages for validation
     * 
     * @return array
     */
    public static function errorMessages()
    {
        return [];
    }
}