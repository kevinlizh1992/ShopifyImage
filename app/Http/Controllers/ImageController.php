<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Session;
use Auth;

class ImageController extends Controller
{

    public function index(){
        $images = Image::paginate(6); //use pagination instead of Image::all()
        return view('welcome')->with('images', $images);
    }

    public function post(Request $request){
        $this->validate($request, [
            'image' => 'required' //make sure its an image(s)
        ]);

        //image that comes in is an array, so we need to loop
        $images = $request->image;
        foreach($images as $image){
            $image_new_name = time() . $image->getClientOriginalName();
            //move this image to the images folder
            $image->move('images', $image_new_name);
            //create record
            $post = new Image; //create the new image called $post
            $post->user_id = Auth::user()->id; //set it's user_id to the currently authenticated user.
            $post->image = 'images/' . $image_new_name;
            $post->save();
        }
        Session::flash('success', 'Images uploaded'); //flash success message
        return redirect('/');
    }

    //if authenticated user is the one who posted the image, allow to remove image
    public function remove($id){
        $image = Image::find($id);
        $image->delete();
        Session::flash('success', 'Images deleted'); //flash success message
        return redirect('/');
    }
}
