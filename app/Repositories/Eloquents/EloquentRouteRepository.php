<?php

namespace App\Repositories\Eloquents;

use App\Contracts\Repositories\ProvinceRepository;
use App\Contracts\Repositories\RouteRepository;
use App\Models\District;
use App\Models\Place;
use App\Models\Route;
use Illuminate\Support\Facades\DB;

class EloquentRouteRepository extends EloquentBaseRepository implements RouteRepository
{
    protected $model;
    protected $provinceRepository;

    public function __construct(
        Route $model,
        EloquentProvinceRepository $eloquentProvinceRepository
    ) {
        $this->model = $model;
        $this->eloquentProvinceRepository = $eloquentProvinceRepository;
    }

    public function all()
    {
        return $this->model->with('images')->orderBy('index', 'ASC')->get();
    }
    
    public function paginate($items = null)
    {
        return $this->model->orderBy('index', 'ASC')->paginate($items);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findTrips($data)
    {
        $departProvince = $data['departProvince'];
        $departPlaces = $departProvince->places()->pluck('places.id')->toArray();

        $desProvince = $data['desProvince'];
        $desPlaces = $desProvince->places()->pluck('places.id')->toArray();

        $formartDate = date("Y-m-d", strtotime($data['departDate']));
        $routes = DB::table('routes as r')
        ->select(
            'r.id as routeId',
            'r.name as routeName',
            'r.distance',
            'r.duration',
            'r.price',
            't.depart_time as departTime',
            't.arrive_time as arriveTime',
            't.pick_up_schedule as pickUpSchedule',
            't.get_off_schedule as getOffSchedule',
            'ct.name as carType',
            'tdd.available_seats as availableSeats',
            'tdd.seat_map as seatMap',
            'b.name as brandName',
            'p1.name as departName',
            'p2.name as desName'
        )
        ->whereIn('depart_place_id', $departPlaces)
        ->whereIn('des_place_id', $desPlaces)
        ->join('trips as t', 'r.id', 't.route_id')
        ->join('car_types as ct', 't.car_type_id', 'ct.id')
        ->join('trip_depart_dates as tdd', 't.id', 'tdd.trip_id')
        ->join('brands as b', 'r.brand_id', 'b.id')
        ->join('places as p1', 'r.depart_place_id', 'p1.id')
        ->join('places as p2', 'r.des_place_id', 'p2.id')
        ->where([
            ['tdd.depart_date', $formartDate],
            ['tdd.available_seats', '>=',$data['quantity']]
            ])
        ->get();
        
        return $routes;
    }
}
