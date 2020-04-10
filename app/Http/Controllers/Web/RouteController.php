<?php

namespace App\Http\Controllers\Web;

use App\Contracts\Repositories\ProvinceRepository;
use App\Contracts\Repositories\RouteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\District;
use App\Models\Place;

class RouteController extends Controller
{
    protected $routeRepository;
    protected $provinceRepository;

    public function __construct(
        RouteRepository $routeRepository,
        ProvinceRepository $provinceRepository
    ) {
        $this->routeRepository = $routeRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function index(Request $request)
    {
        if ($request->has('departure_id') && $request->has('destination_id') && $request->has('depart_date') && $request->has('quantity')) {
            $departProvince = $this->provinceRepository->find($request->departure_id);
            $desProvince = $this->provinceRepository->find($request->destination_id);

            $data = [
                'departProvince' => $departProvince,
                'desProvince' => $desProvince,
                'quantity'  => $request->quantity,
                'departDate' => $request->depart_date
            ];
            $routes = $this->routeRepository->findTrips($data);
            // echo('<pre>');
            // print_r($routes);
            // echo('<pre>');
            // exit();
            \Session::put('step', config('constants.step.STEP1'));
            return view(
                'web.booking.index',
                [
                'routes' => $routes,
                'departProvince' => $departProvince,
                'desProvince' => $desProvince,
            ]
            );
        }
        \Session::put('step', config('constants.step.STEP0'));
        return view('web.booking.index');
    }

    public function search(Request $request)
    {
        $data = [
            'depart_province_id' => $request->departure_id,
            'des_province_id' => $request->destination_id,
            'quantity'  => $request->quantity,
            'depart_date' => $request->depart_date
        ];
        $routes = $this->routeRepository->findTrips($data);

        return $routes;
    }
}
