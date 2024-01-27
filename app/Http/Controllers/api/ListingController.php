<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;


class ListingController extends Controller
{

    public static function calculateDistance($lat1, $lon1, $lat2, $lon2, $unit = 'K')
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1))
                * sin(deg2rad($lat2))
                + cos(deg2rad($lat1))
                * cos(deg2rad($lat2))
                * cos(deg2rad($theta));

            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;

            // returns in KM
            return ($miles * 1.609344) * 1000;
        }
    }


    public function get()
    {
        $token = request()->bearerToken();
        if (!auth()->user()->tokenCan($token)) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized'
            ]);
        }

        $listings = Listing::where('user_id', auth()->user()->id)->get();

        $lists = [];

        foreach ($listings as $listing) {
            $lists[] = [
                'id' => $listing->id,
                'name' => $listing->name,
                'distance' => self::calculateDistance(
                    0,
                    0,
                    $listing->latitude,
                    $listing->longitude,
                    'K',
                ),
                'created_at' => $listing->created_at->format('d-m-Y H:i:s'),
                'updated_at' => $listing->updated_at->format('d-m-Y H:i:s'),
            ];
        }

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'result' => [
                'data' => $lists
            ]
        ]);
    }
}
