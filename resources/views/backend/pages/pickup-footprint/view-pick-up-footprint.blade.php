@extends('backend.app')
@section('content')
<style>
.scroll-demo-table {
    min-height: auto;
    max-height: 400px;
    overflow-y: auto;
    padding-right: 5px;
}
</style>
  <!-- Modal -->
  
  <!-- The Modal -->
  <div class="modal fade" id="pick-up-footprint-modal-id">
    <div class="modal-dialog">
      <div class="modal-content">

        <form action="{{ route('admin.edit-page-pick-a-footprint') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="footprint_main_id" id="main-edit-id"/>
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Edit Pick Up Footprint</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- Modal body -->
          <div class="modal-body">
            <!-- for width  -->
            <div class="form-group">
              <label for="width-in-feet">Width (In Feet*):</label>
              <select class="form-control" name="width_in_feet_selct_id" id="width-in-feet" onchange="width_feet_onchange_fx()" required>
                <option value="">Choose A Width</option>
              </select>
            </div>

            <!-- for height  -->
            <div class="form-group">
              <label for="height-in-feet">Height (In Feet*):</label>
              <select class="form-control" name="height_in_feet_selct_id" id="height-in-feet" onchange="height_feet_onchange_fx()"  required>
                <option value="">Choose A Height</option>
              </select>
            </div>

            <!-- for posts  -->
            <div class="form-group">
              <label for="post-in-feet">Posts (In number *):</label>
              <select class="form-control" name="posts_in_feet_selct_id" id="post-in-feet" onchange="post_feet_onchange_fx()"  required>
                <option value="">Choose A Posts</option>
              </select>
            </div>

            <!-- for img  -->
            <div class="form-group">
              <label for="img-in-feet">Image (Optional):</label>
              <input type="file" class="form-control" name="img_in_feet_master" id="image-file" />
              <div id="show-img">
              
              </div>
            </div>

            <!-- for Price  -->
            <div class="form-group">
              <label for="img-in-feet" style="display:none">Price</label>
              <input type="hidden" class="form-control" placeholder="Price Of Feets" name="price_of_feet" id="price-of-feet" required />
            </div>

            <!-- for wood type -->
            <div class="form-group">
              <label for="img-in-feet">Wood Types</label>
              <select class="form-control" name="modal_wood_types_name" id="wood-types-modal-id">
              
              </select>
            </div>

          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-info" >Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- // end of modal -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pick Up Footprint</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Pick Up Footprint</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pick Up Footprint</h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <a href="{{ route('admin.show-pick-a-footprint') }}" class="btn btn-info btn-sm" id="add-banner-id">Add Pickup Footage</a>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive scroll-demo-table p-0">
              <div style="padding: 10px;">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Width</th>
                      <th>Height</th>
                      <th>Posts</th>
                      <th>Wood Types </th>
                      <!-- <th>price</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="campaign-tbl-id">
                    <tr>
                      <td colspan="7"><center class="text-info"><i class="fa fa-spinner"></i> Loading data's</center></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
@section('adminjsContent')
<script>
    $(function(){
        load_data_table_fx();
    })

    function load_data_table_fx()
    {
        $.ajax({
            url: "{{ route('admin.all-data-on-view-pick-a-footprint') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#campaign-tbl-id").html(event);
                $("table").dataTable();
            }, error: function(event){

            }
        })
    }

    function del_pick_up_footprint(id)
    {
        var x = confirm("Are you sure you want to delete?");
            if (x)
            {
                $.ajax({
                    url: "{{ route('admin.del-pick-up-footprint') }}",
                    type: "GET",
                    data: {id: id},
                    dataType: "json",
                    success: function(event){
                        if(event == "success")
                        {
                            var alert_msg = "Successfully deleted";
                            success_pass_alert_show_msg(alert_msg);
                            load_data_table_fx();
                        }
                        else if(event == "error")
                        {
                            var alert_msg = "Server getting down! Try again later";
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


    // modal open & data manipulation part
    function pick_up_footprint_edit_model_fx(id)
    {
      $("#pick-up-footprint-modal-id").modal('show');
      $.ajax({
        url: "{{ route('admin.get-all-footprint-data')  }}",
        type: "GET",
        data: {id: id},
        dataType: "json",
        success: function(event){
          $("#width-in-feet").html(event.foot_width);
          $("#height-in-feet").html(event.foot_height);
          $("#post-in-feet").html(event.foot_posts);
          $("#price-of-feet").val(event.foot_price);
          $("#wood-types-modal-id").html(event.wood_types);
          $("#show-img").html(event.foot_img);
          $("#main-edit-id").val(id);
          load_edit_type_footprint_config_fx();
        },error: function(event){

        }
      })
    }



    /// config checking function
    function width_feet_onchange_fx()
    {
      var width_val = $("#width-in-feet").val();
      var height_val = $("#height-in-feet").val();
      var post_val = $("#post-in-feet").val();
      
      if(width_val != "" && height_val != "" &&  post_val != "")
      {
        $.ajax({
          url: "{{ route('admin.show-pick-a-footprint-config') }}",
          type: "GET",
          data: {post_id: post_val, width_val: width_val, height_val: height_val},
          dataType: "json",
          success: function(event)
          {
            $("#price-of-feet").val(event.main_price);
          }, 
          error: function(event)
          {

          }
        })
      }
    }

    function height_feet_onchange_fx()
    {
      var width_val = $("#width-in-feet").val();
      var height_val = $("#height-in-feet").val();
      var post_val = $("#post-in-feet").val();
      
      if(width_val != "" && height_val != "" &&  post_val != "")
      {
        $.ajax({
          url: "{{ route('admin.show-pick-a-footprint-config') }}",
          type: "GET",
          data: {post_id: post_val, width_val: width_val, height_val: height_val},
          dataType: "json",
          success: function(event)
          {
            $("#price-of-feet").val(event.main_price);
          }, 
          error: function(event)
          {

          }
        })
      }
    }

    function post_feet_onchange_fx()
    {
      var width_val = $("#width-in-feet").val();
      var height_val = $("#height-in-feet").val();
      var post_val = $("#post-in-feet").val();
      
      if(width_val != "" && height_val != "" &&  post_val != "")
      {
        $.ajax({
          url: "{{ route('admin.show-pick-a-footprint-config') }}",
          type: "GET",
          data: {post_id: post_val, width_val: width_val, height_val: height_val},
          dataType: "json",
          success: function(event)
          {
            $("#price-of-feet").val(event.main_price);
          }, 
          error: function(event)
          {

          }
        })
      }
    }

    function load_edit_type_footprint_config_fx()
    {
      var width_val = $("#width-in-feet").val();
      var height_val = $("#height-in-feet").val();
      var post_val = $("#post-in-feet").val();
      
      if(width_val != "" && height_val != "" &&  post_val != "")
      {
        $.ajax({
          url: "{{ route('admin.show-pick-a-footprint-config') }}",
          type: "GET",
          data: {post_id: post_val, width_val: width_val, height_val: height_val},
          dataType: "json",
          success: function(event)
          {
            $("#price-of-feet").val(event.main_price);
          }, 
          error: function(event)
          {

          }
        })
      }
    }
</script>
@endsection