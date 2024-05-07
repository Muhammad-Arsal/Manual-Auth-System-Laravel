<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\EmailVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmailVerficationController extends Controller
{
    public function hittting(Request $request, $token)
    {
        if (!$request->hasValidSignature()) {
            abort(403);
        }
        
        $emailTesting = EmailVerification::where('token', $token)->with('admin')->firstOrFail();

        Admin::where('id', $emailTesting->admin->id)->update([
            'email_verified_at' => Carbon::now(),
        ]);

        $emailTesting->delete();

        return redirect('login');
    }
}
