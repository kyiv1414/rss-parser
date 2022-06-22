<?php

namespace App\Http\Controllers\Api\Definitions;
/**
 * @OA\Info(title="Simple microservice API docs", version="0.1")
 */

/**
 * @OA\Schema(
 *     @OA\Property(property="totalCount", type="integer"),
 *     @OA\Property(property="pageCount", type="integer"),
 *     @OA\Property(property="currentPage", type="integer"),
 *     @OA\Property(property="perPage", type="integer"),
 * )
 */
final class Meta
{
}
