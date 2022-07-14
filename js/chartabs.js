var level;

$(document).ready(function()
{
  $('.tablinks').click(showPane);
  load();
});

function load()
{
  loadInfo();
  loadStats();
  loadMoney();
  loadEquipment();
  loadAbilities();
}
function showPane()
{
  var test = $(this).val();

  $('.tabcontent').css('display','none');
  $('.tablinks').removeClass("active");
  $(this).addClass('active');
  $('.'+test).css('display','block');
}
function loadInfo()
{
  //console.log("Requesting character info");
  $.get('/php/character/getInfo.php', {q:getUrlParam('q')})

  .done(function(result)
  {
    result = JSON.parse(result);
    //console.log(result);
    if(result != null)
    {
      //console.log("Displaying info");
      $('.displayName').text(result.name);
      $('#class').text(result.class);
      $('#race').text(result.race);
      $('#profile-pic').attr('src',result.img_url);

      $('#curr_hp').text(result.hp);
      $('#max_hp').text(result.max);
      $('#fade').css('width',''+result.hpwidth+'%');
      var color = 'rgba(57,210,81,' + result.hpwidth/100 + ')';
      $('hp').css('background-color',''+color);

      $('#expval').text(result.exp);
      $('#exp_next').text(result.exp_next);
      $('exp').css('width',''+result.expwidth+'%');

      //console.log("Vis: " + result.vis);
      $('#vis_0, #vis_1').css('display','none');

      $('#vis_'+result.vis).css('display','block');
      $('#vis').text(result.vis);
    }
  })
}

function loadStats()
{
  //console.log("Requesting character stats");
  $.get('/php/character/getStats.php', {q:getUrlParam('q')})

  .done(function(result)
  {
    result = JSON.parse(result);
    //console.log(result);
    if(result != null)
    {
        //console.log("Displaying stats");
        $('#str_score').text(result.str_score);
        $('#dex_score').text(result.dex_score);
        $('#con_score').text(result.con_score);
        $('#int_score').text(result.int_score);
        $('#wis_score').text(result.wis_score);
        $('#cha_score').text(result.cha_score);

        $('#str_bonus').text(result.str_bonus);
        $('#dex_bonus').text(result.dex_bonus);
        $('#con_bonus').text(result.con_bonus);
        $('#int_bonus').text(result.int_bonus);
        $('#wis_bonus').text(result.wis_bonus);
        $('#cha_bonus').text(result.cha_bonus);

        //$('.abilities span[id*="_val"]').each(function(index)
        //{
          //console.log(index + ': ' + $(this).text(index));
        //});
        $('.str').each(function(index)
        {
          $(this).text(result.str_bonus);
        })
        $('.dex').each(function(index)
        {
          $(this).text(result.dex_bonus);
        })
        $('.con').each(function(index)
        {
          $(this).text(result.con_bonus);
        })
        $('.int').each(function(index)
        {
          $(this).text(result.int_bonus);
        })
        $('.wis').each(function(index)
        {
          $(this).text(result.wis_bonus);
        })
        $('.cha').each(function(index)
        {
          $(this).text(result.cha_bonus);
        })
    }

  });

}
function loadMoney()
{
  //console.log("Requesting money info");
  $.get('/php/character/getMoney.php', {q:getUrlParam('q')})

  .done(function(result)
  {
    result = JSON.parse(result);
    //console.log(result);
    if(result != null)
    {
      $('#cp').text(result.cp);
      $('#sp').text(result.sp);
      $('#ep').text(result.ep);
      $('#gp').text(result.gp);
      $('#pp').text(result.pp);

      $('#edit_cp').val(result.cp);
      $('#edit_sp').val(result.sp);
      $('#edit_ep').val(result.ep);
      $('#edit_gp').val(result.gp);
      $('#edit_pp').val(result.pp);
    }
    else {
      console.log("No money");
    }
  })
}

function loadEquipment()
{
  //console.log("Requesting equipment info");
  $.get('/php/character/getEquipment.php', {q:getUrlParam('q')})

  .done(function(result)
  {
    result = JSON.parse(result);
    //console.log(result);

    if(result != null)
    {
      result.forEach(function(data)
      {
        $('#inventory tr:last').after('<tr><td>'+data.count+'x</td><td>' + data.name + "</td><td>"+data.value + ' '+data.value_type + '</td><td>'+data.weight+'</td></tr>');
        //console.log(data.name);
      });
    }
  })
}
function loadAbilities()
{
  //console.log("Requesting ability info");

  $.get('/php/character/getAbilities.php', {q:getUrlParam('q')})

  .done(function(result)
  {
    var level = 0;
    result = JSON.parse(result);
    //console.log(result);
    result.abilities.forEach(function(data)
    {
      //console.log(data);
      var prof = data[0];
      var bonus = (result.level-1)/4+2;
      bonus = Math.floor(bonus);
      if(bonus >=0) bonus = '+' + bonus;
      $('#prof_val').text(bonus);

      if(data[1] == 1)
      {
        $('#'+prof+'_prof').css('visibility','visible');
        var base = parseInt($('#'+prof+'_val').text());
        var final = base + parseInt(bonus);
        //console.log(final);
        if(final >= 0)
        {
          final = '+' + final;
        }
        $('#'+prof+'_val').text(final);
        $('#'+prof+'_prof_edit').attr('checked','checked');
      }
      else
      {
        $('#'+prof+'_prof').css('visibility','hidden');
        $('#'+prof+'_prof_edit').attr('checked',false);
      }

      //console.log('total level is ' + result.level);
      //console.log('prof bonus is ' + bonus);

    })
  })
}
function getUrlParam(param)
{
  param = param.replace(/([\[\](){}*?+^$.\\|])/g, "\\$1");
  var regex = new RegExp("[?&]" + param + "=([^&#]*)");
  var url   = decodeURIComponent(window.location.href);
  var match = regex.exec(url);
  return match ? match[1] : "";
}
