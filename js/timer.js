function startTime(sec) {
	// alert("asdddd");
	

}

function formatSecs(sec){
	var hours = Math.floor(sec/(60*60));
	var divisorForMins = sec%(60*60);
	var minutes = Math.floor(divisorForMins/60);
	var divisorForSecs = divisorForMins%60;
	var seconds = Math.ceil(divisorForSecs);
	var obj = hours + ":" + minutes + ":" + seconds;
	return obj;
}

function getReadableTime(sec) {
	var weew = function() {
		if (sec >= 0) {
			document.title = "My Restaurant - Timeout in " + formatSecs(sec);
			sec--;
		} else {
			clearInterval(interv);
			window.location = "logout-timer.php";
		}
	}
	var interv = setInterval(weew, 1000);
}	

if(window.addEventListener){
    window.addEventListener('load',startTime,false); //W3C
}
else{
    window.attachEvent('onload',startTime); //IE
}
