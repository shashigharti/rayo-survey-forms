<?php
namespace Robust\Reports\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;


class ImageController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function post_image(Request $request, ImageManager $image)
    {
        $all_data = $request->all();
        $uploaded_file = '';
        //Check if file  exists
        if (isset($all_data['files'][0])) {
            $name = str_replace(' ', '-', strtolower($all_data['files'][0]->getClientOriginalName()));
            $imageName = $name;
            $uploaded_file = public_path('uploads' . "/" . $imageName);

            //Crop and save the image.
            $image = $image->make($all_data['files'][0]->getRealPath())->crop(intval($all_data['width']), intval($all_data['height']), intval($all_data['x']), intval($all_data['y']));
            $image->save($uploaded_file);
        }

        return response()->json(['file_name' => url("uploads/$imageName"), 'message' => 'Successfully Saved']);
    }


}
