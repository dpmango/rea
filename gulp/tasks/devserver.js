var gulp          = require('gulp');
var browserSync   = require('browser-sync');
var config        = require('../config');

// gulp.task('server', function(){
//   browserSync({
//     proxy: 'https://dev.student.rea.ru/personal/',
//     files: [config.dest.css + '*.css'],
//     middleware: require('serve-static')('./dist'),
//     rewriteRules: [
//       {
//         match: new RegExp('</head>'),
//         fn: function(){
//           return '<script async="" src="/browser-sync/browser-sync-client.js?v=2.18.13"></script><link rel="stylesheet" type="text/css" href="http://localhost:8080/css/index.css">'
//         }
//       }
//     ],
//     port: 8080
//   })
// })

var gulp   = require('gulp');
var server = require('browser-sync').create();
var config = require('../config');

// in CL 'gulp server --open' to open current project in browser
// in CL 'gulp server --tunnel siteName' to make project available over http://siteName.localtunnel.me

gulp.task('server', function() {
  server.init({
    server: {
      baseDir: [config.dest.root, config.src.root],
      directory: false,
      serveStaticOptions: {
        extensions: ['html']
      }
    },
    files: [
      config.dest.html + '/*.html',
      config.dest.css + '/*.css',
      config.dest.js + '/*.js',
      config.dest.img + '/**/*'
    ],
    port: 3000,
    logLevel: 'info', // 'debug', 'info', 'silent', 'warn'
    logConnections: false,
    logFileChanges: true,
    open: true,
    notify: false,
    ghostMode: false,
    online: true,
    // tunnel: util.env.tunnel || null
  });
});

module.exports = server;
