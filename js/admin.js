$(document).ready(function()
{
  $('.admin').click(activate);
  $('.editControl').click(activate);
  setTimeout(loadValues,1000);
  $('#form').on('submit',function(event)
  {
    event.preventDefault();
    var out = $(this).serialize() + "&q="+getUrlParam('q');
    $.post('/php/ajax/updateChar.php', out)
    .done(function(result)
    {
      console.log(result);
      var formData = new FormData();
      formData.append('image',$('input[type=file]')[0].files[0]);
      formData.append('q',getUrlParam('q'));
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
          console.log(data);
          $('#edit').click();
          setTimeout(load,0);
        }
      });
    });


    /*$.ajax({
      'type':'POST',
      'dataType' : 'json',
      'url' : '/php/ajax/updateChar.php',
      'data':out,

      'success': function(data)
      {
        load();
        //console.log(data);
      },
    });*/
  });
});

var toggle = 0;//1 = pane displayed, 0 hidden
function loadValues()
{
  $('#edit_name').val($('#displayName').text());
  $('#edit_race').val($('#race').text());
  $('#edit_class').val($('#class').text());

  $('#edit_str').val($('#str_score').text());
  $('#edit_dex').val($('#dex_score').text());
  $('#edit_con').val($('#con_score').text());
  $('#edit_int').val($('#int_score').text());
  $('#edit_wis').val($('#wis_score').text());
  $('#edit_cha').val($('#cha_score').text());

  $('#edit_exp').val($('#expval').text());
  $('#edit_maxhp').val($('#max_hp').text());

  $('#edit_vis option[value=' + parseInt($('#vis').text()) + ']').attr('selected','selected');
  //console.log('Name: ' +$('#displayName').text());
}
function activate()
{
  if($(this).hasClass('hp'))
  {
      $.post('/php/ajax/updatestat.php',
      {
        stat: 'Current_HP',
        val: $('#curr_hp').text(),
        char: getUrlParam('q'),
      },
      function(data,status)
      {
        //console.log('status: ' + status);
        //console.log('data: ' + data);
      })

      .done(function(data)
      {
          console.log(data);
      });
  }
  else if($(this).hasClass('admin') || $(this).hasClass('editControl'))
  {
    //console.log("Admin Activated");
    if($(this).is('#edit') || $(this).val() == 'Cancel')
    {
      if(toggle==1)
      {
        console.log("Edit pane disappearing");
        $('.sidenav').css('width','0');
        $('html').css('margin-left','0');
        toggle = 0;
      }
      else
      {
        console.log("Edit pane expanding");
        $('.sidenav').css('width','300px');
        $('html').css('margin-left','300px');
        toggle = 1;
      }
    }
    else if($(this).val() == 'Save')
    {
      $('#form').submit();
    }
    else if($(this).val() == 'Delete')
    {
      $('#pane-content').css('display','none');
      $('.delete_warning').css('display','block');
    }
    else if($(this).val() == 'No')
    {
      $('#pane-content').css('display','block');
      $('.delete_warning').css('display','none');
    }
    else if($(this).val() == 'Yes')
    {
      $.get('/php/character/deleteChar.php',{q:getUrlParam('q')})

      .done(function(result)
      {
        //console.log(result);
        window.location.href='/profile.php';
      });
    }
  }
}
