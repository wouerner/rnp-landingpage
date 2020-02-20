(function ($) {

  /**
   * Class containing functionality for Facet API.
   */
  Drupal.ajax_facets = {};
  // Store current query value.
  Drupal.ajax_facets.queryState = null;
  // State of each facet.
  Drupal.ajax_facets.facetQueryState = null;
  // HTML ID of element of current facet.
  Drupal.ajax_facets.current_id = null;
  // Current changed facet.
  Drupal.ajax_facets.current_facet_name = null;

  // You can use it for freeze facet form elements while ajax is processing.
  Drupal.ajax_facets.beforeAjaxCallbacks = {};

  Drupal.ajax_facets.beforeAjax = function (context, settings, element) {
    $.each(Drupal.ajax_facets.beforeAjaxCallbacks, function () {
      if ($.isFunction(this)) {
        this(context, settings, element);
      }
    });
  };

  Drupal.behaviors.ajax_facets = {
    attach: function (context, settings) {
      if (!Drupal.ajax_facets.queryState) {
        if (settings.facetapi.defaultQuery != undefined && settings.facetapi.defaultQuery) {
          Drupal.ajax_facets.queryState = {'f': settings.facetapi.defaultQuery};
        }
        else {
          Drupal.ajax_facets.queryState = {'f': []};
        }
        // We will send original search path to server to get back proper reset links.
        if (settings.facetapi.searchPath != undefined) {
          Drupal.ajax_facets.queryState['searchPath'] = settings.facetapi.searchPath;
        }
        if (settings.facetapi.index_id != undefined) {
          Drupal.ajax_facets.queryState['index_id'] = settings.facetapi.index_id;
        }
        if (settings.facetapi.view_name != undefined) {
          Drupal.ajax_facets.queryState['view_name'] = settings.facetapi.view_name;
        }
        if (settings.facetapi.facet_field != undefined) {
          Drupal.ajax_facets.queryState['facet_field'] = settings.facetapi.facet_field;
        }
        if (settings.facetapi.display_name != undefined) {
          Drupal.ajax_facets.queryState['display_name'] = settings.facetapi.display_name;
        }
        // Respect search keywords in AJAX queries.
        if (settings.facetapi.searchKeys != undefined) {
          Drupal.ajax_facets.queryState['search_api_views_fulltext'] = settings.facetapi.searchKeys;
        }
      }
      // Iterates over facet settings, applies functionality like the "Show more"
      // links for block realm facets.
      // @todo We need some sort of JS API so we don't have to make decisions
      // based on the realm.
      if (settings.facetapi) {
        for (var index in settings.facetapi.facets) {
          Drupal.ajax_facets.bindResetLink(settings.facetapi.facets[index].id, index, settings);

          // Checkboxes.
          $('#' + settings.facetapi.facets[index].id + ' input.facet-multiselect-checkbox:not(.processed)').change(
            [settings.facetapi.facets[index]],
            Drupal.ajax_facets.processCheckboxes
          ).addClass('processed');

          // Selectboxes.
		  if(settings.facetapi.facets[index].widget == "facetapi_ajax_select"){
        /* $('.facet-wrapper-selectbox:not(.processed)').each(function () {
            var target_select = $(this).find('select');
            if ($(target_select).length != null) {*/
              
			  $('.facet-wrapper-selectbox select').change(
                [settings.facetapi.facets[index]],
                Drupal.ajax_facets.processSelectbox)
              .addClass('processed');
            //}
          //});
		  }

          // Links.
          $('#' + settings.facetapi.facets[index].id + ' a:not(.processed)').each(function () {
            $(this).click(
              [settings.facetapi.facets[index]],
              Drupal.ajax_facets.processLink
            ).addClass('processed');
          });

          if (null != settings.facetapi.facets[index].limit) {
            // Applies soft limit to the list.
            if (typeof(Drupal.facetapi) != 'undefined') {
              Drupal.facetapi.applyLimit(settings.facetapi.facets[index]);
            }
          }
        }
      }

      $('body').once(function () {
        $(this).append('<div id="ajax-facets-tooltip"><span></span></div>');
      });
    }
  };

  Drupal.ajax_facets.bindResetLink = function (parentId, index, settings) {
    var facet_values = Drupal.ajax_facets.getFacetValues();
    if (facet_values[settings.facetapi.facets[index]['facetName']] != undefined) {
      $('.' + parentId).parents('.block-facetapi').find('a.reset-link').show();
    }
    else {
      $('.' + parentId).parents('.block-facetapi').find('a.reset-link').hide();
    }

    $('.' + parentId).parents('.block-facetapi').find('a.reset-link:not(".processed")').addClass('processed').click(function () {
      window.location = settings.facetapi.facets[index].resetPath;
      return false;
    });
  };

  /**
   * Process click on each checkbox.
   */
  Drupal.ajax_facets.processSelectbox = function (event) {

    var $this = $(this);
    var facetOptions = event.data[0];
    var name = $this.attr('name') + ':';
    if (Drupal.ajax_facets.queryState['f'] != undefined) {
      var queryNew = new Array();
      for (var index in Drupal.ajax_facets.queryState['f']) {
        if (Drupal.ajax_facets.queryState['f'][index].substring(0, name.length) != name) {
          queryNew[queryNew.length] = Drupal.ajax_facets.queryState['f'][index];
        }
      }
      Drupal.ajax_facets.queryState['f'] = queryNew;

      /* Default value. */
      if ($this.find(":selected").val() == 0) {
        delete Drupal.ajax_facets.queryState['f'][Drupal.ajax_facets.queryState['f'].length];
      }
      else {
        Drupal.ajax_facets.queryState['f'][Drupal.ajax_facets.queryState['f'].length] = name + $this.find(":selected").val();
      }
    }

    Drupal.ajax_facets.sendAjaxQuery($this, facetOptions);
  };

  /**
   * Process click on each checkbox.
   */
  Drupal.ajax_facets.processCheckboxes = function (event) {
    var $this = $(this);
    var facetOptions = event.data[0];
    var facetCheckboxName = $this.attr('name');
    if (Drupal.ajax_facets.queryState['f'] != undefined) {
      var queryNew = new Array();
      if ($this.is(':checked')) {
        var addCurrentParam = true;
        Drupal.settings.facetapi.facets;
        for (var index in Drupal.ajax_facets.queryState['f']) {
          if (Drupal.ajax_facets.queryState['f'][index] == facetCheckboxName) {
            addCurrentParam = false;
          }
        }
        if (addCurrentParam) {
          Drupal.ajax_facets.queryState['f'][Drupal.ajax_facets.queryState['f'].length] = facetCheckboxName;
        }
      }
      // If we unset filter, remove them from query.
      else {
        for (var index in Drupal.ajax_facets.queryState['f']) {
          if (Drupal.ajax_facets.queryState['f'][index] != facetCheckboxName) {
            queryNew[queryNew.length] = Drupal.ajax_facets.queryState['f'][index];
          }
        }
        Drupal.ajax_facets.queryState['f'] = queryNew;
      }
    }

    Drupal.ajax_facets.sendAjaxQuery($this, facetOptions);
  };

  Drupal.ajax_facets.processLink = function (event) {

    var $this = $(this);
    var facetOptions = event.data[0];
    var name_value = $this.data('name') + ':' + $this.data('value');
    if (Drupal.ajax_facets.queryState['f'] != undefined) {
      var queryNew = new Array();
      /* Handle value - deactivate. */
      if ($this.hasClass('facetapi-active')) {
        for (var index in Drupal.ajax_facets.queryState['f']) {
          if (Drupal.ajax_facets.queryState['f'][index] != name_value) {
            queryNew[queryNew.length] = Drupal.ajax_facets.queryState['f'][index];
          }
        }
        Drupal.ajax_facets.queryState['f'] = queryNew;
      }
      /* Handle value - activate. */
      else if ($this.hasClass('facetapi-inactive')) {
        Drupal.ajax_facets.queryState['f'][Drupal.ajax_facets.queryState['f'].length] = name_value;
        var addCurrentParam = true;
        for (var index in Drupal.ajax_facets.queryState['f']) {
          if (Drupal.ajax_facets.queryState['f'][index] == name_value) {
            addCurrentParam = false;
          }
        }
        if (addCurrentParam) {
          Drupal.ajax_facets.queryState['f'][Drupal.ajax_facets.queryState['f'].length] = name_value;
        }
      }
    }

    Drupal.ajax_facets.sendAjaxQuery($this, facetOptions);
    event.preventDefault();
  };

  /* Send ajax. */
  Drupal.ajax_facets.sendAjaxQuery = function ($this, facetOptions) {
    Drupal.ajax_facets.current_id = $this.attr('id');
    Drupal.ajax_facets.current_facet_name = $this.data('facet');
    Drupal.ajax_facets.beforeAjax();
    var data = Drupal.ajax_facets.queryState;
    // Render the exposed filter data to send along with the ajax request
    var exposedFormId = '#views-exposed-form-' + Drupal.ajax_facets.queryState['view_name'] + '-' + Drupal.ajax_facets.queryState['display_name'];
    exposedFormId = exposedFormId.replace(/\_/g, '-');
    $.each($(exposedFormId).serializeArray(), function (index, value) {
      data[value.name] = value.value;
    });
    var settings = {
      url : encodeURI(Drupal.settings.basePath + Drupal.settings.pathPrefix + 'ajax/ajax_facets/refresh/'),
      submit : {'ajax_facets' : data}
    };
    var ajax = new Drupal.ajax(false, false, settings);
    ajax.eventResponse(ajax, {});
  },

  Drupal.ajax_facets.getFacetValues = function () {
    var f = Drupal.ajax_facets.queryState.f;
    var facets_values = {};
    var symbol = ':';
    jQuery.each(f, function (k, v) {
      var parts = v.split(symbol);
      var value = parts[parts.length - 1];
      var appendix = symbol + value;
      var key = v.substr(0, v.length - appendix.length);
      facets_values[key] = value;
    });
    return facets_values;
  },

  /* Show tooltip if facet results are not updated by ajax (in settings). */
  Drupal.ajax_facets.showTooltip = function ($, response) {
    var pos = $('#' + Drupal.ajax_facets.current_id).offset();
    jQuery('#ajax-facets-tooltip').css('top', pos.top - 15);
    jQuery('#ajax-facets-tooltip').css('left', pos.left - jQuery('#ajax-facets-tooltip').width() - 40);
    jQuery('#ajax-facets-tooltip').show();
    jQuery('#ajax-facets-tooltip span').html(Drupal.t('Found:') + ' ' + '<a href="' + response.applyUrl + '">' + response.total_results + '</a>');

    setTimeout(function () {
      jQuery('#ajax-facets-tooltip').hide(250);
    }, 3000);
  }

  if (Drupal.ajax) {
    // Command for process search results and facets by ajax.
    Drupal.ajax.prototype.commands.ajax_facets_update_content = function(ajax, response) {
      if (response.data.activeItems != undefined) {
        Drupal.ajax_facets.facetQueryState = response.data.activeItems;
      }
      // After Ajax success we should update reset, apply link to handle proper redirects.
      if (response.data.resetUrls != undefined && Drupal.settings.facetapi.facets != undefined) {
        for (index in Drupal.settings.facetapi.facets) {
          if (response.data.resetUrls[Drupal.settings.facetapi.facets[index].facetName] != undefined) {
            // Update path from responce.
            Drupal.settings.facetapi.facets[index].resetPath = response.data.resetUrls[Drupal.settings.facetapi.facets[index].facetName];
          }
        }
      }

      if (response.data.newContent != undefined && response.data.newContent) {
        for (var class_name in response.data.newContent) {
          var $blockToReplace = $('.' + class_name);
          if ($blockToReplace.size()) {
            $blockToReplace.replaceWith(response.data.newContent[class_name]);
          }
          var $block = $('.' + class_name).parents('div.block-facetapi:not(:visible)');
          if ($block.size()) {
            $block.show();
          }
        }
      }

      /* Update results. */
      var results_updated = false;
      var show_tip = false;
      $.each(response.data.update_results, function (facet_name, mode) {
        if (Drupal.ajax_facets.current_facet_name == facet_name) {
          /* Update by ajax. */
          if (mode) {
            $('.view-id-' + response.data.views_name + '.view-display-id-' + response.data.display_id).replaceWith(response.data.views_content);
          }
          /* Update by link. */
          else {
            show_tip = true;
          }
        }
      });

      // As some blocks could be empty in results of filtering - hide them.
      if (response.data.hideBlocks != undefined && response.data.hideBlocks) {
        for (var id in response.data.hideBlocks) {
          var $block = $('#' + response.data.hideBlocks[id]);
          if ($block.size()) {
            $block.hide();
          }
        }
      }

      if (response.data.settings.views != undefined) {
        Drupal.settings.views = response.data.settings.views;
      }
      Drupal.attachBehaviors();
      if (show_tip) {
        Drupal.ajax_facets.showTooltip($, response.data);
      }
    }
  }
})(jQuery);
