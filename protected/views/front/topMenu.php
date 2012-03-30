<script type="text/javascript">
function fnpeoplecityid(){
	var var1=document.getElementById('GeoCity_city_people').value;
	if(var1==""){
		alert("Select the City");
		document.getElementById('GeoCity_city_people').focus();
		return false;
	}	
}
</script>
<script type="text/javascript">
function fnpropertycityid(){
	var var1=document.getElementById('GeoCity_city_property').value;
	if(var1==""){
		alert("Select the City");
		document.getElementById('GeoCity_city_property').focus();
		return false;
	}	
}
</script>
<?php 
	$modelProperty = new Property();
	$modelCity = new GeoCity();
	$modelState = new GeoState();
	$modelProfile =new UserProfiles();
	$modelRequirement =new Requirement();
	$specializations = new Specializations;
	
	$stateCache = new CDbCacheDependency('SELECT MAX(updated_time) FROM geo_state');
	$stateList = CHtml::listData(GeoState::model()->cache(1000, $stateCache)->findAll(),'id','state');
	
	$propertyTypeList = CHtml::listData(PropertyTypes::model()->with('category')->findAll(),'id','property_type','category.category');
	
	$cityCache = new CDbCacheDependency('SELECT MAX(updated_time) FROM geo_city');
	$cityList = CHtml::listData(GeoCity::model()->with('state')->cache(1000, $cityCache)->findAll(),'id','city','state.state');
	
	$specializationList = Specializations::model()->findAll();
	
?>
<?php if($this->beginCache('topmenu', array('duration'=>0))) { ?>
<div id="menu-part">
  <div  id="menu">
    <ul>
      <li class="home-icon"><a href="<?php echo Yii::app()->homeUrl?>">
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icon-home.png" alt="" /></a></li>
      <li id="menubox_search"><a  class="drop" onclick="js:menuDrop('menubox_search')">Search</a>
        <!-- Begin Home Item -->
        <div class="dropdown_2columns" id="search_box">
          <p>Find properties, people and much more using the wallfeet intuitive search.<br />
            Lets get started ...</p>
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" style="float:right;cursor: pointer;" onclick="js:removeTab('menubox_search','dropdown_2columns')"></img>
          <!-- Begin 2 columns container -->
          <div class="col_1 left">
            <div class="tabs9">
              <ul class="tabNavigation left">
                <li><a href="#s-one" class="selected">Search Property</a></li>
                <li><a href="#s-two">Search People  &nbsp</a></li>
              </ul>
              <div id="s-one" style="display:none;" class="left">
              <?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'property-search-form',
			'enableAjaxValidation'=>false,
             'action'=>'/search/property',
			)); ?>
			<input type="hidden" name="Property[i_want_to]" value="Sell">
			<input type="hidden" name="without_budget" value="1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right"><label style="padding-right:3px;">Property type</label></td>
                    <td><?php echo $form->dropDownList($modelProperty,'property_type_id',
                    $propertyTypeList
                    ,array('class'=>'select_box','empty'=>'All')); ?>
                    </td>
                    
                  </tr>
                  <tr>
                    <td align="right"> <label style="padding-right:3px;">City</label></td>
                    <td>
                   <?php echo $form->dropdownList($modelCity,'city',
                   $cityList,array('class'=>'select_box','id'=>'GeoCity_city_property','empty'=>'All'))?>
                </td>
                  </tr>
                  <tr>
                    <td align="right">
                    
                    <label class="left" style="padding-right:4px; padding-left:32px;">Budget</label>
                 </td>
