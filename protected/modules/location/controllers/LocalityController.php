<?php

class LocalityController extends FrontController
{
	public function actions()
	{
		
	}

	
	public function actionGetLocalityAutoCompleteByCity($city)
	{
		if($city){
			$list = GeoLocalityApi::getList($city_id);
		}
	}

	public function actionGetList(){		
		$modelProperty = new Property;						
				
				
		$list = null;			
		if(isset($_POST['Project']['city_id'])){			
			$modelProperty = new Project;
			$city_id = $_POST['Project']['city_id'];
		}
		elseif(isset($_POST['Property']['city_id'])){
			$modelProperty = new Property;
			$city_id = $_POST['Property']['city_id'];
		}
		else {
			$modelProperty = new Property;
			$city_id = $_POST['GeoCity']['city'];
		}
		if($city_id!="")
				$list = GeoLocalityApi::getList($city_id);					
		$this->renderPartial('getList',array('list'=>$list,'modelProperty'=>$modelProperty,'class'=>$class));
	}
	
}