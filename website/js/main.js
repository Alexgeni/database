$(document).ready(function() {
  $('#btn-login').on('click',function(){
    $('#ierr').text("");
    $('#perr').text("");
    if($('#sid').val()==''){
      $('#ierr').text("ENTER VALID ID");
    }
    else if($('#pword').val()==''){
      $('#perr').text("ENTER VALID PASSWORD");
    }
    else{
      $('login-form').submit();
    }
  });
