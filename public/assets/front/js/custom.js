$(function ($) {
    "use strict";


    


//**************************** CUSTOM JS SECTION ****************************************
    $(document).ready(function () {
      // LOADER
        if(gs.is_loader == 1)
        {
          $(window).on("load", function (e) {
            setTimeout(function(){
                $('#preloader').fadeOut(500);
              },100)
          });
        }

      // LOADER ENDS

        //  Alert Close




      //More Categories
      $('.rx-parent').on('click', function() {
              $('.rx-child').toggle();
              $(this).toggleClass('rx-change');
          });

    });


        $("button.alert-close").on('click',function(){
          $(this).parent().hide();
        });

      function flashysuccess(msg){
           flashy(msg, {
              type : 'flashy__success',              
              timeout: 5000
            });
      }
      function flashydanger(msg){
           flashy(msg, {
              type : 'flashy__danger',              
              timeout: 5000
            });
      }


    //  FORM SUBMIT SECTION

    $(document).on('submit','#contactform',function(e){
      e.preventDefault();
      $('.gocover').show();
      $('button.submit-btn').prop('disabled',true);
          $.ajax({
           method:"POST",
           url:$(this).prop('action'),
           data:new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
              if ((data.errors)) {
              $('.alert-success').hide();
              $('.alert-danger').show();
              $('.alert-danger ul').html('');
                for(var error in data.errors)
                {
                  $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
                }
                $('#contactform input[type=text], #contactform input[type=email], #contactform textarea').eq(0).focus();
                $('#contactform #reload-cap').trigger('click');

              }
              else
              {
                $('.alert-danger').hide();
                $('.alert-success').show();
                $('.alert-success p').html(data);
                $('#contactform input[type=text], #contactform input[type=email], #contactform textarea').eq(0).focus();
                $('#contactform input[type=text], #contactform input[type=email], #contactform textarea').val('');
                $('#contactform #reload-cap').trigger('click');

              }
              $('.gocover').hide();
              $('button.submit-btn').prop('disabled',false);
           }

          });

    });
    //  FORM SUBMIT SECTION ENDS


    //  SUBSCRIBE FORM SUBMIT SECTION

    $(document).on('submit','.subscribeform',function(e){
      e.preventDefault();
     var $this=$(this);
      $('#sub-btn').prop('disabled',true);
      $('#loading').css("display", "inline-block");
          $.ajax({
           method:"POST",
           url:$(this).prop('action'),
           data:new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
              if ((data.errors)) {

                for(var error in data.errors) {
                  flashydanger(data.errors[error]);
                }
              }
              else {
                 flashysuccess(data);
                 $this.find('.custom-form-input,.empty-me').val('');
                  $('.preload-close').click();
              }

              $('#sub-btn').prop('disabled',false);
              $('#loading').hide();

           }


          });


    });

    //  SUBSCRIBE FORM SUBMIT SECTION ENDS




// COMMENT FORM

$(document).on('submit','#comment-form',function(e){
  e.preventDefault();


  $('#comment-form').find('.alert-danger').hide();  
  $('#comment-form button.submit-btn').prop('disabled',true);
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
        if ((data.errors)) {
            $('#comment-form').find('.alert-success').hide();
            $('#comment-form').find('.alert-info').hide();
            $('#comment-form').find('.alert-danger').show();
            $('#comment-form').find('.alert-danger ul').html('');
            for (var error in data.errors) {
              $('#comment-form').find('.alert-danger ul').html('<li class="ppn">'+ data.errors[error] +'</li>');
            }
          }
          else{
            // $("#comment_count").html(data[4]);
            $('#comment-form textarea').val('');
            $('#comment-form .email-rpeat').val('');
            // var txt='<div class="ps-block--comment"><div class="ps-block__thumbnail"><img src="'+data[0]+'" alt=""></div><div class="ps-block__content"><h5>'+ data[1] +'<small class="sp-txt">'+ data[2] +'</small></h5><p class="sp-txt">'+ data[3] +'</p></div></div>';
            // $('.all-comment').append(txt);
            flashysuccess(data[5]);
          }


          $('#comment-form button.submit-btn').prop('disabled',false);
       }

      });
});

