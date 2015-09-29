	<!--**
    	* Add Errors & Logging from Validator Laravel 5.*
    	* make for Wim_cartago
    **-->
    
 @if( Config::get('laravel-admin.viewErrors') )
	 @if($errors->any())
	    <div class="alert alert-danger alert-dismissible" role="alert">
	    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <strong>Error!</strong>
		         <ul>
	     	        @foreach($errors->all() as $error)
	                    <li>{{ $error }}</li>
	                @endforeach()
	    	    </ul>
	    </div>
	@endif
@endif