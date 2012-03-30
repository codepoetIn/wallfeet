<?php

class EmailTemplateApi {

	public static function create($name,$data){
		$model = new EmailTemplates();
		$model->name = $name;
		$model->attributes = $data;
		return $model->save();
	}

	public static function update($id,$data){
		$model = EmailTemplates::model()->findByPk($id);
		if($model){
			$model->name = $name;
			$model->attributes = $data;
			return $model->save();
		} else {
			return false;
		}
	}

	public static function delete($id){
		$model = EmailTemplates::model()->findByPk($id);
		if($model){
			return $model->delete();
		} else {
			return false;
		}
	}

	public static function getTemplate($id){
		$model = EmailTemplates::model()->findByPk($id);
		if($model){
			return $model;
		} else {
			return false;
		}
	}

	public static function getTemplateByScenario($name){
		$model = EmailTemplates::model()->find("name=:name",array(":name"=>$name));
		if($model){
			return $model;
		} else {
			return false;
		}
	}

	public static function getAllTemplates(){
		$models = EmailTemplates::model()->findAll();
		if($models){
			return $models;
		} else {
			return false;
		}
	}
}

?>