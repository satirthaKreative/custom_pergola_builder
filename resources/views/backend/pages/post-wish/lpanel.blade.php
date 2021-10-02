@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
          Louvered Post Wish View
          <!-- Pick a Footprint (outside post to post) -->
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Louvered Post Wish View</li>
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
              <h3 class="card-title">Louvered Post Wish View</h3>
              <span class="float-right"><a class="btn btn-danger btn-sm" onclick="add_post_wish_lpanel_fx()" style="margin-right: 10px;">Add Posts Wish Louvered</a></span>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive scroll-demo-table p-0" >
            <div style="padding: 10px">
              <table class="table table-hover text-nowrap" id="show-piller-post-id">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Piller Post</th>
                    <th>Popup Details</th>
                    <th>Video Link</th>
                    <th>Image Link</th>
                    <th>Descriptions</th>
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

<!-- Main content -->
<!-- <section class="content">
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Louvered Panel Type Wish Text</h3>
              <span class="float-right"><a class="btn btn-danger btn-sm" onclick="add_louvered_panel_type_text_fx()" style="margin-right: 10px;">Add Louvered Panel Text</a></span>
            </div>
            <div class="card-body table-responsive scroll-demo-table p-0" >
            <div style="padding: 10px">
              <table class="table table-hover text-nowrap" id="show-piller-post-id">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Louvered Panel Types</th>
                    <th>Panel Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="post-wish-lpanel-type-text-id">
                  <tr>
                    <td colspan="4"><center class="text-info"><i class="fa fa-spinner"></i> Loading data's</center></td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section> -->
  <!-- /.content -->

<!-- Post Wish Canopy Model -->
<!-- The Modal -->
<div class="modal" id="post-wish-canopy-modal-id">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Post Wish Louvered</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form role="form" action="{{ route('admin.postwish-lpanel-submit-new') }}" enctype='multipart/form-data' method="POST">
        @csrf
            <div class="form-group">
                <label for="piller-post-id">Piller Post:</label>
                <select class="form-control" required name="piller_post_name" id="piller-post-id">
                    <option value="">Choose piller type</option>
                </select>
            </div>
            <div class="form-group">
                <label for="video-links-id">Video File: <b class="text-danger">( file size not more than 2mb * )</b></label>
                <input type="file"  name="lpanel_video_file_name" class="form-control" placeholder="Enter the video links" id="video-links-id" >
            </div>
            <div class="form-group">
                <label for="video-links-id">Image File: <b class="text-danger">( file size not more than 2mb * )</b></label>
                <input type="file"  name="lpanel_image_file_name" class="form-control" placeholder="Enter the image links" id="image-links-id" >
            </div>
            <div class="form-group">
                <label for="description-id">Descriptions: </label>
                <textarea name="description" required class="form-control" placeholder="Enter the descriptions" id="description-id" ></textarea>
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
<div class="modal" id="edit-post-wish-lpanel-modal-id">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Post Wish Louvered</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form role="form" action="{{ route('admin.postwish-lpanel-submit-update') }}" enctype='multipart/form-data' method="POST">
        @csrf
          <input type="hidden" name="lpanel_name_hidden_id" id="lpanel-name-hidden-id" value="" /> 
            <div class="form-group">
                <label for="piller-post-id">Piller Post:</label>
                <select class="form-control" required name="edit_piller_post_name" id="edit-piller-post-id">
                    <option value="">Choose piller type</option>
                </select>
            </div>
            <div class="form-group">
                <label for="video-links-id">Video File: <b class="text-danger">( file size not more than 2mb * )</b></label>
                <input type="file"  name="edit_lpanel_video_file_name" class="form-control" placeholder="Enter the video links" id="video-links-id" >
                <div class="lpanel-videos-listing-class">

                </div>
            </div>
            <div class="form-group">
                <label for="video-links-id">Image File: <b class="text-danger">( file size not more than 2mb * )</b></label>
                <input type="file"  name="edit_lpanel_image_file_name" class="form-control" placeholder="Enter the image links" id="image-links-id" >
                <div class="lpanel-images-listing-class">

                </div>
            </div>
            <div class="form-group">
                <label for="description-id">Descriptions: </label>
                <textarea name="edit_description" required class="form-control" placeholder="Enter the description" id="edit_description"></textarea>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
        </form>
      </div>


    </div>
  </div>
</div>
<!-- /post wish canopy model -->

<!-- The Modal -->
<div class="modal" id="add-louvered-panel-modal-id">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Post Wish Louvered</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form role="form" action="{{ route('admin.postwish-lpanel-type-text-submit') }}" method="POST">
        @csrf
        
            <div class="form-group">
                <label for="louvered-types-text-id">Louvered Types:</label>
                <select class="form-control" required name="louvered_types_name" id="louvered-types-text-id">
                    <option value="">Choose louvered types</option>
                </select>
            </div>
            <div class="form-group">
                <label for="louvered-description-id">Louvered Descriptions</label>
                <textarea  name="louvered_description" required class="form-control" placeholder="Enter the louvered descriptions" id="louvered-description-id" rows=5></textarea>
            </div>
            <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
        </form>
      </div>


    </div>
  </div>
</div>
<!-- /post wish canopy model -->

