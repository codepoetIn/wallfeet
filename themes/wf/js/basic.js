function fnShow(id){
	document.getElementById(id).style.display = "block";
}

function fnHide(id){
	document.getElementById(id).style.display = "none";
}

function fnUserBlock(arg){
	document.getElementById('agent').style.display="none";
	//document.getElementById('builder').style.display="none";
	document.getElementById('specialist').style.display="none";
	if(arg!="")
		document.getElementById(arg).style.display="block";
	
}

function fnCheckAll(flag){
	var obj = document.thisProperty.elements["posted_by[]"];
	if(obj.length>1){
		for(i=0;i<obj.length;i++){
			if(flag)
				obj[i].checked="checked";
			else 
				obj[i].checked="";
		}
	}
	else{
		if(flag)
			obj.checked="checked";
		else
			obj.checked="";
	}
}

function fnChecked(flag){
	if(!flag)
		document.thisProperty.posted_by_all.checked = "";
	var obj = document.thisProperty.elements["posted_by[]"];
	var count = 0;
	if(obj.length>1){
		for(i=0;i<obj.length;i++){
			if(obj[i].checked)
				count++;
		}
	}
	else{
		if(obj.checked)
			count++;
	}
	if(obj.length==count)
		document.thisProperty.posted_by_all.checked = "checked";			
	
}

function fnMultiSelect(id,val){
	var obj = document.getElementById(id).options;
	var values = val;
	values = values.split(',');
	if(values!=null){
		for(var i=0;i<obj.length;i++){
			for(var j=0;j<values.length;j++){
				if(obj[i].value==values[j]){
					obj[i].selected = "selected";
				}
			}
		}
	}
}		