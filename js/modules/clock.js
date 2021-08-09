
/*
 |
 | ----- Clock
 |
 */
function Clock ( timeElementSelector, dateElementSelector ) {
	this.timeDOMNode = document.querySelector( timeElementSelector )
	this.dateDOMNode = document.querySelector( dateElementSelector )
	this.timeoutId = null
}
Clock.months = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]
Clock.getCurrentDateAndTime = function () {
	let date = new Date

	let year = date.getFullYear()
	let month = Clock.months[ date.getMonth() ]
	let day = date.getDate()

	let hours = date.getHours()
	let minutes = date.getMinutes().toString()
	let seconds = date.getSeconds().toString()

	let meridiem
	let timeAsString
	meridiem = hours >= 12 ? "pm" : "am"
	hours = hours > 12 ? ( hours - 12 ) : hours
	timeAsString = hours + ":" + minutes.padStart( 2, 0 ) + ":" + seconds.padStart( 2, 0 ) + " " + meridiem + " IST";
	// timeAsString = hours + ( seconds % 2 ? ":" : " " ) + minutes.padStart( 2, 0 ) + " " + meridiem;

	let dateAsString = day + " " + month + " " + year

	return [ timeAsString, dateAsString ]
}

Clock.prototype.render = function ( time, date ) {
	this.timeDOMNode.innerText = time;
	this.dateDOMNode.innerText = date;
};

Clock.prototype.run = function () {
	let [ time, date ] = Clock.getCurrentDateAndTime()
	this.render( time, date )
	this.timeoutId = setTimeout( () => {
		this.run()
	}, 1000 )
};
Clock.prototype.pause = function () {
	clearTimeout( this.timeoutId )
};
