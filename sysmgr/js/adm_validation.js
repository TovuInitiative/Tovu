
function CheckEmail(s)
{  
    var i = 1;
    var sLength = s.length;
    while ((i < sLength) && (s.charAt(i) != "@"))
    { 
	i++
    }
    if ((i >= sLength) || (s.charAt(i) != "@")) return false;
    else i += 2;
    while ((i < sLength) && (s.charAt(i) != "."))
    { 
    i++
    }
    if ((i >= sLength - 1) || (s.charAt(i) != ".")) return false;
    else return true;
}

function clip(string)
{
        if (string.length<=0) {return('');}
        position = string.indexOf(' ');
        while (position==0) {
                string = string.substr(1, string.length-1);
                position = string.indexOf(' ');
        }
        position = string.charCodeAt(string.length-1);
        while (position==10) {
              string = string.substr(0, string.length-1);
                position = string.charCodeAt(string.length-1);
        }
        return(string);
} 



function valid_menu() 
{
	if(clip(document.frm_menus.menu_title.value).length<1){
		   alert("Menu Title is required.");
			document.frm_menus.menu_title.focus();
		  return false;
	}
	
	if(clip(document.frm_menus.id_section.value).length<1){
		   alert("Menu Section is required.");
			document.frm_menus.id_section.focus();
		  return false;
	}
	
	if(clip(document.frm_menus.id_type_menu.value).length<1){
		   alert("Menu Type is required.");
			document.frm_menus.id_type_menu.focus();
		  return false;
	}
	else
	{
		if(clip(document.frm_menus.id_type_menu.value)==2){
			
			if(clip(document.frm_menus.id_parent.value).length<1){
				alert("Select Menu Parent.");
				document.frm_menus.id_parent.focus();
				//document.getElementById('id_parent').focus();
				return false;
		 		}
		 }
	}
	
	/*alert(clip(document.rage.id_type_menu.value);
	if(clip(document.rage.id_parent1.value).length > 1){
		if(clip(document.rage.id_type_menu.value)<>2){
				alert("Menu Type must be 'Sub Menu' when Menu Parent is selected.");
				document.rage.id_type_menu.focus();
				return false;
		}
	}*/
	
}	



function valid_article() // valid feedback
{
	//alert(document.getElementById('id_parent').value.length); //(document.rage.id_parent.value);
	
	if(clip(document.rage.title.value).length<1){
		   alert("Article Title is required.");
			document.rage.title.focus();
		  return false;
	}
	
	if(document.getElementById('id_parent').value.length < 1){
		   alert("Parent Link is required.");
			//document.rage.id_parent.focus();
		  return false;
	}
	
}	


/*if ((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) >= 4)) {
	document.captureEvents(Event.KEYUP)
	document.onkeyup = keyTrap;
}
if ((navigator.appName == "Microsoft Internet Explorer") && (parseInt(navigator.appVersion) >= 4)) {
	document.onkeyup = keyTrap;
}*/