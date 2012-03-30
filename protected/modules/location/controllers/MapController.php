<?php 

class MapController extends FrontController {
	
	public function actionRender($name,$request,$modelname){
		
		if(isset($_POST["$request"]['city_id'])){
			$model=new $modelname;
			$city_id=$_POST["$request"]['city_id'];
			$city = GeoCity::model()->findByPk($_POST["$request"]['city_id']);
			if($city){
				$cityName = $city->city;
				$stateName = $city->state->state;			
				$countryName = $city->state->country->country;
				$data['city'] = $cityName;
				$data['state'] = $stateName;
				$data['country'] = $countryName;
			}else {
				return;
			}
		}else{
			return;
		}
		$list = GeoLocalityApi::getList($city_id);			
		
		$this->renderPartial('render',array('data'=>$data,'name'=>$name,'model'=>$model,'list'=>$list));
	}
	
}


?>