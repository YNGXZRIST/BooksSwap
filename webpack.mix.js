const mix = require('laravel-mix');
mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sourceMaps()
    .sass('resources/sass/toastr.scss', 'public/css')
    .sass('resources/sass/slick.scss', 'public/css')
    .sass('resources/sass/tippy.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
    ]);
