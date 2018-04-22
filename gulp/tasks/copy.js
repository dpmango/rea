var gulp   = require('gulp');
var config = require('../config');


gulp.task('copy:html', function() {
  return gulp
    .src(config.src.root + '/*.html')
    .pipe(gulp.dest(config.dest.html));
});

gulp.task('copy', [
  // 'copy:rootfiles',
  'copy:html'
]);

gulp.task('copy:watch', function() {
  gulp.watch(config.src.root + '/*.html', ['copy:html']);
});
