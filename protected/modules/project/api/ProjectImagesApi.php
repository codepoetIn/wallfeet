<?php

class ProjectImagesApi {

	public static function addImages($projectId,$images){
		$success = true;
		foreach($images as $image){
			$success = $success && self::addImage($projectId,$image);
		}

		return $success;
	}

	public static function addImage($projectId,$image){
		$destinationFileName = ImageUtils::generateFileName(basename($image));
		$destinationFile = self::getImagesDirectory($projectId).$destinationFileName;
		$success = Yii::app()->s3->upload($image , $destinationFile, Yii::app()->params['s3BucketName']);
		if($success){
			$model = new ProjectImages();
			$model->project_id = $projectId;
			$model->image = $destinationFileName;
			$model->save();
			return true;
		}else {
			return Yii::app()->s3->lastError;
		}
	}
	
	public static function addMultipleImage($projectId,$images){
		$count = 0;
		foreach($images as $image){
			$destinationFileName = ImageUtils::generateFileName(basename($image));
			$destinationFile = self::getImagesDirectory($projectId).$destinationFileName;
			$success = Yii::app()->s3->upload($image , $destinationFile, Yii::app()->params['s3BucketName']);
			if($success){
				$model = new ProjectImages();
				$model->project_id = $projectId;
				$model->image = $destinationFileName;
				$model->save();
				$count++;
			}
		}
		return $count;
	}

	public static function deleteImage($projectId,$image){
		$imageFile = self::getImagesDirectory($projectId).$image;
		$model= ProjectImages::model()->find('image=:image',array(':image'=>$image));
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

	public static function deleteAllImages($projectId){
		$models = ProjectImages::model()->findAll('project_id=:projectId',array(':projectId'=>$projectId));
		$result = true;
		foreach($models as $model){
			$result = $result && self::deleteImage($projectId,$model->image) && $model->delete();
		}

		return $result;
	}

	public static function getAllImages($projectId){
		$models = ProjectImages::model()->findAll('project_id=:projectId',array(':projectId'=>$projectId));
		$result = false;
		foreach($models as $model){
			$result[] = ImageUtils::getImageUrl('projects',$projectId,$model->image);
		}

		return $result;
	}
	
	public static function getAll($projectId){
		$models = ProjectImages::model()->findAll('project_id=:projectId',array(':projectId'=>$projectId));
		if($models)
		return $models;
		else
		return false;
	}

	public static function getPrimaryImageForProjects($projectIds){

		$criteria=new CDbCriteria;
		$criteria->addInCondition('project_id',$projectIds);

		$models = ProjectImages::model()->findAll($criteria);
		$result = false;;

		foreach($models as $model){
			$result[$model->project_id] = ImageUtils::getImageUrl('projects',$model->project_id,$model->image);
		}

		return $result;
	}

	public static function getImagesDirectory($projectId){
		return Yii::app()->params['s3ProjImagesFolderName'].$projectId.'/';
	}
}

?>