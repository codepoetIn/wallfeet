<?php

class HttpStatus {

	const RESPONSE_CONTINUE = 100;
	const RESPONSE_SWITCHING_PROTOCOLS = 101;
	const RESPONSE_PROCESSING = 102;
	const RESPONSE_OK = 200;
	const RESPONSE_CREATED = 201;
	const RESPONSE_ACCEPTED = 202;
	const RESPONSE_NON_AUTHORITATIVE_INFORMATION = 203;
	const RESPONSE_NO_CONTENT = 204;
	const RESPONSE_RESET_CONTENT = 205;
	const RESPONSE_PARTIAL_CONTENT = 206;
	const RESPONSE_MULTI_STATUS = 207;
	const RESPONSE_IM_USED = 226;
	const RESPONSE_MULTIPLE_CHOICES = 300;
	const RESPONSE_MOVED_PERMANENTLY = 301;
	const RESPONSE_FOUND = 302;
	const RESPONSE_SEE_OTHER = 303;
	const RESPONSE_NOT_MODIFIED = 304;
	const RESPONSE_USE_PROXY = 305;
	const RESPONSE_RESERVED = 306;
	const RESPONSE_TEMPORARY_REDIRECT = 307;
	const RESPONSE_BAD_REQUEST = 400;
	const RESPONSE_UNAUTHORIZED = 401;
	const RESPONSE_PAYMENT_REQUIRED = 402;
	const RESPONSE_FORBIDDEN = 403;
	const RESPONSE_NOT_FOUND = 404;
	const RESPONSE_METHOD_NOT_ALLOWED = 405;
	const RESPONSE_NOT_ACCEPTABLE = 406;
	const RESPONSE_PROXY_AUTHENTICATION_REQUIRED = 407;
	const RESPONSE_REQUEST_TIMEOUT = 408;
	const RESPONSE_CONFLICT = 409;
	const RESPONSE_GONE = 410;
	const RESPONSE_LENGTH_REQUIRED = 411;
	const RESPONSE_PRECONDITION_FAILED = 412;
	const RESPONSE_REQUEST_ENTITY_TOO_LARGE = 413;
	const RESPONSE_REQUEST_URI_TOO_LONG = 414;
	const RESPONSE_UNSUPPORTED_MEDIA_TYPE = 415;
	const RESPONSE_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
	const RESPONSE_EXPECTATION_FAILED = 417;
	const RESPONSE_UNPROCESSABLE_ENTITY = 422;
	const RESPONSE_LOCKED = 423;
	const RESPONSE_FAILED_DEPENDENCY = 424;
	const RESPONSE_UPGRADE_REQUIRED = 426;
	const RESPONSE_INTERNAL_SERVER_ERROR = 500;
	const RESPONSE_NOT_IMPLEMENTED = 501;
	const RESPONSE_BAD_GATEWAY = 502;
	const RESPONSE_SERVICE_UNAVAILABLE = 503;
	const RESPONSE_GATEWAY_TIMEOUT = 504;
	const RESPONSE_HTTP_VERSION_NOT_SUPPORTED = 505;
	const RESPONSE_VARIANT_ALSO_NEGOTIATES = 506;
	const RESPONSE_INSUFFICIENT_STORAGE = 507;
	const RESPONSE_NOT_EXTENDED = 510;

	public static function getStatusMessage($status){
		
		$messages = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		102 => 'Processing',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		207 => 'Multi-Status',
		226 => 'IM Used',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => 'Reserved',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'Unauthorized',
		402 => 'Payment Required',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		422 => 'Unprocessable Entity',
		423 => 'Locked',
		424 => 'Failed Dependency',
		426 => 'Upgrade Required',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported',
		506 => 'Variant Also Negotiates',
		507 => 'Insufficient Storage',
		510 => 'Not Extended'
		);

		return isset($messages[$status]) ?  $messages[$status] : null;
	}
	
	public static function getResponse($status){
		
		$messages = array(
		100 => 'Continue',
		101 => 'Switching Protocols',
		102 => 'Processing',
		200 => 'OK',
		201 => 'Created',
		202 => 'Accepted',
		203 => 'Non-Authoritative Information',
		204 => 'No Content',
		205 => 'Reset Content',
		206 => 'Partial Content',
		207 => 'Multi-Status',
		226 => 'IM Used',
		300 => 'Multiple Choices',
		301 => 'Moved Permanently',
		302 => 'Found',
		303 => 'See Other',
		304 => 'Not Modified',
		305 => 'Use Proxy',
		306 => 'Reserved',
		307 => 'Temporary Redirect',
		400 => 'Bad Request',
		401 => 'You must be authorized to view this page.',
		402 => 'Payment Required',
		403 => 'You are not authorized to view this page.',
		404 => 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'The request has timedout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		422 => 'Unprocessable Entity',
		423 => 'Locked',
		424 => 'Failed Dependency',
		426 => 'Upgrade Required',
		500 => 'The server encountered an error processing your request.',
		501 => 'The requested method is not implemented.',
		502 => 'Bad Gateway',
		503 => 'This service is currently unavailable',
		504 => 'The gateway has timed out.',
		505 => 'HTTP Version Not Supported',
		506 => 'Variant Also Negotiates',
		507 => 'Insufficient Storage',
		510 => 'Not Extended'
		);

		return isset($messages[$status]) ?  $messages[$status] : null;
		
	}

}



?>