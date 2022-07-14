$(document).ready(function()
{
  $('.hp').click(check);
});

function check()
{
  if($(this).hasClass('hp'))
  {
    //console.log($(this).val());
    var curr = $('#curr_hp').text();
    curr = parseInt(curr) + parseInt($(this).val());
    //console.log(curr);
    $('#curr_hp').text(curr);
    var width = parseInt($('#curr_hp').text())/parseInt($('#max_hp').text())*100;
    console.log(width);
    $('#fade').css('width',''+width+'%');
    var color = 'rgba(57,210,81,' + width/100 + ')';
    $('hp').css('background-color',''+color);
  }

}
