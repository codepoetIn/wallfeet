 <?php 

              $this->widget('CStarRating',array(
			    'name'=>'ratingAjax',
			    'value'=>$rating,
              	'readOnly'=>$ratingReadOnly,
			    'callback'=>'
			        function(){
		                $.ajax({
			                   type: "POST",
			                   url: "'.Yii::app()->createUrl($url).'",
			                   data: "'.Yii::app()->request->csrfTokenName.'='.Yii::app()->request->getCsrfToken().'&rate=" + $(this).val(),
			                   success: function(msg){
			                                $("#result").html(msg);
			                        }})}'
			  ));          
					echo "<br/>";
					echo "<div id='result'></div>";
					
?>