<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\PlaceRepository;
use App\Contracts\Repositories\ProvinceRepository;
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
    private $provinceRepository;

    public function __construct(
        RouteRepository $routeRepository,
        PlaceRepository $placeRepository,
        ProvinceRepository $provinceRepository
    ) {
        $this->routeRepository = $routeRepository;
        $this->placeRepository = $placeRepository;
        $this->provinceRepository = $provinceRepository;
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
        $places = $admin->brand->places;
        $provinces = $this->provinceRepository->all();

        $oldDepartProvince = $this->provinceRepository->find(old('departProvinceId'));
        $oldDesProvince = $this->provinceRepository->find(old('desProvinceId'));
        $oldDepartProvincePlaces = $oldDepartProvince ? $oldDepartProvince->places()->whereBrandId($admin->brand_id)->get() : [];
        $oldDesProvincePlaces = $oldDesProvince ? $oldDesProvince->places()->whereBrandId($admin->brand_id)->get() : [];

        return view('admin.route.create', [
            'places' => $places,
            'provinces' => $provinces,
            'oldDepartProvincePlaces' => $oldDepartProvincePlaces,
            'oldDesProvincePlaces' => $oldDesProvincePlaces,
        ]);
    }

    public function store(RouteRequest $request)
    {
        $this->authorize('route.create');

        if ($this->routeRepository->checkRouteExist($request->departPlaceId, $request->desPlaceId)) {
            return redirect()->back()->with('warning', 'Tuyến đường đã này đã tồn tại!')->withInput();
        }

        $listPassingPlaceId = $request->listPassingPlaceId;
        !in_array($request->departPlaceId, $listPassingPlaceId) && $listPassingPlaceId[] = $request->departPlaceId;

        try {
            DB::transaction(function () use ($request, $listPassingPlaceId) {
                $route = $this->routeRepository->store([
                    'name' => $request->name,
                    'depart_place_id' => $request->departPlaceId,
                    'des_place_id' => $request->desPlaceId,
                    'distance' => decodeFormatNumber($request->distance),
                    'price' => decodeFormatNumber($request->price),
                    'brand_id' => getAuthAdminBrandId(),
                    'duration' => json_encode([
                        'hours' => $request->hours,
                        'minutes' => $request->minutes
                    ]),
                    'description' => $request->description,
                ]);
                $route->places()->attach($listPassingPlaceId);
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

        $provinces = $this->provinceRepository->all();
        $departProvince = $route->departPlace->district->province;
        $desProvince = $route->desPlace->district->province;
        $departProvincePlaces = $departProvince->places()->whereBrandId($admin->brand_id)->get();
        $desProvincePlaces = $desProvince->places()->whereBrandId($admin->brand_id)->get();
        $listPassingPlaceId = $route->places()->pluck('id')->toArray();

        return view('admin.route.update', [
            'places' => $places,
            'provinces' => $provinces,
            'route' => $route,
            'departProvince' => $departProvince,
            'desProvince' => $desProvince,
            'departProvincePlaces' => $departProvincePlaces,
            'desProvincePlaces' => $desProvincePlaces,
            'listPassingPlaceId' => $listPassingPlaceId,
        ]);
    }

    public function update(RouteRequest $request, Route $route)
    {
        $this->authorize('route.update', $route);

        try {
            $listPassingPlaceId = $request->listPassingPlaceId;
            !in_array($request->departPlaceId, $listPassingPlaceId) && $listPassingPlaceId[] = $request->departPlaceId;

            DB::transaction(function () use ($route, $request, $listPassingPlaceId) {
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
                $route->description = $request->description;
                $route->places()->sync($listPassingPlaceId);
                
                $route->save();
            });
            
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
            DB::transaction(function () use ($route) {
                $route->delete();
                $route->places()->detach();
            });
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xóa tuyến đường thất bại!');
        }
        return redirect()->back()->with('success', 'Xóa tuyến đường thành công');
    }

    public function passingPlaces(Request $request)
    {
        $route = $this->routeRepository->find($request->routeId);
        $passingPlace = $route->places;

        return response()->json([
            'status' => 200,
            'data' => $passingPlace
        ]);
    }

    public function getTrips(Route $route)
    {
        $trips = $route->trips()->select('id', 'name')->get();

        return response()->json([
            'status' => 200,
            'data' => [
                'trips' => $trips
            ],
        ]);
    }
    
    public function active(Route $route)
    {
        $this->authorize('route.delete', $route);

        $isActive = true;
        if ($this->routeRepository->toggleIsActive($route, $isActive)) {
            return redirect()->route('admin.route.index')->with('success', 'Kích hoạt tuyến thành công.');
        }
        return redirect()->route('admin.route.index')->with('error', 'Kích hoạt tuyến không thành công.');
    }

    public function inactive(Route $route)
    {
        $this->authorize('route.delete', $route);

        $isActive = false;
        if ($this->routeRepository->toggleIsActive($route, $isActive)) {
            return redirect()->route('admin.route.index')->with('success', 'Ngưng kích hoạt tuyến thành công.');
        }
        return redirect()->route('admin.route.index')->with('error', 'Ngưng kích hoạt tuyến không thành công.');
    }
}
