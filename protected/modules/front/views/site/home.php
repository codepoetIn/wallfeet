<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/wow/wowslider.js"></script>
<div id="wowslider-container1">
<div class="ws_images"><span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/banner1.jpg" alt="banner2"
	title="banner2" id="wows1" /></span> <span><img
	src="<?php echo Yii::app()->theme->baseUrl; ?>/images/banner2.jpg" alt="banner2" title="banner2" id="wows2" /></span>
<span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/banner3.jpg" alt="banner2" title="banner2"
	id="wows3" /></span> <span><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/banner4.jpg" alt="banner2"
	title="banner2" id="wows4" /></span> <span><img
	src="<?php echo Yii::app()->theme->baseUrl; ?>/images/banner5.jpg" alt="banner2" title="banner2" id="wows6" /></span>
</div>
<div class="ws_bullets">
<div><a href="#wows0" title="banner1">1</a> <a href="#wows1"
	title="banner2">2</a> <a href="#wows2" title="banner3">3</a> <a
	href="#wows3" title="banner4">4</a> <a href="#wows4" title="banner5">5</a>
</div>
</div>

</div>
<div class="col_lft left">
<?php $this->widget('MiniSearch',array('properties'=>$properties,'modelCity'=>$modelCity,'modelState'=>$modelState,'localityList'=>$localityList))?>
</div>
<?php $this->widget('TopBuilders',array('location'=>$location));?>
<?php $this->widget('FeaturedBuilders',array('location'=>$location));?>
</div>
<div class="col_rgt right">
<?php if(Yii::app()->user->isGuest){
		
		$this->widget('MiniRegister',array('registerUrl'=>Yii::app()->request->baseUrl.'/register'));
}?>
 <?php $this->widget('PropertySpotlight',array('location'=>$location));?>
</div>
<script
	type="text/javascript"
	src="<?php echo Yii::app()->theme->baseUrl; ?>/includes/wow/script.js"></script>

<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
<!-- standalone page styling (can be removed) -->
<script>
// What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
$ = jQuery.noConflict();
$(document).ready(function() {

$("#slider1 img").tooltip({
	effect: 'slide',
	slideOffset: 30,
	direction: 'down'
	});
	});

</script>


