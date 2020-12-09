// source: https://www.goede.site/setting-up-gulp-4-for-automatic-sass-compilation-and-css-injection

// ## Globals
const gulp = require("gulp"),
    sass = require("gulp-sass"),
    postcss = require("gulp-postcss"),
    babel = require('gulp-babel'),
    uglify = require('gulp-uglify'),
    autoprefixer = require("autoprefixer"),
    browserSync = require('browser-sync').create(),
    cssnano = require("cssnano"),
    sourcemaps = require('gulp-sourcemaps'),
    notify = require('gulp-notify'),
    del = require("del");



// var argv         = require('minimist')(process.argv.slice(2));
// var autoprefixer = require('gulp-autoprefixer');
// var browserSync  = require('browser-sync').create();
// var changed      = require('gulp-changed');
// var concat       = require('gulp-concat');
// var flatten      = require('gulp-flatten');
// var gulpif       = require('gulp-if');
// var imagemin     = require('gulp-imagemin');
// var jshint       = require('gulp-jshint');
// var lazypipe     = require('lazypipe');
// var less         = require('gulp-less');
// var merge        = require('merge-stream');
// var cssNano      = require('gulp-cssnano');
// var plumber      = require('gulp-plumber');
// var rename       = require('gulp-rename');
// var rev          = require('gulp-rev');
// var runSequence  = require('run-sequence');
// var sourcemaps   = require('gulp-sourcemaps');
// var uglify       = require('gulp-uglify');


const paths = {
    styles: {
        // By using styles/**/*.sass we're telling gulp to check all folders for any sass file
        src: "assets/styles/**/*.scss",
        // Compiled files will end up in whichever folder it's found in (partials are not compiled)
        dest: "dist/styles"
    }

    ,scripts: {
      src: "assets/scripts/*.js",
      dest: "dist/scripts"
     }
};

// Define tasks after requiring dependencies
function styles() {
    console.log("in styles");
    return (
        gulp.src(paths.styles.src)
            .pipe(sass())
            .on("error", sass.logError)
            .pipe(sourcemaps.init())
            .pipe(sass())
            .on("error", sass.logError)
            .pipe(postcss([autoprefixer(), cssnano()]))
            .pipe(sourcemaps.write())
            .pipe(gulp.dest(paths.styles.dest))
            // Add browsersync stream pipe after compilation
            .pipe(browserSync.stream())
    );
}

// Expose the task by exporting it
// This allows you to run it from the commandline using
// $ gulp style
exports.styles = styles;


function scripts() {
    // Start by calling browserify with our entry pointing to our main javascript file
    return ( gulp.src(paths.scripts.src)
            .pipe(babel())
            .pipe(uglify())
            // Then write the resulting files to a folder
            .pipe(gulp.dest(paths.scripts.dest))
    );
}

// Expose the task, this allows us to call this task
// by running `$ gulp build' in the terminal
exports.scripts = scripts;

function clean(cb) {
  del(["dist"]);
  cb();
}

exports.clean = clean;


function reload() {
    browserSync.reload();
}

// Add browsersync initialization at the start of the watch task
function watch() {
    browserSync.init({
        // You can tell browserSync to use this directory and serve it as a mini-server
        server: {
            baseDir: "./"
        }
        // If you are already serving your website locally using something like apache
        // You can use the proxy setting to proxy that instead
        // proxy: "yourlocal.dev"
    });
    gulp.watch(paths.styles.src, gulp.series(styles, reload));
}

// Don't forget to expose the task!
exports.watch = watch

exports.default = gulp.series(clean, (callbackA) => {
    return gulp.parallel(styles, scripts, (callbackB) =>
    {
        callbackA();
        callbackB();
    })();
});


