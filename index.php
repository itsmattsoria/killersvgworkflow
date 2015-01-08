<!doctype html>
<!--[if IE 8]> <html class="no-js ie8 lt-ie9"> <![endif]-->
<!--[if IE 9 ]> <html class="no-js ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <title>Killer SVG Workflow</title>
    <link rel="canonical" href="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link rel="shortcut icon" type="image/ico" href="favicon.png">
    <link rel="stylesheet" href="assets/css/main.css">
    <link type="text/plain" rel="author" href="humans.txt">
    <script src="//use.typekit.net/atn4ppa.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>
    <!--[if lt IE 9]>
      <script src="assets/js/no-build/respond.min.js"></script>
      <script src="assets/js/no-build/svg4everybody.ie8.min.js"></script>
    <![endif]-->
    <script src="assets/js/no-build/modernizr.custom.js"></script>
  </head>
  <body class="home">
    <span class="hide"><?php include_once("assets/svgs/build/svg-defs.svg"); ?></span>
    <header class="site-header" role="banner">
      <div class="wrap">
        <h1><span class="killer">Killer</span> SVG Workflow</h1>
        <p>I used to be <em>terrified</em> of using <strong>SVG</strong>s in my projects.</p>
        <p class="gold">Not anymore!</p>
        <nav class="site-nav" role="navigation"> 
   
        </nav>
      </div>
    </header>
    <main class="site-main" role="main">
      <div class="wrap">
        <section>
          <h2>Why?</h2>
          <p>I don't know about you, but at first I found saving icons as SVGs confusing, there seemed to be too many different ways to mark them up, and it seemed like a lot of work to get a little icon onto your site. After working with it a while and adopting practices to automate some of the more tedious tasks, and finding that on top of good support, there are some solid fallbacks, I'm not so afraid anymore!</p>
        </section>
        <section>
          <h2>How?</h2>
          <p>Using <a href="http://gruntjs.com/">Grunt.js</a> (if <a href="http://gulpjs.com/">Gulp.js</a> is your preferred flavor of automation, there are equivilant plugins to acheive the same things we'll be doing with Grunt).</p>
          <p>Here is the markup we'll use to actually place an SVG icon on a page:</p>
<pre class="line-numbers">
<code class="language-markup">&lt;svg class="icon icon-gruntjs" role="img" aria-labelledby="title"&gt;
  &lt;use xlink:href="#icon-gruntjs"&gt;&lt;/use&gt;
&lt;/svg&gt;</code>
</pre>
        <p>After you have Grunt installed, along with all of the dependancies, you'll need to set up the <strong>Gruntfile.js</strong> file to tell Grunt how to work with the plugins we'll be using. Below is my example Gruntfile (without some of the things I usually use myself):</p>
<pre class="line-numbers">
<code class="language-javascript">module.exports = function(grunt) {

// Project configuration.
grunt.initConfig({
  pkg: grunt.file.readJSON('package.json'),
  svgmin: {
    dist: {
      files: [{
        expand: true,
        cwd: 'svgs/',
        src: ['*.svg'],
        dest: 'svgs/'
      }]
    },
    options: {
      plugins: [
          { removeViewBox: false },               // don't remove the viewbox atribute from the SVG
          { removeEmptyAttrs: false }             // don't remove Empty Attributes from the SVG
      ]
    }
  },
  svgstore: {
    dist: {
      files: {
        'svgs/build/svg-defs.svg': ['svgs/*.svg']
      },
    },
    options: {
      cleanup: true
    }
  },
  svg2png: {
    dist: {
      files: [{ 
        flatten: true,
        cwd: 'svgs/', 
        src: ['*.svg'], 
        dest: '../' }
      ]
    }
  },
  watch: {
    svgs: {
      files: 'svgs/*.svg',
      tasks: ['svgmin', 'svgstore', 'svg2png'],
      options: {
        livereload: true,
      },
    }
  },
});

require('load-grunt-tasks')(grunt);
grunt.loadNpmTasks('grunt-svgmin');
grunt.loadNpmTasks('grunt-svgstore');
grunt.loadNpmTasks('grunt-svg2png');
grunt.loadNpmTasks('grunt-contrib-watch');

// Default task(s).
grunt.registerTask('default', ['watch']);

};</code>
</pre>
        </section>
        <section class="examples">
          <h2>Examples</h2>
          <p><svg class="icon icon-gruntjs" role="img" aria-labelledby="title"><use xlink:href="#icon-gruntjs"></use></svg></p>
          <p><svg class="icon icon-twitter" role="img" aria-labelledby="title"><use xlink:href="#icon-twitter"></use></svg></p>
        </section>
        <section>
          <h2>Further Reading</h2>
          <p>There's a lot more to be said about using SVGs and ways to improve the way you implement them, these articles might help.</p>
          <ul>
            <li><a href="http://css-tricks.com/gotchas-on-getting-svg-into-production/">5  Gotchas You're Gonna Face Getting Inline SVG Into Production</a></li>
            <li><a href=""></a></li>
          </ul>
        </section>
      </div>
    </main>
    <footer class="site-footer" role="contentinfo">
      <div class="wrap">
        
      </div>
    </footer>
    <script src="assets/js/build/main.min.js"></script>
    <script type="text/javascript">//Google Analytics
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']); // Replace "XXXXXXXX-X" with your account code
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
  </body>
</html>