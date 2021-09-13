const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .js("resources/js/app.js", "public/js")
  .postCss("resources/css/app.css", "public/css", [
    require("postcss-import"),
    require("tailwindcss")
  ]);

mix
  .scripts(
    [
      "public/adminlte/plugins/jquery/jquery.min.js",
      "public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js",
      "public/adminlte/plugins/moment/moment.min.js",
      "public/adminlte/plugins/daterangepicker/daterangepicker.min.js",
      // "public/adminlte/plugins/summernote/summernote-bs4.min.js",
      "public/adminlte/plugins/select2/js/select2.full.min.js",
      "public/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
      "node_modules/jsbarcode/dist/JsBarcode.all.min.js",
      "public/adminlte/dist/js/adminlte.min.js",
      "public/adminlte/dist/js/script.js"
    ],
    "public/js/dashboard.js"
  )
  .sass("public/adminlte/dist/css/dashboard.scss", "public/css")
  .sourceMaps();
