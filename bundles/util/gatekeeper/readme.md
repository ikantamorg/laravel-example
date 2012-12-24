This has been a pretty good bundle for me, A different attempt at authentication.

Its built following the pradigm that routes are the most important thing of any application

How it works is that in config/restricted-paths.php, you provide an array of paths that are protected
by authentication.

NOTE: IT USES LARAVEL's Auth CLASS TO CHECK IF THE CURRENT USER HAS BEEN AUTHENTICATED OR NOT. SO IN SHORT,
		STICK WITH CONVENTIONS OF LARAVEL's Auth CLASS, I FIND IT GOOD ENOUGH

For example:

	return array(
		'admin',
		'fan',
		'controlpanel'
	);


now any uri beginning with these would be restricted. 

But how to setup the gatekeeper? Pretty Easy using the 'before' filter

	Route::filter('before', function()
	{
		$result = Gatekeeper::inspect(URI::current())->result();
		if($result !== true) return $result;
	});

Gatekeeper decides if a request is an api request or not based on the segments given in config/api-calls.php
if any of the segments of the URI are present in the config, its classified as an api-call.

$result, when not true, is an object of Response class which throws a Redirect to the uri set in
config/redirects.php under 'login' key when its a non-api call.
And when its an api call, it throws a json response
with header 403 and data ['error' => 'forbidden'].

When redirecting, it sets the uri which was forbidden as a flash-data and in the before filter. And when login
page is being loaded, it sets a runtime config 'auth.uri.success' which can later be retrieved as.

	Config::get('auth.uri.success');

this can then be used by the action for login to setup a process for redirecting a logged in a successfully
logged in user to the uri he requested