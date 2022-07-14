$(document).ready(function()
{
  $('form').on('submit',function(event)
  {
      var err = false;
      event.preventDefault();
      var input = $('input[type=text]');
      input.each(function()
      {
        if($(this).val() === '')
        {
          window.alert('All fields are required!');
          err = true;
        }
      });

      input = $('.num');
      input.each(function()
    {
      if(!$(this).val().match(/[0-9 -()+]+$/) || $(this).val().match(/[^0-9 -()+]+$/))
      {
        $(this).css('border','1px solid red');
        err=true;
      }
      else
      {
          $(this).css('border','1px solid black');
      }
    });
    if(err)
    {
      window.alert('Input numbers only!');
    }
    else
    {
      var out = $('form').serialize();
      $.post('/php/character/createChar.php',out)
      .done(function(result)
      {
        /*var formData = new FormData();
        formData.append('image',$('input[type=file]')[0].files[0]);
        //formData.append('q',getUrlParam('q'));
        //console.log(formData);
        //console.log(formData);
        $.ajax({
          url:'/php/ajax/uploadPortrait.php',
          type:'POST',
          data: formData,
          contentType: false,
          cache: false,
          processData: false,
          success: function(data)
          {
            //console.log(data);
          }
        });*/
        window.location.href='/profile.php';
        //console.log(result);
      });
    }

  });
});
