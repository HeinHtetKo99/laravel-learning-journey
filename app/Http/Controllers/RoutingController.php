<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoutingController extends Controller
{
    public function viewOnly() {
        return view ('admin.routing.view-only');
    }

    public function passingDataToView(){
        $buttons=[ //index array
            [
                "type"=> "primary",
                "text" => "Primary Button"
            ], //key value array or associated array
            [
                "type"=> "secondary",
                "text" => "Secondary Button"
            ],
            [
                "type"=> "danger",
                "text" => "Danger Button"
            ],
            [
                "type"=> "warning",
                "text" => "Warning Button"
            ],
        ];
        $alerts=[
            (object)[
                "type"=> "primary",
                "text" => "Primary Alert"
            ],
            (object)[
                "type"=> "secondary",
                "text" => "Secondary Alert"
            ],
            (object)[
                "type"=> "danger",
                "text" => "Danger Alert"
            ],
            (object)[
                "type"=> "warning",
                "text" => "Warning Alert"
            ],
        ];
        $listItems = [
            'item1',
            'item2',
            'item3',
        ];

        return view ('admin.routing.passing-data-to-view')
                ->with('listItems', $listItems)
                ->with('btns', $buttons)
                ->with('alerts', $alerts);
    }

    public function routeParameter($bgColor,$textColor){
        return view ('admin.routing.route-parameter')
                ->with('textColor',$textColor)
                ->with('backgroundColor',$bgColor);
    }

    public function dynamicRouteParameter(){
        return view ('admin.routing.dynamic-route-parameter');
    }

    public function SubmitdynamicRouteParameter(Request $request){
        $boxColor = $request['box-color'];
        $textColor = $request['text-color'];

        return redirect ('/admin/routing/route-parameter/' .$boxColor. '/' .$textColor);
    }

    public function namedRoute(){
        return view('/admin/routing/named-route');
    }

    public function middleware(){
        return view('/admin/routing/middleware');
    }

    public function testMiddleware(Request $request){
        dd('U are authorized user');
    }
}
