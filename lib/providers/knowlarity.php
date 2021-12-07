<?php

class Knowlarity {

	public static function parse ( $log ) {
		$call = [ ];

		$call[ 'id' ] = trim( $log[ 'callid' ] );
		$call[ 'ivrNumber' ] = trim( $log[ 'dispnumber' ] );

		$call[ 'phoneNumber' ] = trim( $log[ 'caller_id' ] );

		if ( preg_match( '/^\+/', $log[ 'destination' ] ) === 1 ) {
			$call[ 'taken' ] = true;
			$call[ 'missed' ] = false;
			$call[ 'wasRouted' ] = true;
			// The phone number of the agent who took the call
			$call[ 'agentPhoneNumber' ] = $log[ 'destination' ];
		}
		else if ( strtolower( $log[ 'destination' ] ) === 'call missed' ) {
			$call[ 'taken' ] = false;
			$call[ 'missed' ] = true;
		}
		else {
			$call[ 'taken' ] = false;
			$call[ 'missed' ] = false;
			$call[ 'wasRouted' ] = false;
		}

		$call[ 'startTime' ] = \DateTime::createFromFormat(
			'Y-m-d H:i:s',
			substr( $log[ 'start_time' ], 0, -13 ),
			new \DateTimeZone( 'Asia/Kolkata' )
		);
		$call[ 'endTime' ] = \DateTime::createFromFormat(
			'Y-m-d H:i:s',
			substr( $log[ 'end_time' ], 0, -13 ),
			new \DateTimeZone( 'Asia/Kolkata' )
		);

		// Call duration
		if ( !empty( $log[ 'call_duration' ] ) )
			$call[ 'duration' ] = intval( $log[ 'call_duration' ] );

		// A link to the recording of the call
		if ( !empty( $log[ 'resource_url' ] ) )
			$call[ 'recordingURL' ] = $log[ 'resource_url' ];

		return $call;
	}

}
