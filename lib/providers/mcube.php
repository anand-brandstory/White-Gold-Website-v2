<?php

class MCube {

	public static function parse ( $log ) {
		$call = [ ];

		$call[ 'id' ] = trim( $log[ 'callid' ] );
		$call[ 'status' ] = strtoupper( trim( $log[ 'dialstatus' ] ) );
		$call[ 'startTime' ] = \DateTime::createFromFormat(
			'Y-m-d H:i:s',
			$log[ 'starttime' ],
			new \DateTimeZone( 'Asia/Kolkata' )
		);
		$call[ 'endTime' ] = \DateTime::createFromFormat(
			'Y-m-d H:i:s',
			$log[ 'endtime' ],
			new \DateTimeZone( 'Asia/Kolkata' )
		);
		$call[ 'duration' ] = $call[ 'endTime' ]->getTimestamp() - $call[ 'startTime' ]->getTimestamp();


		if (
			$log[ 'callfrom' ][ 0 ] === '0'
			and strlen( $log[ 'callfrom' ] ) === 11
		)
			$call[ 'phoneNumber' ] = '+91' . substr( $log[ 'callfrom' ], 1 );
		else if (
			strlen( $log[ 'callfrom' ] ) === 10
			and $log[ 'callfrom' ][ 0 ] !== '0'
		)
			$call[ 'phoneNumber' ] = '+91' . $log[ 'callfrom' ];
		else
			$call[ 'phoneNumber' ] = $log[ 'callfrom' ];

		$call[ 'agentPhoneNumber' ] = $log[ 'empnumber' ];

		if ( in_array( $call[ 'status' ], [ 'BUSY', 'NOANSWER', 'CANCEL' ] ) ) {
			$call[ 'taken' ] = false;
			$call[ 'missed' ] = true;
		}
		else if ( $call[ 'status' ] === 'ANSWER' ) {
			$call[ 'taken' ] = true;
			$call[ 'missed' ] = false;
			$call[ 'recordingURL' ] = 'https://mcube.vmctechnologies.com/sounds/' . $log[ 'filename' ];
		}
		else if ( $call[ 'status' ] === 'CONNECTING' ) {
			$call[ 'taken' ] = false;
			$call[ 'missed' ] = false;
		}

		$call[ 'person' ] = [ ];

		if ( strlen( $log[ 'callername' ] ) > 0 )
			$call[ 'person' ][ 'name' ] = trim( $log[ 'callername' ] );

		if ( strlen( $log[ 'caller_email' ] ) > 0 )
			$call[ 'person' ][ 'emailAddresses' ] = [ trim( $log[ 'caller_email' ] ) ];

		return $call;
	}

}
