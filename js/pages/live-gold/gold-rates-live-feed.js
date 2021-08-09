
$( function () {

	// Initialise the clock
	let clock = new Clock( ".js_current_time", ".js_current_date" );
	clock.run();

	// Initialise the tracking of gold rates
	let region = window.__BFS.CONF.region
	let goldRates = new GoldRates( region, {
		"24KaratPerGram": ".js_24_karat_per_gram",
		"22KaratPerGram": ".js_22_karat_per_gram"
	} );
	goldRates.startTracking();
	window.__BFS.goldRateTracker = goldRates;


	/*
	 |
	 | Build and render the chart
	 |
	 */
	initChart()
	async function initChart () {
		let canvasElement = document.getElementById( "js_chart_canvas" )

		// Fetch and organize the data
		let dataPoints = await GoldRates.getRelevantRatesFromTheDay( region )
		let xValues = [
			9, 9.25, 9.5, 9.75,
			10, 10.25, 10.5, 10.75,
			11, 11.25, 11.5, 11.75,
			12, 12.25, 12.5, 12.75,
			13, 13.25, 13.5, 13.75,
			14, 14.25, 14.5, 14.75,
			15, 15.25, 15.5, 15.75,
			16, 16.25, 16.5, 16.75,
			17, 17.25, 17.5, 17.75,
			18,
		]
		let xlabels = xValues.map( function ( x ) {
			let hour = Math.floor( x )
			let minutes = ( ( x - hour ) * 60 ).toString().padStart( 2, 0 )
			let meridian = hour > 11 ? "pm" : "am"

			let formattedHour
			if ( hour > 12 )
				formattedHour = hour - 12
			else if ( hour === 0 )
				formattedHour = hour.toString().padStart( 2, 0 )
			else
				formattedHour = hour

			return `${formattedHour}:${minutes} ${meridian}`
		} )
		// let xlabels = dataPoints.map( p => p.time )
		let yValues = dataPoints.map( p => p.cost__24KaratGold__perGram )
		let minimumY = Math.min.apply( null, yValues )
		let maximumY = Math.max.apply( null, yValues )
		let minYOnScale = minimumY - ( minimumY % 100 )
		let maxYOnScale = maximumY + ( 100 - ( maximumY % 100 ) )


		// Gradient background
		var gradient = canvasElement.getContext( "2d" ).createLinearGradient( 0, 0, 0, 450 );
		gradient.addColorStop( 0, "rgba( 250, 174, 50, 1 )" );
		gradient.addColorStop( 1, "rgba( 250, 174, 50, 0 )" );

		// Consolidate all the configuration
		let chartConfig = {
			type: "line",
			data: {
				labels: xlabels,
				datasets: [ {
					// label: "Market Gold Rates",
					data: yValues,
					cubicInterpolationMode: "monotone",
					tension: 0.1,
					fill: "start",
				} ]
			},
			options: {
				responsive: true,
				maintainAspectRatio: true,
				aspectRatio: 1.3333,
				elements: {
					line: {
						borderWidth: 2,
						borderColor: "rgb( 255, 201, 128 )",
						backgroundColor: gradient
					},
					point: {
						radius: 3,
						backgroundColor: "rgb( 255, 201, 128 )",
					}
				},
				scales: {
					y: {
						type: "linear",
						min: minYOnScale,
						max: maxYOnScale,
						grid: {
							borderWidth: 2,
							color: "rgba( 255, 255, 255, 0.2 )",
							borderColor: "rgba( 255, 255, 255, 0.75 )",
							borderDash: [ 3, 7 ],
						},
						ticks: {
							color: "rgba( 255, 255, 255, 2 )",
							callback: function ( value ) {
								// if ( value % 10 === 0 )
									return GoldRates.formatAsRupee( value ).slice( 2, -3 )
								// else
								// 	return null
							}
						}
					},
					x: {
						grid: {
							borderWidth: 2,
							color: "rgba( 255, 255, 255, 0.2 )",
							borderColor: "rgba( 255, 255, 255, 0.75 )",
							borderDash: [ 3, 7 ],
						},
						ticks: {
							color: "rgba( 255, 255, 255, 1 )",
							callback: function ( value, index ) {
								if ( window.innerWidth < 1040 )
									return index % 12 === 0 ? this.getLabelForValue( value ) : null
								else
									return index % 6 === 0 ? this.getLabelForValue( value ) : null
							}
						}
					}
				},
				plugins: {
					legend: {
						display: false,
					}
				}
			}
		}

		let chart = new Chart( canvasElement, chartConfig )
	}

} );
