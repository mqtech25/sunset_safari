<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Trait UploadAble{

	/**
	* @param UploadedFile $file
	* @param null $folder
	* @param string $disk
	* @param null $filename
	* @return false|string
	*/
	public function uploadOne(UploadedFile $file, $folder = null, $disk = 'public', $filename = null){

		$name = !is_null($filename) ? $filename : Str::random(25);

		return $file->storeAs(
			$folder,
			$name.".".$file->getClientOriginalExtension(),
			$disk
		);
	}

	/**
	* @param UploadedFile $file
	* @param null $folder
	* @param string $disk
	* @param null $filename
	* @return false|string
	*/
	public function uploadThumbs($file, $folder = null, $filename = null, $size, $disk = 'public'){
		$uniqueID = uniqid (rand ());
		$name = $filename."-".$uniqueID.".".$file->getClientOriginalExtension();
		\Image::make($file)->resize($size, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save(public_path($folder.$name));
		return $name;
	}


	/**
	* @param null $path
	* @param string $disk
	*/
	public function deleteOne($path =null, $disk = 'public'){
		Storage::disk($disk)->delete($path);
	}

	/**
	* @param null $path
	* @param string $disk
	*/
	public function deleteThumbs($path =null, $image, $disk = 'public'){
		// dd($path);
		unlink(public_path($path). DIRECTORY_SEPARATOR .$image);
	}

}
