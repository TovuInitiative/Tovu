/*
   Behaviour v1.1 by Ben Nolan, June 2005. Based largely on the work
   of Simon Willison (see comments by Simon below).

   Description:
   	
   	Uses css selectors to apply javascript behaviours to enable
   	unobtrusive javascript in html documents.
   	
   Usage:   
   
	var myrules = {
		'b.someclass' : function(element){
			element.onclick = function(){
				alert(this.innerHTML);
			}
		},
		'#someid u' : function(element){
			element.onmouseover = function(){
				this.innerHTML = "BLAH!";
			}
		}
	};
	
	Behaviour.register(myrules);
	
	// Call Behaviour.apply() to re-apply the rules (if you
	// update the dom, etc).

   License:
   
   	This file is entirely BSD licensed.
   	
   More information:
   	
   	http://ripcord.co.nz/behaviour/
   
*/   

var Behaviour = {
	list : new Array,
	
	register : function(sheet){
		Behaviour.list.push(sheet);
	},
	
	start : function(){
		Behaviour.addLoadEvent(function(){
			Behaviour.apply();
		});
	},
	
	apply : function(){
		for (h=0;sheet=Behaviour.list[h];h++){
			for (selector in sheet){
				list = document.getElementsBySelector(selector);
				
				if (!list){
					continue;
				}

				for (i=0;element=list[i];i++){
					sheet[selector](element);
				}
			}
		}
	},
	
	addLoadEvent : function(func){
		var oldonload = window.onload;
		
		if (typeof window.onload != 'function') {
			window.onload = func;
		} else {
			window.onload = function() {
				oldonload();
				func();
			}
		}
	}
}

Behaviour.start();

/*
   The following code is Copyright (C) Simon Willison 2004.

   document.getElementsBySelector(selector)
   - returns an array of element objects from the current document
     matching the CSS selector. Selectors can contain element names, 
     class names and ids and can be nested. For example:
     
       elements = document.getElementsBySelect('div#main p a.external')
     
     Will return an array of all 'a' elements with 'external' in their 
     class attribute that are contained inside 'p' elements that are 
     contained inside the 'div' element which has id="main"

   New in version 0.4: Support for CSS2 and CSS3 attribute selectors:
   See http://www.w3.org/TR/css3-selectors/#attribute-selectors

   Version 0.4 - Simon Willison, March 25th 2003
   -- Works in Phoenix 0.5, Mozilla 1.3, Opera 7, Internet Explorer 6, Internet Explorer 5 on Windows
   -- Opera 7 fails 
*/

function getAllChildren(e) {
  // Returns all children of element. Workaround required for IE5/Windows. Ugh.
  return e.all ? e.all : e.getElementsByTagName('*');
}

