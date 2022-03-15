<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    public function index()
    {
        return view('qrcode');
    }
}
