process.env.DISABLE_NOTIFIER = true;

var gulp = require('gulp'),
    notify = require('gulp-notify'),
    del = require('del'),
    requireDir = require('require-dir');

var tasks = requireDir('./gulp-tasks');
gulp.task('admin', tasks.admin);
gulp.task('website', tasks.website);
//gulp.task('imagemin', tasks.imagemin);
// gulp.task('watch', function () {
//     gulp.watch(['packages/robust/**/public/**/*.*', 'resources/assets/website/**/*.*'], ['mix-styles', 'mix-styles-css', 'mix-scripts', 'mix-styles-website', 'mix-styles-css-website', 'mix-scripts-website']);
// });

gulp.task('clean', function () {
    return del(['public/assets/css', 'public/assets/js', 'public/assets/images', 'public/assets/website/js', 'public/assets/website/css', 'public/assets/website/scss']).then(function () {
        notify({ message: 'Clean complete!' });
    }).catch(function () {
        notify({ message: 'Clean Failed!' });
    });
});

gulp.task('default', gulp.series('clean', gulp.parallel('admin', 'website'), (done) => {
    done();
}));
