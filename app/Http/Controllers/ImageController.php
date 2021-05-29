<?php

namespace App\Http\Controllers;
use App\Models\Images;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create()
    {
        $slike =Images::latest()->paginate(3);
        return view('images',[ 'slike'=>$slike]);
    }

    public function store(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'name' => 'required',
        ]);

        // ensure the request has a file before we attempt anything else.
        if ($request->hasFile('file')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);
           // $image = $request->file('file');
           // $filename = time() . '.' . $image->getClientOriginalExtension();

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->file->store('slike', 'public');
        
           
            // Store the record, using the new file hashname which will be it's new filename identity.
          
         //   $name= $request->get('name') ."1";
            Images::create([
                "name" =>$request->get('name')// $name,
                "file_path" => $request->file->hashName()//$filename 
            ]);
        }
        //return view('images');
        return back();
    }
}
