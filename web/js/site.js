(function($){
  $(() => {
    $(document).on('change', '[name="rubric"]', function () {
      $.ajax({
        type: 'GET',
        url: '/?rubric=' + $(this).val(),
        success: function (data) {
          $('.js-news-table').html(data);
        }
      });
    });
  });
})(jQuery);