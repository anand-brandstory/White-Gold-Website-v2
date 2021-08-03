<!-- <img class="block" src="https://via.placeholder.com/800x600" alt=""> -->
<style type="text/css">
	/* ( if doing a no-scroll oner ) */
	.chart-container {
		position: relative;
		width: 100%;
		/*height: 0;*/
		/*height: 415px;*/
		/*min-height: 410px;*/
		/*max-height: 100vh;*/
		/*padding-top: 75%;*/
		/*background-color: rgba(255, 0, 0, 0.5);*/
		/*box-sizing: content-box;*/
	}

	/*.chart-container canvas {
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
	}*/
</style>

<div class="chart-container">
	<canvas id="js_chart_canvas"></canvas>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/dat.gui@0.7.7/build/dat.gui.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@3.4.1/dist/chart.min.js"></script>
<script type="module">

	function isNumber ( number ) {
		if ( ! ( number === number ) )
			return false
		if ( Number.isNaN( number ) )
			return false
		return typeof number === "number"
	}

	function clamp ( number, bounds ) {
		number = +number;
		let lower = +bounds.lower
		let upper = +bounds.upper

		// if ( isNumber( lower ) && isNumber( upper ) )
		// 	if ( lower > upper ) {
		// 		let tmp = lower
		// 		lower = upper
		// 		upper = tmp
		// 	}

		if ( ! isNumber( number ) )
			return isNumber( lower ) ? lower : 0

		if ( isNumber( lower ) )
			if ( lower > number )
				return lower

		if ( isNumber( upper ) )
			if ( upper < number )
				return upper

		return number
	}

	function getRandomNumber ( min, max ) {
		return Math.floor(
			Math.random()
			* ( 1 + max - min )
		) + min;
	}

	function getRandomlyGeneratedDataset ( amount, seedValue ) {
		// Default values
		if ( typeof seedValue != "number" )
			seedValue = 100
		if ( typeof amount != "number" )
			amount = 1000
		else
			amount = Math.abs( amount )

		let seedTimestamp = new Date
		seedTimestamp.setTime(
			seedTimestamp.getTime()
			- (
				Math.floor( amount / 2 )
				* ( 5 * 1000 )
			)
		)

		let values = [ {
			number: seedValue,
			timestamp: seedTimestamp
		} ]
		let nextValue = seedValue
		let nextTimestamp = seedTimestamp
		while ( amount ) {
			nextValue += getRandomNumber( -10, 10 )
			let timestamp = new Date
			timestamp.setTime( nextTimestamp.getTime() + ( 5 * 1000 ) )
			nextTimestamp = timestamp

			values.push( {
				number: nextValue,
				timestamp: nextTimestamp
			} )

			amount -= 1
		}
		return values
	}

	function getNewData () {
		let date = new Date
		let hour = date.getHours()
		let minutes = date.getMinutes().toString().padStart( 2, 0 )
		let seconds = date.getSeconds().toString().padStart( 2, 0 )
		let meridian = hour > 11 ? "pm" : "am"
		let currentTime = `${hour}:${minutes}:${seconds} ${meridian}`
		return {
			x: currentTime,
			y: getRandomlyGeneratedDataset( 1, 100 )[ 1 ].number
		}
	}

	/*
	 * ----- Query new data (in real-time)
	 */
	let iterations = 41;
	let currentIterationCount = 1;
	function queryAndPlotDataInRealtime ( chart ) {
		if ( currentIterationCount >= 41 )
			return;
		chart.data.datasets[ 0 ].data.push( getNewData() )
		window.requestAnimationFrame( () => chart.update() )
		// window.requestAnimationFrame( chart.update )
		// chart.update()
		setTimeout( queryAndPlotDataInRealtime.bind( null, chart ), 5 * 1000 )
		currentIterationCount += 1;
	}



	( async function main () {

		let canvasElement = document.getElementById( "js_chart_canvas" )

		var gradient = canvasElement.getContext( "2d" ).createLinearGradient(0, 0, 0, 400);
		gradient.addColorStop(0, 'rgba(250,174,50,1)');
		gradient.addColorStop(1, 'rgba(250,174,50,0)');



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
			18, 18.25, 18.5, 18.75,
		]
		let labels = xValues.map( function ( x ) {
			let meridian = x >= 12 ? "pm" : "am"
			let minutes = ( x - Math.floor( x ) ) * 60
			let hour = Math.floor( x ) % 12
			return `${hour}:${minutes} ${meridian}`
		} )
		let yValues = getRandomlyGeneratedDataset( xValues.length - 1, 100 )
					.map( x => x.number )
		let d = labels.map( function ( x, _i ) {
			return { x, y: yValues[ _i ] }
		} )

		let chartConfig = {
			type: "line",
			data: {
				// labels: labels,
				datasets: [ {
					// label: "Market Gold Rates",
					// data: yValues,
					data: [ ],
					cubicInterpolationMode: "monotone",
					tension: 0.1,
					fill: "start",
				} ]
			},
			options: {
				responsive: true,
				maintainAspectRatio: true,
				aspectRatio: 1.3333,
				// layout: {
					// padding: 50
				// },
				elements: {
					line: {
						borderWidth: 2,
						borderColor: "rgb(255,201,128)",
						backgroundColor: gradient
					},
					point: {
						radius: 3,
						backgroundColor: "rgb(255,201,128)",
					}
				},
				scales: {
					y: {
						type: "linear",
						min: Math.min(
							...yValues.filter( y => ! isNaN( y ) )
						) - 50,
						max: Math.max(
							...yValues.filter( y => ! isNaN( y ) )
						) + 50,
						grid: {
							borderWidth: 2,
							color: "rgba(255,255,255,0.2)",
							borderColor: "rgba(255,255,255,0.75)",
							borderDash: [3,7],
						},
						ticks: {
							color: "rgba(255,255,255,2)",
						}
					},
					x: {
						grid: {
							borderWidth: 2,
							color: "rgba(255,255,255,0.2)",
							borderColor: "rgba(255,255,255,0.75)",
							borderDash: [3,7],
						},
						ticks: {
							color: "rgba(255,255,255,1)",
						}
					}
				},
				plugins: {
					legend: {
						display: false,
					}
				},
				// not used
				_onResize: function ( chart, size ) {
					let canvasComputedStyles = window.getComputedStyle( chart.canvas )
					let minWidth = parseFloat( canvasComputedStyles.minWidth )
					let maxWidth = parseFloat( canvasComputedStyles.maxWidth )
					let width = parseFloat( canvasComputedStyles.width )
					let minHeight = parseFloat( canvasComputedStyles.minHeight )
					let maxHeight = parseFloat( canvasComputedStyles.maxHeight )
					let height = parseFloat( canvasComputedStyles.height )

					chart.canvas.width = clamp( width, { lower: minWidth, upper: maxWidth } )
					chart.canvas.height = clamp( height, { lower: minHeight, upper: maxHeight } )
				}
			}
		}

		// window.chart = new Chart( canvasElement, chartConfig )
		let chart = new Chart( canvasElement, chartConfig )

		queryAndPlotDataInRealtime( chart );

	}() );

</script>