<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\DistrictRepository;
use App\Contracts\Repositories\PlaceRepository;
use App\Contracts\Repositories\ProvinceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Models\Place;

class PlaceController extends Controller
{
    protected $placeRepository;
    protected $districtRepository;
    protected $provinceRepository;

    public function __construct(
        PlaceRepository $placeRepository,
        DistrictRepository $districtRepository,
        ProvinceRepository $provinceRepository
    ) {
        $this->placeRepository = $placeRepository;
        $this->districtRepository = $districtRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function index()
    {
        $this->authorize('place.viewAny');
        
        $admin = getAuthAdmin();
        $places = $admin->brand->places()->with('district', 'district.province')->get();
        return view('admin.place.index', [
            'places' => $places
        ]);
    }

    public function create()
    {
        $this->authorize('place.create');
        $provinces = $this->provinceRepository->allWithDistrict();
        return view('admin.place.create', [
            'provinces' => $provinces,
        ]);
    }

    public function store(PlaceRequest $request)
    {
        $this->authorize('place.create');
        $admin = getAuthAdmin();
        try {
            $this->placeRepository->store([
                'name' => $request->name,
                'address' => $request->address,
                'map_url' => $request->map,
                'description' => $request->description,
                'district_id' => $request->districtId,
                'brand_id' => $admin->brand_id
            ]);

            return redirect()->route('admin.place.index')->with('success', 'Thêm địa điểm thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm địa điểm thất bại')->withInput();
        }
    }

    public function edit(Place $place)
    {
        $this->authorize('place.update', $place);

        $provinces = $this->provinceRepository->allWithDistrict();
        return view('admin.place.update', [
            'place' => $place,
            'provinces' => $provinces,
        ]);
    }

    public function update(PlaceRequest $request,Place $place)
    {
        $this->authorize('place.update', $place);
        try {
            $place->name = $request->name;
            $place->address = $request->address;
            $place->map_url = $request->map;
            $place->district_id = $request->districtId;
            $place->description = $request->description;
            $place->save();
            return redirect()->route('admin.place.index')->with('success', 'Cập nhật địa điểm thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Cập nhật địa điểm thất bại')->withInput();
        }
    }

    public function destroy(Place $place)
    {
        $this->authorize('place.delete', $place);

        $checkRoutes = $place->departRoutes()->count() + $place->desRoutes()->count();
        if ($checkRoutes > 0) {
            return redirect()->back()->with('error', 'Xóa địa điểm thật bại, địa điểm này đã được ghép tuyến');
        }
        $place->delete();
        
        // try {
        //     $place->name = $request->name;
        //     $place->address = $request->address;
        //     $place->map_url = $request->map;
        //     $place->district_id = $request->districtId;
        //     $place->description = $request->description;
        //     $place->save();
            return redirect()->route('admin.place.index')->with('success', 'Xóa địa điểm thành công');
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Cập nhật địa điểm thất bại')->withInput();
        // }
    }
}
