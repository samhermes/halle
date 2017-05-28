'use strict';
 
var gulp = require('gulp'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	livereload = require('gulp-livereload');
 
gulp.task('sass', function () {
  return gulp.src('./sass/style.scss')
  	.pipe(sourcemaps.init())
    .pipe(sass({outputStyle:'compressed'}).on('error', sass.logError))
    .pipe(sourcemaps.write('./'))
    .pipe(gulp.dest('./'))
    .pipe(livereload());
});
 
gulp.task('watch', function () {
	livereload.listen();
  gulp.watch('./sass/**/*.scss', ['sass']);
  gulp.watch('**/*.php', livereload.reload);
});

gulp.task('default', ['sass', 'watch']);