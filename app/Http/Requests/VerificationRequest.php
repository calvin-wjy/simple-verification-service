<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *   title="VerificationRequest",
 *   description="VerificationRequest model",
 *   @OA\Xml(
 *     name="VerificationRequest"
 *   )
 * )
 */
class VerificationRequest {
    public $data;
}
