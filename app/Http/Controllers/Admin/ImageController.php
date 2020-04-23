<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Repositories\ImageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;

class ImageController extends Controller
{
    protected $imageRepository;

    public function __construct(
        ImageRepository $imageRepository
    ) {
        $this->imageRepository = $imageRepository;
    }

    public function upload(Request $request)
    {
        if ($request->ajax()) {
            if ($request->hasFile('file')) {
                $imageFiles = $request->file('file');
                $destinationPath = public_path(config('picture.brand_image'));
                $arrImage = [];
                $listImageId = [];
                if (\Session::has('imageUploaded')) {
                    $imageUploaded = \Session::get('imageUploaded');
                    $listImageId = $imageUploaded['listImageId'];
                }
                
                foreach ($imageFiles as $fileKey => $fileObject) {
                    if ($fileObject->isValid()) {
                        $destinationFileName = time() . '-' . $fileObject->getClientOriginalName();
                        $fileObject->move($destinationPath, $destinationFileName);
                        // save the the destination filename
                        $image = new Image([
                            'url' => config('picture.brand_image') . '/' . $destinationFileName,
                            'admin_id' => auth('admin')->user()->id,
                            'title' => $fileObject->getClientOriginalName(),
                        ]) ;
                        $image->save();
                        $arrImage[] = [
                            'name' => $destinationFileName,
                            'id' => $image->id,
                            'original_name' => $fileObject->getClientOriginalName(),
                            'deleteRoute' => route('admin.image.delete', ['id' =>  $image->id])
                        ];
                        $listImageId[] = $image->id;
                    }
                }
                \Session::put('imageUploaded', ['listImageId' => $listImageId, 'times' => 0]);

                return response()->json([
                    'status' => 'success',
                    'data' => $arrImage,
                    'message' => 'Thêm ảnh thành công'
                ]);
            }
        }
        return response()->json([
            'status'=> 'error',
            'data' => []
        ]);
    }

    public function delete(Request $request)
    {
        $imageId = $request->id;
        if ($imageId) {
            $image = $this->imageRepository->find($imageId);
            unlink(public_path($image->url));
            $this->imageRepository->delete($imageId);
            if (\Session::has('imageUploaded')) {
                $imageUploaded = \Session::get('imageUploaded');
                $imageUploaded['listImageId'] = array_diff($imageUploaded['listImageId'], [$imageId]);
                \Session::put('imageUploaded', $imageUploaded);
                return response()->json([
                    'status'=> 'success',
                    'data' => $imageUploaded,
                    'message' => 'Xóa ảnh thành công'
                ]);
            }
            return response()->json([
                'status'=> 'success',
                'data' => [],
                'message' => 'Xóa ảnh thành công'
            ]);
        }
        return response()->json([
            'status'=> 'error',
            'data' => [],
            'message' => 'Xóa ảnh thất bại'
        ]);
    }
}
