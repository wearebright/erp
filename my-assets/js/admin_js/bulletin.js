function announcement_form(){
  var form          = $("#announcement_form");
  var id    = $("#announcement_id").val();
  var announcement_title = $("#title").val();
  var description = $("#description").val();
  var base_url     = $("#base_url").val();
  var banner = $('#banner')[0].files[0];

  if(id !==''){
    var form_url = base_url+'edit_announcement/'+id;
  }else{
    var form_url = base_url+'add_announcement';
  }

  if (announcement_title == '') {
    $("#announcement_title").focus();
    toastr["error"]("Title must be required");
    setTimeout(function () {
    }, 500);
    return false;
  }

  if (description == '') {
    $("#description").focus();
    toastr["error"]("Description must be required");
    setTimeout(function () {
    }, 500);
    return false;
  }

  var size = $('#attachment')[0].files[0].size;
  if(size > 10000000){
    toastr["error"]("Attachment should be maximum of 10MB");
    setTimeout(function () {
    }, 500);
    return false;
  }

  let form_data = new FormData();
  form_data.append('title', announcement_title)
  form_data.append('description', description)
  form_data.append('banner', banner)
  form_data.append('attachment', $('#attachment')[0].files[0])
  form_data.append('old_banner', $('#old_banner').val())
  form_data.append('old_attachment', $('#old_attachment').val())
  form_data.append('announcement_id', $('#announcement_id').val())

  $.ajax({
      url : form_url,
      method : 'POST',
      data : form_data,
      cache: false, 
      contentType: false,
      processData: false,
      success: function(r) 
      {
        /* var r = JSON.parse(r);
        console.log(r);
          if(r.status === 1){
            if(id ==''){
              window.location = '/manage_announcement'
            }else{
              setTimeout(function () {
                location.reload();
              }, 1000);
            }
            toastr["success"](r.msg);
          }else{
            toastr["error"](r.msg);
          } */
      },
      error: function(xhr)
      {
          alert('failed!');
      }
  });
}

function announcementdelete(id){
  var base_url     = $("#base_url").val();

  var form_url = base_url+'delete_announcement';

  let form_data = new FormData();
  form_data.append('id', id)

  $.ajax({
      url : form_url,
      method : 'POST',
      data : form_data,
      cache: false, 
      contentType: false,
      processData: false,
      success: function(r) 
      {
        var r = JSON.parse(r);
        console.log(r);
          if(r.status === 1){
            if(id ==''){
              window.location = '/manage_announcement'
            }else{
              setTimeout(function () {
                location.reload();
              }, 1000);
            }
            toastr["success"](r.msg);
          }else{
            toastr["error"](r.msg);
          }
      },
      error: function(xhr)
      {
          alert('failed!');
      }
  });
}


function sliderdelete(id){
  var base_url     = $("#base_url").val();

  var form_url = base_url+'delete_slider';

  let form_data = new FormData();
  form_data.append('id', id)

  $.ajax({
      url : form_url,
      method : 'POST',
      data : form_data,
      cache: false, 
      contentType: false,
      processData: false,
      success: function(r) 
      {
        var r = JSON.parse(r);
        console.log(r);
          if(r.status === 1){
            if(id ==''){
              window.location = '/manage_slider'
            }else{
              setTimeout(function () {
                location.reload();
              }, 1000);
            }
            toastr["success"](r.msg);
          }else{
            toastr["error"](r.msg);
          }
      },
      error: function(xhr)
      {
          alert('failed!');
      }
  });
}

function slider_form(){
  var id    = $("#slider_id").val();
  var banner = $('#banner')[0].files[0];
  var link = $("#link").val();
  var base_url     = $("#base_url").val();

  if(id !==''){
    var form_url = base_url+'edit_slider/'+id;
  }else{
    var form_url = base_url+'add_slider';
  }

  if (typeof banner == 'undefined' && $('#old_banner').val()  == '' ) {
    $("#banner").focus();
    toastr["error"]("Banner/Slider Image must be required");
    setTimeout(function () {
    }, 500);
    return false;
  }

  /* if (link == '') {
    $("#link").focus();
    toastr["error"]("Link must be required");
    setTimeout(function () {
    }, 500);
    return false;
  }
 */
  let form_data = new FormData();
  form_data.append('link', link)
  form_data.append('slider_id', id);
  form_data.append('banner', $('#banner')[0].files[0])
  form_data.append('old_banner', $('#old_banner').val())
  if ($('#featured').prop('checked')) {
    featured = 1;
  }else{
    featured = 0;
  }

  form_data.append('enabled', featured)
  $.ajax({
      url : form_url,
      method : 'POST',
      data : form_data,
      cache: false, 
      contentType: false,
      processData: false,
      success: function(r) 
      {
        var r = JSON.parse(r);
        console.log(r);
          if(r.status === 1){
            if(id ==''){
              window.location = '/manage_slider'
            }else{
              setTimeout(function () {
                location.reload();
              }, 1000);
            }
            toastr["success"](r.msg);
          }else{
            toastr["error"](r.msg);
          }
      },
      error: function(xhr)
      {
          alert('failed!');
      }
  });
}

