<?php
namespace App\Helper;
use Image;
use File;
use App\Models\Images;

class Slike
{
  


    public static function DodajSliku($image){
        $thumb_path='/home/edina/Desktop/zavrsni/microGraf/public/thumb';
        $slike_path='/home/edina/Desktop/zavrsni/microGraf/public/slike';
        $input['imagename'] = time().'.'.$image->extension();

        $img = Image::make($image->path());
        $img->save( $slike_path.'/'.$input['imagename']);

        $thumb= Image::make($image->path());
        $thumb->resize(300, 300, function ($const) {
            $const->aspectRatio();
            $const->upsize();
        })->save($thumb_path.'/'.$input['imagename']);
        
        $imagedb= Images::create([
            "name" => $input['imagename'],
            "file_path" =>  $slike_path]);

        return $imagedb->id;
    }

    public static function IzbrisiSliku($image){
        $thumb_path='/home/edina/Desktop/zavrsni/microGraf/public/thumb';
        $slike_path='/home/edina/Desktop/zavrsni/microGraf/public/slike';
        $filename=$slike_path.'/'.$image->name;
        $filenamethumb=$thumb_path.'/'.$image->name;
        File::delete($filename);
        File::delete($filenamethumb);
        $image->delete();
    }
}