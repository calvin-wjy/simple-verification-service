<?php

namespace App\Http\Requests;

/**
 * @OA\Schema(
 *     schema="VerificationRequest",
 *     required={"data", "signature"},
 *     @OA\Property(
 *         property="data",
 *         type="object",
 *         @OA\Property(property="id", type="string"),
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(
 *             property="recipient",
 *             type="object",
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="email", type="string")
 *         ),
 *         @OA\Property(
 *             property="issuer",
 *             type="object",
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(
 *                 property="identityProof",
 *                 type="object",
 *                 @OA\Property(property="type", type="string"),
 *                 @OA\Property(property="key", type="string"),
 *                 @OA\Property(property="location", type="string")
 *             )
 *         ),
 *         @OA\Property(property="issued", type="string", format="date-time")
 *     ),
 *     @OA\Property(
 *         property="signature",
 *         type="object",
 *         @OA\Property(property="type", type="string"),
 *         @OA\Property(property="targetHash", type="string")
 *     )
 * )
 */
class VerificationRequest {
    public $data;
}
