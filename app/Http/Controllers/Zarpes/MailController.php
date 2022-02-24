<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Mail\ZarpesMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function mailZarpe($receiver,$subject,$data,$view){

        Mail::to($receiver)->send(new ZarpesMail($subject,$data,$view));
    }
}
