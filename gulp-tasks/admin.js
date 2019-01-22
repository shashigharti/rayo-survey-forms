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
        browserify = require('gulp-browserify');

    gulp.src('packages/robust/**/public/sass/app.scss')
        .pipe(sassGlob())
        .pipe(sass())
        .pipe(concat('app.css'))
        .pipe(autoprefixer('last 2 version'))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/assets/css'))
        .pipe(notify({message: 'Styles SASS task complete'}));

    gulp.src(['packages/robust/**/public/css/app.css',
        'resources/assets/admin/css/app.css'
    ])
        .pipe(cssimport().on('error', util.log))
        .pipe(autoprefixer('last 2 version'))
        .pipe(concat('app-1.css'))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/assets/css'))
        .pipe(notify({message: 'Scripts CSS task complete'}));

    gulp.src(['packages/robust/**/public/js/main.js',
        'packages/robust/**/public/js/app.js',
        'resources/assets/admin/js/app.js'
    ])
        .pipe(gulpImports())
        .pipe(browserify({transform: ['babelify']}))
        .pipe(uglify({mangle: false}))
        .pipe(concat('app.min.js'))
        .pipe(gulp.dest('public/assets/js'))
        .pipe(notify({message: 'Scripts task complete'}));

    gulp.src('packages/robust/**/public/images/**/*.+(png|jpg|jpeg|gif|svg|ico)')
        .pipe(imagemin({optimizationLevel: 3, progressive: true, interlaced: true}))
        .pipe(flatten())
        .pipe(gulp.dest('public/assets/images'))
        .pipe(notify({message: 'Images task complete'}));

    gulp.src('packages/robust/**/public/fonts/**/*')
        .pipe(flatten({includeParents: -1}))
        .pipe(gulp.dest('public/assets/fonts'))
        .pipe(notify({message: 'Fonts complete'}));

}
