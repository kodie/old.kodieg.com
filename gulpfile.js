var argv = require('yargs').argv;
var del = require('del');
var gulp = require('gulp');
var bower = require('gulp-bower');
var bowerFiles = require('main-bower-files');
var browserSync = require('browser-sync').create();
var cleanCSS = require('gulp-clean-css');
var concat = require('gulp-concat');
var flatten = require('gulp-flatten');
var ftp = require('vinyl-ftp');
var gutil = require('gulp-util');
var imagemin = require('gulp-imagemin');
var jshint = require('gulp-jshint');
var path = require('path');
var rename = require('gulp-rename');
var runSequence = require('run-sequence');
var sass = require('gulp-sass');
var uglify = require('gulp-uglify');

var paths = {
	scripts: 'assets/js/**/*.js',
	styles: 'assets/scss/**/*.scss',
	images: 'assets/img/**/*.{png,jpg,jpeg,gif,svg}',
	bowerDir: 'bower_components'
};

var destPaths = {
	scripts: 'build/js',
	styles: 'build/css',
	fonts: 'build/fonts',
	images: 'build/img'
};

var ftpConfig = {
	remoteDir: 'public_html',
	files: [
		'./build/**/*',
		'./resume/**/*',
		'./*.php'
	],
	creds: {
		host: argv.host,
		port: argv.port,
		user: argv.user,
		pass: argv.pass,
		log: gutil.log
	}
};

gulp.task('bower', function() {
	return bower();
});

gulp.task('css-to-scss', function() {
	return bowerFiles('**/*.css').map(function(file) {
		gulp.src(file)
			.pipe(rename(function(path) {
				path.basename = '_' + path.basename;
				path.basename = path.basename.replace('.min', '');
				path.extname = '.scss';
			}))
			.pipe(gulp.dest(path.dirname(file)));
	});
});

gulp.task('styles', function() {
	return gulp.src(paths.styles)
		.pipe(sass({
			errLogToConsole:true,
			includePaths: bowerFiles('**/*.{scss,sass,css}').map(function(file) {
				return path.dirname(file);
			})
		}))
		.pipe(gulp.dest(destPaths.styles))
});

gulp.task('min-styles', function() {
	return gulp.src(destPaths.styles + '/**/*{,!.min}.css')
		.pipe(cleanCSS({keepSpecialComments: 0}))
		// Un-comment this to make seperate .min files
		//.pipe(rename(function(path) {
		//	path.basename = path.basename + '.min';
		//}))
		.pipe(gulp.dest(destPaths.styles));
});

gulp.task('scripts', function() {
	var files = bowerFiles('**/*.js', {includeSelf:true});
	files.push(paths.scripts);
	
	return gulp.src(files)
		// Un-comment this to turn on js error reporting in the console
		//.pipe(jshint())
		//.pipe(jshint.reporter('default'))
		.pipe(concat('main.js'))
		.pipe(gulp.dest(destPaths.scripts))
});

gulp.task('min-scripts', function() {
	return gulp.src(destPaths.scripts + '/**/*{,!.min}.js')
		.pipe(uglify())
		// Un-comment this to make seperate .min files
		//.pipe(rename(function(path) {
		//	path.basename = path.basename + '.min';
		//}))
		.pipe(gulp.dest(destPaths.scripts));
});

gulp.task('images', function() {
	return gulp.src(paths.images)
		.pipe(imagemin())
		.pipe(gulp.dest(destPaths.images));
});

gulp.task('fonts', function() {
	return gulp.src(paths.bowerDir + '/**/*.{eot,svg,ttf,woff,woff2}')
		.pipe(flatten())
		.pipe(gulp.dest(destPaths.fonts));
});

gulp.task('watch', function() {
	gulp.watch(paths.scripts, ['scripts']);
	gulp.watch(paths.styles, ['styles']);
});

gulp.task('browser-sync', function () {
	var files = [
		'**/*.php',
		'build/css/*.css',
		'build/js/*.js'
	];

	browserSync.init(files, {
		proxy: argv.proxy
	});
});

gulp.task('clean-remote', function() {
	ftp.create(ftpConfig.creds).clean(ftpConfig.remoteDir + '/**', '.');
});

gulp.task('upload', function () {
	var conn = ftp.create(ftpConfig.creds);

	return gulp.src(ftpConfig.files, {base: '.', buffer: false})
		.pipe(conn.newer(ftpConfig.remoteDir))
		.pipe(conn.dest(ftpConfig.remoteDir));
});

gulp.task('clean', function(cb) {
	del(['build']).then(cb());
});

gulp.task('default', function(cb) {
	runSequence('bower', 'clean', 'css-to-scss', 'styles', 'scripts', 'fonts', 'images', cb);
});

gulp.task('build', function(cb) {
	runSequence('bower', 'clean', 'css-to-scss', 'styles', 'min-styles', 'scripts', 'min-scripts', 'fonts', 'images', cb);
});

gulp.task('bs', function(cb) {
	runSequence('default', 'browser-sync', 'watch', cb);
});

gulp.task('deploy', function(cb) {
	runSequence('build', 'clean-remote', 'upload', cb);
});
