
/**
 |
 | Additional functions specific to this project
 |
 |
 */
( function () {

	Person.prototype.getSession = function getSession ( name ) {
		if ( typeof this.sessions !== "object" )
			return null
		else
			return this.sessions[ name ]
	}

	Person.prototype.startSession = function startSession ( name ) {
		this.sessions = this.sessions || { }
		this.sessions[ name ] = { lastStartedAt: new Date }
		return this.getSession( name )
	}

	Person.prototype.sessionHasExpiredOrNotEvenBegun = function sessionHasExpiredOrNotEvenBegun ( name, sessionDuration ) {
		sessionDuration = sessionDuration instanceof Date ?
						sessionDuration.getTime() :
						sessionDuration

		let session = this.getSession( name )
		if ( !session )
			return true

		return (
			Date.now() > ( session.lastStartedAt.getTime() + sessionDuration )
		)
	}

}() )
