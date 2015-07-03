var elixir = require('laravel-elixir'),
        minifyJs = require('gulp-uglify');
// Config Stull
elixir.config.srcDir = '/';
elixir.config.assetsDir = 'resources/';

/** Compile the less and JS! **/
elixir(function (mix) {
    mix.less("laravel-admin.less");
    mix.scripts([
        "vendor/datatables/jquery.dataTables.min.js",
        "vendor/datatables/dataTables.bootstrap.js",
        "vendor/bootstrapSelect/dist/js/bootstrap-select.js",
        "vendor/bootstrapSelect/dist/js/i18n/defaults-es_CL.js",
        "vendor/bootbox/bootbox.min.js",
        "vendor/speakingurl/speakingurl.min.js",
        "vendor/slugify/dist/slugify.min.js",
        "vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js",
        "vendor/datepicker/bootstrap-datepicker.js",
        "vendor/daterangepicker/daterangepicker.js",
        "vendor/daterangepicker/moment.min.js",
        "vendor/fullcalendar/fullcalendar.min.js",
        "vendor/slimScroll/jquery.slimscroll.js",
        "vendor/timepicker/bootstrap-timepicker.min.js",
        "adminlte.js",
        "app.js"
    ]);
});

var gulp = require('gulp');
var sourcemaps = require('gulp-sourcemaps');
var concatCss = require('gulp-concat-css');

gulp.task('build-css', ['conbine-css']);

gulp.task('conbine-css', function () {
    return gulp.src('./resources/css/*.css')
            .pipe(sourcemaps.init())
            .pipe(concatCss('vendors.css'))
            .pipe(gulp.dest('./public/css/'));
});

