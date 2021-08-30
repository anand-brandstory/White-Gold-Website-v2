
( function () {

	let Person = __CUPID.Person

	Person.prototype.trialHasBegun = async function trialHasBegun () {
		let attributes = await this.getExtendedAttributes( "liveGoldRateTrialStartedAt" )
		return !! attributes.liveGoldRateTrialStartedAt
	}

	Person.prototype.trialPeriodIsOver = async function trialPeriodIsOver ( duration ) {
		let attributes = await this.getExtendedAttributes( "liveGoldRateTrialStartedAt" )
		if ( ! attributes.liveGoldRateTrialStartedAt )
			return true
		if ( typeof attributes.liveGoldRateTrialStartedAt === "string" ) {
			attributes.liveGoldRateTrialStartedAt = new Date( attributes.liveGoldRateTrialStartedAt )
			this.appendAdditionalData( { liveGoldRateTrialStartedAt: attributes.liveGoldRateTrialStartedAt } )
		}
		return Date.now() > ( attributes.liveGoldRateTrialStartedAt.getTime() + duration )
	}

	Person.prototype.initTrial = function initTrial () {
		this.appendAdditionalData( { liveGoldRateTrialStartedAt: new Date } );
		return this.submitData();
	}

	Person.prototype.getSession = async function getSession ( name ) {
		let { sessions } = await this.getExtendedAttributes( "sessions" )
		if ( ! sessions || ! sessions[ name ] )
			return { }
		return { lastStartedAt: new Date( sessions[ name ] ) }
	}

	Person.prototype.startSession = async function startSession ( name ) {
		let attributes = await this.getExtendedAttributes( "sessions" )
		attributes.sessions = Object.assign( { }, attributes.sessions, {
			[ name ]: new Date
		} )
		this.appendAdditionalData( attributes )
		await this.submitData()
		return this.getSession( name )
	}

	Person.prototype.sessionHasExpiredOrHasNotBegun = async function sessionHasExpiredOrHasNotBegun ( name, timestamp ) {
		timestamp = timestamp instanceof Date ? timestamp.getTime() : timestamp
		let session = await this.getSession( name )
		if ( ! ( session.lastStartedAt instanceof Date ) )
			return true
		return Date.now() > ( session.lastStartedAt.getTime() + timestamp )
	}

}() )
