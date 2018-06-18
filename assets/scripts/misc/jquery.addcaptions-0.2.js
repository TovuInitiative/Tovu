/**
 * jQuery addCaptions 0.2
 * 
 * Adds the ability to add captions around images
 * 
 * Changelog:
 * 0.2
 *   Added exlude option
 *   Fixed attribute search order
 *   Changed the elemnts to find to bea jQuery selector
 * 
 * 0.1
 *   Initial Version
 */
/**
 * addCaptions
 * 
 * Function to wrap an image in a styled div containing the image caption
 * 
 * @param object options Object containing any options for processing
 * @return void
 * @author Dom Hastings
 */
(function($) {
  $.fn.addCaptions = function(options) {
    // the default settings
    var settings = {
      // attributes to check for caption (these are checked in order)
      attributes: [
        'longdesc',
        'title',
        'alt'
      ],
      
      // exclude any images that match these
      exclude: {
        // property to match
        src: [
          // condition (regexp or string)
          /recaptcha/
        ]
      },

      // whether or not to add the caption box to images with no caption
      allowBlankCaption: true,

      // the elements to find within the container (can be any valid find() selector)
      selector: 'img',

      // remove the float directly on the element
      removeFloat: true,

      // options for respective elements
      containerElement: 'div',
      containerClass: 'caption',
      // 
      titleElement: 'p',
      titleClass: 'caption-title',
      // 
      imageClass: ''
      // 
    }

    // update the settings, if the options aren't set, use an empty object
    $.extend(settings, options || {});

    // get all the images in the current element
    var images = $(this).find(settings.selector);

    // if there are some images
    if (images.length) {
      // loop through each
      $.each(images, function() {
        // check for any exclusion conditions met
        for (var property in settings.exclude) {
          // check the element has the specified property
          if (this[property]) {
            // loop through all the exclusion conditions
            for (var i = 0; i < settings.exclude[property].length; i++) {
              // if it matches
              if (this[property].match(settings.exclude[property][i])) {
                // return the function
                return;
              }
            }
          }
        }
        
        // get the parent object
        var parent = $(this).parent().get(0);

        // check it's not already got a caption
        if (parent.tagName.toLowerCase() == settings.containerElement && $(parent).hasClass(settings.containerClass)) {
          return true;
        }

        // initialize the caption variable
        var caption = '';

        // determine the image caption
        for (var i = 0; i < settings.attributes.length; i++) {
          caption = $(this).attr(settings.attributes[i]);
          
          if (caption) {
            break;
          }
        }

        // if the caption is empty, return unless explicitly allowed
        if (!caption && !settings.allowBlankCaption) {
          return true;
        }

        // get the float
        var location = $(this).css('float');

        // remove the float
        if (settings.removeFloat) {
          $(this).css('float', 'none');
        }

        // if we;ve got to add a class...
        if (settings.imageClass) {
          $(this).addClass(settings.imageClass);
        }

        // wrap the image in a div with the correct styling
        $(this).wrap('<' + settings.containerElement + ' class="' + settings.containerClass + '" style="float: ' + location + ';"></' + settings.containerElement + '>');

        if (caption) {
          // add the caption in after the current element
          $(this).after('<' + settings.titleElement + ' class="' + settings.titleClass + '">' + caption + '</' + settings.titleElement + '>');
        }
      });
    }
  }
})(jQuery);