const mix = require('laravel-mix');

mix.browserSync({
    proxy: process.env['BROWSERSYNC_PROXY'] || 'localhost',
    open: false,
    notify: false,
});

mix.webpackConfig({
    target: 'browserslist',
})

mix.version();
mix.disableNotifications();

// Front
mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss/nesting'),
        require('tailwindcss'),
    ])
    .copyDirectory('resources/img', 'public/img');

// Admin
mix.postCss('resources/css/admin.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss/nesting'),
    require('tailwindcss')('tailwind-admin.config.js'),
]);
