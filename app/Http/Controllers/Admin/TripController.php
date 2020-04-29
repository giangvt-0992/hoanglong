<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\CarTypeRepository;
use App\Contracts\Repositories\RouteRepository;
use App\Contracts\Repositories\TripRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TripRequest;

class TripController extends Controller
{
    protected $tripRepository;
    protected $carTypeRepository;
    protected $routeRepository;

    public function __construct(
        TripRepository $tripRepository,
        CarTypeRepository $carTypeRepository,
        RouteRepository $routeRepository
    ) {
        $this->tripRepository = $tripRepository;
        $this->carTypeRepository = $carTypeRepository;
        $this->routeRepository = $routeRepository;
    }

    public function index()
    {
        $this->authorize('trip.viewAny');
        $trips = $this->tripRepository->allByAdmin();
        // echo('<pre>');
        // print_r($places);
        // echo('<pre>');
        // exit();

        return view('admin.trip.index', [
            'trips' => $trips
        ]);
    }

    public function create()
    {
        $this->authorize('trip.create');

        $carTypes = $this->carTypeRepository->all();
        $routes = $this->routeRepository->allByAdmin();

        return view('admin.trip.create', [
            'carTypes' => $carTypes,
            'routes' => $routes,
        ]);
    }

    public function store(TripRequest $request)
    {
        $this->authorize('trip.create');
    }
}
