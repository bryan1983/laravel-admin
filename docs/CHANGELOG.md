# Changelog

All Notable changes to `laravel-admin` will be documented in this file

# 1.0.0 Official release

This is the first official stable release of the package, here are the changes and upgrades made, please keep in mind this is a major release and it introduces braking changes.

- PSR2 Fixes, see [This commit](https://github.com/joselfonseca/laravel-admin/commit/e96eafc3b18e9f1b0ff48c6bde5770e9acba79f3).
- Refactor users administration to use repositories and lots of cleanup, see [This commit](https://github.com/joselfonseca/laravel-admin/commit/1d5c4b56561ce504e40b73b224fb206e494626a9).
- Refactor roles and permissions administration to use repositories and lots of cleanup, see [https://github.com/joselfonseca/laravel-admin/commit/52df0c48e9a3d41aba7b0f53398085b5a66f8eaf](https://github.com/joselfonseca/laravel-admin/commit/52df0c48e9a3d41aba7b0f53398085b5a66f8eaf).
- Some Layout improvements.
- Table Builder was removed.
- Change users and roles tables to use Laravel DataTables.

Upgrade guide: To upgrade from previous versions please:
 
- Change the package version in composer.json to match 1.0.* and run composer update.
- Most of the views where changed, if you made changes yourself please check the changes made in the repository and try to merge them to fit your needs
- User Model was changed to namespace `Joselfonseca\LaravelAdmin\Entities\User`, so make sure your User model extends the new namespace.
- Role and Permission model were also changed to a new namespace `Joselfonseca\LaravelAdmin\Entities\Role` and `Joselfonseca\LaravelAdmin\Entities\Permission` so update your models accordingly.
- Table builder was removed so replace it for Laravel Data Tables where ever you used it.
- Update your config file to reflect the new one [https://github.com/joselfonseca/laravel-admin/blob/master/config/config.php](https://github.com/joselfonseca/laravel-admin/blob/master/config/config.php)

# 0.6

- Update Permissions assignation View, see [This Commit](https://github.com/joselfonseca/laravel-admin/commit/b6c4481c61bd43c187179db9316e7bc83f49c4f8)
- Update views to use Boxes instead of panels, see [This Commit](https://github.com/joselfonseca/laravel-admin/commit/23606198f145bda893f765407a86b96325e3efe6)
- if Menu permissions false, let it see by everyone, see [This Commit](https://github.com/joselfonseca/laravel-admin/commit/7266039ff19c971fe433a7af497f5d26e272dadd)

# 0.5

- Some Improvements

# 0.4.3

- Merge a pull request to has the errors notice global and it will appear if config says so.
- Added a Middleware to the protected endpoints, it will return to /backend/login for any protected route.
- Small Bug Fixes

# 0.4

- All the styles and plugins were re merged, you have to publish the assets and views.
- New plugins were added
```
    elixir(function (mix) {
        mix.less("laravel-admin.less");
        mix.less("app.less");
        mix.styles([
            "../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css",
            "../plugins/bootstrapSelect/dist/css/bootstrap-select.min.css",
            "../plugins/colorpicker/bootstrap-colorpicker.css",
            "../plugins/datepicker/datepicker3.css",
            "../plugins/daterangepicker/daterangepicker-bs3.css",
            "../plugins/fullcalendar/fullcalendar.css",
            "../plugins/fullcalendar/fullcalendar.print.css",
            "../plugins/morris/morris.css",
            "../plugins/select2/select2.css",
            "../plugins/timepicker/bootstrap-timepicker.min.css"
        ]);
        mix.scripts([
            "../plugins/datatables/jquery.dataTables.min.js",
            "../plugins/datatables/dataTables.bootstrap.js",
            "../plugins/bootstrapSelect/dist/js/bootstrap-select.js",
            "../plugins/bootstrapSelect/dist/js/i18n/defaults-es_CL.js",
            "../plugins/bootbox/bootbox.min.js",
            "../plugins/speakingurl/speakingurl.min.js",
            "../plugins/slugify/dist/slugify.min.js",
            "../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js",
            "../plugins/datepicker/bootstrap-datepicker.js",
            "../plugins/daterangepicker/daterangepicker.js",
            "../plugins/daterangepicker/moment.min.js",
            "../plugins/fullcalendar/fullcalendar.min.js",
            "../plugins/slimScroll/jquery.slimscroll.js",
            "../plugins/chartjs/Chart.min.js",
            "../plugins/colorpicker/bootstrap-colorpicker.min.js",
            "../plugins/morris/morris.min.js",
            "../plugins/select2/select2.full.min.js",
            "../plugins/select2/i18n/es.js",
            "../plugins/pace/pace.js",
            "../plugins/timepicker/bootstrap-timepicker.js",
            "adminlte.js",
            "app.js"
        ]);
    });
```

The installation process has been updated for a more easy and practical way, please check the installation documentation