<!-- Post Wish mount bracket popup -->
<!-- The edit Modal -->
<div class="modal" id="pickup-popup-mount-modal-edit-id">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pickup Popup Louvered Edit</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form role="form" action="{{ route('admin.setup.popup.edit-post-louvered-submit') }}" enctype='multipart/form-data' method="POST">
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
        <h4 class="modal-title">Pickup Popup Louvered Add</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form role="form" action="{{ route('admin.setup.popup.add-post-louvered-submit') }}" enctype='multipart/form-data' method="POST">
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
@endsection
@section('adminjsContent')
<script>
    $(function(){
        load_lpanel_video_fx();
        load_piller_post_fx();

        setTimeout(() => {
          load_lpanel_type_text_fx();
        }, 1000);

        CKEDITOR.replace( 'description' );
        var editor = CKEDITOR.replace( 'popup_description_name' );
        CKFinder.setupCKEditor( editor );
        var editEditor = CKEDITOR.replace( 'edit_popup_description_name' );
        CKFinder.setupCKEditor( editEditor );
    });

    function add_post_wish_lpanel_fx()
    {
        $("#post-wish-canopy-modal-id").modal('show');
    }

    function load_lpanel_video_fx()
    {
        $.ajax({
            url: "{{ route('admin.load-lpanel-post-wish-fx') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#canopy-tbl-id").html(event.lpanel_html);
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


    function lpanel_edit_fx(id)
    {
      $("#edit-post-wish-lpanel-modal-id").modal('show');
      $("#lpanel-name-hidden-id").val(id);
      $.ajax({
        url: "{{ route('admin.lpanel-edit-fx') }}",
        type: "GET",
        data: {edit_id: id},
        dataType: "json",
        success: function(e)
        {
          $("#edit-piller-post-id").html(e.piller_html);
          // $("#edit-description-id").html(e.descriptions);
          CKEDITOR.replace( 'edit_description' );
          CKEDITOR.instances.edit_description.setData(e.descriptions);

          if(e.img_files_id != null)
            {
              $(".lpanel-images-listing-class").html('<img src="'+e.img_files+'" alt="no image" width="100px" height="100px" /><a href="javascript: ;" style="color: red; float: left; position: absolute; left: 20px; " onclick=onImgDelete('+e.imgId+')><i class="fa fa-trash"></i></a>');
            }
            else
            {
              $(".lpanel-images-listing-class").html('');
            }

            if(e.video_files_id != null)
            {
              $(".lpanel-videos-listing-class").html('<video width="100" height="100" controls><source src="'+e.video_files+'" type="video/mp4"></video><a href="javascript: ;" style="color: red; float: left; position: absolute; left: 20px; " onclick=onVideoDelete('+e.imgId+')><i class="fa fa-trash"></i></a>');
            }
            else
            {
              $(".lpanel-videos-listing-class").html('');
            }
        }, 
        error: function(e)
        {

        }
      })
    }


    function lpanel_del_fx(id)
    {
      var x = confirm('Are you sure to delete this?');
      if(x)
      {
        $.ajax({
          url: "{{ route('admin.lpanel-del-fx') }}",
          type: "GET",
          data: {edit_id: id},
          dataType: "json",
          success: function(event){
            if(event == "success_msg")
            {
              var alert_msg = "Successfully deleted";
              success_pass_alert_show_msg(alert_msg);
              location.reload();
            }
            else if(event == "error_msg")
            {
              var alert_msg = "Something wrong! Try again later";
              error_pass_alert_show_msg(alert_msg);
            }
          }, error: function(event){

          }
        })
      }
      else
      {

      }
    }


    function load_lpanel_type_text_fx()
    {
      $.ajax({
        url: "{{ route('admin.load-lpanel-type-text') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
          $("#post-wish-lpanel-type-text-id").html(event.lpanelText);
        }, error: function(event){

        }
      })
    }

    
    function add_louvered_panel_type_text_fx()
    {
      $("#add-louvered-panel-modal-id").modal('show');
      $.ajax({
        url: "{{ route('admin.choose-lpanel-type-text') }}",
        type: "GET",
        dataType: "json",
        success: function(event){
          $("#louvered-types-text-id").html(event.lpanel_html);
        }, error: function(event){

        }
      })
    }

    function lpanel_type_text_del_fx(id)
    {
      var x = confirm('Are you sure to delete this?');
      if(x)
      {
        $.ajax({
          url: "{{ route('admin.lpanel-type-text-del-fx') }}",
          type: "GET",
          data: {edit_id: id},
          dataType: "json",
          success: function(event){
            if(event == "success_msg")
            {
              var alert_msg = "Successfully deleted";
              success_pass_alert_show_msg(alert_msg);
              location.reload();
            }
            else if(event == "error_msg")
            {
              var alert_msg = "Something wrong! Try again later";
              error_pass_alert_show_msg(alert_msg);
            }
          }, error: function(event){

          }
        })
      }
      else
      {

      }
    }


    function onImgDelete(id)
    {
      $.ajax({
        url: "{{ route('admin.lpanel-img-for-post-del-fx') }}",
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
        url: "{{ route('admin.lpanel-video-for-post-del-fx') }}",
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
        url: "{{ route('admin.popup.post-louvered-window-edit-data') }}",
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