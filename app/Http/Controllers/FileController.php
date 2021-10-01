<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    public function file(Request $request){
        $post = new Post;

        if ($request->hasFile('image')) {
            $completeFileName = $request->file('image')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extenshion = $request->file('image')->getClientOriginalExtension();
            $compPic= str_replace(' ', '_', $fileNameOnly).'-'.rand() . '_'.time(). '.'. $extenshion;
            $path = $request->file('image')->storeAs('public/posts', $compPic);
            $post->image= $compPic;
        }

        if ($post->save()) {
            return ['status'=> true, 'message'=> 'Post Guardado Correctamente'];
        }else{
            return ['status'=> false, 'message'=> 'Lo sentimos, no se pudo guardar'];
        }
    }
}
