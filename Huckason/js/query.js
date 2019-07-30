$(function(){

  $('button').click(
    function(){
      $('button:focus').css('outline','0');
    }
  );

  $('#lavel1').click(
  function(){
      $('h3').html('<img src="curry_ko.png" class="img_first"></img>');
    $('#lavel1').css('background-color','yellow');
    $('#lavel1').css('border','solid','0.5px','black');
    $('#lavel2').css('border','none');
    $('#lavel3').css('border','none');
    $('#lavel2').css('background-color','white');
    $('#lavel3').css('background-color','white');
    }
  );

  $('#lavel2').click(
    function(){
      $('h3').html('<img src="cooking_hoajyao.png" class="img_first"></img>');
      $('#lavel2').css('background-color','yellow');
      $('#lavel2').css('border','solid','0.5px','black');
      $('#lavel1').css('border','none');
      $('#lavel3').css('border','none');
      $('#lavel1').css('background-color','white');
      $('#lavel3').css('background-color','white');
      }
    );

    $('#lavel3').click(
      function(){
      $('h3').html('<img src="cooking_spice_pepper_tsubu.png" class="img_first"></img>');
        $('#lavel3').css('background-color','yellow');
        $('#lavel3').css('border','solid','0.5px','black');
        $('#lavel1').css('border','none');
        $('#lavel2').css('border','none');
        $('#lavel2').css('background-color','white');
        $('#lavel1').css('background-color','white');
        }
      );
});