// COMMENT FORM ENDS


    $(document).on('submit','#reviewform',function(e){
      var $this = $(this);
      e.preventDefault();
      $('.gocover').show();
      $('button.submit-btn').prop('disabled',true);
          $.ajax({
           method:"POST",
           url:$(this).prop('action'),
           data:new FormData(this),
           contentType: false,
           cache: false,
           processData: false,
           success:function(data)
           {
              if ((data.errors)) {
              $('.alert-success').hide();
              $('.alert-danger').show();
              $('.alert-danger ul').html('');
                for(var error in data.errors)
                {
                  $('.alert-danger ul').append('<li>'+ data.errors[error] +'</li>')
                }
                $('#reviewform textarea').eq(0).focus();

              }
              else
              {
                $('.alert-danger').hide();
                $('.alert-success').show();
                $('.alert-success p').html(data[0]);
                $('#star-rating').html(data[1]);
                $('#reviewform textarea').eq(0).focus();
                $('#reviewform textarea').val('');
                // $('#reviews-section').load($this.data('href'));
              }
              $('.gocover').hide();
              $('button.submit-btn').prop('disabled',false);
           }

          });
    });

// Review Section Ends

// REPLY FORM

$(document).on('submit','#rc-reply-form',function(e){
  e.preventDefault();
  
  var url1=$(this).prop('action')
  console.log(url1);;
    var btn = $(this).find('button[type=submit]');
    btn.prop('disabled',true);
    var $this = $(this).parent().parent();
    var text = $(this).find('textarea');
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
        console.log(data);
          // $('#comment-form textarea').val('');
          $('button.submit-btn').prop('disabled',false);
          // var txt='<hr><div class="ps-block--comment"><div class="ps-block__thumbnail"><img src="'+data[0]+'" alt=""></div><div class="ps-block__content"><h5>'+ data[1] +'<small class="sp-txt">'+ data[2] +'</small></h5><p class="sp-txt">'+ data[3] +'</p></div></div>';
          // $('a[data-href="'+url1+'"]').first().siblings(".chain-reply").append(txt);
          $('#exampleModal').modal('hide');
          flashysuccess(data[4]);

          // text.val('');
          btn.prop('disabled',false);
       }

      });
});

// REPLY FORM ENDS

// EDIT
$(document).on('click','.edit',function(){
  var text = $(this).parent().parent().prev().find('p').html();
  text = $.trim(text);
  $(this).parent().parent().parent().parent().next('.edit-area').find('textarea').val(text);
  $(this).parent().parent().parent().parent().next('.edit-area').toggle();
});
// EDIT ENDS

// UPDATE
$(document).on('submit','.update',function(e){
  e.preventDefault();
  var btn = $(this).find('button[type=submit]');
  var text = $(this).parent().prev().find('.right-area .comment-body p');
  var $this = $(this).parent();
  btn.prop('disabled',true);
      $.ajax({
       method:"POST",
       url:$(this).prop('action'),
       data:new FormData(this),
       contentType: false,
       cache: false,
       processData: false,
       success:function(data)
       {
        text.html(data);
        $this.toggle();
        btn.prop('disabled',false);
       }
      });
});
// UPDATE ENDS

// COMMENT DELETE
$(document).on('click','.comment-delete',function(){
  var count = parseInt($("#comment_count").html());
  count--;
  $("#comment_count").html(count);
  $(this).parent().parent().parent().parent().parent().remove();
  $.get($(this).data('href'));
});
// COMMENT DELETE ENDS


// COMMENT REPLY
$(document).on('click','.reply',function(){
  $(this).parent().parent().parent().parent().parent().show().find('.reply-reply-area').show();
  $(this).parent().parent().parent().parent().parent().show().find('.reply-reply-area .reply-form textarea').focus();

});
// COMMENT REPLY ENDS

// REPLY DELETE
$(document).on('click','.reply-delete',function(){
  $(this).parent().parent().parent().parent().remove();
  $.get($(this).data('href'));
});
// REPLY DELETE ENDS

// View Replies
$(document).on('click','.view-reply',function(){
  $(this).parent().parent().parent().parent().siblings('.replay-review').removeClass('hidden');

});
// View Replies ENDS

// CANCEL CLICK

$(document).on('click','#comment-area .remove',function(){
  $(this).parent().parent().hide();
});

// CANCEL CLICK ENDS




});
