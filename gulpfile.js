var elixir = require('laravel-elixir');
// Config Stull
elixir.config.srcDir = '/';
elixir.config.assetsDir = 'resources/';

/** Compile the less and JS! **/
elixir(function(mix) {
    mix.less("laravel-admin.less");
    mix.scripts([
    	"vendor/dataTables/media/js/jquery.dataTables.min.js",
    	"vendor/dataTables/media/js/datatablesBootstrap.js",
        "app.js"
    ]);
});