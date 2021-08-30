
/*
 |
 |
 |
 */

( function () {

	/*
	 |
	 | Main flow
	 |
	 */
	ifUserIsLoggedIn()
		.then( runUserFlow )
		.catch( () => {} )

	/*
	 |
	 | Check if the user is logged in
	 |
	 */
	async function ifUserIsLoggedIn () {

		const $liveGoldSection = $( ".live-gold-section" )

		let user = __CUPID.Person.isLoggedIn()
		if ( ! user ) {
			$liveGoldSection.addClass( "otp-verify-message" )
			throw new Error()
		}

		const sessionDurationLimit = window.__BFS.CONF.goldRates.sessionDurationLimit
		if ( await user.sessionHasExpiredOrHasNotBegun( "liveGoldRate", sessionDurationLimit ) ) {
			$liveGoldSection.addClass( "otp-verify-message" )
			throw new Error()
		}

	}

	/*
	 |
	 | The user flow
	 | 	This runs at regular intervals until the session ends
	 |
	 */
	async function runUserFlow () {

		/*
		 | Have the figures and graphs already been set up? If yes, then stop them.
		 */
		if ( window.__BFS.goldRateTracker )
			window.__BFS.goldRateTracker.stopTracking()

		/*
		 | Save references to certain DOM nodes
		 */
		const $liveGoldSection = $( ".live-gold-section" )

		// Blur the page, clear all modals
		$liveGoldSection.addClass( "hide" )
		$liveGoldSection.removeClass( [
			"otp-verify-message",
			"off-hrs-message",
			"holiday-message",
			"end-session-message",
			"number-blocked-message"
		].join( " " ) )

		let user = __CUPID.user

		const sessionDurationLimit = window.__BFS.CONF.goldRates.sessionDurationLimit
		let userSession = await user.getSession( "liveGoldRate" )
		if ( ! ( userSession.lastStartedAt instanceof Date ) )
			userSession = await user.startSession( "liveGoldRate" )
		else if ( await user.sessionHasExpiredOrHasNotBegun( "liveGoldRate", sessionDurationLimit ) )
			return $liveGoldSection.addClass( "end-session-message" )


		// let {
		// 	status: operationalStatus,
		// 	reason
		// } = await GoldRates.areOperational()
		// if ( operationalStatus === false )
		// 	return showAppropriateMessage( reason )

		// const trialDuration = window.__BFS.CONF.goldRates.trialDuration
		// if ( ! await user.trialHasBegun() )
		// 	await user.initTrial()
		// else if ( await user.trialPeriodIsOver( trialDuration ) )
		// 	return $liveGoldSection.addClass( "number-blocked-message" )


		/*
		 | Show gold rate figures and plot the graph
		 */
		$liveGoldSection.removeClass( "hide" )
		if ( ! window.__BFS.goldRateTracker ) {
			window.__BFS.clock.run()
			window.__BFS.setupLiveGoldRateFeed()
			window.__BFS.initChart()
			window.__BFS.bindQuotationCalculatorToGoldRateFeed()
		}
		else
			window.__BFS.goldRateTracker.startTracking()


		/*
		 | Schedule the next check
		 */
		let sessionEndTime = userSession.lastStartedAt.getTime() + sessionDurationLimit
		let durationUntilNextCheck
		if (
			sessionEndTime > Date.now()
			&& ( sessionEndTime - Date.now() ) < sessionDurationLimit
		)
			durationUntilNextCheck = sessionEndTime - Date.now()
		else
			durationUntilNextCheck = sessionDurationLimit

		// console.log( "::runUserFlow:: The next check will be at:\n" + new Date( Date.now() + durationUntilNextCheck ) )
		setTimeout( runUserFlow, durationUntilNextCheck )

	}

	/*
	 |
	 | Exports
	 |
	 */
	window.__BFS.runUserFlow = runUserFlow

}() )
