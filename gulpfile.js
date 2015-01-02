/*-----------------------
  @TODO

* Add custom Modernizr build that includes IE8 polyfills (html5shiv, matchMedia)
  https://github.com/doctyper/gulp-modernizr
------------------------*/

/*-----------------------
  @INCLUDES
------------------------*/
// Theirs
var gulp = require('gulp');

// Ours
var autoprefixer = require('gulp-autoprefixer'),
    cache     = require('gulp-cache'),
    concat    = require('gulp-concat'),
    del       = require('del'),
    imagemin  = require('gulp-imagemin'),
    jshint    = require('gulp-jshint'),
    minifycss = require('gulp-minify-css'),
    notify    = require('gulp-notify'),
    rename    = require('gulp-rename'),
    sass      = require('gulp-sass'),
    svg2png   = require('gulp-svg2png'),
    svgstore  = require("gulp-svgstore"),
    uglify    = require('gulp-uglify');

var livereload = require('gulp-livereload'),
    lr     = require('tiny-lr'),
    server = lr();

/*-----------------------
  @CONFIG
------------------------*/
var config = {
    path_src_img: 'src/public/images',
    path_src_js: 'src/public/js',
    path_src_css: 'src/public/sass',
    path_dist_img: 'dist/public/images',
    path_dist_js: 'dist/public/js',
    path_dist_css: 'dist/public/css',
    path_normalize: 'node_modules/normalize.css/normalize.css',
    main_css: 'styles.scss',
    main_js: 'scripts.js',
};

/*-----------------------
  @ERRORS
------------------------*/
// http://www.mikestreety.co.uk/blog/a-simple-sass-compilation-gulpfilejs
var displayError = function(error) {
    var errorString = '[' + error.plugin + ']';
    errorString += ' ' + error.message.replace("\n",'');

    if(error.fileName)
        errorString += ' in ' + error.fileName;

    if(error.lineNumber)
        errorString += ' on line ' + error.lineNumber;

    console.error(errorString);
}

/*-----------------------
  @CLEAN
------------------------*/
gulp.task('clean', function(cb) {
    del([
        config.path_dist_css,
        config.path_dist_js,
        config.path_dist_img
    ], cb);
});

/*-----------------------
  @STYLES:OURS

  Compile SASS, concatenate and minify our stylesheets, reload browser
------------------------*/
gulp.task('styles:ours', function() {
    return gulp.src(
        [
            config.path_normalize,
            'bower_components/jquery-icheck/skins/flat/flat.css',
            'bower_components/jquery-selectric/dist/selectric.css',
            'bower_components/slick-carousel/slick/slick.css',
            config.path_src_css + '/' + config.main_css,
            '!' + config.path_src_css + '/vendor/*'
        ])
        .pipe(sass(
            {
                outputStyle: 'expanded',
                sourceComments: 'none'
            }))
        .pipe(autoprefixer(
            'last 2 version',
            'safari 5',
            'ie 8',
            'ie 9',
            'opera 12.1',
            'ios 6',
            'android 4'
        ))
        .pipe(concat(config.main_css))
        .pipe(minifycss())
        .pipe(rename(
            {
                suffix: '.min', extname: '.css'
            }))
        .pipe(gulp.dest(config.path_dist_css))
        .on('error', function(err){
            displayError(err);
        })
        .pipe(livereload(server))
        .pipe(notify({ message: 'Finished: styles:ours' }));
});

/*-----------------------
  @STYLES:VENDOR

  Copy vendor scripts to dist (no processing)
------------------------*/
gulp.task('styles:vendor', function() {
    return gulp.src(
        [
            '!' + config.path_src_css + '/' + config.main_css,
            config.path_src_css + '/vendor/*'
        ])
        .pipe(gulp.dest(config.path_dist_css + '/vendor'))
        .pipe(notify({ message: 'Finished: styles:vendor' }));
});

/*-----------------------
  @LINT

  Lint our scripts
------------------------*/
gulp.task('lint', function() {
    return gulp.src(config.path_src_js + '/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'))
        .pipe(notify({ message: 'Finished: lint' }));
});

