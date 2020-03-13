<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Image;

trait FileTrait {

    public function loopFiles($files)
    {
        $array_images = [];

        foreach($files as $file){

            $array_images[] = $this->manageImage($file, 'file/uploads/posts');
        }

        return $array_images;
    }
    public function checkFile(Request $request)
    {
        if($request->hasFile('files')){

            $files = $request->file('files');

            $images = $this->loopFiles($files);

            return $this->manageArrayImages($images);

        }else{

            return $image = '';
        }
    }
    public function manageImage($image, $dir)
    {
        $filename = str_random().'.'.$image->getClientOriginalExtension();
        $img = Image::make($image)->resize(300, 200);

        if(!file_exists($dir)){
            mkdir($dir, 0755, true);
        }
        $path = public_path($dir).'/'.$filename;
        $img->save($path);

        return $filename;
    }
    public function manageArrayImages(array $images)
    {
        if(count($images) > 1){

            return implode("|", $images);

        }else{

            foreach($images as $img){
                return $img;
            }
        }
    }

    // public function manageFile($file, $dir)
    // {
    //     //Explode the string after the comma
    //     $exploded = explode(',', $file);
    //     //decode to base64 the exploded request file with index 1
    //     //with the used of intervention image we can easily resize image width and height
    //     $decoded = Image::make(base64_decode($exploded[1]))->resize(300, 200);
    //     //check file extension using str_contains function 
    //     if(str_contains($exploded[0], 'jpeg'))
    //         $extension = 'jpg';
    //     else
    //         $extension = 'png';
    //     //create file name
    //     $filename = str_random().'.'.$extension;
    //     //directory where the file will be stored
    //     $directory = $dir;
    //     //check if the directory or file exists
    //     if(!file_exists($directory)){
    //         //make new directory if the file does not exists
    //         mkdir($directory, 0755, true);
    //     }
    //     //create file path
    //     $path = public_path($directory).'/'.$filename;

    //     $decoded->save($path);
    //     //file put content
    //     file_put_contents($path, $decoded);

    //     return $filename;
    // }
}