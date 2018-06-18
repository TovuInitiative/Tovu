// Articles - JavaScript Document.
function Article_Operations(div, action, field, val)
{
	var call_ajax = 'no';
	var pass_vars = '';
	switch(action)
	{
		case 'article':	call_ajax = 'yes';	pass_vars = 'called=ajax&act=articles&id='+div;break;
		case 'comment':	call_ajax = 'yes';	pass_vars = 'called=ajax&act=comments&id='+div;break;
		case 'rating':	call_ajax = 'yes';	pass_vars = 'called=ajax&act=ratings&id='+div;break;
		case 'expiry':  call_ajax = 'yes';  pass_vars = 'called=ajax&act=expiry&id='+div;break;
		case 'enable-disable':
			if(document.getElementById(field).value=='yes'){
				document.getElementById(field).value	= 'no';
				//document.getElementById(div).className	= 'selected';
			}
			else{
				document.getElementById(field).value	= 'yes';
				document.getElementById(div).className	= '';
			}
			break;
		default: alert('Undefined action. Process aborted.');
	}
	//alert(pass_vars);
	
	if(call_ajax=='yes'){
		if(div != ''){
			subject_id	= div;
			document.getElementById(div).innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
		}
		else{
			alert('Undefined ID. Proccess aborted');
			return false;
		}
		
		if(action != ''){
			jQuery(document).ready(function ($) {
				//alert(val);
			$.post("adm_operations.php",{ act:action,wrappa:div,id:field,value:val } ,function(data){
				document.getElementById(div).innerHTML = data;
				}); /*return false;*/
			});
		}
		else{
			alert('Undefined Action. Proccess aborted');
			return false;
		}
		//new ajaxObj('adm_operations.php', subject_id, 'Processing...', pass_vars);
	}
}

function CheckArticleForm(edtr_on, cfexist)
{
	// Check the form to make sure that all fields are complete
	var f = document.frmpreviewarticle;
	if(f.title.value==''){
		alert('Please specify the Article Title.');
		f.title.focus(); return false;
	}

	if(edtr_on=='yes'){
		if(oEdit1.getHTMLBody()==''){
			alert('Please Specify the Content of Article.');
			f.txtContent.focus(); return false;
		}
	}
	else{
		if(f.txtContent.value==''){
			alert('Please Specify the Content of Article.');
			f.txtContent.focus(); return false;
		}
	}

	if(cfexist=='yes'){
		return CustomFieldsChk();
	}
	return true;
}

function makeFeatured(id1,id2)
{
	document.getElementById(id2).innerHTML = (document.getElementById(id1).checked==true)?"(Article will be Moved to <strong>Featured Articles</strong>.)":'';
}

function showcats(ident, showid)
{
	if(ident=='private')
	{
		document.getElementById('privatecats').style.display= '';
		document.getElementById('publiccats').style.display	= 'none';
		document.getElementById('lockimage').innerHTML		= '<img src="images/lock.png" alt="Private" style="vertical-align: middle;" />';
	}
	else{
		document.getElementById('privatecats').style.display= 'none';
		document.getElementById('publiccats').style.display	= '';
		document.getElementById('lockimage').innerHTML		= '';
	}
}