/*-----------------------
  @SCRIPTS:OURS

  Concatenate and minify our scripts
------------------------*/
gulp.task('scripts:ours', function() {
    return gulp.src(
        [
            'bower_components/jquery-icheck/icheck.min.js',
            'bower_components/jquery.scrollTo/jquery.scrollTo.min.js',
            'bower_components/jquery-selectric/dist/jquery.selectric.min.js',
            'bower_components/slick-carousel/slick/slick.min.js',
            'bower_components/svg4everybody/svg4everybody.min.js',  // IE9-11. <= IE8 included in template.php
            config.path_src_js + '/*.js',
            '!' + config.path_src_js + '/vendor/passthru/*'
        ])
        .pipe(concat(config.main_js))
        .pipe(gulp.dest(config.path_dist_js))
        .pipe(rename(
            {
                suffix: '.min'
            }))
        .pipe(uglify())
        .on('error', function(err){
            displayError(err);
        })
        .pipe(gulp.dest(config.path_dist_js))
        .pipe(notify({ message: 'Finished: scripts:ours' }));
});

/*-----------------------
  @SCRIPTS:VENDOR

  Copy vendor scripts to dist (no processing)
------------------------*/
gulp.task('scripts:vendor', function() {
    return gulp.src(
        [
            '!' + config.path_src_js + '/*.js',
            config.path_src_js + '/vendor/*'
        ])
        .pipe(gulp.dest(config.path_dist_js + '/vendor'))
        .pipe(notify({ message: 'Finished: scripts:vendor' }));
});

/*-----------------------
  @IMAGES:RASTER

  Compress raster images
  @TODO figure out how to actually use gulp-cache: https://github.com/jgable/gulp-cache
------------------------*/
gulp.task('images:raster', function() {
    return gulp.src(
        [
            config.path_src_img + '/**/*.gif',
            config.path_src_img + '/**/*.jpg',
            config.path_src_img + '/**/*.png',
        ])
        .pipe(imagemin(
            {
                optimizationLevel: 3,
                progressive: true,
                interlaced: true,
            }
        ))
        .pipe(gulp.dest(config.path_dist_img))
        .pipe(notify({ message: 'Finished: images:raster' }));
});


/*-----------------------
  @IMAGES:VECTOR

  Regardless of other processing, at least push all vectors to dist
------------------------*/
gulp.task('images:vector', function() {
    return gulp.src(
        [
            config.path_src_img + '/**/*.svg',
        ])
        .pipe(gulp.dest(config.path_dist_img))
        .pipe(notify({ message: 'Finished: images:vector' }));
});

/*-----------------------
  @IMAGES:VECTOR:PNG

  Create a png for each svg in the specified directory
------------------------*/
gulp.task('images:vector:png', function () {
    return gulp.src(config.path_src_img + '/sprites/**/*.svg')
        .pipe(svg2png())
        .pipe(rename(function(path) {
                path.basename = 'sprite.svg.' + path.basename;
            }))
        .on('error', function(err){
            displayError(err);
        })
        .pipe(gulp.dest(config.path_dist_img + '/sprites/'))
        .pipe(notify({ message: 'Finished: images:vector:png' }));
});

/*-----------------------
  @IMAGES:VECTOR:SPRITES

  Combine all svgs in target directory into a single spritemap.
------------------------*/
gulp.task('images:vector:sprites', function () {
    return gulp.src(config.path_src_img + '/sprites/**/*.svg')
        .pipe(svgstore({
            fileName: 'sprite.svg',
            inlineSvg: true,
            transformSvg: function($svg, done) {
                $svg.attr({style: 'display:none'}) // make sure the spritemap doesn't show
                $svg.find('[fill]').removeAttr('fill') // remove all 'fill' attributes in order to control via CSS
                done(null, $svg)
            },
        }))
        .on('error', function(err){
            displayError(err);
        })
        .pipe(gulp.dest(config.path_dist_img + '/sprites/'))
        .pipe(notify({ message: 'Finished: images:vector:sprites' }));
});

/*-----------------------
  @WATCH
------------------------*/
gulp.task('watch', function() {
    gulp.watch(config.path_src_js + '/**/*.js', ['lint', 'scripts:ours', 'scripts:vendor']);
    gulp.watch(config.path_src_css + '/**/*.scss', ['styles:ours', 'styles:vendor']);
    gulp.watch(
        [
            config.path_src_img + '/**/*.gif',
            config.path_src_img + '/**/*.jpg',
            config.path_src_img + '/**/*.png',
        ],
        [
            'images:raster',
        ]);
    gulp.watch(
        [
            config.path_src_img + '/**/*.svg',
        ],
        [
            'images:vector',
            'images:vector:sprites',
        ]);
});

/*-----------------------
  @DEFAULT TASK
------------------------*/
gulp.task('default', ['clean'], function() {
    gulp.start(
        'styles:ours',
        'styles:vendor',
        'lint',
        'scripts:ours',
        'scripts:vendor',
        'images:raster',
        'images:vector',
        'images:vector:png',
        'images:vector:sprites',
        'watch'
    );
});