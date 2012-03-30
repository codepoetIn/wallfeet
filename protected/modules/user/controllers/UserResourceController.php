<?php
/**
 * This file consists of the user resource controller.
 * 
 * @author Karthick Loganathan - Ones and Zeros Technologies
 * @copyright 2011
 * @link http://www.energizeyourit.com
 * 
 */
 /**
 * This is the controller that handles all requests for http://powengine.in/user API.
 *
 * This controller serves the following URI - 
 * 1) GET http://powengine.com/user - Returns an array of all User objects in the system
 * 2) GET http://powengine.com/user/{id} - Returns a user object of id {id}
 * 3) POST http://powengine.com/user - Creates a new user from the POST fields and returns the object
 * 4) PUT http://powengine.com/user/{id} - Modifies the user of id {id} with the new fields in post
 * 5) DELETE http://powengine.com/user/{id} - Deletes a user with id {id}. Warning, the record cannot be retrieved and all
 * 												related records would be removed.
 * 6)
 * 
 * @package pow.User
 * @todo 
 */ 
class UserResourceController extends ResourceController
{
	
	public $modelClassName='UserCredentials';
	
	public function actionCreate()
	{
		
	}

	public function actionDelete()
	{
		
	}



	public function actionUpdate()
	{
		
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}