<td> <select class="selectbox2" name="budget_min" id="drop_property_min">
						<option value="">Min</option>
						<option class="" value="1">Below 5 Lacs</option>
						<option class="" value="500000">5 Lacs</option>
						<option class="" value="1000000">10 Lacs</option>
						<option class="" value="1500000">15 Lacs</option>
						<option class="" value="2000000">20 Lacs</option>
						<option class="" value="2500000">25 Lacs</option>
						<option class="" value="3000000">30 Lacs</option>
						<option class="" value="4000000">40 Lacs</option>
						<option class="" value="5000000">50 Lacs</option>
						<option class="" value="6000000">60 Lacs</option>
						<option class="" value="7500000">75 Lacs</option>
						<option class="" value="9000000">90 Lacs</option>
						<option class="" value="10000000">1 Crore</option>
						<option class="" value="15000000">1.5 Crores</option>
						<option class="" value="20000000">2 Crores</option>
						<option class="" value="30000000">3 Crores</option>
						<option class="" value="50000000">5 Crores</option>
						<option class="" value="100000000">10 Crores</option>
						<option class="" value="200000000">20 Crores</option>
						<option class="" value="300000000">30 Crores</option>
						<option class="" value="400000000">40 Crores</option>
						<option class="" value="500000000">50 Crores</option>
						<option class="" value="600000000">60 Crores</option>
						<option class="" value="700000000">70 Crores</option>
						<option class="" value="800000000">80 Crores</option>
						<option class="" value="900000000">90 Crores</option>
						<option class="" value="1000000000">100 Crores</option>
						<option class="" value="1000000001">100+ Crores</option>
						</select>
		                  <span style="padding:0 1px;">to </span>
		                  <select class="selectbox2" name="budget_max" id="drop_property_max" onchange="javascript:validateMinMax('drop_property_min','drop_property_max');">
						<option value="">Max</option>
						<option class="" value="500000">5 Lacs</option>
						<option class="" value="1000000">10 Lacs</option>
						<option class="" value="1500000">15 Lacs</option>
						<option class="" value="2000000">20 Lacs</option>
						<option class="" value="2500000">25 Lacs</option>
						<option class="" value="3000000">30 Lacs</option>
						<option class="" value="4000000">40 Lacs</option>
						<option class="" value="5000000">50 Lacs</option>
						<option class="" value="6000000">60 Lacs</option>
						<option class="" value="7500000">75 Lacs</option>
						<option class="" value="9000000">90 Lacs</option>
						<option class="" value="10000000">1 Crore</option>
						<option class="" value="15000000">1.5 Crores</option>
						<option class="" value="20000000">2 Crores</option>
						<option class="" value="30000000">3 Crores</option>
						<option class="" value="50000000">5 Crores</option>
						<option class="" value="100000000">10 Crores</option>
						<option class="" value="200000000">20 Crores</option>
						<option class="" value="300000000">30 Crores</option>
						<option class="" value="400000000">40 Crores</option>
						<option class="" value="500000000">50 Crores</option>
						<option class="" value="600000000">60 Crores</option>
						<option class="" value="700000000">70 Crores</option>
						<option class="" value="800000000">80 Crores</option>
						<option class="" value="900000000">90 Crores</option>
						<option class="" value="1000000000">100 Crores</option>
						<option class="" value="1000000001">100+ Crores</option>
					</select></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center">
