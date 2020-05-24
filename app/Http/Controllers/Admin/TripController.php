<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\CarTypeRepository;
use App\Contracts\Repositories\ProvinceRepository;
use App\Contracts\Repositories\RouteRepository;
use App\Contracts\Repositories\TripRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TripRequest;
use App\Models\Trip;
use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    protected $tripRepository;
    protected $carTypeRepository;
    protected $routeRepository;
    protected $provinceRepository;

    public function __construct(
        TripRepository $tripRepository,
        CarTypeRepository $carTypeRepository,
        RouteRepository $routeRepository,
        ProvinceRepository $provinceRepository
    ) {
        $this->tripRepository = $tripRepository;
        $this->carTypeRepository = $carTypeRepository;
        $this->routeRepository = $routeRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function index()
    {
        $this->authorize('trip.viewAny');
        $trips = $this->tripRepository->allByAdmin();

        return view('admin.trip.index', [
            'trips' => $trips
        ]);
    }

    public function create()
    {
        $this->authorize('trip.create');

        $carTypes = $this->carTypeRepository->all();
        $routes = $this->routeRepository->allByAdmin();

        $oldRoute = $this->routeRepository->find(old('routeId'));
        $oldRoutePlaces = $oldRoute ? $oldRoute->places : [];

        return view('admin.trip.create', [
            'carTypes' => $carTypes,
            'routes' => $routes,
            'oldRoutePlaces' => $oldRoutePlaces,
        ]);
    }

    public function store(TripRequest $request)
    {
        $this->authorize('trip.create');

        if ($this->checkIsDuplicateArray($request->schedule)) {
            return redirect()->back()->with('warning', 'Điểm đón khách không được trùng nhau')->withInput();
        }

        try {
            $this->tripRepository->store([
                'name' => $request->name,
                'depart_time' => $request->departTime,
                'arrive_time' => $request->arriveTime,
                'pick_up_schedule' => json_encode($request->schedule),
                'brand_id' => getAuthAdminBrandId(),
                'route_id' => $request->routeId,
                'car_type_id' => $request->carTypeId,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm chuyến xe thất bại')->withInput();
        }
        
        return redirect()->route('admin.trip.index')->with('success', 'Thêm chuyến xe thành công');
    }

    public function edit(Trip $trip)
    {
        $this->authorize('trip.update', $trip);

        $carTypes = $this->carTypeRepository->all();
        $routes = $this->routeRepository->allByAdmin();

        $oldRoute = $this->routeRepository->find(old('routeId', $trip->route_id));
        $oldRoutePlaces = $oldRoute ? $oldRoute->places : [];
        return view('admin.trip.update', [
            'trip' => $trip,
            'carTypes' => $carTypes,
            'routes' => $routes,
            'oldRoutePlaces' => $oldRoutePlaces,

        ]);
    }

    public function update(TripRequest $request, Trip $trip)
    {
        $this->authorize('trip.update', $trip);

        if ($this->checkIsDuplicateArray($request->schedule)) {
            return redirect()->back()->with('warning', 'Điểm đón khách không được trùng nhau')->withInput();
        }
        
        try {
            $trip->route_id = $request->routeId;
            $trip->name = $request->name;
            $trip->depart_time = $request->departTime;
            $trip->arrive_time = $request->arriveTime;
            $trip->pick_up_schedule = json_encode($request->schedule);
            $trip->car_type_id = $request->carTypeId;
            $trip->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhật chuyến không thành công')->withInput();
        }

        return redirect()->route('admin.trip.index')->with('success', 'Cập nhật chuyến thành công');
    }

    public function checkIsDuplicateArray($schedule)
    {
        $arr = [];
        foreach ($schedule as $sch) {
            if (!in_array($sch['place_id'], $arr)) {
                $arr[] = $sch['place_id'];
            } else {
                break;
            }
            
        }
        return count($schedule) !== count($arr);
    }

    public function destroy(Trip $trip)
    {
        $this->authorize('trip.delete', $trip);

        if ($trip->tripDepartDates()->count() > 0) {
            return redirect()->route('admin.trip.index')->with('error', 'Xóa chuyến không thành công. Chuyến xe này đã được lên lịch');
        }

        try {
            $trip->delete();
        } catch (\Throwable $th) {
            return redirect()->route('admin.trip.index')->with('error', 'Xóa chuyến không thành công.');
        }
        return redirect()->route('admin.trip.index')->with('success', 'Xóa chuyến thành công');
    }

    public function active(Trip $trip)
    {
        $this->authorize('trip.delete', $trip);

        $route = $trip->route;
        // echo('<pre>');
        // print_r($route->getOriginal('is_active'));
        // echo('<pre>');
        // exit();
        if ($route && $route->getOriginal('is_active') == false) {
            return redirect()->route('admin.trip.index')->with('error', 'Kích hoạt chuyến không thành công. Vui lòng kích hoạt tuyến ' . $route->name . ' trước!');
        }

        $isActive = true;
        if ($this->tripRepository->toggleIsActive($trip, $isActive)) {
            return redirect()->route('admin.trip.index')->with('success', 'Kích hoạt chuyến thành công.');
        }
        return redirect()->route('admin.trip.index')->with('error', 'Kích hoạt chuyến không thành công.');
    }

    public function inactive(Trip $trip)
    {
        $this->authorize('trip.delete', $trip);

        $isActive = false;
        if ($this->tripRepository->toggleIsActive($trip, $isActive)) {
            return redirect()->route('admin.trip.index')->with('success', 'Ngưng kích hoạt chuyến thành công.');
        }
        return redirect()->route('admin.trip.index')->with('error', 'Ngưng kích hoạt chuyến không thành công.');
    }
}
