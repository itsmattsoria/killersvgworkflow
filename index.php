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
        <p class="gold"><a href="http://youtu.be/adM8b4LKfI0?t=11s" target="_blank">Not anymore!</a></p>
      </div>
    </header>
    <main class="site-main" role="main">
      <div class="wrap">
        <section>
          <p>I don't know about you, but I was reluctant to start using SVGs in projects because I thought they were kinda confusing, there seemed to be so many ways to save them and mark them up, it seemed like a lot of work, and I assumed support was bad. Turns out <a href="http://caniuse.com/#feat=svg">support is good</a>, there are <a href="http://css-tricks.com/svg-fallbacks/">solid fallbacks</a>, and we can automate all of the tedious work and make working with SVGs downright easy!</p>
        </section>
        <section>
          <h2>The Goals</h2>
            <ul>
              <li>Simplify saving SVGs for use</li>
              <li>Use SVGs in a way that allows us to style them with CSS</li>
              <li>Use SVGs without adding more HTTP requests (part of why we're using SVG in the first place)</li>
              <li>Simplify the markup</li>
              <li>Optimize our SVGs for Accessibility</li>
              <li>Provide PNG fallbacks for browser that don't support SVG (<span class="gold">*</span>without loading extra images for browesers that do)</li>
              <li>Don't waste time with tedious repedative tasks</li>
            </ul>
        </section>
        <section>
          <h2>How?</h2>
          <p>We are going to use <a href="http://gruntjs.com/">Grunt.js</a> (if <a href="http://gulpjs.com/">Gulp.js</a> is your preferred flavor of automation, there are equivilant plugins to acheive the same things we'll be doing with Grunt) to run some of the tasks that help optimize our SVGs for use and accessibility, and streamline our workflow.</p>
          <p>There are three different Grunt plugins we are going to be utilyzing, as well as a JavaScript plugin that will help us provide a fallback for browsers that don't cut the mustard (IE8):</p>
          <ul>
            <li><a href="https://github.com/sindresorhus/grunt-svgmin">grunt-svgmin</a> (uses <a href="https://github.com/svg/svgo">SVGO</a>) to minify and clean up our outputted SVG files</li>
            <li><a href="https://github.com/FWeinb/grunt-svgstore">grunt-svgstore</a> to creat an SVG sprite out of all of the SVG files we save and optimize their final output</li>
            <li><a href="https://github.com/dbushell/grunt-svg2png">grunt-svg2png</a> to automatically save PNG versions of all of our SVGs</li>
            <li><a href="https://github.com/jonathantneal/svg4everybody">SVG for Everybody</a> to inject our PNG fallbacks for IE8</li>
          </ul>
          <p>This whole workflow relies on Using Grunt (again, or Gulp) to handle these tasks for us, so you'll have to be familiar with using Grunt in order to take advantage of it, and learning Grunt is outside of the scope of this little demo, so if you need help getting started head over to <a href="http://gruntjs.com/getting-started">the Grunt.js site</a> and follow the step-by-step guide there.</p>
          <p>It's also worth noting that for the sake of really making this workflow quick and easy I'm using the <a href="https://github.com/gruntjs/grunt-contrib-watch">grunt-contrib-watch</a> plugin with the <a href="http://livereload.com/">LiveReload</a> option enabled so all I have to run in the command line is <code class="language-bash">grunt</code> and all of my tasks run when I save a file, and the page refreshes automatically with those changes.</p>
          <p><span class="killer">Disclaimer</span> — There are seriously <a href="https://github.com/filamentgroup/grunticon">tons</a> of <a href="https://github.com/drdk/grunt-dr-svg-sprites">other</a> <a href="https://github.com/jkphl/grunt-svg-sprite">Grunt plugins</a> that handle the same things I am doing here, and I haven't had to the chance to try them all out, so I'm not saying the is the <em>definitive</em> SVG workflow by any means, it's just one that I've been using lately that has worked really well, but try out others and let me know what's good! The bigger picture here is that it <strong>is</strong> possible to start using SVGs on your sites today, and working with them can be made easy.</p>
        </section>
        <section>
          <h2>Let's <span class="killer">Kill</span> It!</h2>
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
          <p>We call each of the plugins we're using and tell them which files to watch, where to output the generated/revised files, and when to run.</p>
          <p>The file structure here is very important to pay attention to, and though it might vary depending on how you like to structure your projects, the basic structure is as follows:</p>
<pre>
<code class="language-markup">project-folder/
|
|-- assets                        # I like to put all of my working stuff in here
|   |
|   |-- svgs                      
|       |-- icon-killer.svg       # This is where you save all your SVGs (saving with the icon- prefix is needed!)
|       |-- build/                # Call this folder what you want, it's just to keep the final defs file separate
|           |-- svg-defs.svg      # The generated defs file we'll include in our document as a sprite map
|   |                              
|   |-- Gruntfile.js              # Just wanted to note that in my setup, this is where Grunt lives
|
|-- icon-killer.png               # The fallback PNG files that are generated are saved in the root
|                                 # (this is not ideal, but works for now)</code>
</pre>
          <p>In order to include our SVGs with <code class="language-markup">&lt;use&gt;</code> we need to include our <strong>svg-defs.svg</strong> file at the top of our body, which we'll hide with <code class="language-css">display: none;</code> (I know that feels weird, but it works). For my example I'm going to include it with some <strong>PHP</strong>:</p>
<pre>
<code class="language-php">
&lt;span class="hide"&gt;&lt;?php include_once("assets/svgs/build/svg-defs.svg"); ?&gt;&lt;/span&gt;
</code>
</pre>
          <p>Here is the markup we'll use to actually place an SVG icon on a page:</p>
<pre class="line-numbers">
<code class="language-markup">&lt;svg class="icon icon-gruntjs" role="img" aria-labelledby="title"&gt;
  &lt;use xlink:href="#icon-gruntjs"&gt;&lt;/use&gt;
&lt;/svg&gt;</code>
</pre>
        </section>
        <section class="examples">
          <h2>Examples</h2>
          <p><svg class="icon icon-gruntjs" role="img" aria-labelledby="title"><use xlink:href="#icon-gruntjs"></use></svg></p>
          <p><svg class="icon icon-twitter" role="img" aria-labelledby="title"><use xlink:href="#icon-twitter"></use></svg></p>
        </section>
        <section>
          <h2>Further Reading</h2>
          <p>There's a lot more to be said about using SVGs and ways to improve the way you implement them, but <strong class="gold">Chris Coyier</strong> already compiled a list of articles that cover just about anything you would want to know related to using SVG:</p>
          <ul>
            <li><a href="http://css-tricks.com/mega-list-svg-information/">A Compendium of SVG Information</a></li>
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