<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;


class DropzoneController extends Controller
{
  /**
   * Generate Image upload View
   *
   * @return void
   */
  public function dropzone()
  {
      return view('dropzone');
  }

  /**
   * Image Upload Code
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function dropzoneStore(Request $request)
  {
      $image = $request->file('file');

      $imageName = time().'.'.$image->extension();
      $image->move(public_path('images'),$imageName);
      $imageSave = new Photo();
      $imageSave->name = $imageName;
      $imageSave->path = "images/".$imageName;
      if ($imageSave->save()){
          return response()->json(['success'=>$imageName]);
      }
  }
}
