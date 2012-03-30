
 <div class="footer-col3 left">
        	<h2>Top Cities in India</h2>
            <ul>
             <?php
             $count=0;
 foreach($cities as $city){
		$model = array_shift($cities);
		echo $this->render('_location', array('model'=>$model));
		$count++;
		if($count>5)
		break;
		?>
		<?php } ?>
            </ul>
        </div>