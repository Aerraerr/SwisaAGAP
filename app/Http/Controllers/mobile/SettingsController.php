<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use App\Models\GrantSetting;

class SettingsController extends Controller
{
    // ✅ Get all grant settings
    public function getGrantSettings()
    {
        $settings = [
            'equipment_credit_cost' => (int) GrantSetting::get('equipment_credit_cost', 15),
            'machinery_credit_cost' => (int) GrantSetting::get('machinery_credit_cost', 15),
            'other_grant_credit_cost' => (int) GrantSetting::get('other_grant_credit_cost', 10),
            'equipment_quarterly_limit' => (int) GrantSetting::get('equipment_quarterly_limit', 1),
            'machinery_quarterly_limit' => (int) GrantSetting::get('machinery_quarterly_limit', 1),
            'other_grant_quarterly_limit' => (int) GrantSetting::get('other_grant_quarterly_limit', 2),
        ];

        return response()->json([
            'success' => true,
            'settings' => $settings
        ]);
    }
}
