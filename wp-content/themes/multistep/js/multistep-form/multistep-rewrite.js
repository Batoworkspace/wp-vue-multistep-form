/**
* Media files pathes rewrite rules
* Make Vue.js app images available for Wordpress
* Rewrite relative pathes to WP absolute pathes
* Using `themeName` variable in header.php
*/

document.addEventListener('load', rewriteMultistepPathes('#multistep-form'))

function rewriteMultistepPathes (identificator) {
  const multistepForm = document.querySelector(identificator)

  if (multistepForm) {
    const formChildren = multistepForm.querySelectorAll('*')
    const mutationTargets = Array.from(formChildren).filter(element => element.src || element.srcset)

    mutationTargets.forEach(element => {
      const siteUrlData = `${location.protocol}//${location.hostname}`
      const multistepFormPath = `${siteUrlData}/wp-content/themes/${themeName}/js/multistep-form/multistep/dist`

      if (element.src) {
        element.src = `${multistepFormPath}${element.src.slice(siteUrlData.length)}`
      }

      if (element.srcset) {
        element.srcset = `${multistepFormPath}${element.slice(siteUrlData.length)}`
      }
    })
  }
}
