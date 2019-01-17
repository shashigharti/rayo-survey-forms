<?php

namespace Robust\Core\Controllers\API;

use App\Http\Controllers\Controller;


class MobileAppController extends Controller
{
    public function checkForUpdate()
    {
       $app = settings('mobile-app');
        return response()->json(['version' => $app['current_version'], 'update_required' => $app['update_required']]);
    }
}