document.getElementsBySelector = function(selector) {
  // Attempt to fail gracefully in lesser browsers
  if (!document.getElementsByTagName) {
    return new Array();
  }
  // Split selector in to tokens
  var tokens = selector.split(' ');
  var currentContext = new Array(document);
  for (var i = 0; i < tokens.length; i++) {
    token = tokens[i].replace(/^\s+/,'').replace(/\s+$/,'');;
    if (token.indexOf('#') > -1) {
      // Token is an ID selector
      var bits = token.split('#');
      var tagName = bits[0];
      var id = bits[1];
      var element = document.getElementById(id);
      if (tagName && element.nodeName.toLowerCase() != tagName) {
        // tag with that ID not found, return false
        return new Array();
      }
      // Set currentContext to contain just this element
      currentContext = new Array(element);
      continue; // Skip to next token
    }
    if (token.indexOf('.') > -1) {
      // Token contains a class selector
      var bits = token.split('.');
      var tagName = bits[0];
      var className = bits[1];
      if (!tagName) {
        tagName = '*';
      }
      // Get elements matching tag, filter them for class selector
      var found = new Array;
      var foundCount = 0;
      for (var h = 0; h < currentContext.length; h++) {
        var elements;
        if (tagName == '*') {
            elements = getAllChildren(currentContext[h]);
        } else {
            elements = currentContext[h].getElementsByTagName(tagName);
        }
        for (var j = 0; j < elements.length; j++) {
          found[foundCount++] = elements[j];
        }
      }
      currentContext = new Array;
      var currentContextIndex = 0;
      for (var k = 0; k < found.length; k++) {
        if (found[k].className && found[k].className.match(new RegExp('\\b'+className+'\\b'))) {
          currentContext[currentContextIndex++] = found[k];
        }
      }
      continue; // Skip to next token
    }
    // Code to deal with attribute selectors
    if (token.match(/^(\w*)\[(\w+)([=~\|\^\$\*]?)=?"?([^\]"]*)"?\]$/)) {
      var tagName = RegExp.$1;
      var attrName = RegExp.$2;
      var attrOperator = RegExp.$3;
      var attrValue = RegExp.$4;
      if (!tagName) {
        tagName = '*';
      }
      // Grab all of the tagName elements within current context
      var found = new Array;
      var foundCount = 0;
      for (var h = 0; h < currentContext.length; h++) {
        var elements;
        if (tagName == '*') {
            elements = getAllChildren(currentContext[h]);
        } else {
            elements = currentContext[h].getElementsByTagName(tagName);
        }
        for (var j = 0; j < elements.length; j++) {
          found[foundCount++] = elements[j];
        }
      }
      currentContext = new Array;
      var currentContextIndex = 0;
      var checkFunction; // This function will be used to filter the elements
      switch (attrOperator) {
        case '=': // Equality
          checkFunction = function(e) { return (e.getAttribute(attrName) == attrValue); };
          break;
        case '~': // Match one of space seperated words 
          checkFunction = function(e) { return (e.getAttribute(attrName).match(new RegExp('\\b'+attrValue+'\\b'))); };
          break;
        case '|': // Match start with value followed by optional hyphen
          checkFunction = function(e) { return (e.getAttribute(attrName).match(new RegExp('^'+attrValue+'-?'))); };
          break;
        case '^': // Match starts with value
          checkFunction = function(e) { return (e.getAttribute(attrName).indexOf(attrValue) == 0); };
          break;
        case '$': // Match ends with value - fails with "Warning" in Opera 7
          checkFunction = function(e) { return (e.getAttribute(attrName).lastIndexOf(attrValue) == e.getAttribute(attrName).length - attrValue.length); };
          break;
        case '*': // Match ends with value
          checkFunction = function(e) { return (e.getAttribute(attrName).indexOf(attrValue) > -1); };
          break;
        default :
          // Just test for existence of attribute
          checkFunction = function(e) { return e.getAttribute(attrName); };
      }
      currentContext = new Array;
      var currentContextIndex = 0;
      for (var k = 0; k < found.length; k++) {
        if (checkFunction(found[k])) {
          currentContext[currentContextIndex++] = found[k];
        }
      }
      // alert('Attribute Selector: '+tagName+' '+attrName+' '+attrOperator+' '+attrValue);
      continue; // Skip to next token
    }
    
    if (!currentContext[0]){
    	return;
    }
    
    // If we get here, token is JUST an element (not a class or ID selector)
    tagName = token;
    var found = new Array;
    var foundCount = 0;
    for (var h = 0; h < currentContext.length; h++) {
      var elements = currentContext[h].getElementsByTagName(tagName);
      for (var j = 0; j < elements.length; j++) {
        found[foundCount++] = elements[j];
      }
    }
    currentContext = found;
  }
  return currentContext;
}

/* That revolting regular expression explained 
/^(\w+)\[(\w+)([=~\|\^\$\*]?)=?"?([^\]"]*)"?\]$/
  \---/  \---/\-------------/    \-------/
    |      |         |               |
    |      |         |           The value
    |      |    ~,|,^,$,* or =
    |   Attribute 
   Tag
*/


