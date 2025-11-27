<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class SMSService
{
    /*public static function send($number, $message)
    {
        $apiToken = config('services.iprog.api_token');
        $url = 'https://sms.iprogtech.com/api/v1/sms_messages';

        $response = Http::post($url, [
            'api_token' => $apiToken,
            'phone_number'  => $number,
            'message' => $message,
        ]);

        return $response->json();
    }*/

      /**
     * Send SMS via iProg
     */
    public static function send($number, $message)
    {
        try {
            $apiToken = config('services.iprog.api_token');
            $url = 'https://sms.iprogtech.com/api/v1/sms_messages';

            // Format phone number
            $formattedNumber = self::formatPhoneNumber($number);

            Log::info("Sending SMS to: {$formattedNumber}");

            $response = Http::post($url, [
                'api_token' => $apiToken,
                'phone_number' => $formattedNumber,
                'message' => $message,
            ]);

            $result = $response->json();

            if ($response->successful()) {
                Log::info("SMS sent successfully", ['response' => $result]);
                return [
                    'success' => true,
                    'data' => $result
                ];
            }

            Log::error("SMS failed", ['response' => $result]);
            return [
                'success' => false,
                'message' => 'Failed to send SMS',
                'data' => $result
            ];

        } catch (\Exception $e) {
            Log::error("SMS error: " . $e->getMessage());
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Format phone number to international format
     * 09171234567 -> +639171234567
     */
    private static function formatPhoneNumber(string $phone): string
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // If starts with 0, replace with +63 (Philippines)
        if (substr($phone, 0, 1) === '0') {
            return '+63' . substr($phone, 1);
        }

        // If starts with 63, add +
        if (substr($phone, 0, 2) === '63') {
            return '+' . $phone;
        }

        // If already starts with +63, return as is
        if (substr($phone, 0, 3) === '+63') {
            return $phone;
        }

        // Default: assume PH number, add +63
        return '+63' . $phone;
    }

    /**
     * Send OTP via SMS
     */
    public static function sendOTP($number, $otp, $appName = null)
    {
    $appName = $appName ?? config('app.name', 'SwisaAGAP');
    //Updated message to reflect 3 minutes
    $message = "Your {$appName} OTP code is: {$otp}. Valid for 3 minutes. Do not share this code.";
    
    return self::send($number, $message);
    }

    /**
     * Send custom message
     */
    public static function sendMessage($number, $message)
    {
        return self::send($number, $message);
    }
}