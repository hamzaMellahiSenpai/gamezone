
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
/* LIKES ANIMATION START */
$('.like, .dislike').on('click', function() {
    event.preventDefault();
    if($(this).hasClass('active')){
        $(this).removeClass('active');
    }else {
      $('.active').removeClass('active');
      $(this).addClass('active');
    }
});
$('.like').click( function(){
  let like_s = $(this).hasClass('active');
  let post_id = parseInt($(this).attr('data-postid'));
  ////
  $.ajax({
    url : url_like,
    type:"POST",
    data: {
      _token : token,
      post_id : post_id
    }
  }).done((data)=>{
    console.log(data);
    //$(this).addClass('active').siblings().removeClass('active');
    if(data.is_like){
      //$('.active').removeClass('active');
        let likes_count = parseInt($('#li_count').text());
        let new_count  = likes_count + 1;
        $('#li_count').text(new_count);
      if(data.like_change){
        let dislikes_count = parseInt($('#dis_count').text());
        let new_dislikes_count  = dislikes_count - 1;
        $('#dis_count').text(new_dislikes_count);
      }
    }else {
      $(this).removeClass('active');
      let likes_count = parseInt($('#li_count').text());
      let new_count  = likes_count - 1;
      $('#li_count').text(new_count);
    }
  });
});
$('.dislike').click( function(){
  let post_id = $(this).attr('data-postid');
  ////
  $.ajax({
    type:"POST",
    url : url_dislike,
    data: {
      post_id : post_id, _token : token
    }
  }).done((data)=>{
      console.log(data);
      //$(this).addClass('active').siblings().removeClass('active');
      if(data.is_dislike){
       // $(this).addClass('active').siblings().removeClass('active');
        //$('.active').removeClass('active');
        let dislikes_count = parseInt($('#dis_count').text());
        let new_count  = dislikes_count + 1;
        $('#dis_count').text(new_count);
        if(data.dislike_change){
          let likes_count = parseInt($('#li_count').text());
          let new_likes_count  = likes_count - 1;
          $('#dis_count').text(new_likes_count);
        }
      }else {
        $(this).removeClass('active');
        let dislikes_count = parseInt($('#dis_count').text());
        let new_count  = dislikes_count - 1;
        $('#dis_count').text(new_count);
      }
  });
});
// SCROLL TO TOP ANIMATION
let doc = 'html, body';
let but = "#scrollToTop";
$(window).scroll(function(){
    $(but).on("click", function(){
      $(doc).animate({scrollTop:0},1000)
    });
    //$(this).scrollTop();
    //($(this).scrollTop() > 800 ) ? fadeIn() : fadeOut()
    if($(this).scrollTop() > 400 ){
        $(but).fadeIn();
    }else {
        $(but).fadeOut()
    }
     // ADD NAVBAR FIXED CLASS
    if($(window).scrollTop() > 30){
      $('nav').addClass("nav-fixed");
    }else {
      $('nav').removeClass('nav-fixed')
    };

});
console.log('works');
// GET THE CURRENT VIEWS OF POST
let curViews = $('#viewsCounter').val();
let post_id = $('#postID').val();
let newViews = parseInt(curViews) + 1;
// ADD ONE TO THE CUR VALUE
$('#viewsCounter').val(newViews);
$.ajax({
  url:url,
  type:"POST",
  data: {
    _token : token,
    post_id : post_id,
    views : newViews
  }
}).done(function(){
  console.log('hello world')
});
$(window).scroll(function(){
 var navTop =  $(window).scrollTop();
 $('.model-0').css("top", navTop );
});


