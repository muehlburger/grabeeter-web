$(document).ready(function()
{
  $('.search input[type="submit"]').hide();
 
  $('#query').keyup(function(key)
  {
    if (this.value.length >= 3 || this.value == '')
    {
      $('#loader').show();
      $('#tweets').load(
        $(this).parents('form').attr('action'),
        { 'values[]': [this.value + '*', $('#screen_name').val() ] },
        function() { $('#loader').hide(); }
      );
    }
  });
});