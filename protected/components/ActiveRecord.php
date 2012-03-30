<?php

/**
 * Base class to support Active Record models for the system.
 *
 * @author Karthick Loganathan - Ones and Zeros Technologies
 * @copyright 2011
 * @link http://www.energizeyourit.com
 * @package components
 *
 */
abstract class ActiveRecord extends CActiveRecord {

	public function beforeSave(){
		if($this->isNewRecord && $this->hasAttribute("created_by") && $this->hasAttribute("updated_by")){
			$this->created_by = Yii::app()->user->isGuest ? null : Yii::app()->user->id;
			$this->created_time = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss',time());
		} elseif(!$this->isNewRecord && $this->hasAttribute("updated_by") && $this->hasAttribute("updated_time")){
			$this->updated_by = Yii::app()->user->isGuest ? null : Yii::app()->user->id;
			$this->updated_time = Yii::app()->dateFormatter->format('yyyy-MM-dd HH:mm:ss',time());
		}
		return parent::beforeSave();
	}

	public function behaviors() {
		return array(
        'LoggableBehavior'=>
            'application.modules.auditTrail.behaviors.LoggableBehavior',
		);
	}

}