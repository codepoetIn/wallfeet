<?php
/**
 * @author Karthick Loganathan - Ones and Zeros Technologies
 * @copyright 2011
 * @link http://www.energizeyourit.com
 * ResourceController is the customized base controller class.
 * All controller classes that serve a resource should extend from this base class.
 * @todo Add support for XML support
 */
class ResourceController extends CController {

	// Default JSON Format
	public $format = 'json';

	/*
	 * This variable should hold the resource provider model's classname in order for the automatic
	 * CRUD service to work
	 * */
	public $modelClassName;

	private $_modelInstance;

	/*
	 * Code to initialize the class. Fetches an instance of the model and stores it
	 * in the private variable.
	 *
	 */
	public function init(){

		if($this->modelClassName){
			$instance = call_user_func(array($this->modelClassName, 'model'));
			if($instance)
			$this->_modelInstance = $instance;
			else
			$this->_modelInstance = null;
		}
	}

	/*
	 * This method returns all rows of the resource model.
	 */
	public function actionList() {

		if(!is_null($this->_modelInstance)) {
			$models = $this->_modelInstance->findAll();
		} else {
			// Model not implemented error
			$this->_sendResponse(HttpStatus::RESPONSE_SERVICE_UNAVAILABLE, sprintf(
                'Error: Mode <b>list</b> is not implemented for this resource.') );
			exit;
		}

		// Did we get some results?
		if(is_null($models)) {
			// No
			$this->_sendResponse(HttpStatus::RESPONSE_OK,sprintf('No items where found.') );
		} else {
			// Prepare response
			$rows = array();
			// Call getResourceAttributes method on models that extend ResourceActiveRecord.
			if($this->_modelInstance instanceof ResourceActiveRecord) {
				foreach($models as $model)
				$rows[] = $model->getResourcesAttributes();
			} else {
				// Call attributes method if not
				foreach($models as $model)
				$rows[] = $model->attributes;
			}

			// Send the response
			$this->_sendResponse(HttpStatus::RESPONSE_OK, $rows);
		}
	}


	
	public function actionView(){

		// Check if id was submitted via GET
		if(!isset($_GET['id']))
		$this->_sendResponse(500, 'Error: Parameter <b>id</b> is missing' );

		$model_id = $_GET['id'];

		if(!is_null($this->_modelInstance)) {
			$model = $this->_modelInstance->findByPk($model_id);
		} else {
			// Model not implemented error
			$this->_sendResponse(HttpStatus::RESPONSE_SERVICE_UNAVAILABLE, sprintf(
                'Error: Mode <b>view</b> is not implemented for this resource.') );
			exit;
		}
			
		// Did we find the requested model? If not, raise an error
		if(is_null($model)) {
			$this->_sendResponse(404, 'No Item found with id '.$model_id);
		}
		else {
			if($this->_modelInstance instanceof ResourceActiveRecord) {
				$model = $model->getResourcesAttributes();
			} else {
				// Call attributes method if not
				$$model = $model->attributes;
			}
			$this->_sendResponse(200, $model);
		}

	}


	/*
	 * This method sends a http response from the results generated.
	 *
	 * @todo Configure method to support XML responses.
	 * */
	public function _sendResponse($status = 200, $body = '', $content_type = 'text/html'){

		$statusMessage = HttpStatus::getStatusMessage($status);
		// set the status
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $statusMessage;
		header($status_header);
		header('Content-type: ' . $content_type);

		// pages with body are easy
		if($body != '')
		{
			// send the body
			echo CJSON::encode($body);
			exit;
		}
		// we need to create the body if none is passed
		else
		{
			$data = array();

			$data['status'] = $status;
			$data['statusMessage'] = $statusMessage;

			// create some body messages
			$data['message'] = HttpStatus::getResponse($status);

			// servers don't always have a signature turned on
			// (this is an apache directive "ServerSignature On")
			$data['signature'] = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

			$this->renderPartial('application.views.http._htmlResponse',array('data'=>$data));
			exit();

		}
	}
}