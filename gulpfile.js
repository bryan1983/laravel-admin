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
    	"vendor/bootstrapSelect/dist/js/bootstrap-select.js",
    	"vendor/bootstrapSelect/dist/js/i18n/defaults-es_CL.js",
    	"vendor/bootbox/bootbox.min.js",
    	"vendor/sluglify/speakingurl/speakingurl.min.js",
    	"vendor/sluglify/sluglify.js",
        "app.js"
    ]);
});