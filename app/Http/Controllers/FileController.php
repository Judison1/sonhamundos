<?php

/**
* 
*/
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// require 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

// // configure with favored image driver (gd by default)
// Image::configure(array('driver' => 'imagick'));

class FileController extends Controller
{
	protected $name;
	protected $filename;
	protected $path;
	protected $file;
	protected $extension;
	protected $directory;

	function __construct1($directory)
	{
		// $this->filename = $filename;
		// $this->path = $path;
	}
	function __construct2($filename, $path)
	{
		$this->filename = $filename;
		$this->path = $path;
	}
	function __construct($name, $path, $file)
	{
		$this->name = $name;
		$this->path = $path;
		$this->file = $file;
		var_dump($this->file);
	}

	public function save($new_width = false)
	{
		if($this->validation()){
			$this->filename = $this->name . '.' . $this->extension;
			$this->directory = $this->path . '/' . $this->filename;

			$img = Image::make($this->file->getRealPath());
			$width = $img->width();
			$height = $img->height();
			if($new_width){
				if($width > $new_width){
					$prop_width = $width / $new_width;
					$width = $new_width;
					$height = $height / $prop_width;
	       	}
        	}
			$img->resize($width,$height);

			if($img->save($this->directory)){

				$response = true;
				
			} else {
				$response = false;
			}
		} else{
			$response = false;
		}
		return $response;
	}

	public function validation($extensions = false)
	{
		$response = true;
		if(is_null($this->file)){
			$response = false;
		} else {
			if(!($this->file->isValid())){
				$response = false;
				echo "tets";
			}
			if(!is_dir($this->path)){
				$response = false;
				echo $this->path;
			}
		

			$this->extension = $this->file->getClientOriginalExtension();
			
			if($extensions){
				if(is_array($extensions)){
					foreach ($extensions as $extension) {
						if($this->extension == $extension)
							$response = true;
						else{
							$response = false;
							echo "ac";
						}
					}
				}
			}
		}
		return $response;
	}

	public static function saveImageBase64($base64_string, $directory)
	{
		$ifp = fopen( $directory, "wb" ); 
    	$data = explode(',', $base64_string);
		fwrite($ifp, base64_decode($data[1])); 
    	fclose( $ifp ); 
    	return( $directory ); 
	}

	public function getName()
	{
		return $this->name();
	}
	public function getFilename()
	{
		return $this->filename;
	}
	public function getPath()
	{
		return $this->path;
	}
	public function getFile()
	{
		return $this->file;
	}
}