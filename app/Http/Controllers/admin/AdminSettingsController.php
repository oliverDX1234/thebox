<?php

namespace App\Http\Controllers\admin;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;


class AdminSettingsController extends Controller
{
    /**
     * @throws ApiException
     */
    public function changeLayout(Request $request){
        try {
            $user = auth()->user();

            $user->admin_settings = $this->changeNewSetting($user->admin_settings, "layout", $request->layout);

            $user->save();
        } catch (Exception $e) {
            throw new ApiException("global.layout_change_failed", 500, null, $e);
        }

        return response()->api(null, "global.layout_changed_success");
    }

    public function changeNewSetting($settings, $name, $settingToChange){

        $settings[$name] = $settingToChange;

        return $settings;
    }
}
