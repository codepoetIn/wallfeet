<?php

class SmsTemplatesApi {

	public static function create($name,$data){
		$model = new SmsTemplates();
		$model->name = $name;
		$model->attributes = $data;
		return $model->save();
	}

	public static function update($id,$data){
		$model = SmsTemplates::model()->findByPk($id);
		if($model){
			$model->name = $name;
			$model->attributes = $data;
			return $model->save();
		} else {
			return false;
		}
	}

	public static function delete($id){
		$model = SmsTemplates::model()->findByPk($id);
		if($model){
			return $model->delete();
		} else {
			return false;
		}
	}

	public static function getTemplate($id){
		$model = SmsTemplates::model()->findByPk($id);
		if($model){
			return $model;
		} else {
			return false;
		}
	}
	
	public static function getTemplateByScenario($name){
		$model = SmsTemplates::model()->find("name=:name",array(":name"=>$name));
		if($model){
			return $model;
		} else {
			return false;
		}
	}

	public static function getAllTemplates(){
		$models = SmsTemplates::model()->findAll();
		if($models){
			return $models;
		} else {
			return false;
		}
	}
}

?>