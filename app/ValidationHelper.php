<?php

namespace App;

/**
 * ValidationHelper - Centralized XSS protection validation rules
 * 
 * Usage: ValidationHelper::getRules('field_name') or ValidationHelper::FIELD_CONSTANT
 */
class ValidationHelper
{
    // ==========================================
    // XSS-Safe Regex Patterns
    // ==========================================
    
    // Name fields: letters, spaces, apostrophes, hyphens, dots
    const REGEX_NAME = '/^[a-zA-Z\s\'\-\.]+$/';
    
    // Arabic and English name support
    const REGEX_NAME_MULTILANG = '/^[\p{Arabic}a-zA-Z\s\'\-\.]+$/u';
    
    // Mobile number: digits with optional + prefix
    const REGEX_MOBILE = '/^\+?[0-9\s\-\(\)]+$/';
    
    // OTP: digits only
    const REGEX_OTP = '/^[0-9]+$/';
    
    // Alphanumeric: letters and numbers only
    const REGEX_ALPHANUMERIC = '/^[a-zA-Z0-9]+$/';
    
    // Alphanumeric with spaces and hyphens (for registration numbers, etc.)
    const REGEX_ALPHANUMERIC_EXTENDED = '/^[a-zA-Z0-9\s\-]+$/';
    
    // Chassis number: alphanumeric with hyphens
    const REGEX_CHASSIS = '/^[a-zA-Z0-9\-]+$/';
    
    // Device ID/Token: alphanumeric with hyphens, underscores, colons
    const REGEX_DEVICE_TOKEN = '/^[a-zA-Z0-9\-_:]+$/';
    
    // Session ID: alphanumeric with hyphens and underscores
    const REGEX_SESSION_ID = '/^[a-zA-Z0-9_\-]+$/';
    
    // Safe text: letters, numbers, spaces, common punctuation (no HTML)
    const REGEX_SAFE_TEXT = '/^[a-zA-Z0-9\s\.\,\!\?\'\-\(\)]+$/';
    
    // Safe text with Arabic support
    const REGEX_SAFE_TEXT_MULTILANG = '/^[\p{Arabic}a-zA-Z0-9\s\.\,\!\?\'\-\(\)]+$/u';

    // ==========================================
    // Pre-defined Validation Rule Sets
    // ==========================================
    