/*
Page:           rating.js
Created:        Aug 2006
Last Mod:       Mar 11 2007
Handles actions and requests for rating bars.	
--------------------------------------------------------- 
ryan masuga, masugadesign.com
ryan@masugadesign.com 
Licensed under a Creative Commons Attribution 3.0 License.
http://creativecommons.org/licenses/by/3.0/
See readme.txt for full credit details.
--------------------------------------------------------- */

var xmlhttp
	/*@cc_on @*/
	/*@if (@_jscript_version >= 5)
	  try {
	  xmlhttp=new ActiveXObject("Msxml2.XMLHTTP")
	 } catch (e) {
	  try {
	    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")
	  } catch (E) {
	   xmlhttp=false
	  }
	 }
	@else
	 xmlhttp=false
	@end @*/
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	 try {
	  xmlhttp = new XMLHttpRequest();
	 } catch (e) {
	  xmlhttp=false
	 }
	}
	function myXMLHttpRequest() {
	  var xmlhttplocal;
	  try {
	    xmlhttplocal= new ActiveXObject("Msxml2.XMLHTTP")
	 } catch (e) {
	  try {
	    xmlhttplocal= new ActiveXObject("Microsoft.XMLHTTP")
	  } catch (E) {
	    xmlhttplocal=false;
	  }
	 }

	if (!xmlhttplocal && typeof XMLHttpRequest!='undefined') {
	 try {
	  var xmlhttplocal = new XMLHttpRequest();
	 } catch (e) {
	  var xmlhttplocal=false;
	  alert('couldn\'t create xmlhttp object');
	 }
	}
	return(xmlhttplocal);
}

function sndReq(vote,id_num,ip_num,units,reccat) {
	var theUL = document.getElementById('unit_ul'+id_num); // the UL
	
	// switch UL with a loading div
	theUL.innerHTML = '<div class="loading"></div>';
	xmlhttp.open('get', 'assets/ajaxrating/rpc.php?j='+vote+'&q='+id_num+'&t='+ip_num+'&c='+units+'&rc='+reccat);
    xmlhttp.onreadystatechange = handleResponse;
    xmlhttp.send(null);	
}

function handleResponse() {
  if(xmlhttp.readyState == 4){
		if (xmlhttp.status == 200){
       	
        var response = xmlhttp.responseText;
        var update = new Array();

        if(response.indexOf('|') != -1) {
            update = response.split('|');
			//alert(update[0] +" "+ update[1]);
            changeText(update[0], update[1]);
        }
		}
    }
}

function changeText( div2show, text ) {
    // Detect Browser
    var IE = (document.all) ? 1 : 0;
    var DOM = 0; 
    if (parseInt(navigator.appVersion) >=5) {DOM=1};

    // Grab the content from the requested "div" and show it in the "container"
    if (DOM) {
        var viewer = document.getElementById(div2show);
        viewer.innerHTML = text;
    }  else if(IE) {
        document.all[div2show].innerHTML = text;
    }
}

/* =============================================================== */
var ratingAction = {
		'a.rater' : function(element){
			element.onclick = function(){
			//alert("rage");
			var parameterString = this.href.replace(/.*\?(.*)/, "$1"); // onclick="sndReq('j=1&q=2&t=127.0.0.1&c=5');
			var parameterTokens = parameterString.split("&"); // onclick="sndReq('j=1,q=2,t=127.0.0.1,c=5');
			var parameterList = new Array();

			for (j = 0; j < parameterTokens.length; j++) {
				var parameterName = parameterTokens[j].replace(/(.*)=.*/, "$1"); // j
				var parameterValue = parameterTokens[j].replace(/.*=(.*)/, "$1"); // 1
				parameterList[parameterName] = parameterValue;
			}
			var theratingID = parameterList['q'];
			var theVote = parameterList['j'];
			var theuserIP = parameterList['t'];
			var theunits = parameterList['c'];
			var reccat = parameterList['rc'];
			
			//for testing	alert('sndReq('+theVote+','+theratingID+','+theuserIP+','+theunits+')'); return false;
			sndReq(theVote,theratingID,theuserIP,theunits,reccat); return false;		
			}
		}
		
	};
Behaviour.register(ratingAction);
