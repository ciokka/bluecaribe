jQuery(function ($) {
  if ($("input[type='number']").length > 0) {
    $("input[type='number']").inputSpinner()
  }

  $(window).on('scroll', function () {
    var scroll = $(window).scrollTop()

    if (scroll >= 40) {
      $('.header .e-con-inner').addClass('shrink')
    } else {
      $('.header .e-con-inner').removeClass('shrink')
    }
  })

  /* tawk.to widget inol3 */
  let url = 'https://embed.tawk.to/64648a5874285f0ec46bef37/1h0kboqhj'
  if (location.href.indexOf('/it/') != -1) {
    url = 'https://embed.tawk.to/64648a5874285f0ec46bef37/1h0kskugu'
  } else if (location.href.indexOf('/es/') != -1) {
    url = 'https://embed.tawk.to/64648a5874285f0ec46bef37/1h0ksnne3'
  } else if (location.href.indexOf('/de/') != -1) {
    url = 'https://embed.tawk.to/64648a5874285f0ec46bef37/1h9l7je6h'
  } else if (location.href.indexOf('/fr/') != -1) {
    url = 'https://embed.tawk.to/64648a5874285f0ec46bef37/1h9lbu4bm'
  }

  var Tawk_API = Tawk_API || {},
    Tawk_LoadStart = new Date()
  ;(function () {
    var s1 = document.createElement('script'),
      s0 = document.getElementsByTagName('script')[0]
    s1.async = true
    s1.src = url
    s1.charset = 'UTF-8'
    s1.setAttribute('crossorigin', '*')
    s0.parentNode.insertBefore(s1, s0)
  })()

  /* click su cerca */
  if (document.querySelector('.cercaBtn')) {
    const cercaBtn = document.querySelector('.cercaBtn')
    const aElement = cercaBtn.querySelector('a')
    const cercaField = document.querySelector('.cercaField')

    aElement.addEventListener('click', () => {
      if (cercaField.classList.contains('active')) {
        cercaField.classList.remove('active')
      } else {
        cercaField.classList.add('active')
      }
    })
  }
  var viewportMetaTag = document.querySelector('meta[name="viewport"]');

  if (viewportMetaTag) {
    viewportMetaTag.setAttribute("content", "width=device-width, initial-scale=1, maximum-scale=1");
  }
})
/* accordion short description inol3 */

document.addEventListener('DOMContentLoaded', () => {
  const accordionBtn = document.querySelector(
    '.product-template-default .accordion-button'
  )
  const prodExcerpt = document.querySelector(
    '.product-template-default .prodExcerpt'
  )
  if (accordionBtn) {
    accordionBtn.addEventListener('click', () => {
      if (prodExcerpt.classList.contains('active')) {
        prodExcerpt.classList.remove('active')
      } else {
        prodExcerpt.classList.add('active')
      }
    })
  }
})

/* titolo recensioni hide link inol3 */
document.addEventListener('DOMContentLoaded', () => {
  

  
  
  /*const titleLink = document.querySelectorAll(
    '.product-template-default .wpr-grid a'
  )
  const spanElement = document.createElement('span')
  if (titleLink) {
    Array.from(titleLink.attributes).forEach(attr => {
      spanElement.setAttribute(attr.name, attr.value)
    })
    spanElement.innerHTML = titleLink.innerHTML
    titleLink.parentNode.replaceChild(spanElement, titleLink)
  }*/
})

