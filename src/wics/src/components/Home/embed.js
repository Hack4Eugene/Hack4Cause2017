//
// to run this sample
//  1. copy the file in your own directory - say, example.js
//  2. change "***" to appropriate values
//  3. install async and request packages
//     npm install async
//     npm install request
//  4. execute
//     node example.js 
// 

var   	async = require("async"),		// async module
	request = require("request"),		// request module
	email = "hebbfiona@gmail.com",				// your account email
	password = "wicsisdope",			// your account password
	integratorKey = "5060bf88-51e7-487b-8eb7-e317d9fc66b9",			// your account Integrator Key (found on Preferences -> API page)
	recipientName = "alegge@uoregon.edu",			// recipient (signer) name
	templateId = "561d8a75-cc9f-475f-bf8d-1052c8e37163",			// provide valid templateId from a template in your account
	templateRoleName = "parent",		// template role that exists on template referenced above
	baseUrl = "",				// we will retrieve this
	envelopeId = "";			// created from step 2

async.waterfall(
[
	//////////////////////////////////////////////////////////////////////
	// Step 1 - Login (used to retrieve accountId and baseUrl)
	//////////////////////////////////////////////////////////////////////
	function(next) {
		var url = "https://demo.docusign.net/restapi/v2/login_information";
		var body = "";	// no request body for login api call
		
		// set request url, method, body, and headers
		var options = initializeRequest(url, "GET", body, email, password);
		
		// send the request...
		request(options, function(err, res, body) {
			if(!parseResponseBody(err, res, body)) {
				return;
			}
			baseUrl = JSON.parse(body).loginAccounts[0].baseUrl;
			next(null); // call next function
		});
	},
	
	//////////////////////////////////////////////////////////////////////
	// Step 2 - Send envelope with one Embedded recipient (using clientUserId property)
	//////////////////////////////////////////////////////////////////////
	function(next) {
		var url = baseUrl + "/envelopes";
		var body = JSON.stringify({
				"emailSubject": "DocuSign API call - Embedded Sending Example",
				"templateId": templateId,
				"templateRoles": [{
					"email": email,
					"name": recipientName,
					"roleName": templateRoleName,
					"clientUserId": "1001"	// user-configurable
				}],
				"status": "sent"
			});
		
		// set request url, method, body, and headers
		var options = initializeRequest(url, "POST", body, email, password);
		
		// send the request...
		request(options, function(err, res, body) {
			if(!parseResponseBody(err, res, body)) {
				return;
			}
			// parse the envelopeId value from the response
			envelopeId = JSON.parse(body).envelopeId;
			next(null); // call next function
		});
	},
	
	//////////////////////////////////////////////////////////////////////
	// Step 3 - Get the Embedded Signing View (aka the recipient view)
	//////////////////////////////////////////////////////////////////////
	function(next) {
		var url = baseUrl + "/envelopes/" + envelopeId + "/views/recipient";
		var method = "POST";
		var body = JSON.stringify({
				"returnUrl": "http://www.docusign.com/devcenter",
				"authenticationMethod": "email",					
				"email": email,					
				"userName": recipientName,		
				"clientUserId": "1001",	// must match clientUserId in step 2!
			});  
		
		// set request url, method, body, and headers
		var options = initializeRequest(url, "POST", body, email, password);
		
		// send the request...
		request(options, function(err, res, body) {
			if(!parseResponseBody(err, res, body))
				return;
			else
				console.log("\nNavigate to the above URL to start the Embedded Signing workflow...");
		});
	}
]);

//***********************************************************************************************
// --- HELPER FUNCTIONS ---
//***********************************************************************************************
function initializeRequest(url, method, body, email, password) {	
	var options = {
		"method": method,
		"uri": url,
		"body": body,
		"headers": {}
	};
	addRequestHeaders(options, email, password);
	return options;
}

///////////////////////////////////////////////////////////////////////////////////////////////
function addRequestHeaders(options, email, password) {	
	// JSON formatted authentication header (XML format allowed as well)
	dsAuthHeader = JSON.stringify({
		"Username": email,
		"Password": password, 
		"IntegratorKey": integratorKey	// global
	});
	// DocuSign authorization header
	options.headers["X-DocuSign-Authentication"] = dsAuthHeader;
}

///////////////////////////////////////////////////////////////////////////////////////////////
function parseResponseBody(err, res, body) {
	console.log("\r\nAPI Call Result: \r\n", JSON.parse(body));
	if( res.statusCode != 200 && res.statusCode != 201)	{ // success statuses
		console.log("Error calling webservice, status is: ", res.statusCode);
		console.log("\r\n", err);
		return false;
	}
	return true;
}