var elixir = require('laravel-elixir');
// Config Stull
elixir.config.srcDir = '/';
elixir.config.assetsDir = 'resources/';

/** Compile the less! **/
elixir(function(mix) {
    mix.less("laravel-admin.less");
});