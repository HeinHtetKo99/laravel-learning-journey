<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BladeTemplateController extends Controller
{
    public function getComponent(){
        $alerts = [
            [
                "type" => "danger",
                "title" => "Danger Alert",
                "description" => "This is danger alert."
            ],
            [
                "type" => "info",
                "title" => "Info Alert",
                "description" => "This is info alert."
            ],
            [
                "type" => "primary",
                "title" => "Primary Alert",
                "description" => "This is primary alert."
            ]
        ];
        return view('/admin/blade-template/component')
            ->with('alerts',$alerts);
    }

    public function getLocalization(){
        return view('/admin/blade-template/localization');
    }

    public function changelocalization(Request $request){

        $lang = $request->lang;
        session()->put('lang',$lang);
        App::setLocale($lang);
        return redirect('/admin/blade-template/localization');
    }
}

