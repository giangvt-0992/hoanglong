<?php

namespace App\Http\Middleware;

use App\Models\Image;
use Closure;

class DeleteUnuseImage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routePath = $request->path();
        if (\Session::has('imageUploaded')) {
            $imageUploaded = \Session::get('imageUploaded');
            if ($imageUploaded['times'] > 0 || !str_contains($routePath, ['create', 'edit', 'images'])) {
                $listImageId = $imageUploaded['listImageId'];
                $images = Image::whereIn('id', $listImageId)->get();
                foreach ($images as $image) {
                    if (file_exists(public_path($image->url))) {
                        unlink(public_path($image->url));
                        $image->delete();
                    }
                }
                \Session::forget('imageUploaded');
            } else {
                if (!str_contains($routePath, ['create', 'edit', 'images'])) {
                    $imageUploaded['times']++;
                    \Session::put('imageUploaded', $imageUploaded);
                }
            }
        }
        return $next($request);
    }
}
