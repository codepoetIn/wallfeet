<?php
class FeedbackImagesApi 
{
public static function addImage($image){
		$destinationFileName = ImageUtils::generateFileName(basename($image));
		$destinationFile = self::getImagesDirectory().$destinationFileName;
		$success = Yii::app()->s3->upload($image, $destinationFile, Yii::app()->params['s3BucketName']);
		if($success){
			return $destinationFileName;
		}else {
			return Yii::app()->s3->lastError;
		}
	}
public static function getImagesDirectory(){
		return Yii::app()->params['s3FeedImagesFolderName'];
	}

	public static function getImage($imageName)
	{
		
	$url=ImageUtils::getImageUrl('feedback',$id=null,$imageName);
	return $url;
	}
}
	?>