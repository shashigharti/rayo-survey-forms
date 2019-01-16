module.exports = function () {
    "use strict";


    var gulp = require('gulp'),
        sass = require('gulp-sass'),
        autoprefixer = require('gulp-autoprefixer'),
        imagemin = require('gulp-imagemin'),
        rename = require('gulp-rename'),
        concat = require('gulp-concat'),
        notify = require('gulp-notify'),
        livereload = require('gulp-livereload'),
        del = require('del'),
        sassGlob = require('gulp-sass-glob'),
        flatten = require('gulp-flatten'),
        gulpImports = require('gulp-imports'),
        cssimport = require("gulp-cssimport"),
        concatCss = require('gulp-concat-css'),
        util = require('gulp-util'),
        uglify = require('gulp-uglifyjs'),
        babel = require('gulp-babel'),
        browserify = require('gulp-browserify'),
        sourcemaps = require('gulp-sourcemaps'),
        uglifycss = require('gulp-uglifycss');

    gulp.src(['packages/robust/**/public/website/sass/app.scss', 'resources/assets/website/sass/app.scss'])
        .pipe(sassGlob())
        .pipe(sass())
        .pipe(concat('app.min.css'))
        .pipe(autoprefixer('last 2 version'))
        .pipe(uglifycss({
            "maxLineLen": 80,
            "uglyComments": true
        }))
        .pipe(gulp.dest('public/assets/website/css'))
        .pipe(notify({message: 'Styles Website SASS task complete'}));

    gulp.src(['packages/robust/**/public/website/css/app.css', 'resources/assets/website/css/app.css'])
        .pipe(cssimport().on('error', util.log))
        .pipe(autoprefixer('last 2 version'))
        .pipe(concat('app-1.min.css'))
        .pipe(uglifycss({
            "maxLineLen": 80,
            "uglyComments": true
        }))
        .pipe(gulp.dest('public/assets/website/css'))
        .pipe(notify({message: 'Scripts Website CSS task complete'}));

    gulp.src(['packages/robust/**/public/website/js/main.js', 'packages/robust/**/public/website/js/app.js', 'resources/assets/website/js/app.js'])
        .pipe(gulpImports())
        .pipe(browserify({transform: ['babelify']}))
        .pipe(uglify({mangle: false}))
        .pipe(concat('app.min.js'))
        .pipe(gulp.dest('public/assets/website/js'))
        .pipe(notify({message: 'Website Scripts task complete'}));

    gulp.src(['resources/assets/website/images/**/*.+(png|jpg|jpeg|gif|svg|ico)', 'packages/robust/**/public/website/images/**/*.+(png|jpg|jpeg|gif|svg|ico)'])
        .pipe(imagemin({optimizationLevel: 3, progressive: true, interlaced: true}))
        .pipe(flatten())
        .pipe(gulp.dest('public/assets/website/images'))
        .pipe(notify({message: 'Website Images task complete'}));
}
