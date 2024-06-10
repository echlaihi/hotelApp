const mix = require('laravel-mix');

mix.js(['resources/js/app.js',], 'public/js/app.js') // Concatenate and compile multiple JS files
  .sass('resources/scss/main.scss', 'public/css') // Compile SCSS (optional)
  .sass('resources/admin/scss/style.scss', 'public/css'); // Compile SCSS (optional)
