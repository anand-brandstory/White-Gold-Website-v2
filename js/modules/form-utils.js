
BFSForm.validators = {

	phoneNumber ( phoneCountryCode, phoneNumberLocal ) {
		phoneCountryCode = phoneCountryCode.trim();
		phoneNumberLocal = phoneNumberLocal.trim();

		var phoneNumber = phoneCountryCode + phoneNumberLocal;

		if ( phoneNumberLocal.length <= 1 )
			throw new Error( "Please provide a valid phone number." );

		// For India
		if ( phoneCountryCode === "+91" && phoneNumberLocal.length !== 10 )
			throw new Error( "Please provide a valid 10-digit number." )

		if ( phoneNumberLocal.length > 1 )
			if ( ! (
				phoneNumber.match( /^\+\d[\d\-]+\d$/ )	// this is not a perfect regex, but it's close
				&& phoneNumberLocal.replace( /\D/g, "" ).length > 3
			) )
				throw new Error( "Please provide a valid phone number." );

		return phoneNumber;
	}

};
