$(document).on('click', 'a.page-link', function (event) {
    event.preventDefault();
    ajaxLoad($(this).attr('href'));
});
$(document).on('submit', 'form#frm', function (event) {
    event.preventDefault();
    var form = $(this);
    var data = new FormData($(this)[0]);
    var url = form.attr("action");
    $.ajax({
        type: form.attr('method'),
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) { 
            $('.is-invalid').removeClass('is-invalid');
            if (data.fail) {
                for (control in data.errors) {
                    $('#' + control).addClass('is-invalid');
                    $('#error-' + control).html(data.errors[control]);
                }
            } else {
                ajaxLoad(data.redirect_url);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            console.log("Error: " + errorThrown);
        }
    });
    return false;
});

function ajaxLoad(filename, content) {
  content = typeof content !== 'undefined' ? content : 'content';
  $('.loading').show();
  $.ajax({
      type: "GET",
      url: filename,
      contentType: false,
      success: function (data) {
          $("#" + content).html(data);
          $('.loading').hide();
      },
      error: function (xhr, status, error) {
          console.log(xhr.responseText);
      }
  });
}
