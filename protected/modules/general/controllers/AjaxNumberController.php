<?php

class AjaxNumberController extends Controller {

	public function actionConvert(){

		include("Numbers/Words.php");
		
		$nw = new Numbers_Words();
		echo ucwords($nw->toCurrency($_POST['Property']['total_price'],'en_GB'));
	}

}

?>