// Original script by Walter Heitman Jr, first published on http://techblog.shanock.com

// Set an initial scroll speed. This equates to the number of pixels shifted per tick
var scrollspeed=2;
var pxptick=scrollspeed;
function startmarquee(){
	// Make a shortcut referencing our div with the content we want to scroll
	marqueediv=document.getElementById("marqueecontent");
	// Get the total width of our available scroll area
	marqueewidth=document.getElementById("marqueeborder").offsetWidth;
	// Get the width of the content we want to scroll
	contentwidth=marqueediv.offsetWidth;
	// Start the ticker at 50 milliseconds per tick, adjust this to suit your preferences
	// Be warned, setting this lower has heavy impact on client-side CPU usage. Be gentle.
	setInterval("scrollmarquee()",50);
}
	
function scrollmarquee(){
	// Check position of the div, then shift it left by the set amount of pixels.
	if (parseInt(marqueediv.style.left)>(contentwidth*(-1)))
		marqueediv.style.left=parseInt(marqueediv.style.left)-pxptick+"px";
	// If it's at the end, move it back to the right.
	else
		marqueediv.style.left=parseInt(marqueewidth)+"px";
}
window.onload=startmarquee;
