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

	function __construct(){
		$a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        } 
	}
	function __construct1($directory)
	{
		if(file_exists($directory)){
			$this->directory = $directory;
			$path_parts = pathinfo($this->directory);
			$this->name = $path_parts['filename'];
			$this->path = $path_parts['dirname'];
			$this->filename = $path_parts['basename'];
			$this->extension = $path_parts['extension'];
		} else {
			echo "Diretório não existe!";
		}
	}
	function __construct2($directory, $path)
	{
		if(file_exists($directory)){
			$this->directory = $directory;
			$path_parts = pathinfo($this->directory);
			$this->name = $path_parts['filename'];
			$this->path = $path;
			$this->filename = $path_parts['basename'];
			$this->extension = $path_parts['extension'];
		}
	}
	function __construct3($name, $path, $file)
	{
		$this->name = $name;
		$this->path = $path;
		$this->file = $file;
		$this->extension = $this->file->getClientOriginalExtension();
		$this->filename = $this->name . '.' . $this->extension;
	}

	public function save($new_width = false, $thumbnail = false)
	{
		// verifica se o arquivo já existe ou vai ser enviado
		if(is_null($this->file)){

			if (is_null($this->directory))
				return false;

			$img = Image::make($this->directory);

		} else {

			$img = Image::make($this->file->getRealPath());

		}
		// Verifica se tem miniatura
		if($thumbnail) {

			$this->directory = $this->path . '/thumbnail/' . $this->filename;

		} else {

			$this->directory = $this->path . '/' . $this->filename;

		}

		if($new_width){

			$width = $img->width();
			$height = $img->height();
			// Calcula a proporção do tamanho
			if($width > $new_width){

				$prop_width = $width / $new_width;
				$width = $new_width;
				$height = $height / $prop_width;

       	}

       	$img->resize($width,$height);

     	}
		
		if($img->save($this->directory)){

			$response = true;
			
		} else {

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

			if(!($this->file->isValid()))
				$response = false;	

			if(!is_dir($this->path))
				$response = false;
	
			if($extensions){
				if(is_array($extensions)){

					$response = false;
					foreach ($extensions as $extension) {

						if($this->extension == $extension)
							$response = true;							

					}
				}
			}
		}
		return $response;
	}

	public function saveImageBase64($base64_string)
	{

		$ifp = fopen($this->directory, "wb" ); 
    	$data = explode(',', $base64_string);
		fwrite($ifp, base64_decode($data[1])); 
    	fclose($ifp); 

    	return($this->directory); 

	}

	/* Métodos de Acesso da Classe */
	public function setName($name)
	{
		$this->name = $name;
	}
	public function getName()
	{
		return $this->name();
	}

	public function setFilename($filename)
	{
		$this->filename = $filename;
	}
	public function getFilename()
	{
		return $this->filename;
	}

	public function setPath($path)
	{
		$this->path = $path;
	}
	public function getPath()
	{
		return $this->path;
	}

	public function setFile($file)
	{
		$this->file = $file;
	}
	public function getFile()
	{
		return $this->file;
	}

	public function setDirectory($directory)
	{
		$this->directory = $directory;
	}
	public function getDirectory()
	{
		return $this->directory;
	}

}