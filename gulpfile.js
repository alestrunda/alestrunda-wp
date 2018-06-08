"use strict";

var gulp = require("gulp");

var postcss = require("gulp-postcss");
var autoprefixer = require("autoprefixer");
var cssnano = require("cssnano");
var sass = require("gulp-sass");
var concat = require("gulp-concat");
var rename = require("gulp-rename");
var uglify = require("gulp-uglify");

/*
 * sass task
 * run: sass
 */
gulp.task("sass", function() {
  return gulp
    .src("src/scss/main.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(gulp.dest("styles"));
});

/*
 * css task
 * run: cssnano
 */
gulp.task("css", function() {
  var processors = [autoprefixer({ browsers: ["last 5 versions"] }), cssnano()];
  return gulp
    .src("styles/main.css")
    .pipe(postcss(processors))
    .pipe(
      rename({
        suffix: ".min"
      })
    )
    .pipe(gulp.dest("styles"));
});

/*
 * jsmin
 * run uglify
 */
gulp.task("jsmin", function(cb) {
  return gulp
    .src("js/custom.js")
    .pipe(uglify())
    .pipe(
      rename({
        suffix: ".min"
      })
    )
    .pipe(gulp.dest("js"));
});

/*
 * themeinfo task
 * run: concat
 */
gulp.task("themeinfo", function() {
  return gulp
    .src(["src/theme_info.css", "styles/main.min.css"])
    .pipe(concat("style.css"))
    .pipe(gulp.dest("./"));
});

/*
 * develop task
 * run: css and themeinfo tasks separately
 */
gulp.task("develop-css", gulp.series("sass", "css", "themeinfo"));

//watch task
gulp.task("watch", function() {
  gulp.watch("src/scss/*.scss", "develop-css");
});

//default task
gulp.task("default", gulp.series("develop-css"));
