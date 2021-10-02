@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
          Mount Bracket Post-Wish View
          <!-- Pick a Footprint (outside post to post) -->
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Mount Bracket Post-Wish View</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Mount Bracket Post-Wish View</h3>
              <span class="float-right"><a class="btn btn-danger btn-sm" onclick="add_post_wish_canopy_fx()" style="margin-right: 10px;">Add Mount Bracket Post</a></span>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive scroll-demo-table p-0" >
            <div style="padding: 10px">
              <table class="table table-hover text-nowrap" id="show-piller-post-id">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Popup Details</th>
                    <th>Piller Post</th>
                    <th>Video Link</th>
                    <th>Mount Bracket Image</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="canopy-tbl-id">
                  <tr>
                    <td colspan="7"><center class="text-info"><i class="fa fa-spinner"></i> Loading data's</center></td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->

    </div><!-- /.container-fluid -->
</section>
  <!-- /.content -->
<!-- Post Wish mount bracket popup -->
<!-- The edit Modal -->
<div class="modal" id="pickup-popup-mount-modal-edit-id">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pickup Popup Mount Bracket Edit</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form role="form" action="{{ route('admin.setup.popup.edit-mount-bracket-submit') }}" enctype='multipart/form-data' method="POST">
        @csrf
        <input type="hidden" name="popup_hidden_id" class="popup-hidden-id" />
            <div class="form-group">
                <label for="image-links-id">Popup Name:</label>
                <input type="text"  name="popup_name" class="form-control" placeholder="Enter the popup link name" id="popup-name-id" >
            </div>
            <div class="form-group">
                <label for="edit_popup_description_name">Popup Description:</label>
                <textarea  name="edit_popup_description_name" required class="form-control" placeholder="Enter the descriptions" id="edit_popup_description_name" rows=5></textarea>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
        </form>
      </div>


    </div>
  </div>
</div>
<!-- The Modal -->
<div class="modal" id="pickup-popup-mount-modal-add-id">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pickup Popup Mount Bracket Add</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form role="form" action="{{ route('admin.setup.popup.add-mount-bracket-submit') }}" enctype='multipart/form-data' method="POST">
        @csrf
            <input type="hidden" name="popup_hidden_id" class="popup-hidden-id" />
            <div class="form-group">
                <label for="image-links-id">Popup Name:</label>
                <input type="text"  name="popup_name" class="form-control" placeholder="Enter the popup link name" id="popup-name-id" >
            </div>
            <div class="form-group">
                <label for="popup_description_name">Popup Description:</label>
                <textarea  name="popup_description_name" required class="form-control" placeholder="Enter the descriptions" id="popup_description_name" rows=5></textarea>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
        </form>
      </div>


    </div>
  </div>
</div>
<!-- /post wish mount bracket popup model -->
<!-- Post Wish Canopy Model -->
<!-- The Modal -->
<div class="modal" id="post-wish-canopy-modal-id">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pickup Mount Bracket Add</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form role="form" action="{{ route('admin.setup.mount-bracket-submit') }}" enctype='multipart/form-data' method="POST">
        @csrf
            <div class="form-group">
                <label for="piller-post-id">Piller Post:</label>
                <select class="form-control" required name="piller_post_name" id="piller-post-id">
                    <option value="">Choose piller type</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image-links-id">Image File:</label>
                <input type="file"  name="mount_image_file_name" class="form-control" placeholder="Enter the video links" id="image-links-id" >
            </div>
            <div class="form-group">
                <label for="video-links-id">Video File: <b class="text-danger">( file size not more than 2mb * )</b></label>
                <input type="file"  name="mount_video_file_name" class="form-control" placeholder="Enter the video links" id="video-links-id" >
            </div>
            <div class="form-group">
                <label for="mount-description-id">Description:</label>
                <textarea  name="mount_description_name" required class="form-control" placeholder="Enter the descriptions" id="mount-description-id" rows=5></textarea>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
        </form>
      </div>


    </div>
  </div>
</div>
<!-- /post wish canopy model -->
<!-- Edit Post Wish Canopy Model -->
<!-- The Modal -->
<div class="modal" id="edit-post-wish-canopy-modal-id">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Post Wish Mount Bracket</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form role="form" action="{{ route('admin.setup.mount-bracket-update') }}" enctype='multipart/form-data' method="POST">
        @csrf
          <input type="hidden" name="canopy_name_hidden_id" id="canopy-name-hidden-id" value="" /> 
            <div class="form-group">
                <label for="piller-post-id">Piller Post:</label>
                <select class="form-control" required name="edit_piller_post_name" id="edit-piller-post-id">
                    <option value="">Choose piller type</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image-links-id">Image File:</label>
                <input type="file"  name="mount_image_file_name" class="form-control" placeholder="Enter the video links" id="image-links-id" >
                <div id="img-links-mount-image-id">

                </div>
            </div>
            <div class="form-group">
                <label for="video-links-id">Video File: <b class="text-danger">( file size not more than 2mb * )</b></label>
                <input type="file"  name="edit_canopy_video_file_name" class="form-control" placeholder="Enter the video links" id="video-links-id" >
                <div id="video-links-mount-video-id">

                </div>
            </div>
            <div class="form-group">
                <label for="canopy-description-id">Description:</label>
                <textarea  name="edit_canopy_description_name" required class="form-control" placeholder="Enter the descriptions" id="edit_canopy_description_name" rows=5></textarea>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
        </form>
      </div>


    </div>
  </div>