<input type="submit" class="btn-submit-s" onclick="return fnpropertycityid()" value="" name="search">
                    </td>
                  </tr>
                </table>
                <?php $this->endWidget(); ?>
              </div>
              <div id="s-two" class="left">
              <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'agent-search-form',
              	'action'=>'/search/people',
				'enableAjaxValidation'=>false,
				));?> 
              	
              	<input type="hidden" name="mode" value="people" />
				<label><input type="radio" name="user_type" value="agent" onclick="fnUserBlock('agent');" checked="checked" />Agent</label> 
				<label><input type="radio" name="user_type" value="builder" onclick="fnUserBlock('agent');" <?php if(isset($_POST['user_type']) && $_POST['user_type']=="builder") echo 'checked="checked"'; ?> />Builder</label>
				<label><input type="radio" name="user_type" value="specialist" onclick="fnUserBlock('specialist');" <?php if(isset($_POST['user_type']) && $_POST['user_type']=="specialist") echo 'checked="checked"'; ?> />Specialist</label>
                
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
               <tr><td><label style="padding-right:3px;">City</label></td>
                   <td><?php echo $form->dropdownList($modelCity,'city',
                   $cityList,array('class'=>'select_box','id'=>'GeoCity_city_people','empty'=>'All','size'=>'3'))?></td>
                   </br></tr>
                   <tr><td>&nbsp</td></tr>
					<tr><td></td><td><center><input type="submit" class="btn-submit-s" onclick="return fnpeoplecityid()" value="" name="submit"></center></td></tr>
					<?php $this->endWidget(); ?>
					</table>
              </div>
            </div>
          </div>
        </div>
        <!-- End 2 columns container -->
      </li>
      <!-- End Home Item -->
      <li id="menubox_postp"><a  class="drop" onclick="js:menuDrop('menubox_postp')">Post Property</a>
        <!-- Begin 5 columns Item -->
        <div class="dropdown_2columns" >
          <p>Have a listing that you want to promote?<br />
            Have a requirement that you want fellow realtors to meet?<br />
            You are at the right place</p>
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" style="float:right;cursor: pointer;" onclick="js:removeTab('menubox_postp','dropdown_2columns')"></img>
          <!-- Begin 5 columns container -->
          <div class="col_1 left">
            <div>
               <div class="tabs4">
              <ul class="tabNavigation4 left">
                <li><a href="#pp-two">Residential</a></li>
                <li><a href="#pp-one" class="selected">Commercial</a></li>
              </ul>
              <div id="pp-one" style="display:none;" class="left">
              <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'agent-search-form',
              	'action'=>'/property/post',
				'enableAjaxValidation'=>false,
				));?> 
				<input type="hidden" name="PostPropertyMin" value="1"/>
				<input type="hidden" name="Property[property_type_id]" value="0"/>
              	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>City</td>
                    <td> <?php echo $form->dropdownList($modelProperty,'city_id',
                    $cityList,
                    array('empty'=>'All','class'=>'select_box'))?></td>
                  </tr>
                  <tr>
                    <td><h3>I want to</h3></td>
                    <td><span class="frm_cnt">
                <input type="radio" checked="checked" value="Sell" name="Property[i_want_to]">
                Sell
                 <input type="radio" checked="checked" value="Rent" name="Property[i_want_to]">
                 Rent Out
                 <input type="radio" checked="checked" value="Lease" name="Property[i_want_to]">
                Lease</span></td>
                  </tr>
                  <tr>
                    <td><input type="hidden" name="PropertyImages[image]" value="" /></td>
                    <td><div class="pad-top10">
                  <input type="submit" name="submit" value="Submit" class="btn-search"  />
                </div></td>
                  </tr>
                </table>
                <?php $this->endWidget(); ?>
              </div>
              <div id="pp-two" class="left">
              <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'agent-search-form',
              	'action'=>'/property/post',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('name'=>'thisPeople'),
				));?> 
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <input type="hidden" name="Property[property_type_id]" value="0"/>
                <input type="hidden" name="PostPropertyMin" value="1"/>
                  <tr>
                    <td>City</td>
                    <td><?php echo $form->dropdownList($modelProperty,'city_id',
                    $cityList,
                    array('empty'=>'All','id'=>'geo_city','class'=>'select_box'))?></td>
                  </tr>
                  <tr>
                    <td><h3>I want to</h3></td>
                    <td><span class="frm_cnt">
                <input type="radio" checked="checked" value="Sell" name="Property[i_want_to]">
                Sell
                 <input type="radio" checked="checked" value="Rent" name="Property[i_want_to]">
                Rent Out
                <input type="radio" checked="checked" value="Lease" name="Property[i_want_to]">
                Lease
                </span></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><div class="pad-top10">
                  <input type="submit" value="Submit" class="btn-search"  />
                </div></td>
                  </tr>
                </table>
                 <?php $this->endWidget(); ?>
              </div>
              </div>
              
            </div>
          </div>
        </div>
        <!-- End 5 columns container -->
      </li>

      <li id="menubox_req"><a  class="drop" onclick="js:menuDrop('menubox_req')">Post Requirement</a>
        <div class="dropdown_2columns">
          <p>Have a requirement that you want fellow realtors to meet?<br />
            You are at the right place</p>
             <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" style="float:right;cursor: pointer;" onclick="js:removeTab('menubox_req','dropdown_2columns')"></img>
          <div class="col_1 left">
          	<div class="tabs5">
              <ul class="tabNavigation5 left">
                <li><a href="#pr-two">Residential</a></li>
                <li><a href="#pr-one" class="selected">Commercial</a></li>
              </ul>
              <div id="pr-one" style="display:none;" class="left">
               <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'agent-search-form',
              	'action'=>'/requirement/post',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('name'=>'thisPeople'),
				));?>
				<input type="hidden" name="PostRequirementMin" value="1"/> 
              	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>City</td>
                    <td><?php echo $form->dropdownList($modelCity,'city',
                    $cityList,
                    array('empty'=>'All','id'=>'geo_city','class'=>'select_box'))?>
                    </td>
                  </tr>
                  <tr>
                    <td><h3>I want to</h3></td>
                    <td><span class="frm_cnt">
                <input type="radio" checked="checked" value="Buy" onclick="javascript : toggleOptions(this.value); clearSelection();" style="border: medium none;" name="Requirement[i_want_to]" id="listType1">
                Buy
                <input type="radio" value="Rent" onclick="javascript : toggleOptions(this.value); clearSelection();" style="border: medium none;" name="Requirement[i_want_to]" id="listType2">
                Rent-In
                <input type="radio" value="Lease" onclick="javascript : toggleOptions(this.value); clearSelection();" style="border: medium none;" name="Requirement[i_want_to]" id="listType2">
                Lease
                 </span></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><div class="pad-top10">
                  <input type="submit" value="Submit" class="btn-search"  />
                </div></td>
                  </tr>
                </table>
                <?php $this->endWidget(); ?>
              </div>
              <div id="pr-two" class="left">
               <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'agent-search-form',
              	'action'=>'/requirement/post',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('name'=>'thisPeople'),
				));?> 
				<input type="hidden" name="PostRequirementMin" value="1"/>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>City</td>
                    <td><?php echo $form->dropdownList($modelCity,'city',
                    $cityList,
                    array('empty'=>'All','id'=>'geo_city','class'=>'select_box'))?>
                    </td>
                  </tr>
                  <tr>
                    <td><h3>I want to</h3></td>
                    <td><span class="frm_cnt">
                <input type="radio" checked="checked" value="Buy" onclick="javascript : toggleOptions(this.value); clearSelection();" style="border: medium none;" name="Requirement[i_want_to]" id="listType1">
                Buy
                <input type="radio" value="Rent" onclick="javascript : toggleOptions(this.value); clearSelection();" style="border: medium none;" name="Requirement[i_want_to]" id="listType2">
                Rent-In
                <input type="radio" value="Lease" onclick="javascript : toggleOptions(this.value); clearSelection();" style="border: medium none;" name="Requirement[i_want_to]" id="listType2">
                Lease
                </span></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><div class="pad-top10">
                  <input type="submit" value="Submit" class="btn-search"  />
                </div></td>
                  </tr>
                </table>
                <?php $this->endWidget(); ?>
              </div>
              </div>
          </div>
        </div>
      </li>
      <li id="menubox_sp"><a  class="drop" onclick="js:menuDrop('menubox_sp')">WF Specialist</a>
        <!-- Begin 4 columns Item -->
        <div class="dropdown_2columns">
                      <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'agent-search-form',
              	'action'=>'/search/people',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('name'=>'thisPeople'),
				));?> 
          <p>You have the idea? We have the people. 
          We are happy to introduce our range of specialists who strive to bring your real estate dream into reality.</p>
          <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" style="float:right;cursor: pointer;" onclick="js:removeTab('menubox_sp','dropdown_2columns')"></img>
          <div class="col_1">
          	<div class="tabs6">
              <ul class="tabNavigation6 left">
                <li><a href="#wfs-one" class="selected">WF Specialist</a></li><!--
                <li><a href="#ta-two">Top Architecture</a></li>
                <li><a href="#ti-three">Top Interior Designer</a></li>
                <li><a href="#tb-four">Top Builders</a></li>
              --></ul>
              <div id="wfs-one" class="left" style="display:none;">
              	<div class="specialists-content-part-left">
              	<input type="hidden" name="user_type" value="specialist"/>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left">Specialist</td>
                    <td>
                    <?php echo $form->dropdownList($specializations,'specialist',
                   	CHtml::listData($specializationList,'id','specialist'),
                    array('empty'=>'All','id'=>'specialist','class'=>'select_box'))?>
                    </td>
                  </tr>
                  <tr>
                    <td align="left">City</td>
                    <td><?php echo $form->dropdownList($modelCity,'city',
                    $cityList,array('empty'=>'All','id'=>'geo_city','class'=>'select_box'))?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><input type="submit" value="Search" class="search-btn" /></td>
                  </tr>
                </table>

              
            </div>
              	
              </div>              
              </div>
          </div>
          <?php $this->endWidget(); ?>
        </div>
        <!-- End 4 columns container -->
      </li>
      <li id="menubox_jackpot"><a class="drop" onclick="js:menuDrop('menubox_jackpot')">Jackpot Investment</a>
      	<div class="dropdown_2columns" style="width:419px">
      	                      <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'agent-search-form',
              	'action'=>'/search/property',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('name'=>'thisPeople'),
				));?> 
				<p style="width:390px">Jackpot Investment</p>
            	 <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" style="float:right;cursor: pointer;" onclick="js:removeTab('menubox_jackpot','dropdown_2columns')"></img>
         	<div class="col_1">
            	
                <div class="tabs7">
              <ul class="tabNavigation7 left">
                <li><a href="#jp-one" class="selected">Search</a></li>
                <!--<li><a href="#jp-two">Top Investment</a></li>
              --></ul>
              <div id="jp-one" class="left">
              <input type="hidden" value="1" id="Property_jackpot_investment" name="Property[jackpot_investment]">
              	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right"> <label style="padding-right:5px;">City</label></td>
					<td>
					<?php echo $form->dropdownList($modelCity,'city',
					$cityList,array('empty'=>'All','id'=>'geo_city','class'=>'select_box'))?></td>
                  </tr>
                  <tr>
                    <td align="right">
                    <label style="padding-right:5px;">Budget</label>
                 </td>
                    <td> <select class="selectbox2" name="budget_min">
						<option value="">Min</option>
						<option class="" value="1">Below 5 Lacs</option>
						<option class="" value="500000">5 Lacs</option>
						<option class="" value="1000000">10 Lacs</option>
						<option class="" value="1500000">15 Lacs</option>
						<option class="" value="2000000">20 Lacs</option>
						<option class="" value="2500000">25 Lacs</option>
						<option class="" value="3000000">30 Lacs</option>
						<option class="" value="4000000">40 Lacs</option>
						<option class="" value="5000000">50 Lacs</option>
						<option class="" value="6000000">60 Lacs</option>
						<option class="" value="7500000">75 Lacs</option>
						<option class="" value="9000000">90 Lacs</option>
						<option class="" value="10000000">1 Crore</option>
						<option class="" value="15000000">1.5 Crores</option>
						<option class="" value="20000000">2 Crores</option>
						<option class="" value="30000000">3 Crores</option>
						<option class="" value="50000000">5 Crores</option>
						<option class="" value="100000000">10 Crores</option>
						<option class="" value="200000000">20 Crores</option>
						<option class="" value="300000000">30 Crores</option>
						<option class="" value="400000000">40 Crores</option>
						<option class="" value="500000000">50 Crores</option>
						<option class="" value="600000000">60 Crores</option>
						<option class="" value="700000000">70 Crores</option>
						<option class="" value="800000000">80 Crores</option>
						<option class="" value="900000000">90 Crores</option>
						<option class="" value="1000000000">100 Crores</option>
						<option class="" value="1000000001">100+ Crores</option>
						</select>
                  <span style="padding:0 1px;">to </span>
                 <select class="selectbox2" name="budget_max">
						<option value="">Max</option>
						<option class="" value="500000">5 Lacs</option>
						<option class="" value="1000000">10 Lacs</option>
						<option class="" value="1500000">15 Lacs</option>
						<option class="" value="2000000">20 Lacs</option>
						<option class="" value="2500000">25 Lacs</option>
						<option class="" value="3000000">30 Lacs</option>
						<option class="" value="4000000">40 Lacs</option>
						<option class="" value="5000000">50 Lacs</option>
						<option class="" value="6000000">60 Lacs</option>
						<option class="" value="7500000">75 Lacs</option>
						<option class="" value="9000000">90 Lacs</option>
						<option class="" value="10000000">1 Crore</option>
						<option class="" value="15000000">1.5 Crores</option>
						<option class="" value="20000000">2 Crores</option>
						<option class="" value="30000000">3 Crores</option>
						<option class="" value="50000000">5 Crores</option>
						<option class="" value="100000000">10 Crores</option>
						<option class="" value="200000000">20 Crores</option>
						<option class="" value="300000000">30 Crores</option>
						<option class="" value="400000000">40 Crores</option>
						<option class="" value="500000000">50 Crores</option>
						<option class="" value="600000000">60 Crores</option>
						<option class="" value="700000000">70 Crores</option>
						<option class="" value="800000000">80 Crores</option>
						<option class="" value="900000000">90 Crores</option>
						<option class="" value="1000000000">100 Crores</option>
						<option class="" value="1000000001">100+ Crores</option>
						</select></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" class="pad-top10"><input type="submit" class="btn-submit-s" value=""></td>
                  </tr>
                </table>
              </div>
             
              </div>
            </div>
            <?php $this->endWidget(); ?>
         </div>   
      </li>
      
	  <li id="menubox_instant"><a class="drop" onclick="js:menuDrop1('menubox_instant')"><b>Instant Gratification</b></a>
      	<div class="dropdown_7columns" style="width:410px;">
      	                      <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'agent-search-form',
              	'action'=>'/search/property',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('name'=>'thisPeople'),
				));?>
				 <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" style="float:right;cursor: pointer;" onclick="js:removeTab('menubox_instant','dropdown_7columns')"></img>
         	<div class="col_1">
            	
                <div class="tabs8">
              <ul class="tabNavigation left">
                <li><a href="#jp-one" class="selected">Search</a></li>
              </ul>
              <div id="jp-one" class="left">
              <input type="hidden" value="1" id="Property_instant_home" name="Property[instant_home]">
              	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right"> <label style="padding-right:5px;">City</label></td>
					<td>
					<?php echo $form->dropdownList($modelCity,'city',
					$cityList,array('empty'=>'All','id'=>'geo_city','class'=>'select_box'))?></td>
                  </tr>
                  <tr>
                    <td align="right">
                    <label style="padding-right:5px;">Budget</label>
                 </td>
                    <td> <select class="selectbox2" name="budget_min">
						<option value="">Min</option>
						<option class="" value="1">Below 5 Lacs</option>
						<option class="" value="500000">5 Lacs</option>
						<option class="" value="1000000">10 Lacs</option>
						<option class="" value="1500000">15 Lacs</option>
						<option class="" value="2000000">20 Lacs</option>
						<option class="" value="2500000">25 Lacs</option>
						<option class="" value="3000000">30 Lacs</option>
						<option class="" value="4000000">40 Lacs</option>
						<option class="" value="5000000">50 Lacs</option>
						<option class="" value="6000000">60 Lacs</option>
						<option class="" value="7500000">75 Lacs</option>
						<option class="" value="9000000">90 Lacs</option>
						<option class="" value="10000000">1 Crore</option>
						<option class="" value="15000000">1.5 Crores</option>
						<option class="" value="20000000">2 Crores</option>
						<option class="" value="30000000">3 Crores</option>
						<option class="" value="50000000">5 Crores</option>
						<option class="" value="100000000">10 Crores</option>
						<option class="" value="200000000">20 Crores</option>
						<option class="" value="300000000">30 Crores</option>
						<option class="" value="400000000">40 Crores</option>
						<option class="" value="500000000">50 Crores</option>
						<option class="" value="600000000">60 Crores</option>
						<option class="" value="700000000">70 Crores</option>
						<option class="" value="800000000">80 Crores</option>
						<option class="" value="900000000">90 Crores</option>
						<option class="" value="1000000000">100 Crores</option>
						<option class="" value="1000000001">100+ Crores</option>
						</select>
                  <span style="padding:0 1px;">to </span>
                 <select class="selectbox2" name="budget_max">
						<option value="">Max</option>
						<option class="" value="500000">5 Lacs</option>
						<option class="" value="1000000">10 Lacs</option>
						<option class="" value="1500000">15 Lacs</option>
						<option class="" value="2000000">20 Lacs</option>
						<option class="" value="2500000">25 Lacs</option>
						<option class="" value="3000000">30 Lacs</option>
						<option class="" value="4000000">40 Lacs</option>
						<option class="" value="5000000">50 Lacs</option>
						<option class="" value="6000000">60 Lacs</option>
						<option class="" value="7500000">75 Lacs</option>
						<option class="" value="9000000">90 Lacs</option>
						<option class="" value="10000000">1 Crore</option>
						<option class="" value="15000000">1.5 Crores</option>
						<option class="" value="20000000">2 Crores</option>
						<option class="" value="30000000">3 Crores</option>
						<option class="" value="50000000">5 Crores</option>
						<option class="" value="100000000">10 Crores</option>
						<option class="" value="200000000">20 Crores</option>
						<option class="" value="300000000">30 Crores</option>
						<option class="" value="400000000">40 Crores</option>
						<option class="" value="500000000">50 Crores</option>
						<option class="" value="600000000">60 Crores</option>
						<option class="" value="700000000">70 Crores</option>
						<option class="" value="800000000">80 Crores</option>
						<option class="" value="900000000">90 Crores</option>
						<option class="" value="1000000000">100 Crores</option>
						<option class="" value="1000000001">100+ Crores</option>
						</select></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" class="pad-top10"><input type="submit" class="btn-submit-s" value=""></td>
                  </tr>
                </table>
              </div>
              </div>
            </div>
            <?php $this->endWidget(); ?>
         </div>   
      </li>
      <li id="menubox_new"><a  class="drop" onclick="js:menuDrop2('menubox_new')">New Launches</a>
      	 <div class="dropdown_8columns" style="padding-bottom: 10px;width: 295px;">
      	                       <?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'agent-search-form',
              	'action'=>'/search/property',
				'enableAjaxValidation'=>false,
				'htmlOptions'=>array('name'=>'thisPeople'),
				));?> 
					 <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/close.png" style="float:right;cursor: pointer;" onclick="js:removeTab('menubox_new','dropdown_8columns')"></img>
         	<div class="col_1" style="line-height:36px;">
         	<input type="hidden" name="new_launches" value="1" />
         	<input type="hidden" name="property[i_want_to]" value="Rent">
            <table width="90%" border="0" cellspacing="0" cellpadding="0" class="new_launches">
              <tr>
              	<td><label>Property type</label>
                  <?php echo $form->dropDownList($modelProperty,'property_type_id',
                  $propertyTypeList,array('class'=>'select_box new_lanun','empty'=>'All')); ?>
                  </td>
              </tr>
              <tr>
              <td><label>City</label>
                  <?php echo $form->dropdownList($modelProperty,'city_id',
                  $cityList,array('empty'=>'All','id'=>'geo_city','class'=>'select_box new_lanun'))?>     
              </td>
              </tr>
              <tr>
                <td>
                <label>Budget</label>
                 <select class="selectbox2" name="budget_min">
						<option value="">Min</option>
						<option class="" value="1">Below 5 Lacs</option>
						<option class="" value="500000">5 Lacs</option>
						<option class="" value="1000000">10 Lacs</option>
						<option class="" value="1500000">15 Lacs</option>
						<option class="" value="2000000">20 Lacs</option>
						<option class="" value="2500000">25 Lacs</option>
						<option class="" value="3000000">30 Lacs</option>
						<option class="" value="4000000">40 Lacs</option>
						<option class="" value="5000000">50 Lacs</option>
						<option class="" value="6000000">60 Lacs</option>
						<option class="" value="7500000">75 Lacs</option>
						<option class="" value="9000000">90 Lacs</option>
						<option class="" value="10000000">1 Crore</option>
						<option class="" value="15000000">1.5 Crores</option>
						<option class="" value="20000000">2 Crores</option>
						<option class="" value="30000000">3 Crores</option>
						<option class="" value="50000000">5 Crores</option>
						<option class="" value="100000000">10 Crores</option>
						<option class="" value="200000000">20 Crores</option>
						<option class="" value="300000000">30 Crores</option>
						<option class="" value="400000000">40 Crores</option>
						<option class="" value="500000000">50 Crores</option>
						<option class="" value="600000000">60 Crores</option>
						<option class="" value="700000000">70 Crores</option>
						<option class="" value="800000000">80 Crores</option>
						<option class="" value="900000000">90 Crores</option>
						<option class="" value="1000000000">100 Crores</option>
						<option class="" value="1000000001">100+ Crores</option>
						</select>
                  <span style="padding:0 1px;">to </span>
                   <select class="selectbox2" name="budget_max">
						<option value="">Max</option>
						<option class="" value="500000">5 Lacs</option>
						<option class="" value="1000000">10 Lacs</option>
						<option class="" value="1500000">15 Lacs</option>
						<option class="" value="2000000">20 Lacs</option>
						<option class="" value="2500000">25 Lacs</option>
						<option class="" value="3000000">30 Lacs</option>
						<option class="" value="4000000">40 Lacs</option>
						<option class="" value="5000000">50 Lacs</option>
						<option class="" value="6000000">60 Lacs</option>
						<option class="" value="7500000">75 Lacs</option>
						<option class="" value="9000000">90 Lacs</option>
						<option class="" value="10000000">1 Crore</option>
						<option class="" value="15000000">1.5 Crores</option>
						<option class="" value="20000000">2 Crores</option>
						<option class="" value="30000000">3 Crores</option>
						<option class="" value="50000000">5 Crores</option>
						<option class="" value="100000000">10 Crores</option>
						<option class="" value="200000000">20 Crores</option>
						<option class="" value="300000000">30 Crores</option>
						<option class="" value="400000000">40 Crores</option>
						<option class="" value="500000000">50 Crores</option>
						<option class="" value="600000000">60 Crores</option>
						<option class="" value="700000000">70 Crores</option>
						<option class="" value="800000000">80 Crores</option>
						<option class="" value="900000000">90 Crores</option>
						<option class="" value="1000000000">100 Crores</option>
						<option class="" value="1000000001">100+ Crores</option>
						</select>
                </td>
                </tr>             
              <tr>
                <td colspan="2">                  
                  <input type="submit" value="" class="btn-submit-s" />
                  </td>
              </tr>
            </table>
            </div>
         <?php $this->endWidget(); ?>
         </div>
      
      </li>
      <!-- End 5 columns Item -->

      <li class="mar-rgt0"><a href="/Price" class="drop">Advertise</a>
        <div class="dropdown_3columns" style="width:170px;">
          <p style="width:auto">Take your brand to the masses. Promote your listings in style. </p>
        </div>
      </li>
      <?php $this->endCache(); } ?>
      
      <?php if(!Yii::app()->user->isGuest) {?>
      <li><a href="<?php echo Yii::app()->createUrl('/dashboard');?>" class="drop">My Account</a>
        <div class="dropdown_3columns_account" style="width:148px;">
          <p style="width:auto">Control your account specific information here.</p>
          <div class="col_3"> 
          <a href="<?php echo Yii::app()->createUrl('/dashboard');?>">Dashboard</a>
          <a href="<?php echo Yii::app()->createUrl('/properties');?>">My Properties</a>
          <a href="<?php echo Yii::app()->createUrl('/wishlists');?>">Wishlist</a>
          <a href="<?php echo Yii::app()->createUrl('/update');?>">Edit Profile</a> 
          
          <a href="/account/logout">Log Out</a> 
          </div>
        </div></li>
        <?php }elseif(Yii::app()->user->isGuest)
        {?>
        <li><a href="/login" class="">Login</a></li>
        <?php }
        ?>
        <!-- End 3 columns container -->
      
      <li class="plus-icon"><a href="#" class="drop icon-plus-hover"></a>
        <div class="dropdown_3columns_login" style="width:120px;">
          <div class="col_3"> 
          <a href="<?php echo Yii::app()->createUrl('/jukebox/search');?>">Q & A</a>
          <a href="<?php echo Yii::app()->createUrl('/jukebox/post');?>">Post a question</a>
          <a href="<?php echo Yii::app()->createUrl('/emi');?>">EMI Calculator</a> 
          <a href="/emi">Easy Finance</a>
          <a href="<?php echo Yii::app()->createUrl('/AboutUs');?>">About Us</a>
          <a href="<?php echo Yii::app()->createUrl('/contactUs');?>">Contact Us</a> 
          
           </div>
        </div>
      </li>
    </ul>
  </div>
