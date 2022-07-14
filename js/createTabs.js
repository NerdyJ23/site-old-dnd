$(document).ready(function(){
  $('#buttons button').on('click',function(event)
  {
    if($(this).val() == 1)
    {
      $('#user-gen').css('display','none');
      $('#auto-gen').css('display','block');
    }
    else
    {
      $('#user-gen').css('display','block');
      $('#auto-gen').css('display','none');
    }
    //$('#buttons').css('display','none');
  });
});
