<!--Top Builders Widget-->
    <div id="tabbed_box_1" class="tabbed_box">
    <h2 class="head-tab">Top Builders</h2>
  <div class="tabbed_area">
  <div class="tabs-widget">
            <ul id="slider1">
            
            <?php 
            if($topBuilders)
            {
            foreach ($topBuilders as $builder){ 
            $city=GeoCityApi::getCityNameByID($builder['city_id']);
           	$image=BuilderProfileApi::getImage($builder['user_id']);
            	?>
              <li><a href="/builder/<?php echo $builder['user_id'];?>" title="<?php echo $builder['company_name']?>"><img src="<?php echo $image;?>" height="50" width="80"border="0" title="<b><?php echo $builder['company_name'];?></b> <br /> <?php echo $city->city;?><br /> 
              <br /> <a href='/builder/<?php echo $builder['user_id'];?>'>More details</a>" /></a></li>
             <?php }
            }?>
              
            </ul>
            <br class="clear" />
    <div class="clear"></div>
    </div>
  </div>
</div>