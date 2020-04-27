<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\PlaceRepository;
use App\Contracts\Repositories\RouteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RouteRequest;
use App\Models\Route;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    private $routeRepository;
    private $placeRepository;

    public function __construct(
        RouteRepository $routeRepository,
        PlaceRepository $placeRepository
    ) {
        $this->routeRepository = $routeRepository;
        $this->placeRepository = $placeRepository;
    }

    public function index()
    {
        $this->authorize('route.viewAny');

        $routes = $this->routeRepository->allByAdmin();

        return view('admin.route.index', [
            'routes' => $routes
        ]);
    }

    public function create()
    {
        $this->authorize('route.create');

        $admin = getAuthAdmin();
        $places = $admin->brand->places()->with('district.province:id,name')->get();

        return view('admin.route.create', [
            'places' => $places
        ]);
    }

    public function store(RouteRequest $request)
    {
        $this->authorize('route.create');

        if ($this->routeRepository->checkRouteExist($request->departPlaceId, $request->desPlaceId)) {
            return redirect()->back()->with('warning', 'Tuyến đường đã này đã tồn tại!')->withInput(); 
        }

        try {
            DB::transaction(function () use ($request) {
                $this->routeRepository->store([
                    'name' => $request->name,
                    'depart_place_id' => $request->departPlaceId,
                    'des_place_id' => $request->desPlaceId,
                    'distance' => decodeFormatNumber($request->distance),
                    'price' => decodeFormatNumber($request->price),
                    'brand_id' => getAuthAdminBrandId(),
                    'duration' => json_encode([
                        'hours' => $request->hours,
                        'minutes' => $request->minutes
                    ])
                ]);
                if ($request->chkBackRoute) {
                    $departPlace = $this->placeRepository->find($request->departPlaceId);
                    $departProvinceName = $departPlace->district->province->name;
                    $desPlace = $this->placeRepository->find($request->desPlaceId);
                    $desProvinceName = $desPlace->district->province->name;

                    $routeName = "Tuyến $desProvinceName - $departProvinceName ($desPlace->name - $departPlace->name)";
                    
                    $this->routeRepository->store([
                        'name' => $routeName,
                        'depart_place_id' => $request->desPlaceId,
                        'des_place_id' => $request->departPlaceId,
                        'distance' => decodeFormatNumber($request->distance),
                        'price' => decodeFormatNumber($request->price),
                        'brand_id' => getAuthAdminBrandId(),
                        'duration' => json_encode([
                            'hours' => $request->hours,
                            'minutes' => $request->minutes
                        ])
                    ]);
                }
            });
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm tuyền đường thất bại')->withInput();
        }
        return redirect()->route('admin.route.index')->with('success', 'Thêm tuyền đường thành công');
    }

    public function edit(Route $route)
    {
        $this->authorize('route.update', $route);

        $admin = getAuthAdmin();
        $places = $admin->brand->places;

        return view('admin.route.update', [
            'places' => $places,
            'route' => $route
        ]);
    }

    public function update(RouteRequest $request, Route $route)
    {
        $this->authorize('route.update', $route);

        try {
            $route->name = $request->name;
            $route->depart_place_id = $request->departPlaceId;
            $route->des_place_id = $request->desPlaceId;
            $route->distance = decodeFormatNumber($request->distance);
            $route->price = decodeFormatNumber($request->price);
            $route->brand_id = getAuthAdminBrandId();
            $route->duration = json_encode([
                'hours' => $request->hours,
                'minutes' => $request->minutes
            ]);
            $route->save();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm tuyến đường thất bại');
        }
        return redirect()->route('admin.route.index')->with('success', 'Cập nhật tuyến đường thành công');
    }

    public function destroy(Route $route)
    {
        $this->authorize('route.delete', $route);

        $checkTrips = $route->trips()->count();
        if ($checkTrips > 0) {
            return redirect()->back()->with('error', 'Xóa tuyến đường thất bại! Tuyến đường đã được ghép chuyến');
        }
        try {
            $route->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xóa tuyến đường thất bại!');
        }
        return redirect()->back()->with('success', 'Xóa tuyến đường thành công');
    }
}
