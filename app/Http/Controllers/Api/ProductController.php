<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

use function Symfony\Component\Clock\now;

class ProductController extends Controller
{
    public function products()
    {
        try {
            $products = [];

            /** @var \Illuminate\Http\Client\Response $response */
            $response = Http::timeout(5)  // we set seconds to show the error give 0.6 sec minimum
                ->retry(10, 100, function ($exception, $request) {
                    Log::warning('Api fails due to multiple attempt' . $exception->getMessage());
                    return $exception instanceof ConnectionException;
                })
                ->get('https://fakestoreapi.com/products');

            if ($response->failed()) {
                return response()->json([
                    'error' => 'API response failed',
                    'status' => $response->status()
                ]);
                // throw new Exception('API response failed');
            }
            if ($response->successful()) {
                $products = $response->json();
            }
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
                'status' => 401,
            ], 401);
        }

        return view('api.products.index', compact('products'));
    }

    public function productnews()
    {
        try {
            $apikey = config('services.productnews-api.key');

            /** @var \Illuminate\Http\Client\Response $response */
            // $response = Http::get('https://newsapi.org/v2/top-headlines', [
            //     'apikey' => $apikey,
            //     'country' => 'us',
            //     'category' => 'business',
            //     // 'pageSize' => 10
            // ]);

            // $response = Cache::remember('products', Carbon::now()->addMinutes(2), function () use ($apikey) {
            //     return Http::get('https://newsapi.org/v2/top-headlines', [
            //         'apiKey' => $apikey,  // yaha K capital hoga
            //         'country' => 'us',
            //         'category' => 'business',
            //     ])->json();
            // });

            $apiUrl = 'https://newsapi.org/v2/top-headlines';
            $cacheKey = 'products';
            $cachedData = Cache::get($cacheKey);

            $response = Http::get($apiUrl, [
                'apikey' => $apikey,
                'country' => 'us',
                'category' => 'business',
                // 'pageSize' => 10
            ]);
            $newData = $response->json();

            if ($cachedData !== $newData) {
                Cache::forget($cacheKey);
                Cache::put($cacheKey, $newData, Carbon::now()->addMinutes(2));
            }

            $data = $newData ?? [];
            // $data = $response ?? [];

            $products = $data['articles'] ?? [];
        } catch (Exception $ex) {
            return response()->json([
                'error' => $ex->getMessage(),
                'status' => 401,
            ], 401);
        }

        return view('api.products.productnews', compact('products'));
    }
}
