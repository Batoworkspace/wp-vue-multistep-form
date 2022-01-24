# WordPress Vue.js Multistep Form
##### Universal ACF PRO based multistep form implementation

![Wordpress + Vue.js](preview.png?raw=true "Wordpress + Vue.js")

This form is created with Vue.js and it fully prepared to be easily installed to your project.
You can use this repo in two ways:
1. Start from installation of whole theme
2. Implement form following the instructions below

## ⚙️ Implementation Instructions
- Firstly, you should have a **Node.js** installed on your environment. You can install it following the setup instructions from the [Node.js site](https://nodejs.org/en/).
- To build the form app you should have a **npm** package manager installed on your environment. **npm** can be installed during Node.js installation. To check the version of npm run ```npm -v``` in a command line.

### Theme installation
1. Clone the current repo on your machine
2. Create local database and setup connection settings in ```wp-config.php```
3. Check is **ACF PRO** plugin active
4. Check is **multistep** theme choosed as a site theme
5. To build the form app, go to ```wp-content/themes/multistep/js/multistep-form/multistep``` and run ```npm run build```
6. ✨ Now form can be connected to your templates

### Connection to the existing project
1. Check is **ACF PRO** plugin installed
2. Connect styles and scripts from ```functions.php```
3. Add script to your ```header.php``` (or another heading template)

```html
<!-- Theme name root -->
<script>
  const themeName = '<?php echo get_current_theme(); ?>'
  const themeString = document.createElement('span')
  themeString.id = 'theme-name'
  themeString.style.display = 'none'

  const pageWrapElement = document.querySelector('#page')
  if (pageWrapElement) {
    pageWrapElement.before(themeString)
  }
</script>
```
Script will set your theme name to the global js variable

4. Copy **multistep-form.php** to the ```template-parts``` folder
5. Clone **multistep-form** folder to the ```/{theme_name}/js/``` directory.
There should be the file **multistep-rewrite.js** that will rewrire media src's in Vue app
6. Add **acf-json** folder to the root of your project. 
> ⚠️ **PAY ATTENTION! ACF PRO json setting can rewrite your previous ACF fields settings. If you have already created fields, clone the data from multistep fields json file to your ACF json file row by row.**
7. Finally, build the app using ```npm run build``` in ```/{theme_name}/js/multistep-form/multistep``` directory
8. ✨ Now form can be connected to your templates
