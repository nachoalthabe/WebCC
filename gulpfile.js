'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();

gulp.task('sass', function() {
    return gulp.src('./cc.scss')
        .pipe(sass({
            outputStyle: 'expanded'
        }).on('error', sass.logError))
        .pipe(gulp.dest('./'))
        .pipe(browserSync.stream());
});

gulp.task('sass:watch', function() {

});

gulp.task('browser-sync', function() {
    browserSync.init({
        proxy: "local.conceptocero.com",
        files: ['./']
    });
    gulp.watch('./**/*.scss', ['sass']);
    gulp.watch("./**/*.php").on('change', browserSync.reload);
    gulp.watch("./**/*.js").on('change', browserSync.reload);
});

gulp.task('default', ['sass', 'browser-sync']);
