
var gulp = require('gulp');
var runSequence = require('run-sequence');

gulp.task('default', function (callback) {
  runSequence(['build:development'], 'watch', 'server',
    callback
  )
})

gulp.task('build', function (callback) {
  runSequence('build:production',
    callback
  )
})

// Watch
gulp.task('watch',
  ['sass:watch',
  'sprite:svg:watch',
  'sprite:png:watch',
  'list-pages:watch',
  'copy:watch'
  ]
);
