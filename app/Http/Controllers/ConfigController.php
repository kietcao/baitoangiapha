<?php

namespace App\Http\Controllers;

use App\Constants\CurrentPage;
use App\Models\ConfigTemp;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function config()
    {
        $config = ConfigTemp::first();
        return view('global.themes', [
            'config' => $config,
            'current_page' => CurrentPage::THEMES,
        ]);
    }

    public function setConfig(Request $request)
    {
        $config = ConfigTemp::first();
        $config->title = $request->title;
        $config->template_id = $request->template_id;
        $config->save();

        return redirect()->back()->with(['message' => 'Cập nhật thành công !']);
    }
}
