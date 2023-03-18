<?php
namespace App\Traits;

use Carbon\Carbon;

trait Image{
		
	public  function uploadToFileServer($imagePath, $folder, $sizes = "500x500"){
		
		$dir = '';
		$extension = $imagePath->extension();
		$data = file_get_contents($imagePath);
		$dataEncoded = base64_encode($data);
		$base64 = 'data:image/' . $extension . ';base64,' . $dataEncoded;

		if($base64 != "") {			
			$folder = 'public/uploads/ossp/'.$folder.'/';
			
			$dataFile = explode(',', $base64);			
			$ini =substr($dataFile[0], 11);
			$ext = explode(';', $ini);
			
			if(isset($ext[0])){
				
				$ext = strtolower($ext[0]);
				
				if($ext == "png" || $ext == "jpg" || $ext == "jpeg" ){
					//extract data from the post
										
					$base64Name = str_random(25).uniqid();
					$fields = array(
							'file' => urlencode($base64),
							'folder'=> $folder,
							'fileName' => urlencode($base64Name),
							'sizes' => $sizes
					);
					
					$fieldsString = '';
					foreach($fields as $key=>$value) { 
						$fieldsString .= $key.'='.$value.'&'; 
					}
					rtrim($fieldsString, '&');
					
					$ch = curl_init();					
					curl_setopt($ch,CURLOPT_URL, env('FILE_UPLOAD_URL'));
					curl_setopt($ch,CURLOPT_POST, count($fields));
					curl_setopt($ch,CURLOPT_POSTFIELDS, $fieldsString);
					$result = curl_exec($ch);
					curl_close($ch);
					 
					$dir  = env('PREFIX_FILE_UPLOAD_URL').$folder.$base64Name.'.'.$ext;						
				}
			}
		}
		return $dir;
	}	
}