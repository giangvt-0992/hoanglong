<?php

namespace App\Http\Controllers\Web;

use App\Contracts\Repositories\TripRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TripDepartDate;

class TripController extends Controller
{
    protected $tripRepository;

    public function __construct(TripRepository $tripRepository) {
        $this->tripRepository = $tripRepository;
    }

    public function getPickupPlaces(Request $request)
    {
        $trip = $this->tripRepository->find($request->tripId);
        $pickupPlace = $trip->getPickupPlace();
        return response()->json([
            'status' => 200,
            'data' => $pickupPlace
        ]);
    }

    public function getSeatMap(Request $request) {
        $tripDepartDate = TripDepartDate::findOrFail($request->tddId);
        $seatMap = $tripDepartDate->seatMap();
        $view = view('web.seat_template.seat', ['seatMap' => $seatMap])->render();
        return response()->json([
            'status' => 200,
            'data' => [
                'view' => $view
            ],
            "message" => 'Add ticket success'
        ]);
    }
}
