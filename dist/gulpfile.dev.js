"use strict";

var _require = require('gulp'),
    src = _require.src,
    dest = _require.dest,
    watch = _require.watch,
    parallel = _require.parallel; // CSS


var sass = require('gulp-sass')(require('sass'));

var plumber = require('gulp-plumber');

var autoprefixer = require('autoprefixer');

var cssnano = require('cssnano');

var postcss = require('gulp-postcss');

var sourcemaps = require('gulp-sourcemaps'); // Imagenes


var cache = require('gulp-cache');

var imagemin = require('gulp-imagemin');

var webp = require('gulp-webp');

var avif = require('gulp-avif'); // Javascript


var terser = require('gulp-terser-js');

var concat = require('gulp-concat');

var rename = require('gulp-rename');

var paths = {
  scss: 'src/scss/**/*.scss',
  js: 'src/js/**/*.js',
  imagenes: 'src/img/**/*'
};

function css() {
  return src(paths.scss).pipe(sourcemaps.init()).pipe(sass({
    outputStyle: 'expanded'
  })) // .pipe( postcss([autoprefixer(), cssnano()]))
  .pipe(sourcemaps.write('.')).pipe(dest('public/build/css'));
}

function javascript() {
  return src(paths.js).pipe(sourcemaps.init()).pipe(concat('bundle.js')).pipe(terser()).pipe(sourcemaps.write('.')).pipe(rename({
    suffix: '.min'
  })).pipe(dest('./public/build/js'));
}

function imagenes() {
  return src(paths.imagenes).pipe(cache(imagemin({
    optimizationLevel: 3
  }))).pipe(dest('public/build/img'));
}

function versionWebp(done) {
  var opciones = {
    quality: 50
  };
  src('src/img/**/*.{png,jpg}').pipe(webp(opciones)).pipe(dest('public/build/img'));
  done();
}

function versionAvif(done) {
  var opciones = {
    quality: 50
  };
  src('src/img/**/*.{png,jpg}').pipe(avif(opciones)).pipe(dest('public/build/img'));
  done();
}

function dev(done) {
  watch(paths.scss, css);
  watch(paths.js, javascript);
  watch(paths.imagenes, imagenes);
  watch(paths.imagenes, versionWebp);
  watch(paths.imagenes, versionAvif);
  done();
}

exports.css = css;
exports.js = javascript;
exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.versionAvif = versionAvif;
exports.dev = parallel(css, imagenes, versionWebp, versionAvif, javascript, dev);