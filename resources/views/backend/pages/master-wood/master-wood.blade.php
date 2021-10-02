@extends('backend.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Master Wood</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Master Wood</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Master Wood Table</h3>
              <span class="float-right" id="piller-state-id"><a href="javascript: ;" onclick="change_piller_table_minus_state()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a></span>
              <span class="float-right"><a class="btn btn-danger btn-sm" href="#add-master-height" id="add-master-height-id" style="margin-right: 10px;">Add Wood Type</a></span>
            </div>
            <div style="padding: 10px" id="show-piller-post-id"> 
                <table id="myTable" >
                    <thead>
                    <tr>
                        <th>S.no</th>
                        <th>Wood Image</th>
                        <th>Wood</th>
                        <th>Wood Descriptions</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="myTable-data">
                        <tr>
                            <td colspan="6"><center class="text-info"><i class="fa fa-spinner"></i> Loading Data's</center></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
          </div>
        </div>
        <div class="row">
        <!-- left column -->
        <div class="col-md-6" id="add-master-height">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" id="add-edit-master-height-id">Master Wood ( Add Form ) </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" id="add-edit-master-height-action-id" method="POST" action="{{ route('admin.master-wood-submit') }}">
            @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="wood-img-id">Wood Image File *</label>
                  <input type="file" class="form-control" name="wood_img_name" id="wood-img-id" placeholder="Enter master image" required />
                </div>
                <div class="form-group">
                  <label for="wood-name-id">wood Name *</label>
                  <input type="text" class="form-control" name="wood_name" id="wood-name-id" placeholder="Enter wood name" required />
                </div>
                <!-- <div class="form-group">
                  <label for="wood-price-id">Wood Price *</label> -->
                  <input type="hidden" class="form-control" name="wood_price" id="wood-price-id" placeholder="Enter wood price" value="0" />
                <!-- </div> -->
                <div class="form-group">
                  <label for="wood-des-id">Wood Descriptions *</label>
                  <textarea class="form-control" name="wood_descriptions" rows=5 id="wood-des-id" placeholder="Enter wood descriptions" required></textarea>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </div>
</section>
<!-- /.content -->

<!-- Modal -->
<div id="master-wood-modal-id" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" id="add-edit-master-height-id">Master Wood ( Edit Form ) </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" id="add-edit-master-height-action-id" method="POST" action="{{ route('admin.master-wood-submit-update') }}">
            @csrf
              <div class="card-body">


                <input type="hidden" name="wood_hidden_type_name" id="modal-wood-hidden-type-id" value="" />


                <div class="form-group">
                  <label for="wood-img-id">Wood Image File *</label>
                  <input type="file" class="form-control" name="wood_img_name" id="wood-img-id" placeholder="Enter master image" />
                </div>
                <div id="modal-wood-img-id">

                </div>
                <div class="form-group">
                  <label for="wood-name-id">wood Name *</label>
                  <input type="text" class="form-control" name="wood_name" id="modal-wood-name-id" placeholder="Enter wood name" required />
                </div>
                <!-- <div class="form-group">
                  <label for="wood-price-id">Wood Price *</label> -->
                  <input type="hidden" class="form-control" name="wood_price" id="modal-wood-price-id" placeholder="Enter wood price" value="0" />
                <!-- </div> -->
                <div class="form-group">
                  <label for="wood-des-id">Wood Descriptions *</label>
                  <textarea class="form-control" name="wood_descriptions" rows=5 id="modal-wood-des-id" placeholder="Enter wood descriptions" required></textarea>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </form>
          </div>
          <!-- /.card -->
      </div>
    </div>

  </div>
</div>
@endsection
@section('adminjsContent')
<script>
    $(function(){
        showDataPanelfx();

        $("#add-master-height-id").click(function(){
          $("#add-edit-master-height-id").html("Master Width ( Add Form )");
          $("#add-edit-master-height-action-id").find('#master-height-id').val("");
          $("#add-edit-master-height-action-id").attr("action","{{ route('admin.master-height-submit') }}");
        })
    });

    // plus minus start

    function change_piller_table_plus_state()
    {
        $("#piller-state-id").html('<a href="javascript: ;"  onclick="change_piller_table_minus_state()" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></a>');
        $("#show-piller-post-id").show();
    }

    function change_piller_table_minus_state()
    {
        $("#piller-state-id").html('<a href="javascript: ;"  onclick="change_piller_table_plus_state()" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i></a>');
        $("#show-piller-post-id").hide();
    }

    // plus minus end
   

    function showDataPanelfx()
    {
        $.ajax({
            url: "{{ route('admin.master-wood-tbl-show') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
              if(event.status_wood_tbl == "success")
              {
                $("#myTable-data").html(event.wood_tbl_html);
                $("table").dataTable();
              }
              else if(event.status_wood_tbl == "error")
              {
                $("#myTable-data").html(event.wood_tbl_html);
                $("table").dataTable();
              }
                
            }, error: function(event){

            }
        })
    }

    function make_btn_change(state, id)
    {
        $.ajax({
            url: "{{ route('admin.master-wood-action-change') }}",
            type: "GET",
            data: {state: state, id: id},
            dataType: "json",
            success: function(event){
                if(event == "success")
                {
                    msg = "Admin action successfully applied";
                    success_pass_alert_show_msg(msg);
                    showDataPanelfx();
                }
                else if(event == "error")
                {
                    msg = "Something went wrong! Try again later";
                    error_pass_alert_show_msg(msg);
                }
                else
                {
                    var msg = "Server getting down! Try again later";
                    error_pass_alert_show_msg(msg);
                }
            }, error: function(event){

            }
        })
    }

    function make_del_change(id)
    {
      var x = confirm('Are you sure to this data?');
      if(x)
      {
        $.ajax({
            url: "{{ route('admin.master-wood-action-del') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
                if(event == "success")
                {
                    msg = "Delete action successfully applied";
                    success_pass_alert_show_msg(msg);
                    showDataPanelfx();
                }
                else if(event == "error")
                {
                    msg = "Something went wrong! Try again later";
                    error_pass_alert_show_msg(msg);
                }
                else
                {
                    var msg = "Server getting down! Try again later";
                    error_pass_alert_show_msg(msg);
                }
            }, error: function(event){

            }
        })
      }
      else
      {

      }
        
    }


    function make_edit_change(id)
    {
        $("#master-wood-modal-id").modal('show');
        $.ajax({
            url: "{{ route('admin.master-wood-action-get-show') }}",
            type: "GET",
            data: {id: id},
            dataType: "json",
            success: function(event){
              $("#modal-wood-hidden-type-id").val(id);
              $("#modal-wood-img-id").html(event.wood_img);
              $("#modal-wood-name-id").val(event.wood_name);
              $("#modal-wood-price-id").val(event.wood_price);
              $("#modal-wood-des-id").val(event.wood_descrip);
            }, error: function(event){

            }
        })
    }
</script>
@endsection