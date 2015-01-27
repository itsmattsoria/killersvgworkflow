###Killer SVG Workflow###
---

See the demo at [http://mattsoria.com/killersvgworkflow/](http://mattsoria.com/killersvgworkflow/)

## Dependencies:

- [Grunt.js](http://gruntjs.com/)
- [SVG for Everybody](https://github.com/jonathantneal/svg4everybody)

## Instructions

After you have [Grunt](http://gruntjs.com/) installed on your machine, clone the repo and navigate to the `assets` directory and run `npm install` to install the Grunt plugins used. After that just run `grunt` from the project root and you're good to go! 

From there you can save SVG files to the `assets/svgs` folder, making sure to save them with the prefix of `icon-`, and you can use the SVGs anywhere with the ability to style them with CSS, and the confidence that a fallback PNG will be generated for IE8.

To use the SVG icons throughout the project you'll want to include the defs file at the top of your document, just after the opening `<body>` tag, and hide it so they don't all just show up at the top of your document:

```
<span class="hide"><?php include_once("assets/svgs/build/svg-defs.svg"); ?></span>
```

Just hide that baby with something like `.hide{display:none;}`.

Then you can embed the SVG icons throughout your project following this format:

```
<svg class="icon icon-mysvg" role="img" aria-labelledby="title"><use xlink:href="#icon-mysvg"></use></svg>
```

For a closer look at how it works and some more notes that will help you get started, [see the demo page](http://mattsoria.com/killersvgworkflow/).