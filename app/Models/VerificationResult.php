<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *    title="VerificationResult",
 *    description="VerificationResult model",
 *    @OA\Xml(
 *       name="VerificationResult"
 *   )
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
