function announcement_form(){
  var form          = $("#announcement_form");
  var id    = $("#announcement_id").val();
  var announcement_title = $("#title").val();
  var description = $("#description").val();
  var base_url     = $("#base_url").val();

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

  let form_data = new FormData();
  form_data.append('title', announcement_title)
  form_data.append('description', description)
  form_data.append('banner', $('#banner')[0].files[0])
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
      "aaSorting": [[ 2, "desc" ]],
      "columnDefs": [
          { "bSortable": false, "aTargets": [0,1,3] },

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
});