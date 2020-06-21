const gulp = require('gulp');
const sass = require('gulp-sass');

// Compile Sass into CSS
function runSass() {

  // Sass File Destination
  return gulp.src('./app/resources/sass/**/*.scss')
    // Compile Sass
    .pipe(sass())
    // Compiled to Css at public/css/style.css
    .pipe(gulp.dest('./public/css'));

}

function media() {
  return gulp.src('./app/resources/media/*/*')
    .pipe(gulp.dest('./public/media'));
}



function watch() {
  gulp.watch('./app/resources/sass/**/*.scss', runSass);
  gulp.watch('./app/resources/media/*/*', media);
}

exports.runSass = runSass;
exports.media = media;
exports.watch = watch;