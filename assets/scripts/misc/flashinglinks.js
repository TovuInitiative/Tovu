//** Flashing Links script v2.0- (c) Dynamic Drive DHTML code library: http://www.dynamicdrive.com
//** Last updated April 6th, 09' to v2.0
//** This notice must stay intact for legal use

var flashinglinks={

pause: 800, //pause between flashes (in milliseconds)
targetlinks:[],

changecolor:function(){
	for (var i=0; i<this.targetlinks.length; i++){
		var targetlink=this.targetlinks[i]
		var cssprop=(targetlink.colorsetting.type=="flashfg")? "color" : "backgroundColor"
		targetlink.style[cssprop]=(targetlink.style[cssprop]!=targetlink.colorsetting.ncolor)? targetlink.colorsetting.ncolor : targetlink.colorsetting.ocolor
		targetlink.colorsetting.ccolor=targetlink.style[cssprop]
	}
},

fetchcssvalue:function(el, prop){ //prop is assumed to be non hyphenated css properties
	return (el.style[prop])? el.style[prop] : (el.currentStyle)? el.currentStyle[prop] : (document.defaultView.getComputedStyle)? document.defaultView.getComputedStyle(el, "").getPropertyValue(prop) : ""
},


addEvent:function(targetarr, functionref, tasktype){
	if (targetarr.length>0){
		var target=targetarr.shift()
		if (target.addEventListener)
			target.addEventListener(tasktype, functionref, false)
		else if (target.attachEvent)
			target.attachEvent('on'+tasktype, function(){return functionref.call(target, window.event)})
		this.addEvent(targetarr, functionref, tasktype)
	}
},

init:function(){
	var alllinks=document.getElementsByTagName("a")
	for (var i=0; i<alllinks.length; i++){
		if (alllinks[i].getAttribute('rel') && /(flash[bf]g)\[(.+)\]/i.test(alllinks[i].getAttribute('rel'))){ //test for required rel attribute
			alllinks[i].colorsetting={
				ocolor: this.fetchcssvalue(alllinks[i], RegExp.$1=="flashfg"? "color" : "backgroundColor"), //get original element's fore/background color
				ncolor: RegExp.$2, //get flash to element's fore/background color
				type: RegExp.$1 //type: "flashfg" or "flashbg"
			}
			this.targetlinks.push(alllinks[i])
		}
	}
	if (this.targetlinks.length>0){
		setInterval(function(){flashinglinks.changecolor()}, this.pause)
	}
}

}

//flashinglinks.addEvent([window], function(){flashinglinks.init()}, "load")