jQuery(function ($) {
  $('.product-template-default .wpr-grid-item .inner-block a').css('pointer-events', 'none').attr("href", 'javascript:void(0);');
  
  $(document).on('click' , '.submit.btn_tran', function (event) {
    var $button = $(this)
    var $form = $button.closest('#booking_form')
    // var submit = true;

    // Disable the button and show the loading spinner
    $form.block({
      message: null,
      overlayCSS: {
        backgroundColor: '#FFF',
        zIndex: 100,
        opacity: 0.8
      },
      overlayColor: '#fff',
      css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        borderRadius: '10px',
        opacity: 0.5,
        color: '#fff'
      },
      className: 'loading'
    })
    

    // $('.required').each(function() {
    //   if($(this).val() == '' || $(this).val() == 0) submit = false;
    //   console.log($(this).val());
    // });
        
    
    // if(submit){
      setTimeout(function () {
        $form.submit()
      }, 1000)
    // } else {
    //   $form.unblock();
    // }
  

    event.preventDefault()
  })
  
  $(document).on('change' , '.period_package select', function (event) {
      if($('.ovabrw_datetimepicker').val() == '')
        $(".submit.btn_tran").removeClass("active");
      else
        $(".submit.btn_tran").addClass("active");
  });
  
  $(document).on('change' , '.ovabrw_datetimepicker', function (event) {
      $(".submit.btn_tran").removeClass("active");
  });

  // $(document).ready(function () {
    var myOptional = jQuery('#myOptional').text()
    var myPassengers = jQuery('#myPassengers').text()
    var myLanguage = jQuery('#myLanguage').text()
    var myPassengersPlaceholder = jQuery('#myPassengersPlaceholder').text()
    var myLanguagePlaceholder = jQuery('#myLanguagePlaceholder').text()
    var myRequired = $('<abbr class="required" title="obbligatorio">*</abbr>')
    console.log('pronto')
    var currentUrl = window.location.href

    if (currentUrl.indexOf('/checkout/') !== -1) {
      console.log('checkout')
      $('label[for="_shopengine_passengers"]')
        .text(myPassengers)
        .append(myRequired)
      $('label[for="_shopengine_language"]').text(myLanguage + ' ' + myOptional)
      $('#_shopengine_passengers').attr('placeholder', myPassengersPlaceholder)
      $('#_shopengine_language').attr('placeholder', myLanguagePlaceholder)

      // $("body").html($("body").html().replace(/Passengers/g, myMessage));
    }
  //})
    $('.ovabrw_datetimepicker.ovabrw_start_date.startdate_perido_time').on('click', function(){
      console.log('click');
      window.setTimeout(function(){
        console.log('il timeout funziona');
        $('.xdsoft_today_button').trigger('mousedown').trigger('touchend');
      }, 100)
    })
  // fix allineamento datepicker inol3
    $('.home .xdsoft_datetimepicker').addClass('small-custom')




// function handleDateClick() {
//       var today = new Date();
//       var tomorrow = new Date();
//       tomorrow.setDate(tomorrow.getDate() + 1);
    
//       var day = today.getDate();
//       var month = today.getMonth();
//       var year = today.getFullYear();
    
//       var tomorrowDay = tomorrow.getDate();
//       var tomorrowMonth = tomorrow.getMonth();
//       var tomorrowYear = tomorrow.getFullYear();
    
//       var targetElementToday = $('[data-date="' + day + '"][data-month="' + month + '"][data-year="' + year + '"]');
//       var targetElementTomorrow = $('[data-date="' + tomorrowDay + '"][data-month="' + tomorrowMonth + '"][data-year="' + tomorrowYear + '"]');
    

//       targetElementToday.removeClass('xdsoft_current xdsoft_today');
//       targetElementToday.addClass('xdsoft_disabled');
//       targetElementTomorrow.addClass('xdsoft_disabled');
    
//     }
    
//   var checkDate;
//   $(document).on('click', '.colorato', function() {
//     window.setTimeout(function() {
//       handleDateClick();
//         checkDate = setInterval(handleDateClick, 500);
//     }, 100);
//   });

//   $(document).on('click', function(event) {
//     var $target = $(event.target);
  
//     if (!$target.is('.colorato') && !$target.parents('.colorato').length) {
//       clearInterval(checkDate);
//     }
//   });
    
    
    // $(document).on('click', '.xdsoft_prev[style="visibility: visible;"]', function() {
    //   window.setTimeout(function() {
    //     console.log('clicked');
    //     handleDateClick();
    //   }, 1000);
    // });

    // $(document).on('click', '.xdsoft_next[style="visibility: visible;"]', function() {
    //   window.setTimeout(function() {
    //     console.log('clicked');
    //     handleDateClick();
    //   }, 1000);
    // });

    const btnSearch = document.getElementById('btnSearch');
    const productsDropdown = document.getElementById('products_dropdown');
    const productTagsDropdown = document.getElementById('product_tags_dropdown');
    
    // Maximum number of characters to display in the select options
    const maxChars = 20;
    
    // Function to update products based on the selected tag
    function updateProducts(tagId) {
        console.log("Selected tag:", tagId); // Logging the selected tag
        const data = new FormData();
        data.append('action', 'get_products_by_tag');
        data.append('tag_id', tagId);
    
        // Show loading option and disable the select
        productsDropdown.innerHTML = '<option value="">Loading...</option>';
        productsDropdown.disabled = true;
    
        fetch(window.FetchTagsUrl, {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(response => {
            console.log("Server response:", response); // Logging server response
            productsDropdown.innerHTML = ''; // Clear current options
            if (response.success) {
                response.data.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.url;
                    const cleanCategories = product.categories.replace(/-/g, ' ');
                    const fullText = `${product.title} - ${cleanCategories}`;
                    option.textContent = truncateText(fullText, maxChars); // Display truncated text initially
                    option.setAttribute('data-full-text', fullText); // Store full text as attribute
                    productsDropdown.appendChild(option);
                });
            } else {
                console.error("Server error:", response.data);
                productsDropdown.innerHTML = '<option value="">No tours available</option>';
            }
            // Re-enable the select
            productsDropdown.disabled = false;
        })
        .catch(error => {
            console.error('Error:', error);
            productsDropdown.innerHTML = '<option value="">Error loading</option>';
            productsDropdown.disabled = false;
        });
    }
    
    // Function to load all products initially
    function loadAllProducts() {
        updateProducts(0); // Load all products
    }
    
    // Event listener for change in product tags dropdown
    productTagsDropdown.addEventListener('change', function() {
        const selectedTag = this.value;
        const tagId = this.options[this.selectedIndex].getAttribute('data-tag-id');
        console.log("Selected tag URL:", selectedTag); // Log the selected tag URL
    
        if (selectedTag === "0") {
            console.log("Reloading page to show all products"); // Log reloading page
            window.location.reload(); // Reload the page
        } else {
            // Extract the tag ID from the tag URL
            console.log("Derived tag ID:", tagId); // Log the derived tag ID
            if (tagId) {
                updateProducts(tagId);
            }
        }
    });
    
    // Event listener to show full text when select is opened
    productsDropdown.addEventListener('focus', function() {
        const options = this.options;
        Array.from(options).forEach(option => {
            const fullText = option.getAttribute('data-full-text');
            if (fullText) {
                option.textContent = fullText;
               
            }
        
        });

    });

    const form = jQuery('form.ovabrw_search');

    form.on('change', productsDropdown, function(event) {
      const target = jQuery(event.currentTarget);
      const options = target.find('option');
    
      if(options.length) {
        options.each(function(i) {
          const el = options.eq(i);
          if (el.is(':selected')) {
            const fullText = el.attr('data-full-text');
            if(fullText){
              const newText = truncateText(fullText, maxChars);
              el.text(newText);
            }
          }

        });
      }
    });

    // Event listener to truncate text when select loses focus
    productsDropdown.addEventListener('blur', function() {
        const options = this.options;
        Array.from(options).forEach(option => {
            const fullText = option.getAttribute('data-full-text');
            if (fullText) {
                option.textContent = truncateText(fullText, maxChars);
            }
        });
    });
    
    // Event listener for click on the search button
    btnSearch.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent default form submission behavior
    
        const selectedUrl = productsDropdown.value;
    
        if (selectedUrl) {
            window.location.href = selectedUrl;
        } else {
            alert('Please select a product.');
        }
    });
    
    // Function to truncate text
    function truncateText(text, maxLength) {
        return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
    }
    
    // Load all products on page load
    window.addEventListener('load', loadAllProducts);
    
})
