<?php

class ImageUtils {

	public static function generateFileName($fileName){
		return time().'_'.$fileName;
	}

	public static function getImagesBaseUrl($entity){

		switch(strtolower($entity)){
			case "properties":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3PropImagesFolderName'];
			case "projects":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3ProjImagesFolderName'];
			case "specialists":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3SpecialistsImagesFolderName'];
			case "profiles":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3ProfilesImagesFolderName'];
			case "agents":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3AgentImagesFolderName'];
			case "builders":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3BuilderImagesFolderName'];	
			default:
				return false;
		}

	}
	
	public static function getImagesDirectoryUrl($entity,$id){

		switch(strtolower($entity)){
			case "properties":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3PropImagesFolderName'].$id.'/';
			case "projects":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3ProjImagesFolderName'].$id.'/';
			case "specialists":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3SpecialistsImagesFolderName'].$id.'/';
			case "profiles":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3ProfilesImagesFolderName'].$id.'/';
			case "agents":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3AgentImagesFolderName'].$id.'/';
			case "builders":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3BuilderImagesFolderName'].$id.'/';
				
			default:
				return false;
		}

	}
	
	public static function getImageUrl($entity,$id=null,$imageName){
		switch(strtolower($entity)){
			case "properties":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3PropImagesFolderName'].$id.'/'.$imageName;
			case "projects":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3ProjImagesFolderName'].$id.'/'.$imageName;
			case "specialists":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3SpecialistsImagesFolderName'].$id.'/'.$imageName;
			case "profiles":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3ProfilesImagesFolderName'].$id.'/'.$imageName;
			case "agents":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3AgentImagesFolderName'].$id.'/'.$imageName;
			case "builders":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3BuilderImagesFolderName'].$id.'/'.$imageName;
			case "feedback":
				return Yii::app()->params['s3Url'].Yii::app()->params['s3FeedImagesFolderName'].$imageName;
			default:
				return false;
		}

	}
	
	public static function getDefaultImage($entity){

		switch(strtolower($entity)){
			case "properties":
				return Yii::app()->theme->baseUrl.'/images/default/no-image-available.jpg';
			case "projects":
				return Yii::app()->theme->baseUrl.'/images/default/no-image-available.jpg';
			case "requirements":
				return Yii::app()->theme->baseUrl.'/images/default/no-image-available.jpg';
			case "specialists":
				return Yii::app()->theme->baseUrl.'/images/default/no-image-available.jpg';
			case "profiles":
				return Yii::app()->theme->baseUrl.'/images/default/no-image-available.jpg';
			case "agents":
				return Yii::app()->theme->baseUrl.'/images/default/no-image-available.jpg';
			case "builders":
				return Yii::app()->theme->baseUrl.'/images/default/no-image-available.jpg';	
			default:
				return false;
		}

	}
	
	public static function uploadImage($model,$field){
		$model->image=CUploadedFile::getInstance($model,$field);
		$newname=date("dmYHis")."_".$model->$field;
		if($model->$field!=""){
			$model->$field->saveAs(Yii::app()->basePath . '/../uploads/tmp/' . $newname);
			return Yii::app()->basePath . '/../uploads/tmp/' . $newname;
		}
		return false;
	}
	
	public static function uploadMultipleImage($files){
		$imagePaths = null;
		
		if (isset($files) && count($files) > 0) {
			
			foreach ($files as $i => $file) {	
				
				$newname =  date("dmYHis")."_".$file->name;      
				 
	            $file->saveAs(Yii::app()->basePath . '/../uploads/tmp/' . $newname);    
	            $imagePaths[] = Yii::app()->basePath . '/../uploads/tmp/' . $newname;                 
			}
		}
		return $imagePaths;
	}
	
	public static function deleteImage($imagePath){
		if(file_exists($imagePath))
			unlink($imagePath);
	}
	
	public static function deleteMultipleImages($imagePaths){
		foreach($imagePaths as $imagePath){
			if(file_exists($imagePath))
				unlink($imagePath);
		}
	}
}

?>