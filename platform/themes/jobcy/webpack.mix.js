let mix = require('laravel-mix');

const path = require('path');
let directory = path.basename(path.resolve(__dirname));

const source = 'platform/themes/' + directory;
const dist = 'public/themes/' + directory;

mix
    .sass(source + '/assets/sass/app.scss', dist + '/css')
    .postCss(dist + '/css/app.css', dist + '/css/app-rtl.css', {}, [
        require('rtlcss')(),
    ])
    .sass(source + '/assets/sass/icons.scss', dist + '/css')
    .js(source + '/assets/js/scripts.js', dist + '/js')
    .js(source + '/assets/js/backend.js', dist + '/js')
    .js(source + '/assets/js/coming-soon.js', dist + '/js')
    .js(source + '/assets/js/tagify-select.js', dist + '/js')

if (mix.inProduction()) {
    mix
        .copy(dist + '/css/app.css', source + '/public/css')
        .copy(dist + '/css/icons.css', source + '/public/css')
        .copy(dist + '/css/app-rtl.css', source + '/public/css')
        .copy(dist + '/js/scripts.js', source + '/public/js')
        .copy(dist + '/js/backend.js', source + '/public/js')
        .copy(dist + '/js/coming-soon.js', source + '/public/js')
        .copy(dist + '/js/tagify-select.js', source + '/public/js')
}
