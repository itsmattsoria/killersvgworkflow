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
    <link rel="canonical" href="http://mattsoria.com">
    <meta name="description" content="A tutorial on how to adopt a killer SVG workflow on your next web project.">
    <meta name="keywords" content="SVG, workflow, tutorial, web, development, front-end, code, matt soria, ChiHTML5, meetup">

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
          <h2><a href="https://github.com/poopsplat/killersvgworkflow">Download this example on Github</a></h2>
        </section>
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
              <li>Provide PNG fallbacks for browser that don't support SVG (<span class="gold">*</span>without loading extra images for browsers that do)</li>
              <li>Don't waste time with tedious repetitive tasks</li>
            </ul>
        </section>
        <section>
          <h2>How?</h2>
          <p>We are going to use <a href="http://gruntjs.com/">Grunt.js</a> (if <a href="http://gulpjs.com/">Gulp.js</a> is your preferred flavor of automation, there are equivalent plugins to achieve the same things we'll be doing with Grunt) to run some of the tasks that help optimize our SVGs for use and accessibility, and streamline our workflow.</p>
          <p>There are three different Grunt plugins we are going to be utilizing, as well as a JavaScript plugin that will help us provide a fallback for browsers that don't cut the mustard (IE8):</p>
          <ul>
            <li><a href="https://github.com/sindresorhus/grunt-svgmin">grunt-svgmin</a> (uses <a href="https://github.com/svg/svgo">SVGO</a>) to minify and clean up our outputted SVG files</li>
            <li><a href="https://github.com/FWeinb/grunt-svgstore">grunt-svgstore</a> to create an SVG sprite out of all of the SVG files we save and optimize their final output</li>
            <li><a href="https://github.com/dbushell/grunt-svg2png">grunt-svg2png</a> to automatically save PNG versions of all of our SVGs</li>
            <li><a href="https://github.com/jonathantneal/svg4everybody">SVG for Everybody</a> to inject our PNG fallbacks for IE8</li>
          </ul>
          <p>This whole workflow relies on Using Grunt (again, or Gulp) to handle these tasks for us, so you'll have to be familiar with using Grunt in order to take advantage of it, and learning Grunt is outside of the scope of this little demo, so if you need help getting started head over to <a href="http://gruntjs.com/getting-started">the Grunt.js site</a> and follow the step-by-step guide there.</p>
          <p>It's also worth noting that for the sake of really making this workflow quick and easy I'm using the <a href="https://github.com/gruntjs/grunt-contrib-watch">grunt-contrib-watch</a> plugin with the <a href="http://livereload.com/">LiveReload</a> option enabled so all I have to run in the command line is <code class="language-bash">grunt</code> and all of my tasks run when I save a file, and the page refreshes automatically with those changes.</p>
          <p><span class="killer">Disclaimer</span> — There are seriously <a href="https://github.com/filamentgroup/grunticon">tons</a> of <a href="https://github.com/drdk/grunt-dr-svg-sprites">other</a> <a href="https://github.com/jkphl/grunt-svg-sprite">Grunt plugins</a> that handle the same things I am doing here, and I haven't had to the chance to try them all out, so I'm not saying the is the <em>definitive</em> SVG workflow by any means, it's just one that I've been using lately that has worked really well, but try out others and let me know what's good! The bigger picture here is that it <strong>is</strong> possible to start using SVGs on your sites today, and working with them can be made easy.</p>
        </section>
        <section>
          <h2>Let's <span class="killer">Kill</span> It!</h2>
          <p>After you have Grunt installed, along with all of the dependencies (if you pulled down <a href="https://github.com/poopsplat/killersvgworkflow">the example project</a> to work from you just need to navigate to the <strong>assets</strong> directory in the command line and run <code class="language-bash">npm install</code> and it will install all of the Grunt plugins we'll be using), you'll need to set up the <strong>Gruntfile.js</strong> file to tell Grunt how to work with the plugins we'll be using. Below is my example Gruntfile (I've excluded non-SVG-related tasks that are actually included in the demo files for the sake of the example):</p>
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
          { removeViewBox: false },               // don't remove the viewbox attribute from the SVG
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
          <p>Now we actually need some SVGs to save and work with. You can design them yourself or grab some from online somewhere (there are even some pretty great web apps with full icon libraries to choose from that will save as SVG for you like <a href="https://icomoon.io/app/#/select">Icomoon</a> and <a href="http://fontastic.me/">Fontastic</a>). I'm just going to grab Github's vector icon, which they have provided as an Adobe Illustrator file, and we're going to open it up in Illustrator to prepare and save for use on the web.</p>
          <p>Illustrator is a giant piece of software and they present you with a ton of options when trying to save your icon as an SVG, so I'm just going to point out a few steps and things to pay attention to that tripped me up for a while.</p>
          <p><strong class="callout">Fit artboards to artwork bounds</strong> — most of the time when you open up a vector file in Ai there will be some substantial blank space around the actual icon, and you'll want to get rid of that before you save it by going to <strong>Object > Artboards > Fit to Artwork Bounds</strong> (if there are strokes applied to the outside of the icon make sure they don't get ignored — you might have to manually adjust for them).</p>
          <p><img src="assets/images/fittoartworkbounds.png"></p>
          <p><strong class="callout">Make all fills pure black, and all strokes transparent</strong> — most of the time we'll be using these SVGs as icons that might be used in various places and we'll want to style them based on the context they are viewed in, so it's likely we'll be changing either their <strong>fill</strong> or <strong>stroke</strong> properties in our CSS, but if we save an SVG with a transparent fill or with a fill other than pure black (#000), the SVG file that compiles to our <strong>svg-defs.svg</strong> file will have an inline <code class="language-markup">fill</code> attribute that will render it impossible to override via CSS. With strokes you just need to make sure they are transparent and you'll be golden.</p>
          <p><img src="assets/images/blackfills.png"></p>
          <p>Once you've prepared the file properly you can save it by simply going to <strong>File > Save As</strong> and placing the file into our <strong>assets/svgs/</strong> directory. For the sake of making the naming of our fallback PNG images that will be generated after we save, give the filename a prefix of <strong>icon-</strong>. Make sure you select <strong>SVG</strong> as the file format (not SVG Compressed), and click <strong>Save</strong>.</p>
          <p>A new window with a bunch of options will pop up and you'll want to make sure of just a couple of things. I honestly don't even really know what the <strong>SVG Profiles</strong> is about, but the default <strong>1.1</strong> has worked just fine. For the <strong>Fonts</strong> option you'll almost always want to set it to <strong>Convert to outline</strong> so that the icon is completely comprised of paths and shapes, and not embedding any fonts. The last bit is to just make sure that the <strong>Image Location</strong> is set to <strong>Embed</strong> so that it doesn't generate and save a crappy jpg file on you.</p>
          <p><img src="assets/images/svgoptions.png"></p>
          <p>Treehouse has a pretty thorough <a href="http://blog.teamtreehouse.com/quick-tip-saving-svg-files-in-adobe-illustrator">video tutorial</a> that will help you understand it better if you're still stuck.</p>
          <p><strong class="callout">Next</strong> — In order to include our SVGs with <code class="language-markup">&lt;use&gt;</code> we need to include our <strong>svg-defs.svg</strong> file at the top of our body, which we'll hide with <code class="language-css">display: none;</code> (I know that feels weird, but it works). For my example I'm going to include it with some <strong>PHP</strong>:</p>
<pre>
<code class="language-php">&lt;span class="hide"&gt;&lt;?php include_once("assets/svgs/build/svg-defs.svg"); ?&gt;&lt;/span&gt;</code>
</pre>
          <p>There are many reasons I like to work with SVGs this way, but if you want to know more check out <a href="http://css-tricks.com/svg-sprites-use-better-icon-fonts/">this article</a> on CSS-Tricks.</p>
          <p>Once we've included the <strong>svg-defs.svg</strong> file we can now access all of the SVGs we defined there and implement them as if they were inline via the <code class="language-markup">&lt;svg&gt;</code> and <code class="language-markup">&lt;use&gt;</code> elements, and a couple of classes to help style them.</p>
          <p>Here is what the markup looks like:</p>
<pre class="line-numbers">
<code class="language-markup">&lt;svg class="icon icon-github" role="img" aria-labelledby="title"&gt;
  &lt;use xlink:href="#icon-github"&gt;&lt;/use&gt;
&lt;/svg&gt;</code>
</pre>
          <p>We can then target our individual SVG icons in CSS by the <code class="language-markup">&lt;svg&gt;</code> element and its class:</p>
<pre class="line-numbers">
<code class="language-scss">.icon-github {
  width: 60px;
  fill: $brand-main;
}</code>
</pre>
          <p class="center">And we get this:</p>
          <p class="center"><svg class="icon icon-github" role="img" aria-labelledby="title"><use xlink:href="#icon-github"></use></svg></p>
        </section>
        <section>
          <h2 class="huge"><span class="killer">Killer!</span></h2>
        </section>
        <div class="section">
          <p>Now we can go crazy and use SVGs all over the place, <a href="http://css-tricks.com/using-svg/">style them</a> uniquely with CSS, <a href="http://codyhouse.co/gem/animate-svg-icons-with-css-and-snap/">animate them</a>, and we don't have to worry a bunch of extra HTTP requests are a bloated icon font file! Plus, with our automatically generated PNG fallbacks for IE8, we can use them pretty confidently and we don't have to even think about it that much!</p>
        </div>
        <section class="examples">
          <h2>Examples</h2>
<!--           <p><svg class="icon icon-gruntjs" role="img" aria-labelledby="title"><use xlink:href="#icon-gruntjs"></use></svg></p>
          <p><svg class="icon icon-twitter" role="img" aria-labelledby="title"><use xlink:href="#icon-twitter"></use></svg></p> -->
        </section>
        <section>
          <h2>The IE8 Fallback</h2>
          <p>Just thought I should point out what is going on with our PNG fallbacks for IE8.</p>
          <p>We just include the <strong>svg4everybody.ie8.min.js</strong> file in some conditional comments in our header:</p>
<pre class="line-numbers">
<code class="language-markup">&lt;!--[if lt IE 9]&gt;
  &lt;script src="assets/js/no-build/svg4everybody.ie8.min.js"&gt;&lt;/script&gt;
&lt;![endif]--&gt;</code>
</pre>
          <p>And then all we're doing is saving PNG versions of our SVG icons (and we're automating that too!), and the script we loaded figures out if the browser is incapable of displaying the SVG icons and replaces each instance with the corresponding PNG file that has the same name as the <strong>id</strong> we declared as the value of the <strong>href</strong> attribute for the <code class="language-markup">&lt;use&gt;</code> element.</p>
          <p>So looking back at our Github icon example from above, the generated markup in a browser like IE8 would be:</p>
