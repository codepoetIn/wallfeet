<?php

/**
 * @author Karthick Loganathan - Ones and Zeros Technologies
 * @copyright 2011
 * @link http://www.energizeyourit.com
 * ResourceActiveRecord is the customized active record class.
 * All models that serve a resource should extend from this base class.
 */

abstract class ResourceActiveRecord extends CActiveRecord
{
	 /*
	  * Derived classes can modify this default implementation to add/hide
	  * attributes that must be served to a client.	 	
	  * Returns all attributes by default 
	  */	
	public function getResourcesAttributes(){
		return $this->attributes;
	}
}