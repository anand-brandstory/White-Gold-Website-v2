
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
GoldRates.apiEndpointBase = window.__BFS.CONF.goldRates.apiEndpoint
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
	return fetch( GoldRates.apiEndpointBase + "/v2/gold-rates/current?region=" + region )
		// .then( response => response.json() )
		// .then( response => response.data )
		.then( response => response.text() )
		.then( responseText => JSON.parse( responseText ) )
		.then( parsedResponse => {
			parsedResponse[ 0 ] = parsedResponse[ 0 ] > 0 ? ( ( parsedResponse[ 0 ] - 1 ) % 256 ) : 255
			return parsedResponse
		} )
		.then( processedResponse => JSON.parse( buffer( processedResponse ).toString() ) )
		.then( responseObject => responseObject.data )
}
GoldRates.getRelevantRatesFromTheDay = function ( region ) {
	return fetch( GoldRates.apiEndpointBase + "/v2/gold-rates?region=" + region )
		// .then( response => response.json() )
		// .then( response => response.data )
		.then( response => response.text() )
		.then( responseText => JSON.parse( responseText ) )
		.then( parsedResponse => {
			parsedResponse[ 0 ] = parsedResponse[ 0 ] > 0 ? ( ( parsedResponse[ 0 ] - 1 ) % 256 ) : 255
			return parsedResponse
		} )
		.then( processedResponse => JSON.parse( buffer( processedResponse ).toString() ) )
		.then( recoveredResponse => recoveredResponse.data )
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
	if ( !this.dom22KaratPerGram && !this.dom22KaratPerGram ) {
		return
	}
	let valueHasChanged = true
	if ( this.previous ) {
		let previous = this.previous

		valueHasChanged = cost__24KaratGold__perGram !== previous.cost__24KaratGold__perGram
		if ( ! valueHasChanged )
			return

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
	// If the gold rates are already in the midst of tracking, don't schedule the next cycle
	if ( this.timeoutId !== null )
		return

	let data
	try {
		data = await GoldRates.getCurrent( this.region )
	}
	catch ( e ) {
		data = { }
	}
	if ( Object.keys( data ).length ) {
		this.render( data )
		this.broadcast( data )
		this.previous = data
	}
	let timeUntilNextFetch = Object.keys( data ).length ? 1000 : 19000
	this.timeoutId = setTimeout( () => {
		this.stopTracking()
		this.startTracking()
	}, timeUntilNextFetch )
};
GoldRates.prototype.stopTracking = function () {
	clearTimeout( this.timeoutId )
	this.timeoutId = null
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
		catch ( e ) {
			console.error( e )
		}
	} )
}