<pre class="line-numbers">
<code class="language-markup">&lt;svg class="icon icon-github" role="img" aria-labelledby="title"&gt;
  &lt;img src="icon-github.png"&gt;
&lt;/svg&gt;</code>
</pre>
        </section>
        <section>
          <h2>Not Quite <span class="killer">Killer</span></h2>
          <p>This workflow has been great, but it's not perfect. There are still a couple of things I'd like to nail down, and I think they're worth pointing out.</p>
          <ul>
            <li>To really ensure proper semantics you have to go into the <strong>svg-defs.svg</strong> file and manually enter in a more descriptive title, because by default it just grabs the name of the SVG file you saved (ex: "icon-grunt", which isn't great)</li>
            <li>Sometimes it's desirable to save an SVG without any fills or strokes applied to give yourself complete control of variation in your CSS, but then the PNG that gets automatically generated is blank, so there are times when it makes sense to go in and manually save a fallback PNG</li>
            <li>As I pointed out earlier, the <a href="https://github.com/jonathantneal/svg4everybody">SVG For Everybody</a> plugin doesn't currently allow you to specify where to grab the PNG files from, so you're forced to place them in the project root, which is fine because it works, but personally I feel like a bunch of loose PNG files in my root feels cluttered and unorganized, but there is <a href="https://github.com/jonathantneal/svg4everybody/issues/14">an open issue</a> in the repo addressing this problem, so it could be resolved soon (maybe by you?!)</li>
          </ul>
        </section>
        <section>
          <h2>Further Reading</h2>
          <p>There's a lot more to be said about using SVGs and ways to improve the way you implement them, but <a href="https://twitter.com/chriscoyier">Chris Coyier</a> already compiled a list of articles that covers just about anything you would want to know related to using SVG:</p>
          <ul>
            <li><a href="http://css-tricks.com/mega-list-svg-information/">A Compendium of SVG Information</a></li>
          </ul>
        </section>
      </div>
    </main>
    <footer class="site-footer" role="contentinfo">
      <div class="wrap">
        <h2>Get In Touch</h2>
        <p>As I said earlier — this isn't perfect, so I'd love to hear some tips on how to make it better, or other ways you've optimized your SVG workflow.</p>
        <p>Send me an email at <a href="mailto:matt.m.soria@gmail.com">matt.m.soria@gmail.com</a>, tweet me at <a href="twitter.com/poopsplat">@poopsplat</a>, or fork this example project on <a href="https://github.com/poopsplat/killersvgworkflow">Github</a> to improve upon it.</p>
        <p class="huge center"><span class="killer">Thanks!</span></p>
      </div>
    </footer>
    <script src="assets/js/build/main.min.js"></script>
    <script type="text/javascript">//Google Analytics
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-20365223-1']);
      _gaq.push(['_setDomainName', 'mattsoria.com']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
  </body>
</html>