    /**
     * Username validation rules
     */
    public static function username($required = true)
    {
        $rules = ['string', 'max:255', 'regex:' . self::REGEX_NAME];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Mobile number validation rules
     */
    public static function mobileNumber($required = true, $unique = null)
    {
        $rules = ['string', 'min:10', 'max:15', 'regex:' . self::REGEX_MOBILE];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        if ($unique) $rules[] = 'unique:' . $unique;
        return $rules;
    }
    
    /**
     * OTP validation rules
     */
    public static function otp($required = true, $maxLength = 10)
    {
        $rules = ['string', 'max:' . $maxLength, 'regex:' . self::REGEX_OTP];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Email validation rules
     */
    public static function email($required = true, $unique = null)
    {
        $rules = ['email:rfc,dns', 'max:255'];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        if ($unique) $rules[] = 'unique:' . $unique;
        return $rules;
    }
    
    /**
     * Car registration number validation rules
     */
    public static function carRegistration($required = true)
    {
        $rules = ['string', 'max:255', 'regex:' . self::REGEX_ALPHANUMERIC_EXTENDED];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Chassis number validation rules
     */
    public static function chassisNumber($required = true, $unique = null)
    {
        $rules = ['string', 'max:255', 'regex:' . self::REGEX_CHASSIS];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        if ($unique) $rules[] = 'unique:' . $unique;
        return $rules;
    }
    
    /**
     * Session ID validation rules
     */
    public static function sessionId($required = true)
    {
        $rules = ['string', 'max:255', 'regex:' . self::REGEX_SESSION_ID];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Customer ID validation rules
     */
    public static function customerId($required = true)
    {
        $rules = ['integer', 'min:1'];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Language ID validation rules
     */
    public static function languageId($required = true)
    {
        $rules = ['integer', 'in:1,2'];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Brand ID validation rules
     */
    public static function brandId($required = true, $allowedValues = [1, 2, 3])
    {
        $rules = ['integer', 'in:' . implode(',', $allowedValues)];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Model ID validation rules
     */
    public static function modelId($required = true)
    {
        $rules = ['integer', 'min:1'];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Device type validation rules
     */
    public static function deviceType($required = true, $allowedValues = [1, 2])
    {
        $rules = ['integer', 'in:' . implode(',', $allowedValues)];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Device ID validation rules
     */
    public static function deviceId($required = true)
    {
        $rules = ['string', 'max:255', 'regex:' . self::REGEX_DEVICE_TOKEN];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Device token validation rules
     */
    public static function deviceToken($required = true)
    {
        $rules = ['string', 'max:500', 'regex:' . self::REGEX_DEVICE_TOKEN];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Latitude validation rules
     */
    public static function latitude($required = true)
    {
        $rules = ['numeric', 'between:-90,90'];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Longitude validation rules
     */
    public static function longitude($required = true)
    {
        $rules = ['numeric', 'between:-180,180'];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Category number validation rules
     */
    public static function categoryNumber($required = true)
    {
        $rules = ['string', 'max:50', 'regex:' . self::REGEX_ALPHANUMERIC_EXTENDED];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Car owned type validation rules
     */
    public static function carOwnedType($required = true, $allowedValues = [0, 1])
    {
        $rules = ['integer', 'in:' . implode(',', $allowedValues)];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Image validation rules
     */
    public static function image($required = false, $maxSize = 5120)
    {
        $rules = ['image', 'max:' . $maxSize, 'mimes:jpeg,png,jpg,gif,webp'];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Safe text validation rules (for comments, descriptions, etc.)
     */
    public static function safeText($required = true, $maxLength = 1000)
    {
        $rules = ['string', 'max:' . $maxLength, 'regex:' . self::REGEX_SAFE_TEXT_MULTILANG];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Date validation rules
     */
    public static function date($required = true, $format = 'Y-m-d')
    {
        $rules = ['date_format:' . $format];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    /**
     * Positive integer validation rules
     */
    public static function positiveInteger($required = true)
    {
        $rules = ['integer', 'min:1'];
        if ($required) array_unshift($rules, 'required');
        else array_unshift($rules, 'nullable');
        return $rules;
    }
    
    // ==========================================
    // Custom XSS Sanitization Methods
    // ==========================================
    
    /**
     * Strip potential XSS content from string
     */
    public static function sanitize($input)
    {
        if (is_array($input)) {
            return array_map([self::class, 'sanitize'], $input);
        }
        
        if (!is_string($input)) {
            return $input;
        }
        
        // Remove HTML tags
        $input = strip_tags($input);
        
        // Encode special characters
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        
        // Remove potential script injections
        $input = preg_replace('/javascript:/i', '', $input);
        $input = preg_replace('/on\w+=/i', '', $input);
        
        return trim($input);
    }
    
    /**
     * Get standard error messages for XSS validation
     */
    public static function errorMessages()
    {
        return [
            'regex' => 'The :attribute contains invalid characters.',
            'username.regex' => 'The username may only contain letters, spaces, apostrophes, hyphens, and dots.',
            'mobile_number.regex' => 'The mobile number may only contain digits, plus sign, spaces, hyphens, and parentheses.',
            'otp.regex' => 'The OTP may only contain digits.',
            'session_id.regex' => 'The session ID contains invalid characters.',
            'device_id.regex' => 'The device ID contains invalid characters.',
            'device_token.regex' => 'The device token contains invalid characters.',
            'car_registration_number.regex' => 'The car registration number may only contain letters, numbers, spaces, and hyphens.',
            'reg_chasis_number.regex' => 'The chassis number may only contain letters, numbers, and hyphens.',
            'category_number.regex' => 'The category number may only contain letters, numbers, spaces, and hyphens.',
        ];
    }
}

