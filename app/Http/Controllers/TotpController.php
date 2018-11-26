<?php

namespace App\Http\Controllers;

use App\Totp;
use Illuminate\Http\Request;

class TotpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function create()
    {
        $otp = (new Totp())->generate();
        return $otp;
    }

    public function verify(Request $request){
        $otp = $request->otp;
        return (new Totp())->verify($otp);
    }
}