function sticky_image_form(){
  var id    = $("#sticky_image_id").val();
  var image = $('#sticky_image')[0].files[0];
  var base_url     = $("#base_url").val();

  var form_url = base_url+'update_sticky_image';


  if (image == '') {
    $("#banner").focus();
    toastr["error"]("Banner/Slider Image must be required");
    setTimeout(function () {
    }, 500);
    return false;
  }

  let form_data = new FormData();
  form_data.append('id', id);
  form_data.append('sticky_image', image);
  form_data.append('old_sticky_image', $('#old_sticky_image').val());

  $.ajax({
      url : form_url,
      method : 'POST',
      data : form_data,
      cache: false, 
      contentType: false,
      processData: false,
      success: function(r) 
      {
          var r = JSON.parse(r);
          if(r.status === 1){
            if(id ==''){
              window.location = '/update_sticky_image'
            }else{
              setTimeout(function () {
                location.reload();
              }, 1000);
            }
            toastr["success"](r.msg);
          }else{
            toastr["error"](r.msg);
          }
      },
      error: function(xhr)
      {
          alert('failed!');
      }
  });
}

$(document).ready(function() { 
  // customer list
  var CSRF_TOKEN = $('#CSRF_TOKEN').val();
  var base_url  = $('#base_url').val();
  var mydatatable = $('#AnnouncementList').DataTable({
          responsive: true,
          "aaSorting": [[ 0, "asc" ]],
          "columnDefs": [
              { "bSortable": false, "aTargets": [2,4] },

          ],
          'processing': true,
          'serverSide': true,
          'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
          'serverMethod': 'post',
          'ajax': {
              'url':base_url + 'bulletin/announcement/announcementList',
              "data": function ( data) {
                data.csrf_test_name = CSRF_TOKEN;
                data.customfiled =  $("select[name='customsearch[]']").val();
              },    
          },
          'columns': [
            { data: 'title' },
            { data: 'name'},
            { data: 'banner'},
            { data: 'created_at' },
            { data: 'button'},
          ],
  });


  $('#SliderList').DataTable({
      responsive: true,
      "aaSorting": [[ 3, "desc" ]],
      "columnDefs": [
          { "bSortable": false, "aTargets": [0,1,4] },

      ],
      'processing': true,
      'serverSide': true,
      'lengthMenu':[[10, 25, 50,100,250,500, -1], [10, 25, 50,100,250,500, "All"]],
      'serverMethod': 'post',
      'ajax': {
          'url':base_url + 'bulletin/slider/sliderList',
          "data": function ( data) {
            data.csrf_test_name = CSRF_TOKEN;
            data.customfiled =  $("select[name='customsearch[]']").val();
          },    
      },
      'columns': [
        { data: 'image' },
        { data: 'link'},
        { data: 'enabled'},
        { data: 'created_at' },
        { data: 'button'},
      ],
  });
  

  $('#banner').on('change', function (event){
    var output = document.getElementById('banner_preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  })

  $('#sticky_image').on('change', function (event){
    var output = document.getElementById('banner_preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  })

  $("#carousel").owlCarousel({
    items: 1,			// Maximum number of items to show at a time
    lazyLoad: true,		// Do not load image content until frame is in focus
    navigation: false,	// Enabled navigation buttons
    singleItem: true,	// Show only one item at a time (prevents flash of upcoming content)
    pagination: true,	// Prevent loading of pagination bullets
    autoHeight: true,	// Auto-height
    autoPlay:true,
    loop:true,
  });

  $('.load-more').click(function(){
    var row = Number($('#row').val());
    var allcount = Number($('#all').val());
    var rowperpage = 5;
    row = row + rowperpage;

    if(row <= allcount){
        $("#row").val(row);

        $.ajax({
            url: base_url + 'bulletin/bulletin/getPaginateData',
            type: 'post',
            data: {row:row},
            beforeSend:function(){
                $(".load-more").text("Loading...");
            },
            success: function(response){
                // Setting little delay while displaying new content
                setTimeout(function() {
                    // appending posts after last post with class="post"
                    $(".post:last").after(response).show().fadeIn("slow");

                    var rowno = row + rowperpage;

                    // checking row value is greater than allcount or not
                    if(rowno > allcount){
                        // Change the text and background
                        $('.load-more').remove();
                        $('.load-more').css("background","darkorchid");
                    }else{
                        $(".load-more").text("Load more");
                    }
                }, 2000);

            }
        });
    }
  });
});

var fixmeTop = $('.fixme').offset().top;
$(window).scroll(function() {
    var currentScroll = $(window).scrollTop();
    if (currentScroll >= fixmeTop) {
        $('.fixme').css({
            position: 'fixed',
            top: '0',
            left: '0'
        });
    } else {
        $('.fixme').css({
            position: 'static'
        });
    }
});