
jQuery(function()
  {
    jQuery(".modal-form").on("submit", function(e)
      {
        e.preventDefault()
        jQuery(this).prop('disabled', true)
        let formData = new FormData(this),
            gadanie = jQuery(".modal-mid__left").find("input:checked"),
            textGadanie = ''
        gadanie.each(function(){
          textGadanie += jQuery(this).parent().text().trim() + ' / '
        })
        textGadanie = textGadanie.slice(0,-3)
        formData.append('gadanie', textGadanie)
        formData.append('timeDifference', jQuery("#timeDifference").text().trim())
        formData.append('customerTime', jQuery("#customerTime").text().trim())
        formData.append('func', 'setZakaz')
        jQuery.ajax(
          {
            url: "ajaxController.php",
            method: 'post',
            contentType: false,
            processData: false,
            cache: false,
            data: formData,
            success: function(response)
            {
              console.log(response)
              jQuery(".modal-form input:not([type=submit]").val('')
              jQuery('body').append(response)
            }
          })
      })
  })