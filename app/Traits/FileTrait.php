<?php

namespace App\Traits;

use Image;

trait FileTrait {

	public function manageFile($file, $dir)
	{
		//Explode the string after the comma
        $exploded = explode(',', $file);
        //decode to base64 the exploded request file with index 1
        //with the used of intervention image we can easily resize image width and height
        $decoded = Image::make(base64_decode($exploded[1]))->resize(300, 200);
        //check file extension using str_contains function 
        if(str_contains($exploded[0], 'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';
        //create file name
        $filename = str_random().'.'.$extension;
        //directory where the file will be stored
        $directory = $dir;
        //check if the directory or file exists
        if(!file_exists($directory)){
            //make new directory if the file does not exists
            mkdir($directory, 0755, true);
        }
        //create file path
        $path = public_path($directory).'/'.$filename;

        $decoded->save($path);
        //file put content
        file_put_contents($path, $decoded);

        return $filename;
	}
}