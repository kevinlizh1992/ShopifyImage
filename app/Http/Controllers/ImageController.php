<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Session;
use Auth;

class ImageController extends Controller
{
    //shows all posted images
    public function index(){
        $images = Image::paginate(6); //paginate after 6 images
        return view('welcome')->with('images', $images);
    }

    //post image
    public function post(Request $request){
        $this->validate($request, [
            'image' => 'required' //make sure request is an/are image(s)
        ]);

        //loop over images to give each one a name, save it to images folder and create/save an instance.
        $images = $request->image;
        foreach($images as $image){
            $image_new_name = time() . $image->getClientOriginalName(); //give a unique name using current time.
            $image->move('images', $image_new_name); //move this image to the images folder.
            $post = new Image; //create Image record.
            $post->user_id = Auth::user()->id; //set image user_id to the currently authenticated user.
            $post->image = 'images/' . $image_new_name;
            $post->save();
        }
        Session::flash('success', 'Images uploaded'); //flash success message
        return redirect('/'); //redirect to main repository page
    }

    //remove image. If authenticated user is the one who posted the image, allow them to remove image.
    public function remove($id){
        $image = Image::find($id); //find image using id
        $image->delete(); //delete
        Session::flash('success', 'Images deleted'); //flash success message
        return redirect('/'); //redirect to main repository page
    }
}
