var buildDir = 'greenoak-build';

//GENERAL MODULES
var gulp = require('gulp'),
    concat = require('gulp-concat'),
    changed = require('gulp-changed');



var del = require('del'); // rm -rf
//

function clean() {
  // You can use multiple globbing patterns as you would with `gulp.src`
  // If you are using del 2.0 or above, return its promise
  return del(['../'+buildDir+'/**'], {force:true});
}
gulp.task('clean', function(){
  clean();
});
//CSS PROCESSING
var sass = require('gulp-sass'),
    minifyCSS = require('gulp-minify-css'),
    postcss = require('gulp-postcss'),
    mqpacker = require('css-mqpacker'),
    autoprefixer = require('autoprefixer');
    var processors = [
      autoprefixer({ browsers: ['last 2 versions'] }),
      mqpacker
    ];
gulp.task('sass', function () {



  gulp.src(['sass/main.scss', 'sass/expanded.scss','sass/ie-fixes.scss','sass/editor-styles.scss'])
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss(processors))
    .pipe(minifyCSS({keepBreaks:false, keepSpecialComments: 0}))
    .pipe(gulp.dest('../'+buildDir+'/css'));
});

//JAVASCRIPT PROCESSING
var uglify = require('gulp-uglify'),
    jshint = require('gulp-jshint');

gulp.task('js', function () {
  gulp.src([ 'js/plugins/*.js', 'js/site.js', 'js/modules/*.js'])
    .pipe(uglify())
    .on('error', console.error.bind(console))
    .pipe(concat('main.js'))
    .pipe(gulp.dest('../'+buildDir+'/js'));
  gulp.src('js/inline-load.js')
    .pipe(uglify())
    .on('error', console.error.bind(console))
    .pipe(gulp.dest('../'+buildDir+'/js'));
});

gulp.task('lint', function() {
  return gulp.src(['js/site.js', 'modules/*.js', 'js/inline-load.js'])
    .pipe(jshint())
    .pipe(jshint.reporter('default'));
});

//HTML PROCESSING
var  htmlclean = require('gulp-htmlclean');

gulp.task('templatecrush', function() {
  gulp.src(['*.php','*.html','!custom-module-functions.php'])
    .pipe(changed('../'+buildDir))
    .pipe(htmlclean({}))
    .pipe(gulp.dest('../'+buildDir));
});

//IMAGE PROCESSING
var svgstore = require('gulp-svgstore'),
    imagemin = require('gulp-imagemin');

gulp.task('svgstore', function () {
    return gulp
        .src('assets/svgs/*.svg')
        .pipe(imagemin())
        .pipe(svgstore({ inlineSvg: true }))
        .pipe(gulp.dest('../'+buildDir+'/assets'));
});

gulp.task('imgmin', function () {
  gulp.src('assets/imgs/**/*')
    .pipe(changed('../'+buildDir+'/assets/imgs'))
    .pipe(imagemin({interlaced: true, progressive: true,svgoPlugins: [{removeViewBox: false}],use: []}))
    .pipe(gulp.dest('../'+buildDir+'/assets/imgs'));
});

//DUMPS
gulp.task('fontdump', function(){
  gulp.src('assets/fonts/**/*')
    .pipe(gulp.dest('../'+buildDir+'/assets/fonts'));
});

gulp.task('wpdump', function(){
  gulp.src(['style.css', 'screenshot.png'])
    .pipe(gulp.dest('../'+buildDir));
});

gulp.task('backend-modules', function(){
  gulp.src(['backend-modules/**/*.html', 'backend-modules/**/*.php'])
  .pipe(htmlclean({}))
  .pipe(gulp.dest('../'+buildDir+'/backend-modules'));
  gulp.src(['backend-modules/**/*.scss'])
  .pipe(sass().on('error', sass.logError))
  .pipe(postcss(processors))
  .pipe(minifyCSS({keepBreaks:false, keepSpecialComments: 0}))
  .pipe(gulp.dest('../'+buildDir+'/backend-modules'));
  gulp.src(['backend-modules/**/*.js'])
  .pipe(uglify())
  .on('error', console.error.bind(console))
  .pipe(gulp.dest('../'+buildDir+'/backend-modules'));
});

gulp.task('watch', function() {
    gulp.watch('js/**/*.js', ['js']);
    gulp.watch(['sass/**/*'], ['sass']);
    gulp.watch('assets/imgs/**/*', ['imgmin']);
    gulp.watch('assets/fonts/**/*', ['fontdump']);
    gulp.watch(['*.php', '*.html', '**/*.php'], ['templatecrush']);
    gulp.watch(['style.css', 'screenshot.png'], ['wpdump']);
    gulp.watch(['assets/svgs/*.svg'], ['svgstore']);
    gulp.watch(['backend-modules/**/*'], ['backend-modules']);
});
gulp.task('build', [ 'js', 'imgmin', 'templatecrush', 'fontdump', 'wpdump','sass', 'svgstore', 'backend-modules']);