</div>

 <script type="text/javascript">
 	 function validateMinMax(minid,maxid)
	 {
 		 
	 	var min=document.getElementById(minid).value;
	 	var max=document.getElementById(maxid).value;
	 	 if(min>max)
	 	{
		 	
	 		alert("Maximum value is less than Minimum");
	 		document.getElementById(maxid).value='0';
	 	}
	 	
	 }	
		
</script>

 <script type="text/javascript">
 	 function validateMin(minid,maxid)
	 {
	 	var min=document.getElementById(minid).value;
	 	document.getElementById(maxid).value='0';
	 	if(min==1)
	 	{
		 	alert("Can`t select maximum"); 		
	 		document.getElementById(maxid).disabled=true;
	 	}
	 	else
	 	{
	 		document.getElementById(maxid).disabled=false;
	 	}
	 }	
 		
	    function removeTab(name,dropbox)
	    {   
	    	$("li#"+name+" ."+dropbox).removeClass("dropdown_menu");
	    	$("li#"+name+" ."+dropbox).removeClass("dropdown_menu1");
	    	$("li#"+name+" ."+dropbox).removeClass("dropdown_menu2");
	    	$("#menu li#"+name).removeClass("menu_li_hover");
	    }
	   function menuDrop(classname)
	   {
		 
		  		removeTab('menubox_search','dropdown_2columns');
	 			removeTab('menubox_postp','dropdown_2columns');
	 			removeTab('menubox_req','dropdown_2columns');
	 			removeTab('menubox_sp','dropdown_2columns');
	 			removeTab('menubox_jackpot','dropdown_2columns');
	 			removeTab('menubox_instant','dropdown_7columns');
	 			removeTab('menubox_new','dropdown_8columns');
	 			
	 	      $("#menu li#"+classname+" .dropdown_2columns").addClass("dropdown_menu");
	 	      $("#menu li#"+classname).addClass("menu_li_hover");
	 	  
	   }
	    
	   function menuDrop1(classname)
	   {
	    	removeTab('menubox_search','dropdown_2columns');
	    	removeTab('menubox_postp','dropdown_2columns');
	    	removeTab('menubox_req','dropdown_2columns');
 			removeTab('menubox_sp','dropdown_2columns');
 			removeTab('menubox_jackpot','dropdown_2columns');
			removeTab('menubox_new','dropdown_8columns');
 			
	    	  $("#menu li#"+classname+" .dropdown_7columns").addClass("dropdown_menu1");
	 	      $("#menu li#"+classname).addClass("menu_li_hover");
	  
	   }
	    function menuDrop2(classname)
	    {
	    	removeTab('menubox_search','dropdown_2columns');
	    	removeTab('menubox_postp','dropdown_2columns');
	    	removeTab('menubox_req','dropdown_2columns');
 			removeTab('menubox_sp','dropdown_2columns');
 			removeTab('menubox_jackpot','dropdown_2columns');
 			removeTab('menubox_instant','dropdown_7columns');
 			
	    	  $("#menu li#"+classname+" .dropdown_8columns").addClass("dropdown_menu2");
	 	      $("#menu li#"+classname).addClass("menu_li_hover");
	  
 	    }
</script>
