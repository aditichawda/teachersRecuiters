let mix = require('laravel-mix');

const path = require('path');
let directory = path.basename(path.resolve(__dirname));

const source = 'platform/themes/' + directory;
const dist = 'public/themes/' + directory;

mix
    .sass(source + '/assets/sass/main.scss', dist + '/css')
    .sass(source + '/assets/sass/style.scss', dist + '/css')
    .js(source + '/assets/js/main.js', dist + '/js')
    .js(source + '/assets/js/script.js', dist + '/js')
    .js(source + '/assets/js/coming-soon.js', dist + '/js')
    .js(source + '/assets/js/company.js', dist + '/js')
    .js(source + '/assets/js/candidate.js', dist + '/js')
    .js(source + '/assets/js/tagify-select.js', dist + '/js')
    .js(source + '/assets/js/jobs.js', dist + '/js');

// Copy compiled assets to theme public folder (so changes reflect in both dev & prod)
mix
    .copy(dist + '/css/main.css', source + '/public/css')
    .copy(dist + '/css/style.css', source + '/public/css')
    .copy(dist + '/js/main.js', source + '/public/js')
    .copy(dist + '/js/jobs.js', source + '/public/js')
    .copy(dist + '/js/script.js', source + '/public/js')
    .copy(dist + '/js/coming-soon.js', source + '/public/js')
    .copy(dist + '/js/company.js', source + '/public/js')
    .copy(dist + '/js/candidate.js', source + '/public/js')
    .copy(dist + '/js/tagify-select.js', source + '/public/js');

if (mix.inProduction()) {
    // Production-only optimizations can go here
}
