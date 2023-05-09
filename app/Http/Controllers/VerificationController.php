<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Helper;

class VerificationController extends Controller
{

    const GOOGLE_DNS_API = 'https://dns.google/resolve?name=%s&type=TXT';

    public function verify(Request $request) {
        $data = $request->json()->all()['data'];
        $isRecipientValid = $this->isRecipientValid(isset($data['recipient']) ? $data['recipient'] : null);
        if (!$isRecipientValid) {
            $response = [
                'data' => [
                    'result' => 'invalid_recipient',
                ]
            ];
            return response()->json($response, 200);
        }

        $isIssuerValid = $this->isIssuerValid(isset($data['issuer']) ? $data['issuer'] : null);
        if (!$isIssuerValid) {
            $response = [
                'data' => [
                    'result' => 'invalid_issuer',
                ]
            ];
            return response()->json($response, 200);
        }
        $signature = $request->json()->all()['signature'];
        $isSignatureValid = $this->isSignatureValid(isset($signature) ? $signature : null, $data);
        if (!$isSignatureValid) {
            $response = [
                'data' => [
                    'result' => 'invalid_signature',
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
    
    private function isRecipientValid(?array $recipient) {
        if ($recipient == null) {
            return false;
        }

        return array_key_exists('name', $recipient) && array_key_exists('email', $recipient);
    }
    
    private function isIssuerValid(?array $issuer) {
        if ($issuer == null) {
            return false;
        }

        $areNameAndIdentityProofExists = array_key_exists('name', $issuer) &&
            array_key_exists('identityProof', $issuer) &&
            array_key_exists('location', $issuer['identityProof']) &&
            array_key_exists('key', $issuer['identityProof']);

        if(!$areNameAndIdentityProofExists) {
            return false;
        }

        $issuerLocation = $issuer['identityProof']['location'];
        $issuerKey = $issuer['identityProof']['key'];
        
        // Hit google DNS API and check if the issuer key is present in the TXT record
        $client = new Client();
        $response = $client->get(sprintf(self::GOOGLE_DNS_API, $issuerLocation));
        $data = json_decode($response->getBody(), true);
        foreach($data['Answer'] as $answer) {
            // check if the issuer key is present in the TXT record
            if (strpos($answer['data'], $issuerKey) !== false) {
                return true;
            }
        }

        return false;
    }

    private function isSignatureValid(?array $signature, ?array $data) {
        if ($signature == null || !array_key_exists('targetHash', $signature)) {
            return false;
        }

        $flattenedData = flattenJson($data);
        $result = array();
        foreach($flattenedData as $key => $value) {
            array_push($result, hash('sha256', json_encode([$key => $value])));
        }

        sort($result);
        $targetHash = hash('sha256', json_encode($result));
        return $targetHash == $signature['targetHash'];
    }
}
