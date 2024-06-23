<?php

namespace App\OpenApi;

use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="API Documentation",
 *         version="1.0.0",
 *         description="Documentation for the CraftedBy API"
 *     ),
 *     @OA\Components(
 *         @OA\Schema(
 *             schema="Product",
 *             type="object",
 *             @OA\Property(property="id", type="string", format="uuid"),
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="description", type="string"),
 *             @OA\Property(property="price", type="number"),
 *             @OA\Property(property="quantity", type="number"),
 *             @OA\Property(property="material", type="string"),
 *             @OA\Property(property="color", type="string"),
 *             @OA\Property(property="size", type="string"),
 *             @OA\Property(property="category", type="string"),
 *             @OA\Property(property="img_url", type="string"),
 *             @OA\Property(property="shop_id", type="string", format="uuid"),
 *             @OA\Property(property="created_at", type="string", format="date-time"),
 *             @OA\Property(property="updated_at", type="string", format="date-time")
 *         )
 *     )
 * )
 */
class OpenApiConfig
{
}