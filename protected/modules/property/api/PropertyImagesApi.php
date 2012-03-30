<?php

class PropertyImagesApi {

	public static function addImages($propertyId,$images){
		$success = true;
		foreach($images as $image){
			$success = $success && self::addImage($propertyId,$image);
		}

		return $success;
	}

	public static function addImage($propertyId,$image){
		$destinationFileName = ImageUtils::generateFileName(basename($image));
		$destinationFile = self::getImagesDirectory($propertyId).$destinationFileName;
		$success = Yii::app()->s3->upload($image , $destinationFile, Yii::app()->params['s3BucketName']);
		if($success){
			$model = new PropertyImages();
			$model->property_id = $propertyId;
			$model->image = $destinationFileName;
			$model->save();
			return true;
		}else {
			return Yii::app()->s3->lastError;
		}
	}
	
	public static function addMultipleImage($propertyId,$images){
		$count = 0;
		foreach($images as $image){
			$destinationFileName = ImageUtils::generateFileName(basename($image));
			$destinationFile = self::getImagesDirectory($propertyId).$destinationFileName;
			$success = Yii::app()->s3->upload($image , $destinationFile, Yii::app()->params['s3BucketName']);
			if($success){
				$model = new PropertyImages();
				$model->property_id = $propertyId;
				$model->image = $destinationFileName;
				$model->save();
				$count++;
			}
		}
		return $count;
	}
	
	public static function deleteImageByPk($id){
		return PropertyImages::model()->deleteByPk($id);
	}

	public static function deleteImage($propertyId,$image){
		$imageFile = self::getImagesDirectory($propertyId).$image;
		$model= PropertyImages::model()->find('image=:image',array(':image'=>$image));
		if($model){
			$success = Yii::app()->s3->deleteObject(Yii::app()->params['s3BucketName'],$imageFile);
			if($success){
				$model->delete();
				return true;
			}else {
				return false;
			}
		}

		return false;

	}

	public static function deleteAllImages($propertyId){
		$models = PropertyImages::model()->findAll('property_id=:propertyId',array(':propertyId'=>$propertyId));
		$result = true;
		foreach($models as $model){
			$result = $result && self::deleteImage($propertyId,$model->image) && $model->delete();
		}

		return $result;
	}
	
	public static function getImageByUrl($propertyId,$url){
		return ImageUtils::getImageUrl('properties',$propertyId,$url);
	}

	public static function getAllImages($propertyId){
		$models = PropertyImages::model()->findAll('property_id=:propertyId',array(':propertyId'=>$propertyId));
		$result = false;
		foreach($models as $model){
			$result[$model->id] = ImageUtils::getImageUrl('properties',$propertyId,$model->image);
		}

		return $result;
	}

	public static function getPrimaryImageForProperties($propertyIds){

		$criteria=new CDbCriteria;
		$criteria->addInCondition('property_id',$propertyIds);

		$models = PropertyImages::model()->findAll($criteria);
		$result = false;;

		foreach($models as $model){
			$result[$model->property_id] = ImageUtils::getImageUrl('properties',$model->property_id,$model->image);
		}

		return $result;
	}

	public static function getImagesDirectory($propertyId){
		return Yii::app()->params['s3PropImagesFolderName'].$propertyId.'/';
	}

}

?>