<?php

namespace App\Http\Controllers;

use App\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadFileController extends Controller
{
    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('service-image')) {
                $image = $request->file('service-image');
                $ext = $image->getClientOriginalExtension();
                $name = $request->service . '.' . $ext;
                $path = "public/images/services/" . $name;
                Storage::disk('local')->put($path, file_get_contents($image));
                $service = Service::find($request->service);
                $service->image = $name;
                $service->update();
                return response()->json([
                    'name' => $name,
                    'type' => "service-image"
                ]);
            }
            if ($request->hasFile('post-image')) {
                $image = $request->file('post-image');
                $ext = $image->getClientOriginalExtension();
                $name = time() . '.' . $ext;
                $path = "public/images/posts/" . $name;
                Storage::disk('local')->put($path, file_get_contents($image));

                return response()->json([
                    'name' => $name,
                    'type' => "post-image"
                ]);
            }
            if ($request->hasFile('city-image')) {
                $image = $request->file('city-image');
                $ext = $image->getClientOriginalExtension();
                $name = time() . '.' . $ext;
                $path = "public/images/cities/" . $name;
                Storage::disk('local')->put($path, file_get_contents($image));

                return response()->json([
                    'name' => $name,
                    'type' => "post-image"
                ]);
            }
            if ($request->hasFile('blog-image')) {
                $image = $request->file('blog-image');
                $ext = $image->getClientOriginalExtension();
                $name = time() . '.' . $ext;
                $path = "public/images/blog/" . $name;
                Storage::disk('local')->put($path, file_get_contents($image));

                return response()->json([
                    'name' => $name,
                    'type' => "blog-image"
                ]);
            }
            if ($request->hasFile('chat-image')) {
                $image = $request->file('chat-image');
                $ext = $image->getClientOriginalExtension();
                $name = time() . '.' . $ext;
                $path = "public/images/chat/" . $name;
                Storage::disk('local')->put($path, file_get_contents($image));

                return response()->json([
                    'name' => $name,
                    'type' => "chat-image"
                ]);
            }
            if ($request->hasFile('galery-image')) {
                $image = $request->file('galery-image');
                $ext = $image->getClientOriginalExtension();
                $name = time() . '.' . $ext;
                $path = "public/images/galery/" . $name;
                Storage::disk('local')->put($path, file_get_contents($image));

                return response()->json([
                    'name' => $name,
                    'type' => "galery-image"
                ]);
            }
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function remove(Request $request)
    {
        $file = "public/images/posts/" . $request->name;
        Storage::delete($file);
        return response()->json("Image deleted.");
    }
}
