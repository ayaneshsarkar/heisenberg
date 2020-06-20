var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var browserSync = require('browser-sync').create();

var babel = require('gulp-babel');

// Compile Sass into CSS

function runSass() {

  // Sass File Destination
  return gulp.src('./app/resources/sass/**/*.scss')
    // Compile Sass
    .pipe(sass())
    // Compiled to Css at public/css/style.css
    .pipe(gulp.dest('./public/css'))
    // Stream changes to all Browsers
    .pipe(browserSync.stream());

}

function runBabel() {

  return gulp.src('./app/resources/js/**/*.js')
    .pipe(babel())
    //.pipe(concat('script.js'))
    .pipe(gulp.dest('./public/js'))
    .pipe(browserSync.stream());

}

function watch() {
  browserSync.init({
    server: {
      baseDir: './'
    }
  });
  gulp.watch('./app/resources/sass/**/*.scss', runSass);
  gulp.watch('./app/resources/js/**/*.js', runBabel)
}

exports.runSass = runSass;

exports.runBabel = runBabel;
exports.watch = watch;


