<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request) {
        $data = $request->all();

        $isRecipientValid = $this->isRecipientValid($data['recipient']);
        if (!$isRecipientValid) {
            $response = [
                'data' => [
                    'result' => 'invalid_recipient',
                ]
            ];
            return response()->json($response, 200);
        }



        $response = [
            'data' => [
                'issuer' => 'Accredify',
                'result' => 'verified',
            ]
        ];
        return response()->json($response, 200);
    }
    
    private function isRecipientValid(Request $recipient) {
        return $recipient->has('name') && $recipient->has('email');
    }

    private function isIssuerValid(Request $issuer) {
        $areNameAndIdentityProofExists = $issuer->has('name') && $issuer->has('identityProof');
        if(!$areNameAndIdentityProofExists) {
            return false;
        }

        // TODO calvin: hit Google DNS' API to check if
        // issuer.identityProof.key is found in DNS TXT record of the domain name specified by
        // issuer.identityProof.location

        // e.g. https://dns.google/resolve?name=ropstore.accredify.io&type=TXT

    }
}
