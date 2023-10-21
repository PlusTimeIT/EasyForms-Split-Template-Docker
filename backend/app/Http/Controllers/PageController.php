<?php
namespace App\Http\Controllers;

use App\Http\Forms\ExampleForm1;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function form1(Request $request)
    {
        $form = (new ExampleForm1())->fill($request);
        return response()->json([
            'data' => $form->toArray(),
            'results' => TRUE,
            'message' => '',
        ], 200);
    }
}
