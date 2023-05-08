<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request) {
        $data = $request->all();

        $response = [
            'data' => [
                'issuer' => 'Accredify',
                'result' => 'verified',
            ]
        ];
        return response()->json($response, 200);
    }
}
