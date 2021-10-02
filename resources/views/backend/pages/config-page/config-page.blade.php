@extends('backend.app')
@section('content')
<style>
.card_panel_body h4{
  color: #000;
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}
.card_panel_body label{
  color: #666;
    font-size: 16px;
    font-weight: 400 !important;
    margin: 10px 0 7px;
}
#main-config-div-panel-id{
    display:none;
}
</style>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Config Panel</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Config Panel</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- wood type -->
        <div class="row" id="wood-select-id">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title" id="add-edit-master-height-id">Config Panel </h3>
                    </div>
                    <div class="card-body card_panel_body">
                        <div class="form-group">
                        <label for="choose-config-wood-type-id">Choose Wood Type *</label>
                            <select class="form-control" name="choose_config_wood_type" id="choose-config-wood-type-id" onchange="choose_wood_check_fx()" required>
                                    <option value="">Choose wood type</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                            <button type="button" onclick="update_wood_submittion_fx()" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /wood type -->
        <div class="row" id="main-config-div-panel-id">
            <form role="form" enctype="multipart/form-data" id="add-edit-master-height-action-id" method="POST" action="{{ route('admin.combination-panel-add') }}">
            @csrf
            <!-- left column -->
            <div class="row">
                <!-- pick a footprint -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title" id="add-edit-master-height-id">Config Panel ( Pick a footprint ) </h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        <div class="card-body card_panel_body">
                            
                            <div class="form-group">
                            <h4 for="ladder-spacing-id">PICK A FOOTPRINT *</h4>
                            <label for="post4-price-id">4 Posts Price *</label>
                                <input type="number" class="form-control" name="post4_price_name" id="post4-price-id" required>
                            </div>
                            <!-- <div class="form-group"> -->
                            <!-- <label for="post4d-price-id">4 double posts Price (per post price)*</label> -->
                                <input type="hidden" class="form-control" name="post4d_price_name" id="post4d-price-id" value="0" >
                            <!-- </div> -->
                            <div class="form-group">
                            <label for="post6-price-id">6 posts price (per post price)*</label>
                                <input type="number" class="form-control" required name="post6_price_name" id="post6-price-id">
                            </div>
                            <div class="form-group">
                            <label for="post8-price-id">8 posts price (per post price)*</label>
                                <input type="number" class="form-control" required name="post8_price_name" id="post8-price-id">
                            </div>
                            <div class="form-group">
                            <label for="post8-price-id">Size ≤ 100sqft price*</label>
                                <input type="number" class="form-control" required name="less100_price" id="less100-price-id">
                            </div>
                            <div class="form-group">
                            <label for="post8-price-id">100sqft < Size ≤ 150sqft price*</label>
                                <input type="number" class="form-control" required name="less100150_price" id="less100150-price-id">
                            </div>
                            <div class="form-group">
                            <label for="post8-price-id">150sqft < Size price*</label>
                                <input type="number" class="form-control" required name="greater150_price" id="greater150-price-id">
                            </div>
                            <h6><b>Width x Length = Pergola Size</b></h6>
                            <ul>
                                <li>Pergola Size ≤ 100 sqft. = Pergola Size * Size Value + Per Post Price * Post Number </li>
                                <li>100sqft < Pergola Size ≤ 150 sqft. = Pergola Size * Size Value + Per Post Price * Post Number </li>
                                <li>150 sqft. ≤ Pergola Size = Pergola Size * Size Value + Per Post Price * Post Number </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->

                        <!-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> -->
                        
                        
                        
                       
                        
                    </div>
                    <!-- /.card -->

                </div>
                <!-- overhead shades -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title" id="add-edit-master-height-id">Config Panel ( Overhead Shades ) </h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        <div class="card-body card_panel_body">
                            
                            <div class="form-group">
                            <h4 for="ladder-spacing-id">OVERHEAD SHADES *</h4>
                            <label for="open-price-id">Open overhead shades Price (in %)* </label>
                                <input type="number" class="form-control" name="open_price_name" id="open-price-id" required>
                            </div>
                            <div class="form-group">
                            <label for="regular-price-id">Regular overhead shades Price (in %)*</label>
                                <input type="number" class="form-control" name="regular_price_name" id="regular-price-id" required>
                            </div>
                            <div class="form-group">
                            <label for="sunblocker-price-id">Sunblocker overhead shades price (in %)*</label>
                                <input type="number" class="form-control" required name="sunblocker_price_name" id="sunblocker-price-id">
                            </div>

                            <h6><b>Price = OPEN shade</b></h6>
                            <ul>
                                <li>If REGULAR is selected (price + REGULAR percentage (input field))</li>
                                <li>If SUNBLOCKER is selected (price + SUNBLOCKER percentage (input field))</li>
                            </ul>
                        </div>
                        <!-- /.card-body -->

                        <!-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> -->
                        
                        
                    </div>
                    <!-- /.card -->

                </div>
                <!-- overhead shades -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title" id="add-edit-master-height-id">Config Panel ( Post length ) </h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        <div class="card-body card_panel_body">
                            
                            <div class="form-group">
                            <h4 for="ladder-spacing-id">PICK A PICK LENGTH *</h4>
                            <label for="post9ft-price-id">9 ft Post Price (in %)*</label>
                                <input type="number" class="form-control" name="post9ft_price_name" id="post9ft-price-id" required>
                            </div>
                            <div class="form-group">
                            <label for="post12ft-price-id">12 ft Post Price (in %)*</label>
                                <input type="number" class="form-control" name="post12ft_price_name" id="post12ft-price-id" required>
                            </div>
                            <h6><b>Price = 9ft post</b></h6>
                            <ul>
                                <li>If 12ft is selected (price + PICK POST LENGTH percentage (input field))</li>
                            </ul>
                        </div>
                        <!-- /.card-body -->

                        <!-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> -->
                        
                        
                        
                    </div>
                    <!-- /.card -->

                </div>
                <!-- mount bracket -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title" id="add-edit-master-height-id">Config Panel ( Mount Bracket ) </h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        <div class="card-body card_panel_body">
                            
                            <div class="form-group">
                            <h4 for="ladder-spacing-id">Mount Bracket  *</h4>
                            <label for="bracket4-price-id">4 mount brackets Price *</label>
                                <input type="number" class="form-control" name="bracket4_price_name" id="bracket4-price-id" required>
                            </div>
                            <div class="form-group">
                            <label for="bracket6-price-id">6 mount brackets Price *</label>
                                <input type="number" class="form-control" name="bracket6_price_name" id="bracket6-price-id" required>
                            </div>
                            <div class="form-group">
                            <label for="bracket8-price-id">8 mount brackets Price *</label>
                                <input type="number" class="form-control" name="bracket8_price_name" id="bracket8-price-id" required>
                            </div>

                            <ul>
                                <li>Price + bracket costs value (input field)</li>
                            </ul>
                        </div>
                        <!-- /.card-body -->

                        <!-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> -->

                        
                        
                        
                    </div>
                    <!-- /.card -->

                </div>
                <!-- canopy bracket -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title" id="add-edit-master-height-id">Config Panel ( Canopy Panel ) </h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        <div class="card-body card_panel_body">
                            
                            <div class="form-group">
                            <h4 for="ladder-spacing-id">Canopy Panel  *</h4>
                            <label for="canopy-price-id">each sqft. Price *</label>
                                <input type="number" class="form-control" name="canopy_price_name" id="canopy-price-id" required>
                            </div>
                            <ul>
                                <li>Price + length x width x Sqft value (input field)</li>
                            </ul>
                        </div>
                        <!-- /.card-body -->

                        <!-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> -->
                        
                    </div>
                    <!-- /.card -->

                </div>
                <!-- louvered bracket -->
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title" id="add-edit-master-height-id">Config Panel ( Louvered Panel ) </h3>
                        </div>
                        
                        <!-- /.card-header -->
                        <!-- form start -->
                        
                        <div class="card-body card_panel_body">
                            
                            <div class="form-group">
                            <h4 for="ladder-spacing-id">Louvered Panel  *</h4>
                            <label for="lpanel-price-id">each sqft. Price *</label>
                                <input type="number" class="form-control" name="lpanel_price_name" id="lpanel-price-id" required>
                            </div>
                            <ul>
                                <li>Price + length x height x Sqft value (input field)</li>
                            </ul>
                        </div>
                        <!-- /.card-body -->

                        <!-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> -->
                        
                    </div>
                    <!-- /.card -->

                </div>
            </div>
            </form>
            <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </div>
