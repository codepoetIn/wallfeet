<?php if(isset($_POST['cal']))
{

}?>




<style type="text/css">
.areacal p span
{
	width:100px;float:left;
}
</style>
<form name=form1 id=form1>
<div class="areacal">
		        <h2 >Area Calculator</h2>
		 
		        
		          <p >
		            <span>Area :</span>
		            
		            	<input id="area" name="area"  type="text" value="" >
		            	
		            
		          </p>
		          <p>
		            <span>From Unit : </span>
		            
		           	 	<select id="unit_from" name="unitfrom">
							<option value="">--- Unit---</option>
							<option value="12850">Sq-ft</option><option value="12851">Sq-yrd</option><option value="12852">Sq-m</option><option value="12853">Acre</option><option value="12854">Bigha</option><option value="12855">Hectare</option><option value="12856">Marla</option><option value="12857">Kanal</option><option value="12588">Biswa1</option><option value="12589">Biswa2</option><option value="12590">Ground</option><option value="12591">Aankadam</option><option value="12592">Rood</option><option value="12593">Chatak</option><option value="12594">Kottah</option><option value="12595">Marla</option><option value="12596">Cent</option><option value="12597">Perch</option><option value="12598">Guntha</option><option value="12599">Are</option>
						</select>
						
		           
		          </p>
		          <p >
		            <span>To Unit :</span>
		           
		            	<select id="unit_to" name="unitto">
							<option value="">--- Unit---</option>
							<option value="12850">Sq-ft</option><option value="12851">Sq-yrd</option><option value="12852">Sq-m</option><option value="12853">Acre</option><option value="12854">Bigha</option><option value="12855">Hectare</option><option value="12856">Marla</option><option value="12857">Kanal</option><option value="12588">Biswa1</option><option value="12589">Biswa2</option><option value="12590">Ground</option><option value="12591">Aankadam</option><option value="12592">Rood</option><option value="12593">Chatak</option><option value="12594">Kottah</option><option value="12595">Marla</option><option value="12596">Cent</option><option value="12597">Perch</option><option value="12598">Guntha</option><option value="12599">Are</option>
						</select>
						
		          
		          </p>
		          <p >
		            <span>Result :</span>
		            
		            	<input id="result" name="result"  type="text" value="" >
		            
		          </p>
		       
			   
					<p >
						 <span>&nbsp</span>
						<input type="submit" id="cal" value="Calculate" onclick="return CheckNumeric()" name="cal">
					</p>
		       </div>
</form>
<script type="text/javascript">
function CheckNumeric()
{

	var area=document.getElementsByName('area').value;
	var unitfrom=document.getElementsByName('unitfrom').value;
	var unitto=document.getElementsByName('unitto').value;
	alert(value);
	if(isNumeric(area))
	{
		alert('numeric');
	}
	else
	{
		alert('no numeric');
	}

		function isNumeric(value) {
			
		  if (value == null || !value.toString().match(/^[-]?\d*\.?\d*$/)) return false;
		  return true;
		}
}
</script>