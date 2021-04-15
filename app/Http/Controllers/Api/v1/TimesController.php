<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Time;
use Illuminate\Http\Request;

class TimesController extends Controller
{
    public function index(Request $request)
    {
        return Time::where('car_id', $request->body['id'])->get();
    }
}