</section>
<!-- /.content -->
@endsection
@section('adminjsContent')
<script>
    $(function(){
        load_wood_check_fx();
    });

    function load_wood_check_fx()
    {
        $.ajax({
            url: "{{ route('admin.config.config-wood-load') }}",
            type: "GET",
            dataType: "json",
            success: function(event){
                $("#choose-config-wood-type-id").html(event.wood_html);
            }, error: function(event){

            }
        })
    }

    function choose_wood_check_fx()
    {
        var choose_wood_val = $("#choose-config-wood-type-id").val();
        if(choose_wood_val == "" || choose_wood_val == null)
        {
            $("#main-config-div-panel-id").hide();
        }
        else
        {
            $("#main-config-div-panel-id").show();
            load_all_config_data_fx(choose_wood_val);
        }
    }

    function load_all_config_data_fx(wood_id)
    {
        $.ajax({
            url: "{{ route('admin.config.load-all-config-data') }}",
            type: "GET",
            data: {wood_id: wood_id},
            dataType: "json",
            success: function(resp){
                $("#post4-price-id").val(resp.post4_price);
                $("#post4d-price-id").val(resp.post4d_price);
                $("#post6-price-id").val(resp.post6_price);
                $("#post8-price-id").val(resp.post8_price);
                $("#less100-price-id").val(resp.less100_price);
                $("#less100150-price-id").val(resp.less100150_price);
                $("#greater150-price-id").val(resp.greater150_price);

                $("#open-price-id").val(resp.open_price);
                $("#regular-price-id").val(resp.regular_price);
                $("#sunblocker-price-id").val(resp.sunblocker_price);

                $("#post9ft-price-id").val(resp.post9_price);
                $("#post12ft-price-id").val(resp.post12_price);

                $("#bracket4-price-id").val(resp.mount_bracket4_price);
                $("#bracket6-price-id").val(resp.mount_bracket6_price);                                   
                $("#bracket8-price-id").val(resp.mount_bracket8_price);

                $("#canopy-price-id").val(resp.canopy_price);

                $("#lpanel-price-id").val(resp.lpanel_price);

            }, error: function(resp){

            }
        })
    }

    function update_wood_submittion_fx()
    {
        var choose_wood = $("#choose-config-wood-type-id").val();
        if(choose_wood == "" || choose_wood == null)
        {
            msg = "Choose a wood first";
            error_pass_alert_show_msg(msg);
        }
        else
        {
            var post4_price = $("#post4-price-id").val();
            var post4d_price = $("#post4d-price-id").val();
            var post6_price = $("#post6-price-id").val();
            var post8_price = $("#post8-price-id").val();

            var less100_price = $("#less100-price-id").val();
            var less100150_price = $("#less100150-price-id").val();
            var greater150_price = $("#greater150-price-id").val();

            var open_price = $("#open-price-id").val();
            var regular_price = $("#regular-price-id").val();
            var sunblocker_price = $("#sunblocker-price-id").val();

            var post9_price = $("#post9ft-price-id").val();
            var post12_price = $("#post12ft-price-id").val();

            var bracket4_price = $("#bracket4-price-id").val();
            var bracket6_price = $("#bracket6-price-id").val();                                   
            var bracket8_price = $("#bracket8-price-id").val();

            var canopy_price = $("#canopy-price-id").val();

            var lpnael_price = $("#lpanel-price-id").val();

            if(post4_price == "" || post4_price == null)
            {
                msg = "4 posts price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(post4d_price == "" || post4d_price == null)
            {
                msg = "4 double posts price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(post6_price == "" || post6_price == null)
            {
                msg = "6 posts price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(post8_price == "" || post8_price == null)
            {
                msg = "8 posts price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(open_price == "" || open_price == null)
            {
                msg = "open overhead shades price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(regular_price == "" || regular_price == null)
            {
                msg = "regular overhead shades price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(sunblocker_price == "" || sunblocker_price == null)
            {
                msg = "sunblocker overhead shades price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(post9_price == "" || post9_price == null)
            {
                msg = "9ft. post length price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(post12_price == "" || post12_price == null)
            {
                msg = "12ft. post length price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(bracket4_price == "" || bracket4_price == null)
            {
                msg = "4 brackets price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(bracket6_price == "" || bracket6_price == null)
            {
                msg = "6 brackets price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(bracket8_price == "" || bracket8_price == null)
            {
                msg = "8 brackets price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(canopy_price == "" || canopy_price == null)
            {
                msg = "canopy price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else if(lpnael_price == "" || lpnael_price == null)
            {
                msg = "louvered price can't be null";
                error_pass_alert_show_msg(msg);
            }
            else
            {
                var wood_id = $("#choose-config-wood-type-id").val();
                $.ajax({
                    url: "{{ route('admin.config.config-data-update-insert') }}",
                    type: "GET",
                    data: { wood_id: wood_id, post4_price: post4_price, post4d_price: post4d_price, post6_price: post6_price, post8_price: post8_price, open_price: open_price, regular_price: regular_price, sunblocker_price: sunblocker_price, post9_price: post9_price, post12_price: post12_price, bracket4_price: bracket4_price, bracket6_price: bracket6_price, bracket8_price: bracket8_price, canopy_price: canopy_price, lpnael_price: lpnael_price, less100_price: less100_price, less100150_price: less100150_price, greater150_price: greater150_price },
                    dataType: "json",
                    success: function(event){
                        if(event == "insertSuccess")
                        {
                            msg = "Config data inserted successfully";
                            success_pass_alert_show_msg(msg);
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                        else if(event == "insertError")
                        {
                            msg = "Config data didn't inserted! try again later.";
                            error_pass_alert_show_msg(msg);
                        }
                        else if(event == "updateSuccess")
                        {
                            msg = "Config data updated successfully";
                            success_pass_alert_show_msg(msg);
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        }
                        else if(event == "updateError")
                        {
                            msg = "Config data didn't updated! try again later";
                            error_pass_alert_show_msg(msg);
                        }
                    }, error: function(event){

                    }
                })
            }
        }
    }
</script>
@endsection