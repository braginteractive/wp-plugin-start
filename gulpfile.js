// Load all the modules from package.json
var gulp = require( 'gulp' ),
  plumber = require( 'gulp-plumber' ),
  autoprefixer = require('gulp-autoprefixer'),
  watch = require( 'gulp-watch' ),
  minifycss = require( 'gulp-minify-css' ),
  jshint = require( 'gulp-jshint' ),
  stylish = require( 'jshint-stylish' ),
  uglify = require( 'gulp-uglify' ),
  rename = require( 'gulp-rename' ),
  notify = require( 'gulp-notify' ),
  include = require( 'gulp-include' ),
  sass = require( 'gulp-sass' );
  zip = require('gulp-zip');

 
// Default error handler
var onError = function( err ) {
  console.log( 'An error occured:', err.message );
  this.emit('end');
}

gulp.task('zip', function () {
 return gulp.src([
   '*',
   './includes/**/*',
   './languages/*',
   '!node_modules',
  ], {base: "."})
  .pipe(zip('plugin-name.zip'))
  .pipe(gulp.dest('.'));
});

// As with javascripts this task creates two files, the regular and
// the minified one. It automatically reloads browser as well.
var options = {};
options.sass = {
  errLogToConsole: true,
  sourceMap: 'sass',
  sourceComments: 'map',
  precision: 10,
  //imagePath: 'assets/img',
};
options.autoprefixer = {
  map: true
  //from: 'sass',
  //to: 'asrp.min.css'
};

gulp.task('sass', function() {
  return gulp.src('./includes/sass/style.scss')
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe(sass(options.sass))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4',
      options.autoprefixer
      ))
    .pipe( gulp.dest( './includes/css/' ) )
    .pipe( minifycss() )
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( gulp.dest( './includes/css' ) )
    .pipe(notify({ message: 'sass task complete' }))
});
 
 
// Start watch files for change
gulp.task( 'watch', function() {
 
  gulp.watch( './includes/sass/**/*.scss', ['sass'] );
 
} );
 
 
gulp.task( 'default', ['watch'], function() {
 // Does nothing in this task, just triggers the dependent 'watch'
} );