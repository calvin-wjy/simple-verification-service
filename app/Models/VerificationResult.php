<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="VerificationResult",
 *     required={"data"},
 *     @OA\Property(
 *         property="data",
 *         type="object",
 *         @OA\Property(property="issuer", type="string"),
 *         @OA\Property(property="result", type="string", enum={"verified", "invalid_recipient", "invalid_issuer", "invalid_signature"})
 *     )
 * )
 */
class VerificationResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_type',
        'verification_result',
    ];

    protected $table = 'verification_result';
}
