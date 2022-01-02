<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AdminSettingsController extends Controller
{
    public function changeLayout(Request $request){

        $user = auth()->user();

        $user->admin_settings = $this->changeNewSetting($user->admin_settings, "layout", $request->layout);
        
        $user->save();

        return response()->json(["success" => "Your settings have been changed"], 200);
    }

    public function changeNewSetting($settings, $name, $settingToChange){

        $settings[$name] = $settingToChange;
        
        return $settings;
    }
}
