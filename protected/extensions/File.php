<?php


class File
{
	private $uploadDir;
	private $tempUploadDir;
	
	public function __construct($uploadDir)
	{
		if (trim($uploadDir) != '' && is_dir($uploadDir)) 
		{
			$this->uploadDir=trim($uploadDir);
		}
		else 
		{
			die("<b>ERROR:</b> Failed to open Directory: $uploadDir");
		}
		
	
	}
	
	
	public function uploadFileForTINYmac($uploaderId)
	{
			//echo $this->uploadDir."\n";
			//echo $this->tempUploadDir;
			$fileName = $_FILES[$uploaderId]['name'];
			
				if(!move_uploaded_file($_FILES[$uploaderId]['tmp_name'], $this->uploadDir.'/'.$fileName))
				{
					return	false;
				}
				else 
				{	
					
											 
						$this->writeToFile($this->uploadDir."/example_image_list.js");	
								
						$this->createTmb($fileName);
						return true;
					
				}		
	}
	
	
	
	public function uploadFile($uploaderId,$newName,$width=100,$height=100)
	{
			
			//echo $this->tempUploadDir;
				$fileName =$_FILES[$uploaderId]['name'];
			
				if(!move_uploaded_file($_FILES[$uploaderId]['tmp_name'], $this->uploadDir.'/'.$fileName))
				{
				
					return	false;
				}else 
				{
					rename($this->uploadDir.'/'.$fileName, $this->uploadDir.'/'.$newName);
					$this->createTmb($newName,$width,$height);
					return true;
				}	
	}
	
	
	public function createTmb($filename,$width=40,$height=30)
	{
				// The file
		
		$newFileName="tmb-".$filename;
		// Set a maximum height and width
		//$width = 200;
		//$height = 200;
		
		// Content type
		//header('Content-type: image/jpeg');
		
		// Get new dimensions
		list($width_orig, $height_orig) = getimagesize($this->uploadDir."/".$filename);
		
		$ratio_orig = $width_orig/$height_orig;
		
		if ($width/$height > $ratio_orig) {
		   $width = $height*$ratio_orig;
		} else {
		   $height = $width/$ratio_orig;
		}
		
		// Resample
		$image_p = imagecreatetruecolor($width, $height);
		$image = imagecreatefromjpeg($this->uploadDir."/".$filename);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		
		// Output
		imagejpeg($image_p,$this->uploadDir."/".$newFileName);
	}
	
	
	public function getImageList()
	{
		
		$dh = opendir($this->uploadDir);
		
		$files = array();
		
		while (($file = readdir($dh)) !== false) 
		{
			if($file!='Thumbs.db' and $file!='.' and $file!='..' and $file!='example_image_list.js' )
			{
				
				$files[]= $file;
				
			}
			
		}
		closedir($dh);
		return $files;		
	}
	

	
	
	
	public  function deleteFile($file)
	{
		$temp =  $this->uploadDir."/".$file;
		
		if (file_exists($temp)) 
		{
			if (unlink($temp)) 
			{
			
				$this->writeToFile($this->uploadDir."/example_image_list.js");				
				
			
				
				return true;	
			}
			else return false;
		}
		
		
	}
	
	
	public  function deleteGalleryFile($file)
	{
		$temp =  $this->uploadDir."/".$file;
		
		if (file_exists($temp)) 
		{
    		if (unlink($temp))return true;	
			else return false;
		} 
		

		
		
	
	}
	
	
	
	private function writeToFile($file)
	{
		$fp = fopen($file, "w");
		
		
		
		$data="var IL = new Array();";
		
		$i=0;
		foreach ($this->getImageList() as $names)
		{
			if(substr($names,0,3)!='tmb')
			{
					$data = $data. " IL[".$i."]='./images/".$names."';";	
			
					$i++;
			}
		}
		
		fwrite($fp, $data);
		
		fclose($fp);
		return $data;
	}
	
	
	
	
	
}
?>