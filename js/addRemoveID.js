$(document).ready(function(){
    $(".sidebar a").on('click', function(){
      $(this).siblings().removeClass('active');
      $(this).addClass('active')
    })
  })
  function savesubcat(){
    return null
  }