<script type="text/javascript" charset="utf-8">
		$(function () {
			var tabContainers = $('div.tabs8 > div');
			tabContainers.hide().filter(':first').show();
			
			$('div.tabs8 ul.tabs a').click(function () {
				tabContainers.hide();
				tabContainers.filter(this.hash).show();
				$('div.tabs8 ul.tabs a').removeClass('selected');
				$(this).addClass('selected');
				return false;
			})
			
		});
</script>

<div id="property_search">
<h1 class="heading">Requirement Details</h1>
<div class="inner-column">
<div class="left cols1">
<div class="property_id_details"><span>Requirement ID :</span> <?php echo $requirement->id; ?><br />
</div>


<div class="white_wrap">
<h2>User Information</h2>
<div style="padding: 10px;">
<p><?php echo $userDetails->first_name; ?><br />
<?php echo $userDetails->last_name; ?><br />
<?php echo $userDetails->address_line1; ?><br />
<?php echo $userDetails->address_line2; ?><br />
<span>Mobile :</span> <?php echo $userDetails->mobile; ?> <br />
<!--  <span>Email: </span> <a href="mailto:<?php //echo $userDetails->email_id; ?>"><?php //echo $userDetails->email_id; ?></a>-->
<br />
<a href="/profile/<?php echo $userDetails->user_id; ?>" class="btn-profile">View User Profile</a></p>
</div>
</div></div>
<div class="right cols2">

<?php $this->widget('PropertySearchResults',array('properties'=>$properties,'pages'=>$pages,'propertiesCount'=>$propertiesCount)); ?>

</div>
<br class="clear" />
</div>
</div>
</div>
