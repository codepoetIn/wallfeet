 
 <script type="text/javascript">
function changeSpecialist()
{
	document.getElementById("bottom-specialist-form").submit();
}

</script>
 <div class="footer-col2 left" style="width:121px;">
        	<h2>Specialists Types</h2>
            <ul>
            <?php $count=0; 
            foreach($results as $result)
            {
           	echo '<li><a onClick="changeSpecialist()" href="#">'.$result->specialist.'</a></li>';
           	if($count>5)
           	break;
           	$count++;
            }?>
            </ul>
 </div>
 <form action="/search/people" method="POST" id="bottom-specialist-form">
<input type="hidden" name="user_type" value="specialist" >
<input type="hidden" name="search"  />
<input type="hidden" name="specialist_type" id="top-current-input" />
</form>