</div>
<!-- /post wish canopy model -->
@endsection
@section('adminjsContent')
<script>
    $(function(){
        load_canopy_video_fx();
        load_piller_post_fx();

        CKEDITOR.replace( 'mount_description_name' );
        var editor = CKEDITOR.replace( 'popup_description_name' );
        CKFinder.setupCKEditor( editor );
        var editEditor = CKEDITOR.replace( 'edit_popup_description_name' );
        CKFinder.setupCKEditor( editEditor );
    });

    function add_post_wish_canopy_fx()
    {
        $("#post-wish-canopy-modal-id").modal('show');
    }

    function load_canopy_video_fx()
    {
        $.ajax({
            url: "{{ route('admin.setup.mount-bracket-show-data') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#canopy-tbl-id").html(event.canopy_html);
            }, error: function(event){

            }
        })
    }

    function load_piller_post_fx()
    {
        $.ajax({
            url: "{{ route('admin.load-piller-post-for-wish-canopy') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#piller-post-id").html(event.piller_html);
            }, error: function(event){

            }
        });
    }


    function canopy_edit_fx(id)
    {
      $("#edit-post-wish-canopy-modal-id").modal('show');
      $("#canopy-name-hidden-id").val(id);
      $.ajax({
        url: "{{ route('admin.setup.mount-bracket-edit') }}",
        type: "GET",
        data: {edit_id: id},
        dataType: "json",
        success: function(e)
        {
            $("#edit-piller-post-id").html(e.piller_html);
            // $("#edit-canopy-description-id").html(e.description);
            CKEDITOR.replace( 'edit_canopy_description_name' );
            CKEDITOR.instances.edit_canopy_description_name.setData(e.description);
            if(e.img_files_id != null)
            {
              $("#img-links-mount-image-id").html('<img src="'+e.img_files+'" alt="no image" width="100px" height="100px" /><a href="javascript: ;" style="color: red; float: left; position: absolute; left: 20px; " onclick=onImgDelete('+e.imgId+')><i class="fa fa-trash"></i></a>');
            }
            else
            {
              $("#img-links-mount-image-id").html('');
            }

            if(e.video_files_id != null)
            {
              $("#video-links-mount-video-id").html('<video width="100" height="100" controls><source src="'+e.video_files+'" type="video/mp4"></video><a href="javascript: ;" style="color: red; float: left; position: absolute; left: 20px; " onclick=onVideoDelete('+e.imgId+')><i class="fa fa-trash"></i></a>');
            }
            else
            {
              $("#video-links-mount-video-id").html('');
            }
        },
        error: function(e)
        {

        }
      })
    }


    
    function mount_del_fx(id)
    {
      var x = confirm('Are you sure to delete this item?');
      if(x){
        $.ajax({
          url: "{{ route('admin.setup.mount-bracket-del') }}",
          type: "GET",
          data: {id: id},
          dataType: "json",
          success: function(event){
            if(event == "success"){
              var alert_msg = "Successfully deleted";
              success_pass_alert_show_msg(alert_msg);
              location.reload();
            }else if(event == "error"){
              var alert_msg = "Something wrong! Try again later";
              error_pass_alert_show_msg(alert_msg);
            }
          }, error: function(event){

          }
        })
      }else{

      }
    }


    function onImgDelete(id)
    {
      $.ajax({
        url: "{{ route('admin.setup.mount-bracket-img-del') }}",
        type: "GET",
        data: {id: id},
        dataType: "json",
        success: function(event)
        {
            if(event == "success"){
              var alert_msg = "Successfully deleted";
              success_pass_alert_show_msg(alert_msg);
              location.reload();
            }else if(event == "error"){
              var alert_msg = "Something wrong! Try again later";
              error_pass_alert_show_msg(alert_msg);
            }
        },
        error: function(event)
        {

        }
      })
    }


    function onVideoDelete(id)
    {
      $.ajax({
        url: "{{ route('admin.setup.mount-bracket-video-del') }}",
        type: "GET",
        data: {id: id},
        dataType: "json",
        success: function(event)
        {
            if(event == "success"){
              var alert_msg = "Successfully deleted";
              success_pass_alert_show_msg(alert_msg);
              location.reload();
            }else if(event == "error"){
              var alert_msg = "Something wrong! Try again later";
              error_pass_alert_show_msg(alert_msg);
            }
        },
        error: function(event)
        {
          
        }
      })
    }

    function popup_window_fx(id, state)
    {
      $(".popup-hidden-id").val(id);
      if(state == "Edit")
      {
        $("#pickup-popup-mount-modal-edit-id").modal('show');
        $("#pickup-popup-mount-modal-add-id").modal('hide');
        edit_popup_window_fx(id);
      }
      else if(state == "Add")
      {
        $("#pickup-popup-mount-modal-add-id").modal('show');
        $("#pickup-popup-mount-modal-edit-id").modal('hide');
      }
    }

    function edit_popup_window_fx(id)
    {
      $.ajax({
        url: "{{ route('admin.popup.mount-bracket-window-edit-data') }}",
        type: "GET",
        data: {id: id},
        dataType: "json",
        success: function(event){
            $("#popup-name-id").val(event.popup_name);
            CKEDITOR.replace( 'edit_popup_description_name' );
            CKEDITOR.instances.edit_popup_description_name.setData(event.popup_details);
        }, error: function(event){

        }
      })
    }
</script>
@endsection