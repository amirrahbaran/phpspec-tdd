var gulp = require('gulp');
var phpspec = require('gulp-phpspec');
var run = require('gulp-run');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');


gulp.task('test', function() {
    gulp.src('phpspec.yml')
        .pipe(phpspec('phpspec run', { 'verbose': 'v', notify: true }))
        .on('error', notify.onError({
            title: "Crap",
            message: "Your tests failed!",
            icon: __dirname + '/fail.png'
        }))
        .pipe(notify({
            title: "Success",
            message: "All tests have returned green!"
        }));
});

gulp.task('watch', function() {
    gulp.watch(['spec/**/*.php', 'src/**/*.php'], ['test']);
});

gulp.task('default', ['test', 'watch']);