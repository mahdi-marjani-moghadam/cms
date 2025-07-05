<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CalcController extends Controller
{

    public function index(Request $request): View
    {
        // calc page detail
        $detail = new Content;
        $detail->title = 'محاسبه قیمت طلا';
        $detail->description = '';
        $detail->slug = 'calc';


        $template = env('TEMPLATE_NAME') . '.Calc';

        $breadcrumb[0]['title'] = 'محاسبه قیمت طلا';
        $breadcrumb[0]['slug'] = $detail->slug;

        return view($template, [
            'calculate' => $request->calculate,
            // 'mainMenu' => menuTree(),
            'detail' => $detail,
            'breadcrumb' => $breadcrumb
        ]);
    }

    function calculate(Request $request)
    {

        $goldPrice = (int) $request->tala;
        $weight = (float) $request->weight;
        $additionalPrice = (int) $request->additionalPrice;
        $ojrat = (int) $request->ojrat;
        $sooddarsad = (int) $request->sood / 100;
        $tax = (int) $request->tax / 100;

        $gold = $goldPrice * $weight;
        $ojrat = $gold * $ojrat / 100;
        $sood = ($gold + $ojrat) * $sooddarsad;
        $tax = ($sood + $ojrat) * $tax;

        $calculate = (int) floor(($gold + $sood + $ojrat + $tax + $additionalPrice) / 1000) * 1000;
        $calculate = number_format($calculate,0);
        // dd($weight);

        return redirect()->route('calc', ['calculate' => $calculate])->withInput();
    }

}
