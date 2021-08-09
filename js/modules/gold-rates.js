
/*
 |
 | ----- Gold Rates
 |
 */
function GoldRates ( region, nodeSelectors ) {
	this.region = region
	this.dom24KaratPerGram = document.querySelector( nodeSelectors[ "24KaratPerGram" ] )
	this.dom22KaratPerGram = document.querySelector( nodeSelectors[ "22KaratPerGram" ] )

	this.timeoutId = null
	this.listeners = [ ]
}
GoldRates.formatAsRupee = function formatAsRupee ( amount ) {

	let pattern = "! #"
	let negativePattern = "-! #"
	let symbol = "₹"
	let separator = ","
	let decimal = "."
	let groups = /(\d)(?=(\d\d)+\d\b)/g	// vedic numbering system regex

	let split = amount.toFixed( 2 ).replace( /^-/, "" ).split( "." )
	let wholePart = split[ 0 ]
	let fractionalPart = split[ 1 ];

	return ( amount >= 0 ? pattern : negativePattern )
		.replace( "!", symbol )
		.replace( "#", wholePart.replace( groups, '$1' + separator ) + ( fractionalPart ? decimal + fractionalPart : "" ) )

}
GoldRates.formatAsTime = function formatAsTime ( date ) {
	let hour = date.getHours()
	let minutes = date.getMinutes().toString().padStart( 2, 0 )
	let meridian = hour > 11 ? "pm" : "am"

	if ( hour > 12 )
		hour = hour - 12
	else if ( hour === 0 )
		hour = hour.toString().padStart( 2, 0 )

	return `${hour}:${minutes} ${meridian}`
}
GoldRates.getCurrent = function ( region ) {
	return fetch( "https://api.whitegold.money/v1/gold-rates/current?region=" + region )
		.then( response => response.json() )
		.then( response => response.data )
}
GoldRates.getRelevantRatesFromTheDay = function ( region ) {
	return fetch( "https://api.whitegold.money/v1/gold-rates?region=" + region )
		.then( response => response.json() )
		.then( response => response.data )
		.then( data => {
			return data.map( function ( rate ) {
				return {
					...rate,
					cost__24KaratGold__perGram: parseFloat( rate.cost__24KaratGold__perGram.toFixed( 2 ) ),
					// time: GoldRates.formatAsTime( new Date( rate.timestamp ) )
				}
			} )
		} )
}
GoldRates.prototype.render = function ( { cost__24KaratGold__perGram, cost__22KaratGold__perGram } ) {
	if ( this.previous ) {
		let previous = this.previous
		let className

		className = cost__24KaratGold__perGram > previous.cost__24KaratGold__perGram ? "trend-up" : cost__24KaratGold__perGram < previous.cost__24KaratGold__perGram ? "trend-down" : null
		if ( className ) {
			this.dom24KaratPerGram.classList.remove( "trend-up", "trend-down" )
			this.dom24KaratPerGram.classList.add( className )
		}

		className = cost__22KaratGold__perGram > previous.cost__22KaratGold__perGram ? "trend-up" : cost__22KaratGold__perGram < previous.cost__22KaratGold__perGram ? "trend-down" : null
		if ( className ) {
			this.dom22KaratPerGram.classList.remove( "trend-up", "trend-down" )
			this.dom22KaratPerGram.classList.add( className )
		}
	}

	this.dom24KaratPerGram.innerText = GoldRates.formatAsRupee( cost__24KaratGold__perGram )
	this.dom22KaratPerGram.innerText = GoldRates.formatAsRupee( cost__22KaratGold__perGram )
};
GoldRates.prototype.startTracking = async function () {
	let data = await GoldRates.getCurrent( this.region )
	this.render( data )
	this.broadcast( data )
	this.previous = data
	this.timeoutId = setTimeout( () => {
		this.startTracking()
	}, 1000 )
};
GoldRates.prototype.stopTracking = function () {
	clearTimeout( this.timeoutId )
};
GoldRates.prototype.subscribe = function ( callbackFunction ) {
	this.listeners = this.listeners.concat( callbackFunction )
	return function unsubscribe () {
		this.listeners = this.listeners.filter( listener => listener !== callbackFunction )
	}.bind( this )
};
GoldRates.prototype.broadcast = function ( data ) {
	this.listeners.forEach( function ( callbackFunction ) {
		try {
			callbackFunction( data )
		}
		catch ( e ) {}
	} )
}
