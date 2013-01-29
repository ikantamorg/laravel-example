This is The Crud bundle which provides the Crud_Base_Controller

Any controller extending this bundle needs to define some properties and methods

Each Controller acts on a resource and implements the full Crud for it, along with facility for activation
and deactivation

The Crud bundle uses the Uploader bundle and Hybrid bundle's Form and Table library

The properties needed are:

	public $fields = [..] 
	/**
	* The fields which are gonna be set on the resource (mass assignment is not used, 
	* so take care of your setters and getters)
	*/

	public $relations = [..]
	/**
	* Name of all the relations which this controller handles for the resource
	* (Only works for 'many-many' and 'belongs-to' right now)
	*/

	public $base_uri = '..';
	/**
	* The Base Uri for this controller
	*/

	public $view_base = '..';
	/**
	* The Base of all different views for the resource being handled
	*/

	public function resource($id = null)
	/**
	* Should return the resource which the show and edit/update actions use
	* Should return a new Resource object when $id is null
	*/

	public function listing()
	/**
	* Should return the listing that needs to be shown in index page.
	* If pagination is enabled, this should return a paginated list.
	* If search is enabled, this should make a query which joins all the tables
	* that the search is performed on and pass that query to the function
	* $this->prepare_search_query($query, $serached_field, Input::get($searched_field))
	*/

	public function form()
	/**
	* Should return a Hybrid\Form object which should take care of repopulation and stuff
	*/

	public function listing_table()
	/**
	* Should return a Hybrid\Table object populated with whatever listing you want to displau
	*/

	public function show_table()
	/**
	* Should return a Hybrid\Table object populated with an array conclusion of the resource
	*/

	public function search_aliases()
	/**
	* This returns an array which basically maps the searched field to its appropriate field(s)
	* in the joined query object passed on to $this->prepare_search_query()
	*/

	
	protected static $valid_callbacks = [
		'before_upload', 'after_upload',

		'before_persist', 'after_persist',

		'before_action', 'after_action',

		'before_index', 'after_index',

		'before_show', 'after_show',

		'before_new', 'after_new',

		'before_create', 'after_create',

		'before_edit', 'after_edit',

		'before_update', 'after_update',

		'before_destroy', 'after_destroy',

		'before_activate', 'after_activate',

		'before_deactivate', 'after_deactivate'
	];

	/**
	* HOOKS: The Crud Controller provides several hooks which can be used throughout your request response cycle.
	* A list is given below.
	*/

	
	protected $_extend_listing_table = true;
	/**
	* Flag: if set to false, the index table wont be extended to add in 'Edit', 'Delete' and 'Destroy' links
	*/

	protected  $_upload_driver = 'laravel';
	/**
	* Upload driver to be used by the controller ('aws' or 'laravel')
	*/


	protected $_resource;
	/**
	* Cache for resource
	*/

	protected $_listing;
	/**
	* Cache for listing
	*/

	protected $_action;
	/**
	* Cache for current action
	*/

	protected $_response;
	/**
	* Cache for prepared response
	*/