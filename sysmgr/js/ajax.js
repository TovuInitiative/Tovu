// JavaScript Document

function ajaxObj(url, elmnts, loadingMsg, passParams)
{
	this.obj		= new Object();
	this.url		= url;
	this.loadInto	= elmnts;
	this.params		= passParams;
	
	if(loadingMsg) //if we have set a loading message here it will be put into the changed elemnt(s)
	{
		if(typeof(this.loadInto) != 'object') //if we wanna change just one element, simply do it using it's id
			document.getElementById(this.loadInto).innerHTML.innerHTML = loadingMsg;
		else //or if the 'elmnts' parameter is an array - change all the elements of the array
		{
			for(i in this.loadInto)
			{
				document.getElementById(this.loadInto[i]).innerHTML = loadingMsg;
			}
		}
	}
	//This prototype is used to create our request, send it and handle it
	this.init();
}
ajaxObj.prototype.create = function()
{
	try
	{
		xmlHttp = new XMLHttpRequest();
	}
	catch(e)
	{
		try
		{
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			try
			{
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				return false;
			}
		}
	} 
	this.obj = xmlHttp;
}
ajaxObj.prototype.handle = function()
{
	var o = this.obj;
	var into = this.loadInto;
	o.onreadystatechange = function() //Set an event handler that is triggered everytime the readystate of the object has changed
	{
		if(o.readyState==4) //If the readyState is 4, the request has been completed - we can proceed with using the response
		{
			if(typeof(into) != 'object') //if we want to change just one element - set it's innerHTML equal to the response 
				document.getElementById(into).innerHTML = o.responseText;
			else //otherwise - we have more than one elements to change. We must first split the data that is returned into parts for each one of the elements and then update them
			{
				temp = o.responseText.split("@@");
				for(i in into)
				{
					document.getElementById(into[i]).innerHTML = temp[i];
				}
			}
		}
	}
}
ajaxObj.prototype.send = function()
{
	this.obj.open("POST", this.url, true);
	this.obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	//this.obj.setRequestHeader("Content-length", this.params);
	//this.obj.onreadystatechange = this.handle;
	this.obj.send(this.params);
}
ajaxObj.prototype.init = function()
{
	this.obj = null;
	this.create();
	this.handle();
	this.send();
}