@extends('frontend.app')

@section('content')

<style>
div#new-mount-bracket-img-Qid img {
    width: 100%;
    height: auto;
    margin: 20px 0 0;
}
.canopy-note-select-panel-class.pergola-canopy-panel-class p
{
    display: none !important;
    visibility: hidden !important;
}
section.body-cont1 .img-wrap {
    padding: 0 !important;
}


section.body-cont1 .img-wrap img {
    max-width: 100% !important;
}
.pick-slap-select-panel-class {
    display: flex ;
    align-items: center !important;
    background: #fff !important;
    padding: 20px !important;
    justify-content: space-between !important;
    box-shadow: 0 0 12px #d3d3d3 !important;
    margin: 0 0 31px !important;
}
.pick-slap-select-panel-class label {
    margin: 0 !important;
    font-weight: 500 !important;
    text-transform: uppercase !important;
}
.pick-slap-select-panel-class p#pick-slap-mount-panel-load-id {
    color: #000000 !important;
    font-size: 17px !important;
    font-weight: bold !important;
    font-style: normal !important;
    letter-spacing: 0 !important;
    line-height: normal !important;
    text-align: left !important;
    text-transform: uppercase !important;
    margin: 0 !important;
}


#checkout-pay-btn-id {

    margin: 64px auto 0;

    display: inline-block;

    min-width: 160px;

    padding: 0 35px;

    height: 55px;

    border-radius: 4px;

    background-color: #718b38;

    border: none;

    font-size: 16px;

    font-weight: 700;

    font-style: normal;

    letter-spacing: 0.48px;

    line-height: normal;

    text-align: center;

    text-transform: uppercase;

    color: #fff;

    line-height: 55px;

}

.pergola-canopy-panel-class p {

    color: #000000 !important;

    font-size: 14px !important;

    font-weight: 300 !important;

    font-style: normal !important;

    letter-spacing: normal !important;

    line-height: 28px !important;

    text-align: justify !important;

    margin: 0 0 30px !important;

}



section.body-cont1 table td {
    color: #7a9739;
    font-size: 14px !important;
    font-weight: 500 !important;
    font-style: normal;
    letter-spacing: 0;
    line-height: normal;
    text-align: left;
    text-transform: uppercase;
    padding: 15px 20px !important;
    border-bottom: 1px solid #7a9739;
}


section.body-cont1 table tr.pergola-new-panel-price-class td {
    font-size: 20px !important;
    font-weight: bold !important;
}
</style>
<!-- loader  -->
<style>
    .loader {
        border: 6px solid #f3f3f3;
    	border-radius: 50%;
    	border-top: 6px solid #7a9739;
    	width: 100px;
    	height: 100px;
        -webkit-animation: spin 2s linear infinite;
    	animation: spin 2s linear infinite;
    	margin: 100px 0;
    }
    /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<style>
    #lpanel-checkbox-id label{
        display: inline-block !important;
    }

    #lpanel-checkbox-id{
        text-align: left !important;
    }
</style>

<!-- MultiStep Form -->

<section class="body-cont1">

    <div class="container">
        <input type="hidden" name="home_hidden_session_check_val_name" id="home-hidden-session-check-val-id" value="0" />
        <form id="msform">

            <fieldset id="jio-zero-panel-id">

                <div class="row">

                    <div class="col-lg-12 text-center">

                        <h2>Custom Pergola Builder</h2>

                    </div>

                    <div class="col-lg-6">

                        <h3>Pick a wood type</h3>

                        <input type="hidden" name="pick_fwood_hide_data_change_panel"
                            id="pick_wood_hide_data_change_panel" value="0" />

                        <label for="">Wood type *</label>

                        <select name="" id="master-home-wood-id" onchange="master_home_wood_fx()">

                            <option value="">Choose a wood type</option>

                        </select>

                        <p class="master-wood-type-description-class"></p>

                        <!-- <table>

                            <tr class="pergola-new-panel-price-class">

                                <td>Total Price </td>

                                <input type="hidden" name="" id="zero-page-price-hidden-id" value="0">

                                <td>$<span id="master-wood-panel-price-id">0</span></td>

                            </tr>

                        </table> -->

                    </div>

                    <div class="col-lg-6">

                        <div class="img-wrap" id="master-wood-img-panel-page1-id">



                        </div>

                    </div>

                </div>
                
                <input type="button" name="next" id="zero-page-to-next-id" class="next action-button-next button"
                    value="Next" />
                <input type="hidden" name="wood_hidden_session_name" id="wood-hidden-session-id" value="0" />

            </fieldset>

            <fieldset id="jio-first-panel-id">

                <div class="row">

                    <div class="col-lg-12 text-center">

                        <h2>Custom Pergola Builder</h2>

                    </div>

                    <div class="col-lg-6">

                        <h3>Pick a Footprint (outside post to post)</h3>

                        <input type="hidden" name="pick_footprint_hide_data_change_panel"
                            id="pick_footprint_hide_data_change_panel" value="0" />

                        <label for="">Width (In Feet) *</label>

                        <select name="" id="master-home-width-id" onchange="master_home_width_fx()">

                            <option value="">Choose a width</option>

                        </select>

                        <label for="">Length (In Feet) *</label>

                        <select name="" id="master-home-height-id" onchange="master_home_height_fx()">

                            <option value="">Choose a length</option>

                        </select>

                        <div class="master-post-div-panel-class">

                            <label for="">Post *</label>

                            <select name="" id="master-home-post-id" onchange="change_master_post_fx()">

                                <option value="">Choose posts</option>

                            </select>

                        </div>

                        <h3>Price would be Calculated for a Standard <span
                                id="master-new-combine-width-id"></span>x<span id="master-new-combine-height-id"></span>
                            Pergola Now</h3>
                            
                        
                      


                        <table>
                            
                            <tr>

                                <td>Pick A Footprint Price </td>

                                <td>$<span id="pergola-pick-a-footprint-price-id">0</span></td>

                            </tr>

                            <!-- <tr>

                                <td>Pergola Price </td>

                                <td>$<span id="pergola-price-id1">0</span></td>

                            </tr> -->

                            <tr class="pergola-new-panel-price-class">

                                <td>Total Price </td>

                                <input type="hidden" name="" id="first-page-price-hidden-id" value="0">

                                <td>$<span id="master-panel-price-id">0</span></td>

                            </tr>

                        </table>

                    </div>

                    <div class="col-lg-6">

                        <div class="img-wrap" id="master-img-panel-page1-id">



                        </div>

                    </div>

                </div>



                <input type="button" name="previous" class="previous action-button-previous button" value="Back" />

                <input type="button" name="next" id="first-page-to-next-id" class="next action-button-next button"
                    value="Next" />
                <input type="hidden" name="pick_a_footprint_hidden_session_name" id="pick-a-footprint-hidden-session-id" value="0" />

            </fieldset>

            <fieldset>

                <div class="row">

                    <div class="col-lg-12 text-center">

                        <h2>Custom Pergola Builder</h2>
                        <div class="size"> </div>

                    </div>

                    <div class="col-lg-6">

                        <input type="hidden" name="pick_overhead_shades_hide_data_change_panel" id="pick_overhead_shades_hide_data_change_panel" value="0" />

                        <h3>Pick Overhead Shades</h3>

                        <label for="">Ladder Spacing *</label>

                        <select name="" id="ladder-overhead-datas-show-id" onchange="overhead_shades2_change_fx()">

                            <option value="">Choose a overhead shades</option>

                        </select>
                        
                      

                        <table>
                            
                            <tr>

                                <td>Pick Overhead Shades Price </td>

                                <td>$<span id="pergola-pick-overhead-shades-price-id">0</span></td>

                            </tr>
                            
                            <tr>

                                <td>Pergola Price </td>

                                <td>$<span id="pergola-price-id2">0</span></td>

                            </tr>

                            <tr class="pergola-new-panel-price-class">

                                <td>Total Price </td>

                                <input type="hidden" name="" id="second-page-price-hidden-id" value="0">

                                <td>$<span id="second-price-panel-id">0</span></td>

                            </tr>

                        </table>

                    </div>

                    <div class="col-lg-6">                       
                        <div class="img-wrap" id="second-image-panel-id">



                        </div>

                    </div>

                </div>

                <input type="button" name="previous" class="previous action-button-previous button" value="Back" />

                <input type="button" name="next" class="next action-button-next button" id="second-page-to-next-id"
                    value="Next" />

                <input type="hidden" name="pick_overhead_hidden_session_name" id="pick-overhead-hidden-session-id" value="0" />

            </fieldset>

            <fieldset>

                <div class="row">

                    <div class="col-lg-12 text-center">

                        <h2>Custom Pergola Builder</h2>
                        <div class="size"> </div>
                    </div>

                    <div class="col-lg-12">

                        <div class="img-wrap" id="new-custom-third-val-id">
					<div class="loader"></div>
					<iframe style="display: none" id='3dviewerplayer' type='text/html' width='640' height='480' src='' frameborder='0' scrolling='no' allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>
                        </div>

                    </div>

                </div>

                <input type="button" name="previous" class="previous action-button-previous button" value="Back" />

                <input type="button" name="next" class="next action-button-next button" id="third-page-to-next-id"
                    value="Next" />

            </fieldset>

            <fieldset>

                <div class="row">

                    <div class="col-lg-12 text-center">

                        <h2>Custom Pergola Builder</h2>
                        <div class="size"> </div>
                    </div>

                    <div class="col-lg-6">

                        <h3>Pick Post Length</h3>

                        <input type="hidden" name="pick_post_length_hide_data_change_panel"
                            id="pick_post_length_hide_data_change_panel" value="0" />

                        <label for="">Post Length (In Feet )*</label>

                        <select name="" id="fourth-page-post-length-id" onchange="choose_fourth_page_data_fx4()">

                            <option value="">Choose a post length</option>

                        </select>

                        <input type="hidden" name="" id="fourth-page-price-hidden-id" value="0">

                        <h4 style="display: none">Price <span>$<span id="fourth-price-panel-id">0</span></span></h4>
                       


                        <table>
                            
                            <tr>

                                <td>Pick Post Length Price </td>

                                <td>$<span id="pergola-pick-post-length-price-id">0</span></td>

                            </tr>
                            
                            <tr>

                                <td>Pergola Price </td>

                                <td>$<span id="pergola-price-id3">0</span></td>

                            </tr>

                            <tr class="pergola-new-panel-price-class">

                                <td>Total Price </td>

                                <td>$<span id="fourth-total-price-panel-id">0</span></td>

                            </tr>

                        </table>

                    </div>

                    <div class="col-lg-6">

                        <div class="img-wrap" id="fourth-img-panel-view-id">



                        </div>

                    </div>

                </div>

                <input type="button" name="previous" class="previous action-button-previous button" value="Back" />

                <input type="button" name="next" id="fourth-page-to-next-id" class="next action-button-next button"
                    value="Next" />

                <input type="hidden" name="pick_post_length_hidden_session_name" id="pick-post-length-hidden-session-id" value="0" />

            </fieldset>

            <fieldset>

                <div class="row">

                        <div class="col-lg-12 text-center">

                            <h2>Custom Pergola Builder</h2>
                            <div class="size"> </div>
                        </div>
                        <div class="col-lg-6">
                            <h6>Pick Post Mount Bracket</h6>

                            <ul class="Canopy1 checking-radio-panel-of-slap-class">

                                <input type="hidden" id="mount_answer_hidden_id" name="mount_answer_hidden" value="yes">

                                <li>

                                    <input type="radio" name="bracket1" value="yes"
                                        class="pick-post-mount-bracket-class-yes-type" >Yes

                                </li>

                                <li>

                                    <input type="radio" name="bracket1" value="no"
                                        class="pick-post-mount-bracket-class-no-type" >No

                                </li>

                            </ul>
                            <select name="" id="mount-brackets-datas-show-id" onchange="mount_brackets_type_change_fx()">
                                <option value="">Choose a mount brackets</option>
                                <option value="1">Concrete setup</option>
                                <option value="2">Existing slap setup</option>
                            </select>
                            <p id="mount-bracket-type-wish-text-id">
                            </p>

                            <div class="pick-slap-select-panel-class">

                                <label for="" id="mount-bracket-pick-slap-name-id">Pick Slab *</label>
                                <p id="pick-slap-mount-panel-load-id"></p>
                                <input type="hidden" id="pick-slap-mount-panel-name-load-id" value="" />
                                <!-- <input type="text" readonly name="" id="pick-slap-mount-panel-load-id" onchange="pick_slap_types_fx5()" value="" /> -->

                            </div>

                            <input type="hidden" name="" id="fifth-page-price-hidden-id" value="" />

                            <input type="hidden" id="mount-hidden-panel-price-new-id" value="0" />

                            <h4 style="display: none">Price <span>$<span id="fifth-price-panel-id">0</span></span></h4>
                            
                            



                            <table>
                                <tr>

                                    <td>Pick Mount Bracket Price </td>

                                    <td>$<span id="pergola-pick-mount-bracket-price-id">0</span></td>

                                </tr>
                                
                                <tr>

                                    <td>Pergola Price </td>

                                    <td>$<span id="pergola-price-id4">0</span></td>

                                </tr>

                                <tr class="pergola-new-panel-price-class">

                                    <td>Total Price </td>

                                    <td>$<span id="fifth-total-price-panel-id">0</span></td>

                                </tr>

                            </table>

                        </div>

                        <div class="col-lg-6">
                            <div class="video-wrap">
                                <div class="embed-responsive embed-responsive-16by9" id="mount-bracket-video-id">
                                    
                                </div>
                            </div>
                            <div id="new-mount-bracket-img-Qid">
                                
                            </div>
                        </div>

                    

                </div>

                <input type="button" name="previous" class="previous action-button-previous button" value="Back" />

                <input type="button" name="next" id="fifth-page-to-next-id" class="next action-button-next button"
                    value="Next" />

                <input type="hidden" name="pick_mount_bracket_hidden_session_name" id="pick-mount-bracket-hidden-session-id" value="0" />

            </fieldset>

            <fieldset>

                <div class="row">
                    <div class="col-lg-12 text-center">
                    <h2>Custom Pergola Builder</h2>
                    <div class="size"> </div>
                    </div>
                    <div class="col-lg-6 ">       
                        <h3>Pick Retactable Canopy</h3>
                        <ul class="Canopy1 Canopy-2 checking-radio-panel-of-canopy-class">
                            <input type="hidden" id="canopy_answer_hidden_id" name="canopy_answer_hidden" value="no">
                            <li>
                                <input type="radio" name="bracket2" value="yes"
                                    class="pick-post-canopy-class-yes-type">Yes
                            </li>
                            <li>
                                <input type="radio" name="bracket2" value="no" class="pick-post-canopy-class-no-type" checked>No
                            </li>
                        </ul>
                        <p id="canopy-type-wish-text-id"></p>
                        <div class="canopy-note-select-panel-class pergola-canopy-panel-class">
                        </div>
                        
                        
                        <table>
                            <tr>

                                <td>Canopy Price </td>

                                <td>$<span id="pergola-canopy-price-id">0</span></td>

                            </tr>
                            <tr>

                                <td>Pergola Price </td>

                                <td>$<span id="pergola-price-id5">0</span></td>

                            </tr>
                            <tr class="pergola-new-panel-price-class">

                                <td>Total Price </td>

                                <input type="hidden" name="" id="sixth-panel-price-hidden-id" value="" />

                                <td>$<span id="sixth-total-price-panel-id">0</span></td>

                            </tr>

                        </table>

                    </div>
                    <div class="col-lg-6">
                        <div class="video-wrap">
                            <div class="embed-responsive embed-responsive-16by9" id="youtube-canopy-video-id">

                            </div>
                        </div>

                    </div>

                </div>

                <input type="button" name="previous" class="previous action-button-previous button" value="Back" />

                <input type="button" name="next" id="sixth-page-to-next-id" class="next action-button-next button"
                    value="Next" />

                <input type="hidden" name="pick_canopy_hidden_session_name" id="pick-canopy-hidden-session-id" value="0" />

            </fieldset>

            <fieldset>

                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Custom Pergola Builder</h2>
                        <div class="size"> </div>
                    </div>
                    <div class="col-lg-6 Louvered-sec">

                        

                        <h3>Pick Louvered Panel</h3>

                        <p>Go to link about Louvered Panels? *</p>

                        <ul class="Canopy1 Canopy-2 checking-radio-panel-of-lpanel1-class">

                            <input type="hidden" id="lpanel_answer_hidden_id" name="lpanel_answer_hidden" value="no">

                            <li>

                                <input type="radio" name="bracket3" value="yes" class="pick-lpanel-yes-type-new" >Yes

                            </li>

                            <li>

                                <input type="radio" name="bracket3" value="no" class="pick-lpanel-no-type-new" checked>No

                            </li>

                        </ul>



                        <ul class="Canopy2 checking-radio-panel-of-lpanel2-class">



                        </ul>


                        <p id="lpanel-type-wish-text-id"></p>

                        <div id="lpanel-checkbox-id" style="display: none">
                            <input type="hidden" id="lpanel-checkbox-side1-count-id" name="lpanel_checkbox_count_side1_name" value="0" />
                            <input type="hidden" id="lpanel-checkbox-side2-count-id" name="lpanel_checkbox_count_side2_name" value="0" />
                            <input type="hidden" id="lpanel-checkbox-side3-count-id" name="lpanel_checkbox_count_side3_name" value="0" />
                            <input type="hidden" id="lpanel-checkbox-side4-count-id" name="lpanel_checkbox_count_side4_name" value="0" />
                            <input type="checkbox" id="left-lpanel-id" name="left_lpanel_name" onclick="" value="side1">
                            <label for="left-lpanel-id" id="side1-lpanel-id"> Side1</label><br>
                            <input type="checkbox" id="right-lpanel-id" name="right_lpanel_name" onclick="" value="side2">
                            <label for="right-lpanel-id" id="side2-lpanel-id"> Side2</label><br>
                            <input type="checkbox" id="front-lpanel-id" name="front_lpanel_name" onclick="" value="side3">
                            <label for="front-lpanel-id" id="side3-lpanel-id"> Side3</label><br>
                            <input type="checkbox" id="rear-lpanel-id" name="rear_lpanel_name" onclick="" value="side4">
                            <label for="rear-lpanel-id" id="side4-lpanel-id"> Side4</label><br>
                        </div>


                        <input type="hidden" id="lpanel-hide-radio-btn-panel-price-id" val="0" />

                        <h4 style="display: none">Price <span>$<span id="lpanel-wish-price-id">0</span></span></h4>
                        
                        

                        
                        <table>
                            
                            <tr>

                                <td>Louvered Panel Price </td>

                                <td>$<span id="pergola-louvered-panel-price-id">0</span></td>

                            </tr>
                            
                            <tr>

                                <td>Pergola Price </td>

                                <td>$<span id="pergola-price-id6">0</span></td>

                            </tr>

                            <tr class="pergola-new-panel-price-class">

                                <td>Total Price </td>

                                <input type="hidden" name="" id="seventh-panel-price-hidden-id" value="" />

                                <td>$<span id="seventh-total-price-panel-id">0</span></td>

                            </tr>

                        </table>

                    </div>
                    <div class="col-lg-6">
                        <div class="video-wrap">
                            <div class="embed-responsive embed-responsive-16by9" id="youtube-lpanel-video-id">

                            </div>
                        </div>

                    </div>

                </div>

                <input type="button" name="previous" class="previous action-button-previous button" value="Back" />

                <input type="button" name="next" class="next action-button-next button" id="seventh-page-to-next-id"
                    value="Next" />
                
                <input type="hidden" name="pick_louvered_panel_hidden_session_name" id="pick-louvered-panel-hidden-session-id" value="0" />

            </fieldset>



            <fieldset id="jio-final-panel">

                <div class="row">

                    <div class="col-lg-12 text-center">

                        <h2>Custom Pergola Builder</h2>
                    </div>

                    <div class="col-lg-4 text-center">



                        <h3>View Your Pergola</h3>

                        <label for="">Selected Pergola:</label>



                        <ul class="Pergola">

                            <li>

                                <h5>Width</h5>

                                <p><span id="final-product-width">0</span> Ft</p>

                            </li>

                            <li>

                                <h5>Length</h5>

                                <p><span id="final-product-length">0</span> Ft</p>

                            </li>

                            <li>

                                <h5>Post Length</h5>

                                <p><span id="final-product-post-length">0</span> Ft</p>

                            </li>

                            <li>

                                <h5>Overhead Shade</h5>

                                <p><span id="final-product-overhead">0</span></p>

                            </li>

                            <li>

                                <h5>Mount Bracket</h5>

                                <p><span id="final-product-mount">0</span></p>

                            </li>

                            <li>

                                <h5>Retactable Canopy</h5>

                                <p><span id="final-product-canopy">0</span></p>

                            </li>

                            <li>

                                <h5>Louvered Panel</h5>

                                <p><span id="final-product-lpanel">0</span></p>

                            </li>

                            <li>

                                <h5>Wood Types</h5>

                                <p><span id="final-product-wood-type">0</span></p>

                            </li>

                        </ul>

                        <table>

                            <tr class="pergola-new-panel-price-class">

                                <td>Total Price </td>

                                <td>$<span id="final-product-total-price-id">0</span></td>

                            </tr>

                        </table>

                        <label for="">Select the action ( Take Printout, Generate PDF or Send Email )</label>

                        <ul class="print-sec">

                            <li><a href="javascript:;" onClick="window.print()"> <i class="fas fa-print"></i> Print</a>
                            </li>

                            <li><a href="{{ route('satirtha.generate-pdf') }}" target="_blank"><i
                                        class="far fa-file-pdf"></i> PDF</a></li>

                            <li><a href="#" data-toggle="modal" data-target="#myModal"><i class="far fa-envelope"></i>
                                    Email</a></li>

                        </ul>

                    </div>

                    <div class="col-lg-8">

                        <div class="img-wrap final-product-img-final-class">



                        </div>

                    </div>

                </div>

                <input type="button" name="previous" class="previous action-button-previous button" value="Back" />

                <input type="button" name="next" class="action-button-next button" id="last-getting-next-id"
                    value="view Footprint of pergola" />

                <a href="{{ route('satirtha.show-payment') }}" name="pay" class="button"
                    id="checkout-pay-btn-id">Checkout</a>

            </fieldset>

            <fieldset>

                <div class="row">

                    <div class="col-lg-12 text-center">

                        <h2>Custom Pergola Builder</h2>



                        <div class="last-footprint-img-class">



                        </div>

                        <label for="">Select the action ( Take Printout, Generate PDF or Send Email )</label>

                        <ul class="print-sec">

                            <li><a href="javascript:;" onClick="window.print()"> <i class="fas fa-print"></i> Print</a>
                            </li>

                            <li><a href="{{ route('satirtha.generate-last-pdf') }}" target="_blank"><i
                                        class="far fa-file-pdf"></i> PDF</a></li>

                            <li><a href="#" data-toggle="modal" data-target="#myModal1"><i class="far fa-envelope"></i>
                                    Email</a></li>

                        </ul>

                    </div>

                </div>

                <input type="button" name="previous" class="previous action-button-previous button" value="Back" />

                <a href="{{ route('satirtha.show-payment') }}" name="pay" class="button"
                    id="checkout-pay-btn-id">Checkout</a>

            </fieldset>

        </form>

    </div>

</section>

<!-- The Modal -->

<div class="modal fade email-modal" id="myModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title">Send Email</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-lg-3">

                        <label for="">Name</label>

                    </div>

                    <div class="col-lg-9">

                        <input type="text" id="send-form-name-id">

                    </div>

                    <div class="col-lg-3">

                        <label for="">Email</label>

                    </div>

                    <div class="col-lg-9">

                        <input type="email" id="send-form-email-id">

                    </div>

                    <div class="col-lg-3">

                        <label for="">Comment</label>

                    </div>

                    <div class="col-lg-9">

                        <textarea name="" id="send-form-comment-id"></textarea>

                    </div>

                    <div class="col-lg-12">

                        <input type="button" value="submit" onclick="submit_Send_mail_fx()">

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- end of modal -->

<div class="modal fade email-modal" id="myModal1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title">Send Email</h4>

                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-lg-3">

                        <label for="">Name</label>

                    </div>

                    <div class="col-lg-9">

                        <input type="text" id="send-form-name-id1">

                    </div>

                    <div class="col-lg-3">

                        <label for="">Email</label>

                    </div>

                    <div class="col-lg-9">

                        <input type="email" id="send-form-email-id1">

                    </div>

                    <div class="col-lg-3">

                        <label for="">Comment</label>

                    </div>

                    <div class="col-lg-9">

                        <textarea name="" id="send-form-comment-id1"></textarea>

                    </div>

                    <div class="col-lg-12">

                        <input type="button" value="submit" onclick="submit_Send_mail_fx1()">

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



@endsection

@section('jsContent')





@if(Session::has('main_unique_session_key'))

<script>
var for_new_wood_type_check = 1;
</script>

@else

<script>
var for_new_wood_type_check = 0;
</script>

@endif







@if(Session::has('main_back_session_key'))

<script>



$("#jio-final-panel").show();

$("#jio-zero-panel-id").hide();

$.ajax({

    url: "{{ route('satirtha.forget-new-session-back-to-home') }}",

    type: "GET",

    dataType: "json",

    success: function(event) {



    },
    error: function(event) {



    }

});
</script>

@endif

<script>
$(function() {

    $(".pick-slap-select-panel-class").css("display", "show");

    $(".canopy-note-select-panel-class").css("display", "show");

    $(".checking-radio-panel-of-lpanel2-class").css("display", "none");

    master_wood_fx();

    master_width_fx();

    master_height_fx();

});
</script>

@if(Session::has('main_unique_session_key'))

<script>
// new session
$("#wood-hidden-session-id").val(1);
$("#pick-a-footprint-hidden-session-id").val(1);
$("#pick-overhead-hidden-session-id").val(1);
$("#pick-post-length-hidden-session-id").val(1);
$("#pick-mount-bracket-hidden-session-id").val(1);
$("#pick-canopy-hidden-session-id").val(1);
$("#pick-louvered-panel-hidden-session-id").val(1);
// end of new session

$(".master-post-div-panel-class").css("display", "block");

show_page_loading_after_back_fx();
// master width



function show_page_loading_after_back_fx()

{

    $.ajax({

        url: "{{ route('satirtha.main_pass_load_back_home_panel_session') }}",

        type: "GET",

        dataType: "json",

        success: function(event) {

            $(".size").html("Selected width "+event.master_width_view_upper+"ft, Length "+event.master_height_view_upper+"ft" );

            $("#master-home-wood-id").html(event.wood_types);

            $("#zero-page-price-hidden-id").val(event.wood_type_price);

            $('#master-wood-panel-price-id').html(event.wood_type_price);

            $("#master-wood-img-panel-page1-id").html(event.wood_type_img);

            $(".master-wood-type-description-class").html(event.final_wood_description_new);



            $("#youtube-canopy-video-id").html(event.canopy_video);

            $("#canopy-type-wish-text-id").html(event.canopy_msg_html);

            $("#lpanel-type-wish-text-id").html(event.lpanel_msg_html);

            $("#youtube-lpanel-video-id").html(event.lpanel_video);

            var wood_hidden_session_id = $("#wood-hidden-session-id").val();
            
            if(wood_hidden_session_id == 1)
            {
                $("#master-home-post-id").html(event.main_posts);
                
                var master_first_new_price = parseFloat(event.master_price).toFixed(2);

                $("#master-panel-price-id").html(master_first_new_price);

                $("#first-page-price-hidden-id").val(master_first_new_price);

                $("#master-img-panel-page1-id").html(event.master_img);
                
                $("#pergola-pick-a-footprint-price-id").html(parseFloat(event.master_price).toFixed(2));

                $("#pergola-price-id1").html(parseFloat(event.wood_type_price).toFixed(2));

            }
            if(wood_hidden_session_id == 0)
            {
                $("#master-home-post-id").html('<option value="">Choose posts</option>');

                $(".master-post-div-panel-class").css("display", "none");
                
                var master_first_new_price = parseFloat(event.master_price).toFixed(2);

                $("#master-panel-price-id").html("");

                $("#first-page-price-hidden-id").val(0);

                $("#master-img-panel-page1-id").html("");
                
                $("#pergola-pick-a-footprint-price-id").html("");

                $("#pergola-price-id1").html("");
                master_width_fx();
                master_height_fx();
            }







            $("#ladder-overhead-datas-show-id").html(event.overhead_types);

            var first_price11 = $("#first-page-price-hidden-id").val();

            // if(event.main_overhead_q == "open")
            // {
            //     var second_price12 = (parseFloat(first_price11) - parseFloat(event.master_overhead_price)).toFixed(2);
            // }
            // else
            // {
                    var second_price12 = (parseFloat(first_price11) + parseFloat(event.master_overhead_price)).toFixed(2);
            // }

           

            $("#second-page-price-hidden-id").val(second_price12);

            $("#second-price-panel-id").html(second_price12);

            $("#second-image-panel-id").html(event.master_overhead_img);
            
            $("#pergola-pick-overhead-shades-price-id").html(parseFloat(event.master_overhead_price).toFixed(2));

            $("#pergola-price-id2").html(parseFloat(first_price11).toFixed(2));





            $("#new-custom-third-val-id").find("#3dviewerplayer").attr('src',event.video_data); 
            setTimeout(() => {
                $(".loader").hide();
                $("#new-custom-third-val-id").find("#3dviewerplayer").css('display','block'); 
            }, 10000);     
        



            $("#fourth-page-post-length-id").html(event.master_post_length);

            $("#fourth-price-panel-id").html(event.master_post_length_price);

            var second_price42 = (parseFloat(event.master_post_length_price) + parseFloat(second_price12)).toFixed(2);

            

            $("#fourth-img-panel-view-id").html(event.master_post_length_img);



            $("#fourth-total-price-panel-id").html(second_price42);

            $("#fourth-page-price-hidden-id").val(second_price42);
            
            $("#pergola-pick-post-length-price-id").html(parseFloat(event.master_post_length_price).toFixed(2));

            $("#pergola-price-id3").html(parseFloat(second_price12).toFixed(2));





            // slap
            if(event.mount_price_html == 0)
            {
                $(".pick-post-mount-bracket-class-yes-type").prop('checked',false);

                $(".pick-post-mount-bracket-class-no-type").prop('checked',true);

                $(".pick-slap-select-panel-class").css('display', 'none');

                $("#mount-brackets-datas-show-id").html('<option value="">Choose a mount brackets</option><option value="1">Concrete setup</option><option value="2">Existing slap setup</option>');

                var mountB = "Pick Slap*";
                $("#mount-bracket-pick-slap-name-id").html(mountB);

                $("#mount-brackets-datas-show-id").css('display', 'none');

                var step1_price = parseFloat(second_price42);

                var main_step3_price = step1_price;

                $("#pick-slap-mount-panel-load-id").html(event.choose_pick_slap_html);

                $("#fifth-page-price-hidden-id").val(main_step3_price.toFixed(2));

                $("#fifth-total-price-panel-id").html(main_step3_price.toFixed(2));

                $("#fifth-price-panel-id").html(0);

                $("#pick-slap-mount-panel-name-load-id").val("");

                $("#mount-hidden-panel-price-new-id").val(0);
                
                $("#pergola-pick-mount-bracket-price-id").html(0);

                $("#pergola-price-id4").html(parseFloat(second_price42).toFixed(2));

                $("#mount-bracket-video-id").html('<video width="1280" height="720" controls><source src="'+event.video_link+'" type="video/mp4"></video>');
                $("#new-mount-bracket-img-Qid").html('<img loading="lazy" src="'+event.image_link+'" style="margin-bottom: 0; box-shadow: 0 0 3px rgba(0,0,0,0.1); border: 10px solid #fff;" alt="post mount brackets" width="428" height="257" class="aligncenter size-full wp-image-3479">');
                $("#mount-bracket-type-wish-text-id").html(event.mount_description);
            }
            else
            {
                $(".pick-post-mount-bracket-class-yes-type").prop('checked',true);

                $(".pick-post-mount-bracket-class-no-type").prop('checked',false);

                $("#mount-brackets-datas-show-id").css('display', 'block');

                $(".pick-slap-select-panel-class").css('display', 'flex');

                if(event.show_mount_slap_types == 1)
                {
                    $("#mount-brackets-datas-show-id").html('<option value="">Choose a mount brackets</option><option value="1" selected>Concrete setup</option><option value="2">Existing slap setup</option>');
                    var mountB = "Concrete Setup*";
                }
                else if(event.show_mount_slap_types == 2)
                {
                    $("#mount-brackets-datas-show-id").html('<option value="">Choose a mount brackets</option><option value="1">Concrete setup</option><option value="2" selected>Existing slap setup</option>');
                    var mountB = "Existing Slap Setup*";
                }

                $("#mount-bracket-pick-slap-name-id").html(mountB);

                var step1_price = parseFloat(second_price42);

                var step2_price = parseFloat(event.final_post_mount);

                var main_step3_price = step1_price + step2_price;

                $("#pick-slap-mount-panel-name-load-id").val(event.choose_pick_slap_html);

                $("#pick-slap-mount-panel-load-id").html(event.choose_pick_slap_html);

                $("#fifth-page-price-hidden-id").val(main_step3_price.toFixed(2));

                $("#fifth-total-price-panel-id").html(main_step3_price.toFixed(2));

                $("#fifth-price-panel-id").html(step2_price.toFixed(2));

                $("#mount-hidden-panel-price-new-id").val(step2_price.toFixed(2));
                
                $("#pergola-pick-mount-bracket-price-id").html(parseFloat(event.final_post_mount).toFixed(2));

                $("#pergola-price-id4").html(parseFloat(second_price42).toFixed(2));

                $("#mount-bracket-video-id").html('<video width="1280" height="720" controls><source src="'+event.video_link+'" type="video/mp4"></video>');
                $("#new-mount-bracket-img-Qid").html('<img loading="lazy" src="'+event.image_link+'" style="margin-bottom: 0; box-shadow: 0 0 3px rgba(0,0,0,0.1); border: 10px solid #fff;" alt="post mount brackets" width="428" height="257" class="aligncenter size-full wp-image-3479">');
                $("#mount-bracket-type-wish-text-id").html(event.mount_description);


            }

            
            // slap checking


            if(event.my_latest_canopy_type_check == "yes")
            {
                $(".pick-post-canopy-class-yes-type").prop('checked',true);

                $(".pick-post-canopy-class-no-type").prop('checked',false);

                $(".canopy-note-select-panel-class").css('display', 'block');

                $("#canopy_answer_hidden_id").val("yes");

                $(".canopy-note-select-panel-class").html(event.canopy_session_name);

                var first_price = parseFloat($("#fifth-page-price-hidden-id").val());

                var second_price = parseFloat(event.show_canopy_name_price);

                var total_price111 = first_price + second_price;

                console.log("canopy yes price : "+event.show_canopy_name_price);

                $("#sixth-total-price-panel-id").html(total_price111.toFixed(2));

                $("#sixth-panel-price-hidden-id").val(total_price111.toFixed(2));
                
                $("#pergola-canopy-price-id").html(parseFloat(event.show_canopy_name_price).toFixed(2));

                $("#pergola-price-id5").html(parseFloat($("#fifth-page-price-hidden-id").val()).toFixed(2));
            }
            else if(event.my_latest_canopy_type_check == "no")
            {
                $(".pick-post-canopy-class-yes-type").prop('checked',false);

                $(".pick-post-canopy-class-no-type").prop('checked',true);

                $(".canopy-note-select-panel-class").css('display', 'block');

                $("#canopy_answer_hidden_id").val("no");

                $(".canopy-note-select-panel-class").html(event.canopy_session_name);

                var first_price = parseFloat($("#fifth-page-price-hidden-id").val());

                var second_price = parseFloat(event.show_canopy_name_price);

                var total_price111 = first_price + second_price;

                // console.log("canopy yes price : "+event.show_canopy_name_price);

                $("#sixth-total-price-panel-id").html(total_price111.toFixed(2));

                $("#sixth-panel-price-hidden-id").val(total_price111.toFixed(2));
                
                $("#pergola-canopy-price-id").html(parseFloat(event.show_canopy_name_price).toFixed(2));

                $("#pergola-price-id5").html(parseFloat($("#fifth-page-price-hidden-id").val()).toFixed(2));
            }
            




            // end canopy


            if(event.show_lpanel_type == "yes")
            {
                $(".pick-lpanel-yes-type-new").prop('checked',true);

                $(".pick-lpanel-no-type-new").prop('checked',false);

                $(".checking-radio-panel-of-lpanel2-class").css('display', 'block');

                $("#lpanel-checkbox-id").css('display','block');

                $("#lpanel_answer_hidden_id").val("yes");

                if(event.lpanel_side1 == 1)
                {
                    $("#left-lpanel-id").prop('checked',true);
                    $("#lpanel-checkbox-side1-count-id").val(1);
                }
                else
                {
                    $("#left-lpanel-id").prop('checked',false);
                    $("#lpanel-checkbox-side1-count-id").val(0);
                }

                if(event.lpanel_side2 == 1)
                {
                    $("#right-lpanel-id").prop('checked',true);
                    $("#lpanel-checkbox-side2-count-id").val(1);
                }
                else
                {
                    $("#right-lpanel-id").prop('checked',false);
                    $("#lpanel-checkbox-side2-count-id").val(0);
                }

                if(event.lpanel_side3 == 1)
                {
                    $("#front-lpanel-id").prop('checked',true);
                    $("#lpanel-checkbox-side3-count-id").val(1);
                }
                else
                {
                    $("#front-lpanel-id").prop('checked',false);
                    $("#lpanel-checkbox-side3-count-id").val(0);
                }

                if(event.lpanel_side4 == 1)
                {
                    $("#rear-lpanel-id").prop('checked',true);
                    $("#lpanel-checkbox-side4-count-id").val(1);
                }
                else
                {
                    $("#rear-lpanel-id").prop('checked',false);
                    $("#lpanel-checkbox-side4-count-id").val(0);
                }

                $(".checking-radio-panel-of-lpanel2-class").html(event.lpanel_radio_panel);

                $("#lpanel-wish-price-id").html(event.show_lpanel_name_price);
                // $("#lpanel-wish-price-id").html(0);
                $("#lpanel-hide-radio-btn-panel-price-id").val(event.show_lpanel_name_price);
                // $("#lpanel-hide-radio-btn-panel-price-id").val(0);

                var second_price = parseFloat(event.show_lpanel_name_price);

                var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());

                var total_price222 = first_price + second_price;

                $("#seventh-total-price-panel-id").html(total_price222.toFixed(2));

                $("#seventh-panel-price-hidden-id").val(total_price222.toFixed(2));
                
                $("#pergola-louvered-panel-price-id").html(parseFloat(event.show_lpanel_name_price).toFixed(2));

                $("#pergola-price-id6").html(parseFloat($("#sixth-panel-price-hidden-id").val()).toFixed(2));

                setTimeout(() => {
                    load_louvered_panel_session_new_single_fx();
                }, 2000);
                

            }
            else if(event.show_lpanel_type == "no")
            {
                $("#lpanel_answer_hidden_id").val("no");

                $(".pick-lpanel-yes-type-new").prop('checked',false);

                $(".pick-lpanel-no-type-new").prop('checked',true);

                $(".checking-radio-panel-of-lpanel2-class").css('display', 'block');

                $("#lpanel-checkbox-id").css('display','none');

                $(".checking-radio-panel-of-lpanel2-class").html(event.lpanel_radio_panel);

                $("#lpanel-wish-price-id").html(event.show_lpanel_name_price);

                $("#lpanel-hide-radio-btn-panel-price-id").val(0);

                var second_price = parseFloat(event.show_lpanel_name_price);

                var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());

                var total_price222 = first_price + second_price;

                $("#seventh-total-price-panel-id").html(total_price222.toFixed(2));

                $("#seventh-panel-price-hidden-id").val(total_price222.toFixed(2));
                
                $("#pergola-louvered-panel-price-id").html(parseFloat(event.show_lpanel_name_price).toFixed(2));

                $("#pergola-price-id6").html(parseFloat($("#sixth-panel-price-hidden-id").val()).toFixed(2));

            }

               





            $("#final-product-width").html(event.width_data3);

            $("#final-product-length").html(event.height_data3);

            $("#final-product-post-length").html(event.length_data3);

            $("#final-product-overhead").html(event.overhead_data3);

            $(".final-product-img-final-class").html(event.final_prod_img3);

            $(".last-footprint-img-class").html(event.final_footprint_img3);

            var event_mount_new_panel_type = event.mount_new_panel_type;

            if(event.mount_new_panel_type == "" || event.mount_new_panel_type == null)
            {
                var event_mount_new_panel_type = "No"; 
            }

            $("#final-product-mount").html(event_mount_new_panel_type);


            $("#final-product-canopy").html(event.canopy_new_panel_type);

            $("#final-product-lpanel").html(event.final_new_lpanel_type);

            $("#final-product-total-price-id").html(event.final_home_price_due);

            $("#final-product-wood-type").html(event.final_wood_type_new);



        },
        error: function(event) {



        }

    })

}

function load_louvered_panel_session_new_single_fx()
{
    var wood_type = $("#master-home-wood-id").val();
    var width_type = $("#master-home-width-id").val();
    var height_type = $("#master-home-height-id").val();
    var post_length = $("#fourth-page-post-length-id").val();
    $.ajax({
        url: "{{ route('satirtha.louvered-panel-yes-shown') }}",
        type: "GET",
        data: {wood_type: wood_type, width_type: width_type, height_type: height_type, post_length: post_length },
        dataType: "json",
        success: function(event){
            $("#side1-lpanel-id").html(" Side1 ("+event.side13+" Price: "+event.side13_price+") ");
            $("#left-lpanel-id").attr('onclick','checkbox_lpanel_fx("side1",'+event.side13_price+')');
            $("#side2-lpanel-id").html(" Side2 ("+event.side24+" Price: "+event.side24_price+") ");
            $("#right-lpanel-id").attr('onclick','checkbox_lpanel_fx("side2",'+event.side24_price+')');
            $("#side3-lpanel-id").html(" Side3 ("+event.side13+" Price: "+event.side13_price+") ");
            $("#front-lpanel-id").attr('onclick','checkbox_lpanel_fx("side3",'+event.side13_price+')');
            $("#side4-lpanel-id").html(" Side4 ("+event.side24+" Price: "+event.side24_price+") ");
            $("#rear-lpanel-id").attr('onclick','checkbox_lpanel_fx("side4",'+event.side24_price+')');
        }, error: function(event){

        }
    })
}
</script>

@else

<script>
$(".master-post-div-panel-class").css("display", "none");
</script>

@endif

<script>
function submit_Send_mail_fx()

{

    var uname = $("#send-form-name-id").val();

    var uemail = $("#send-form-email-id").val();

    var ucomment = $("#send-form-comment-id").val();



    if (uname == "")

    {

        error_pass_alert_show_msg("Please enter a name");

    } else if (uemail == "")

    {

        error_pass_alert_show_msg("Please enter a email");

    } else if (ucomment == "")

    {

        error_pass_alert_show_msg("Please enter a comment");

    } else

    {

        $.ajax({

            url: "{{ route('satirtha.send-my-mail') }}",

            type: "GET",

            data: {
                uname: uname,
                uemail: uemail,
                ucomment: ucomment
            },

            dataType: "json",

            success: function(event)

            {

                if (event == "success") {

                    success_pass_alert_show_msg("Successfully send mail");
                    $("#myModal").modal('hide');

                } else if (event == "error") {

                    error_pass_alert_show_msg("Someting wrong ! try again later");

                }

            }

        })

    }

}

function submit_Send_mail_fx1()

{

    var uname = $("#send-form-name-id1").val();

    var uemail = $("#send-form-email-id1").val();

    var ucomment = $("#send-form-comment-id1").val();



    if (uname == "")

    {

        error_pass_alert_show_msg("Please enter a name");

    } else if (uemail == "")

    {

        error_pass_alert_show_msg("Please enter a email");

    } else if (ucomment == "")

    {

        error_pass_alert_show_msg("Please enter a comment");

    } else

    {

        $.ajax({

            url: "{{ route('satirtha.send-my-mail-footprint') }}",

            type: "GET",

            data: {
                uname: uname,
                uemail: uemail,
                ucomment: ucomment
            },

            dataType: "json",

            success: function(event)

            {

                if (event == "success") {

                    success_pass_alert_show_msg("Successfully send mail");
                    $("#myModal1").modal('hide');

                } else if (event == "error") {

                    error_pass_alert_show_msg("Someting wrong ! try again later");

                }

            }

        })

    }

}


// master wood

function master_wood_fx()

{

    $.ajax({

        url: "{{ route('satirtha.choose-master-wood') }}",

        type: "GET",

        dataType: "json",

        success: function(event) {

            $("#master-home-wood-id").html(event);

        },
        error: function(event) {



        }

    });

}


</script>




@if(Session::has('main_unique_session_key'))
    <script>  
        var unique_wood_session_val = "yes"; 
        
    </script>
@else
    <script>  var unique_wood_session_val = "no"; </script>
@endif

<script>

function master_home_wood_fx()

{
    if(unique_wood_session_val == "yes")
    {
        
        var x = $("#master-home-wood-id").val();

        if (x == "")

        {

            $("#zero-page-price-hidden-id").val(0);

            $("#master-wood-panel-price-id").html("0");

            $("#master-wood-img-panel-page1-id").html("");

            $(".master-wood-type-description-class").html("");

            master_width_new_fx();

            master_height_new_fx();  

            $(".master-post-div-panel-class").css('display','block');

            

        } else

        {

            $.ajax({

                url: "{{ route('satirtha.choose-master-wood-change') }}",

                type: "GET",

                data: {
                    id_x: x
                },

                dataType: "json",

                success: function(event) {

                    $("#zero-page-price-hidden-id").val(event.wood_price);

                    $("#master-wood-panel-price-id").html(event.wood_price);

                    $("#master-wood-img-panel-page1-id").html(event.image_file);

                    $(".master-wood-type-description-class").html(event.wood_descriptions);

                    master_width_new_fx();

                    master_height_new_fx(); 

                    $(".master-post-div-panel-class").css('display','none');

                    $("#pergola-pick-a-footprint-price-id").html(0);
                    
                    $("#master-panel-price-id").html(0);

                    $("#master-new-combine-width-id").html("");

                    $("#master-new-combine-height-id").html("");

                    $("#master-img-panel-page1-id").html("");

                },
                error: function(event) {

                }

            });

        }

        $("#wood-hidden-session-id").val(0);
        $("#master-img-panel-page1-id").html("");
        $("#wood-hidden-session-id").val(0);

    }
    else if(unique_wood_session_val == "no")
    {
        var x = $("#master-home-wood-id").val();

        if (x == "")

        {

            $("#zero-page-price-hidden-id").val(0);

            $("#master-wood-panel-price-id").html("0");

            $("#master-wood-img-panel-page1-id").html("");

            $(".master-wood-type-description-class").html("");

            master_width_fx();

            master_height_fx();  

            $(".master-post-div-panel-class").css('display','block');

            

        } else

        {

            $.ajax({

                url: "{{ route('satirtha.choose-master-wood-change') }}",

                type: "GET",

                data: {
                    id_x: x
                },

                dataType: "json",

                success: function(event) {

                    $("#zero-page-price-hidden-id").val(event.wood_price);

                    $("#master-wood-panel-price-id").html(event.wood_price);

                    $("#master-wood-img-panel-page1-id").html(event.image_file);

                    $(".master-wood-type-description-class").html(event.wood_descriptions);

                    // var m_price = $("#first-page-price-hidden-id").val();

                    // if(m_price != null || m_price != "" || m_price != 0)
                    // {
                    //     var f_Qprice = parseFloat($("#zero-page-price-hidden-id").val());
                    //     $("#first-page-price-hidden-id").val((f_Qprice + m_price).toFixed(2));
                    //     $("#master-panel-price-id").html((f_Qprice + m_price).toFixed(2));
                    // }

                    
                    master_width_fx();

                    master_height_fx(); 

                    $(".master-post-div-panel-class").css('display','none');

                    $("#pergola-pick-a-footprint-price-id").html(0);
                    
                    $("#master-panel-price-id").html(0);

                    $("#master-new-combine-width-id").html("");

                    $("#master-new-combine-height-id").html("");

                    $("#master-img-panel-page1-id").html("");

                },
                error: function(event) {

                }

            });

        }
    }
    

}


// master width new
function master_width_new_fx()
{
    $.ajax({

        url: "{{ route('satirtha.choose-master-new-width') }}",

        type: "GET",

        dataType: "json",

        success: function(event) {

            $("#master-home-width-id").html(event);
            $("#master-home-post-id").html('<option value="">Choose posts</option>');
            $("#pick-a-footprint-hidden-session-id").val(0);

        },
        error: function(event) {

        }

    })

}


// master width

function master_width_fx()

{

    $.ajax({

        url: "{{ route('satirtha.choose-master-width') }}",

        type: "GET",

        dataType: "json",

        success: function(event) {

            $("#master-home-width-id").html(event);

        },
        error: function(event) {



        }

    })

}

// new session master height
function master_height_new_fx()
{
    $.ajax({
        url: "{{ route('satirtha.choose-master-new-height') }}",
        type: "GET",
        dataType: "json",
        success: function(event) {
            $("#master-home-height-id").html(event);
        },
        error: function(event) { }
    })
}

// master height

function master_height_fx()

{

    $.ajax({

        url: "{{ route('satirtha.choose-master-height') }}",

        type: "GET",

        dataType: "json",

        success: function(event) {

            $("#master-home-height-id").html(event);

        },
        error: function(event) {



        }

    })

}
</script>
@if(Session::has('main_unique_session_key'))
    <script> var unique_no_of_post_session_val = "yes"; </script>
@else
    <script>  var unique_no_of_post_session_val = "no"; </script>
@endif
<script>
// master posts

function master_post_fx()

{

    if(unique_no_of_post_session_val == "yes")
    {
        var wood_new_hidden_session = $("#wood-hidden-session-id").val();

        if(wood_new_hidden_session == 0)
        {
            var master_width_name = $("#master-home-width-id").val();

            var master_height_name = $("#master-home-height-id").val();

            var master_wood_name = $("#master-home-wood-id").val();

            $.ajax({

                url: "{{ route('satirtha.choose-master-new-session-post') }}",

                type: "GET",

                data: {
                    master_width_name: master_width_name,
                    master_height_name: master_height_name,
                    master_wood_name: master_wood_name
                },
                dataType: "json",
                success: function(event) {
                    $("#master-home-post-id").html(event);
                },
                error: function(event) {

                }
            })
        }
        else if(wood_new_hidden_session == 1)
        {
            var master_width_name = $("#master-home-width-id").val();

            var master_height_name = $("#master-home-height-id").val();

            var master_wood_name = $("#master-home-wood-id").val();

            $.ajax({

                url: "{{ route('satirtha.choose-master-post') }}",

                type: "GET",

                data: {
                    master_width_name: master_width_name,
                    master_height_name: master_height_name,
                    master_wood_name: master_wood_name
                },
                dataType: "json",
                success: function(event) {
                    $("#master-home-post-id").html(event);
                },
                error: function(event) {

                }
            })
        }
        
        
    }
    else if(unique_no_of_post_session_val == "no")
    {
        var master_width_name = $("#master-home-width-id").val();

        var master_height_name = $("#master-home-height-id").val();

        var master_wood_name = $("#master-home-wood-id").val();

        $.ajax({

            url: "{{ route('satirtha.choose-master-post') }}",

            type: "GET",

            data: {
                master_width_name: master_width_name,
                master_height_name: master_height_name,
                master_wood_name: master_wood_name
            },
            dataType: "json",
            success: function(event) {
                $("#master-home-post-id").html(event);
            },
            error: function(event) {

            }
        })
    }
}

// onchange master width

function master_home_width_fx()
{
    $("#pick-a-footprint-hidden-session-id").val(0);

    $("#pick_footprint_hide_data_change_panel").val(1);

    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    var master_wood_val = $("#master-home-wood-id").val();

    if (master_width == "")

    {

        $("#master-new-combine-width-id").html("");

        master_post_fx();

        $("#master-panel-price-id").html($("#zero-page-price-hidden-id").val());

        $("#first-page-price-hidden-id").val($("#zero-page-price-hidden-id").val());

        $("#master-img-panel-page1-id").html('');

        $(".master-post-div-panel-class").css("display", "none");

        $("#pergola-pick-a-footprint-price-id").html(0);

        $("#pergola-price-id1").html($("#zero-page-price-hidden-id").val());

    } else

    {

        if (master_width != "" && master_height != "" && master_post != "")

        {
            $(".master-post-div-panel-class").css("display", "block");

            choose_master_panel_upper_view_fx();

            change_master_post_fx();

            master_post_fx();

        } else if (master_width != "" && master_height != "")

        {
            choose_master_panel_upper_view_fx();
            
            $(".master-post-div-panel-class").css("display", "block");

            $("#pergola-pick-a-footprint-price-id").html(0);

            $("#pergola-price-id1").html($("#zero-page-price-hidden-id").val());

            master_post_fx();

        }

        $.ajax({

            url: "{{ route('satirtha.change-master-width') }}",
            type: "GET",
            data: {
                id: master_width
            },
            dataType: 'json',
            success: function(event) {
                $("#master-new-combine-width-id").html(event);

                
            },
            error: function(event) {

            }

        });

    }

}


function choose_master_panel_upper_view_fx()
{
    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    $.ajax({
        url: "{{ route('satirtha.master-panel-upper-view-fx') }}",
        type: "GET",
        data: {master_width: master_width, master_height: master_height},
        dataType: "json",
        success: function(event)
        {
            $(".size").html("Selected width "+event.master_width+"ft, Length "+event.master_height+"ft" );
        },
        error: function(event)
        {

        }
    })
    
}
// 

function master_home_height_fx()

{
    $("#pick-a-footprint-hidden-session-id").val(0);

    $("#pick_footprint_hide_data_change_panel").val(1);

    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    if (master_height == "")

    {

        $("#master-new-combine-height-id").html("");

        master_post_fx();

        $("#master-img-panel-page1-id").html('');

        $("#master-panel-price-id").html($("#zero-page-price-hidden-id").val());

        $("#first-page-price-hidden-id").val($("#zero-page-price-hidden-id").val());

        $(".master-post-div-panel-class").css("display", "none");

        $("#pergola-pick-a-footprint-price-id").html(0);

        $("#pergola-price-id1").html($("#zero-page-price-hidden-id").val());

    } else

    {

        if (master_width != "" && master_height != "" && master_post != "")

        {
            $(".master-post-div-panel-class").css("display", "block");

            choose_master_panel_upper_view_fx();
            
            change_master_post_fx();

            master_post_fx();

        } else if (master_width != "" && master_height != "")

        {
            choose_master_panel_upper_view_fx();

            $(".master-post-div-panel-class").css("display", "block");

            $("#pergola-pick-a-footprint-price-id").html(0);

            $("#pergola-price-id1").html($("#zero-page-price-hidden-id").val());

            master_post_fx();

        }

        $.ajax({

            url: "{{ route('satirtha.change-master-height') }}",

            type: "GET",

            data: {
                id: master_height
            },

            dataType: 'json',

            success: function(event) {

                $("#master-new-combine-height-id").html(event);

            },
            error: function(event) {



            }

        });

    }

}

// change master posts

function change_master_post_fx()

{
    $("#pick-a-footprint-hidden-session-id").val(0);

    $("#pick_footprint_hide_data_change_panel").val(1);

    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    var master_wood = $("#master-home-wood-id").val();

    if (master_post == "")

    {
        $("#pergola-pick-a-footprint-price-id").html(0);

        $("#youtube-canopy-video-id").html("");

        $("#canopy-type-wish-text-id").html("");

        $("#lpanel-type-wish-text-id").html("");

        $("#youtube-lpanel-video-id").html("");

        $("#master-panel-price-id").html($("#zero-page-price-hidden-id").val());

        $("#first-page-price-hidden-id").val($("#zero-page-price-hidden-id").val());

        $("#master-img-panel-page1-id").html('');

        $("#master-panel-price-id").html($("#zero-page-price-hidden-id").val());

        // $("#pergola-pick-a-footprint-price-id").html(0);

        // $("#pergola-price-id1").html($("#zero-page-price-hidden-id").val());

    } else

    {
        

        $.ajax({

            url: "{{ route('satirtha.choose-master-post-wish-price-frame') }}",

            type: "GET",

            data: {
                master_width: master_width,
                master_height: master_height,
                master_post: master_post,
                master_wood: master_wood
            },

            dataType: "json",

            success: function(event) {

                var new_master_price = parseFloat(event.master_price).toFixed(2);

                $("#pergola-pick-a-footprint-price-id").html((parseFloat(event.master_price)).toFixed(2));

                $("#master-panel-price-id").html(new_master_price);

                $("#first-page-price-hidden-id").val(new_master_price);

                $("#master-img-panel-page1-id").html(event.master_img);

                $("#youtube-canopy-video-id").html(event.canopy_video);

                $("#youtube-lpanel-video-id").html(event.lpanel_video);

                $("#canopy-type-wish-text-id").html(event.canopy_msg_html);

                $("#lpanel-type-wish-text-id").html(event.lpanel_msg_html);

            },
            error: function(event) {

            }

        });

    }

}

// click to next (0th to 1st)
</script>

@if(Session::has('main_unique_session_key'))
    <script> var unique_overhead_shades_session_val = "yes"; </script>
@else
    <script>  var unique_overhead_shades_session_val = "no"; </script>
@endif
<script>
$("#zero-page-to-next-id").click(function() {

    var master_wood_type = $("#master-home-wood-id").val();

    var master_wood_price = $("#zero-page-price-hidden-id").val();



    if (master_wood_type == "")

    {

        error_pass_alert_show_msg("Please choose a wood type");

    } else

    {

        current_fs = $(this).parent();

        next_fs = $(this).parent().next();



        //show the next fieldset

        next_fs.show();

        //hide the current fieldset with style

        current_fs.animate({
            opacity: 0
        }, {

            step: function(now) {

                // for making fielset appear animation

                opacity = 1 - now;



                current_fs.css({

                    'display': 'none',

                    'position': 'relative'

                });

                next_fs.css({
                    'opacity': opacity
                });

            },

            duration: 600

        });


        if (for_new_wood_type_check != 1)

        {

            $("#first-page-price-hidden-id").val($("#zero-page-price-hidden-id").val());

            $("#master-panel-price-id").html($("#zero-page-price-hidden-id").val());

            $("#pergola-price-id1").html($("#zero-page-price-hidden-id").val());

        }



    }

});



// click to next (1st to 2nd)

$("#first-page-to-next-id").click(function() {

    var checking_data1 = $("#pick_footprint_hide_data_change_panel").val();

    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    var second_page_store = $("#ladder-overhead-datas-show-id").val();



    if (master_width == "")

    {

        error_pass_alert_show_msg("Please choose a width");

    } else if (master_height == "")

    {

        error_pass_alert_show_msg("Please choose a length");

    } else if (master_post == "")

    {

        error_pass_alert_show_msg("Please choose posts");

    } else

    {

        current_fs = $(this).parent();

        next_fs = $(this).parent().next();



        //show the next fieldset

        next_fs.show();

        //hide the current fieldset with style

        current_fs.animate({
            opacity: 0
        }, {

            step: function(now) {

                // for making fielset appear animation

                opacity = 1 - now;



                current_fs.css({

                    'display': 'none',

                    'position': 'relative'

                });

                next_fs.css({
                    'opacity': opacity
                });

            },

            duration: 600

        });


        if(unique_overhead_shades_session_val == "yes")
        {
            var footprint_session_val = $("#pick-a-footprint-hidden-session-id").val();
            if(footprint_session_val == 0)
            {
                loading_second_page_data_fx();
                $("#pergola-pick-overhead-shades-price-id").html(0);
                $("#second-image-panel-id").html("");
            }
            else
            {
                if (checking_data1 == "1")
                {
                    loading_second_page_data_fx();
                }
            }
        }
        else if(unique_overhead_shades_session_val == "no")
        {
            if (checking_data1 == "1")
            {
                loading_second_page_data_fx();
            }
        }



    }



});





// second page

function loading_second_page_data_fx()

{

    $("#pick_footprint_hide_data_change_panel").val(0);

    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    var master_wood = $("#master-home-wood-id").val();

    var master_hidden_overhead_shades_value = $("#pick-a-footprint-hidden-session-id").val(); 

    $.ajax({

        url: "{{ route('satirtha.show-second-page-data') }}",

        type: "GET",

        data: {
            master_width: master_width,
            master_height: master_height,
            master_post: master_post,
            master_wood: master_wood,
            master_hidden_overhead_shades_value: master_hidden_overhead_shades_value,
        },

        dataType: "json",

        success: function(event) {

            console.log(event);

            $("#ladder-overhead-datas-show-id").html(event.overhead_types);

            var first_price = parseFloat($("#first-page-price-hidden-id").val());

            var second_price = parseFloat(first_price);

            $("#second-page-price-hidden-id").val(second_price.toFixed(2));

            $("#second-price-panel-id").html(second_price.toFixed(2));

            $("#pergola-price-id2").html(second_price.toFixed(2));



        },
        error: function(event) {



        }

    });

}



function overhead_shades2_change_fx()

{
    $("#pick-overhead-hidden-session-id").val(0);

    $("#pick_overhead_shades_hide_data_change_panel").val(1);

    var first_price = $("#first-page-price-hidden-id").val();

    var overhead_val = $("#ladder-overhead-datas-show-id").val();

    if (overhead_val == "")

    {


        $("#pergola-pick-overhead-shades-price-id").html(0);

        $("#second-image-panel-id").html("");

        var second_price = parseFloat(first_price);

        $("#second-price-panel-id").html(second_price.toFixed(2));

        $("#second-page-price-hidden-id").val(second_price.toFixed(2));

    } else

    {

        var master_width = $("#master-home-width-id").val();

        var master_height = $("#master-home-height-id").val();

        var master_post = $("#master-home-post-id").val();

        var master_wood = $("#master-home-wood-id").val();

        var pickAFootprint_val = $("#first-page-price-hidden-id").val();

        $.ajax({

            url: "{{ route('satirtha.choose-second-page-data') }}",

            type: "GET",

            data: {
                id: overhead_val,
                master_width: master_width,
                master_height: master_height,
                master_post: master_post,
                master_wood: master_wood,
                pickAFootprint_price: pickAFootprint_val
            },

            dataType: "json",

            success: function(event) {

                // if(event.overhead_type == "open")
                // {
                //     var second_price = (parseFloat(first_price) - parseFloat(event.overhead_price)).toFixed(2);
                // }
                // else
                // {
                    var second_price = (parseFloat(first_price) + parseFloat(event.overhead_price)).toFixed(2);
                // }

                $("#pergola-pick-overhead-shades-price-id").html((parseFloat(event.overhead_price)).toFixed(2));

                $("#second-page-price-hidden-id").val(second_price);

                $("#second-image-panel-id").html(event.overhead_img);

                $("#second-price-panel-id").html(second_price);

            },
            error: function(event) {



            }

        });

    }

}



// click next btn (2nd to 3rd page)

$("#second-page-to-next-id").click(function() {

    var second_page_store = $("#ladder-overhead-datas-show-id").val();

//pergola-pick-post-length-price-id
    $("#pergola-price-id3").html($("#second-page-price-hidden-id").val());


    if (second_page_store == "")

    {

        error_pass_alert_show_msg("Please choose a ladder spacing type");

    } else

    {

        current_fs = $(this).parent();

        next_fs = $(this).parent().next();



        //show the next fieldset

        next_fs.show();

        //hide the current fieldset with style

        current_fs.animate({
            opacity: 0
        }, {

            step: function(now) {

                // for making fielset appear animation

                opacity = 1 - now;



                current_fs.css({

                    'display': 'none',

                    'position': 'relative'

                });

                next_fs.css({
                    'opacity': opacity
                });

            },

            duration: 600

        });





        video3Dfx();



    }

})





// end of second page

// start of third page

function video3Dfx()

{

    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    var overhead_val = $("#ladder-overhead-datas-show-id").val();





    $.ajax({

        url: "{{ route('satirtha.show-third-page-data') }}",

        type: "GET",

        data: {
            master_width: master_width,
            master_height: master_height,
            master_post: master_post,
            overhead_val: overhead_val
        },

        dataType: "json",
        success: function(event) {
	    $("#new-custom-third-val-id").find("#3dviewerplayer").attr('src',event); 
	    setTimeout(() => {
                $(".loader").hide();
		$("#new-custom-third-val-id").find("#3dviewerplayer").css('display','block'); 
            }, 10000);     
        },
        error: function(event) {

        }

    });

}
</script>

@if(Session::has('main_unique_session_key'))
    <script> var unique_post_length_session_val = "yes"; </script>
@else
    <script>  var unique_post_length_session_val = "no"; </script>
@endif
<script>

// click next btn (3nd to 4th page)

$("#third-page-to-next-id").click(function() {

    var fourth_page_data = $("#fourth-page-post-length-id").val();



    current_fs = $(this).parent();

    next_fs = $(this).parent().next();



    //show the next fieldset

    next_fs.show();

    //hide the current fieldset with style

    current_fs.animate({
        opacity: 0
    }, {

        step: function(now) {

            // for making fielset appear animation

            opacity = 1 - now;



            current_fs.css({

                'display': 'none',

                'position': 'relative'

            });

            next_fs.css({
                'opacity': opacity
            });

        },

        duration: 600

    });

        if(unique_post_length_session_val == "yes")
        {
            var overhead_shades_session_val = $("#pick-a-footprint-hidden-session-id").val();
            if(overhead_shades_session_val == 0)
            {
                loading_fourth_page_data_fx();
                $("#pergola-pick-post-length-price-id").html(0);
                $("#fourth-img-panel-view-id").html("");
            }
            else
            {
                if ($("#pick_overhead_shades_hide_data_change_panel").val() == "1")
                {
                    loading_fourth_page_data_fx();
                }
            }
        }
        else if(unique_post_length_session_val == "no")
        {
            if ($("#pick_overhead_shades_hide_data_change_panel").val() == "1")
            {
                loading_fourth_page_data_fx();
            }
        }

})



// end of third page



// start fourth page

function loading_fourth_page_data_fx()

{
    $("#pick-post-length-hidden-session-id").val(0);

    $("#pick_overhead_shades_hide_data_change_panel").val(0);



    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    var second_page_store = $("#ladder-overhead-datas-show-id").val();

    var master_wood = $("#master-home-wood-id").val();

    var pickAFootprint_val = $("#first-page-price-hidden-id").val();



    var price_range = $("#second-page-price-hidden-id").val();

    var master_hidden_post_length_value = $("#pick-overhead-hidden-session-id").val(); 

    $.ajax({

        url: "{{ route('satirtha.show-fourth-page-data') }}",

        type: "GET",

        data: {
            master_width: master_width,
            master_height: master_height,
            master_post: master_post,
            second_page_store: second_page_store,
            master_wood: master_wood,
            pickAFootprint_price: pickAFootprint_val,
            master_hidden_post_length_value: master_hidden_post_length_value
        },

        dataType: "json",

        success: function(event) {

            $("#fourth-page-post-length-id").html(event);

            $("#fourth-page-price-hidden-id").html(price_range);

            $("#fourth-total-price-panel-id").html(price_range);

        },
        error: function(event) {



        }

    })

}



function choose_fourth_page_data_fx4()

{

    $("#pick_post_length_hide_data_change_panel").val(1);

    var price_range = $("#second-page-price-hidden-id").val();

    var first_step_price = parseFloat(price_range);

    var fourth_data = $("#fourth-page-post-length-id").val();

    var master_wood = $("#master-home-wood-id").val();

    var pickAFootprint_val = $("#first-page-price-hidden-id").val();



    if (fourth_data == "" || fourth_data == null)

    {
        $("#pergola-pick-post-length-price-id").html(0);

        $("#fourth-price-panel-id").html(0);

        $("#fourth-total-price-panel-id").html(first_step_price.toFixed(2));

        $("#fourth-page-price-hidden-id").val(first_step_price.toFixed(2));

        $("#fourth-img-panel-view-id").html('');

    } else

    {

        var master_width = $("#master-home-width-id").val();

        var master_height = $("#master-home-height-id").val();

        var master_post = $("#master-home-post-id").val();

        var overhead_val = $("#ladder-overhead-datas-show-id").val();

        $.ajax({

            url: "{{ route('satirtha.choose-fourth-page-data') }}",

            type: "GET",

            data: {
                id: fourth_data,
                master_width: master_width,
                master_height: master_height,
                master_post: master_post,
                overhead_val: overhead_val,
                master_wood: master_wood,
                pickAFootprint_price: pickAFootprint_val
            },

            dataType: "json",

            success: function(event) {

                $("#fourth-price-panel-id").html(event.fourth_price);

                var second_price = parseFloat(event.fourth_price);

                $("#fourth-img-panel-view-id").html(event.fourth_img);



                var total_price = (parseFloat(second_price) + parseFloat(first_step_price)).toFixed(2);

                $("#fourth-total-price-panel-id").html(total_price);

                $("#fourth-page-price-hidden-id").val(total_price);

                $("#pergola-pick-post-length-price-id").html(parseFloat(second_price).toFixed(2));

            },
            error: function(event) {



            }

        });

    }

}
</script>

@if(Session::has('main_unique_session_key'))
    <script> var unique_post_length_session_val = "yes"; </script>
@else
    <script>  var unique_post_length_session_val = "no"; </script>
@endif
<script>



// click next btn (4th to 5th page)

$("#fourth-page-to-next-id").click(function() {

    var fourth_page_store = $("#fourth-page-post-length-id").val();

    var fifth_price_val = $("#fifth-page-price-hidden-id").val();



    if (fourth_page_store == "")
    {
        error_pass_alert_show_msg("Please choose a post length");
    } 
    else
    {

        current_fs = $(this).parent();

        next_fs = $(this).parent().next();



        //show the next fieldset

        next_fs.show();

        //hide the current fieldset with style

        current_fs.animate({
            opacity: 0
        }, {

            step: function(now) {

                // for making fielset appear animation

                opacity = 1 - now;



                current_fs.css({

                    'display': 'none',

                    'position': 'relative'

                });

                next_fs.css({
                    'opacity': opacity
                });

            },

            duration: 600

        });

        if(unique_post_length_session_val == "yes")
        {
            var pick_post_length_session_val = $("#pick-post-length-hidden-session-id").val();
            if(pick_post_length_session_val == 0)
            {
                load_fifth_page_fx5();
            }
            else
            {
                if(fifth_price_val == "" || fifth_price_val == null)
                {
                    load_fifth_page_fx5();
                }
            }
        }
        else if(unique_post_length_session_val == "no")
        {
            if(fifth_price_val == "" || fifth_price_val == null)
            {
                load_fifth_page_fx5();
            }
        }

        
    }
})



// end of fourth page



// fifth page

function load_fifth_page_fx5()

{
    $("#pick-mount-bracket-hidden-session-id").val(0);
    $("#pick-canopy-hidden-session-id").val(0);
    $("#pick-louvered-panel-hidden-session-id").val(0);

    $(".pick-post-mount-bracket-class-yes-type").prop('checked',true);

    $(".pick-post-mount-bracket-class-no-type").prop('checked',false);

    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    var second_page_store = $("#ladder-overhead-datas-show-id").val();

    var post_length_data = $("#fourth-page-post-length-id").val();

    var master_wood = $("#master-home-wood-id").val();

    var pickAFootprint_val = $("#first-page-price-hidden-id").val();

    $.ajax({

        url: "{{ route('satirtha.show-fifth-page-data') }}",

        type: "GET",

        data: {
            master_width: master_width,
            master_height: master_height,
            master_post: master_post,
            second_page_store: second_page_store,
            post_length_data_val: post_length_data,
            master_wood: master_wood,
            pickAFootprint_price: pickAFootprint_val
        },

        dataType: "json",

        success: function(event) {

            $("#fifth-price-panel-id").html(event.post_mount_price);

            $("#mount-hidden-panel-price-new-id").val(event.post_mount_price);

            var mountT1 = event.post_mount_price;

            $("#pergola-pick-mount-bracket-price-id").html(mountT1.toFixed(2));

            $("#pick-slap-mount-panel-load-id").html(event.choose_bracket);

            $("#pick-slap-mount-panel-name-load-id").val(event.choose_bracket);

            var fourth_price = parseFloat($("#fourth-page-price-hidden-id").val());
            
            $("#pergola-price-id4").html(fourth_price.toFixed(2));

            $("#fifth-page-price-hidden-id").val((fourth_price+event.post_mount_price).toFixed(2));

            $("#fifth-total-price-panel-id").html((fourth_price+event.post_mount_price).toFixed(2));

            

            $.ajax({
                url: "{{ route('satirtha.bracket-mount-img-video') }}",
                type: "GET",
                data: {choose_brackets: event.choose_bracket_post},
                dataType: "json",
                success: function(resp){
                    $("#mount-bracket-video-id").html('<video width="1280" height="720" controls><source src="'+resp.video_link+'" type="video/mp4"></video>');
                    $("#new-mount-bracket-img-Qid").html('<img loading="lazy" src="'+resp.image_link+'" style="margin-bottom: 0; box-shadow: 0 0 3px rgba(0,0,0,0.1); border: 10px solid #fff;" alt="post mount brackets" width="428" height="257" class="aligncenter size-full wp-image-3479">');
                    $("#mount-bracket-type-wish-text-id").html(resp.mount_description);
                }, error: function(resp){

                }
            })

        },
        error: function(event) {

        }

    });



    $("#pick_post_length_hide_data_change_panel").val(0);

}



function load_fifth_page_fx5_show_view()

{

    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    var second_page_store = $("#ladder-overhead-datas-show-id").val();

    var post_length_data = $("#fourth-page-post-length-id").val();

    $.ajax({

        url: "{{ route('satirtha.show-fifth-page-data') }}",

        type: "GET",

        data: {
            master_width: master_width,
            master_height: master_height,
            master_post: master_post,
            second_page_store: second_page_store,
            post_length_data_val: post_length_data
        },

        dataType: "json",

        success: function(event) {

            $("#pick-slap-mount-panel-load-id").html(event);

        },
        error: function(event) {



        }

    })

}





$('.checking-radio-panel-of-slap-class input:radio').change(function() {

    if ($(this).val() == "yes")

    {

        $("#mount_answer_hidden_id").val("yes");

        $(".pick-slap-select-panel-class").css('display', 'flex');

        $("#mount-brackets-datas-show-id").css('display', 'block');

        load_fifth_page_fx5_show_view();

        load_fifth_page_fx5();

    } else if ($(this).val() == "no")

    {
        $("#mount-brackets-datas-show-id").html('<option value="">Choose a mount brackets</option><option value="1">Concrete setup</option><option value="2">Existing slap setup</option>');

        $("#mount-brackets-datas-show-id").css('display', 'none');

        var mountB = "Pick Slap*";
        $("#mount-bracket-pick-slap-name-id").html(mountB);

        $("#mount_answer_hidden_id").val("no");

        $(".pick-slap-select-panel-class").css('display', 'none');

        var fourth_price = parseFloat($("#fourth-page-price-hidden-id").val());

        $("#fifth-page-price-hidden-id").val(fourth_price.toFixed(2));

        $("#fifth-total-price-panel-id").html(fourth_price.toFixed(2));

        $("#fifth-price-panel-id").html('0');

        $("#mount-hidden-panel-price-new-id").val('0');

        $("#pergola-pick-mount-bracket-price-id").html(0);

        $("#pergola-price-id4").html(fourth_price.toFixed(2));

    }

});



function pick_slap_types_fx5()

{

    var pick_slap_var = $("#pick-slap-mount-panel-load-id").val();


        var step1_price = parseFloat($("#fourth-page-price-hidden-id").val());

        var step2_price = parseFloat($("#pick-slap-mount-panel-load-id").val());

        var main_step3_price = step1_price + step2_price;

        $("#fifth-page-price-hidden-id").val(main_step3_price.toFixed(2));

        $("#fifth-total-price-panel-id").html(main_step3_price.toFixed(2));

        $("#fifth-price-panel-id").html(step2_price.toFixed(2));

        $("#mount-hidden-panel-price-new-id").val(step2_price.toFixed(2));

 

}



// page click btn (5th to 6th)

$("#fifth-page-to-next-id").click(function() {

    var check_radio_val = $('.checking-radio-panel-of-slap-class input[type=radio]:checked').val();

    if (check_radio_val == "" || check_radio_val == null || check_radio_val == "undefined")

    {

        current_fs = $(this).parent();

        next_fs = $(this).parent().next();



        //show the next fieldset

        next_fs.show();

        //hide the current fieldset with style

        current_fs.animate({
            opacity: 0
        }, {

            step: function(now) {

                // for making fielset appear animation

                opacity = 1 - now;



                current_fs.css({

                    'display': 'none',

                    'position': 'relative'

                });

                next_fs.css({
                    'opacity': opacity
                });

            },

            duration: 600

        });



    } else if (check_radio_val == "yes" || check_radio_val == "no")

    {

        if (check_radio_val == "yes")

        {

            var mountBracketsTypesChange = $("#mount-brackets-datas-show-id").val(); 
            if(mountBracketsTypesChange == "" || mountBracketsTypesChange == null)
            {
                error_pass_alert_show_msg("Please choose a mount bracket");
            }
            else
            {

                current_fs = $(this).parent();

                next_fs = $(this).parent().next();



                //show the next fieldset

                next_fs.show();

                //hide the current fieldset with style

                current_fs.animate({
                    opacity: 0
                }, {

                    step: function(now) {

                        // for making fielset appear animation

                        opacity = 1 - now;



                        current_fs.css({

                            'display': 'none',

                            'position': 'relative'

                        });

                        next_fs.css({
                            'opacity': opacity
                        });

                    },

                    duration: 600

                });

            }


        } else if (check_radio_val == "no")

        {

            current_fs = $(this).parent();

            next_fs = $(this).parent().next();



            //show the next fieldset

            next_fs.show();

            //hide the current fieldset with style

            current_fs.animate({
                opacity: 0
            }, {

                step: function(now) {

                    // for making fielset appear animation

                    opacity = 1 - now;



                    current_fs.css({

                        'display': 'none',

                        'position': 'relative'

                    });

                    next_fs.css({
                        'opacity': opacity
                    });

                },

                duration: 600

            });

        }







    }



    var my_fifth_panel_price_val = $("#sixth-panel-price-hidden-id").val();

    
        load_sixth_panel_fx6();


})

// end of fifth page

</script>
@if(Session::has('main_unique_session_key'))
    <script>
        var session_data_checking_for_canopy = "active";
    </script>
@else
    <script>
        var session_data_checking_for_canopy = "inactive";
    </script>
@endif
<script>


// start sixth page

function load_sixth_panel_fx6()

{

    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    var second_page_store = $("#ladder-overhead-datas-show-id").val();

    var post_length_data = $("#fourth-page-post-length-id").val();

    var master_wood = $("#master-home-wood-id").val();

    var pickAFootprint_val = $("#first-page-price-hidden-id").val();
    

    $.ajax({

        url: "{{ route('satirtha.show-sixth-page-data') }}",

        type: "GET",

        data: {
            master_width: master_width,
            master_height: master_height,
            master_post: master_post,
            second_page_store: second_page_store,
            post_length_data_val: post_length_data,
            master_wood: master_wood,
            pickAFootprint_price: pickAFootprint_val
        },

        dataType: "json",

        success: function(event) {

            if(session_data_checking_for_canopy == "inactive")
            {

            $(".canopy-note-select-panel-class").html(event.canopy_html);

            $("#sixth-total-price-panel-id").html(parseFloat($("#fifth-page-price-hidden-id").val()).toFixed(2));

            $("#sixth-panel-price-hidden-id").val(parseFloat($("#fifth-page-price-hidden-id").val()).toFixed(2));

            var p_fifth_page_id = parseFloat($("#fifth-page-price-hidden-id").val());

            var canopy_c_price = parseFloat(event.canopy_price).toFixed(2);
            
            $("#pergola-canopy-price-id").html(0);

            $("#pergola-price-id5").html(p_fifth_page_id.toFixed(2));
            
            }

            else if(session_data_checking_for_canopy == "active")
            {
                if($("#pick-mount-bracket-hidden-session-id").val() == 0)
                {
                    $(".pick-post-canopy-class-yes-type").prop('checked',false);

                    $(".pick-post-canopy-class-no-type").prop('checked',true);

                    $(".canopy-note-select-panel-class").html(event.canopy_html);

                    $("#sixth-total-price-panel-id").html(parseFloat($("#fifth-page-price-hidden-id").val()).toFixed(2));

                    $("#sixth-panel-price-hidden-id").val(parseFloat($("#fifth-page-price-hidden-id").val()).toFixed(2));

                    var p_fifth_page_id = parseFloat($("#fifth-page-price-hidden-id").val());

                    var canopy_c_price = parseFloat(event.canopy_price).toFixed(2);
                    
                    $("#pergola-canopy-price-id").html(0);

                    $("#pergola-price-id5").html(p_fifth_page_id.toFixed(2));
                }
            }


        },
        error: function(event) {



        }

    })

}



$('.checking-radio-panel-of-canopy-class input:radio').change(function() {

    if ($(this).val() == "yes")

    {
        $(".pick-post-canopy-class-yes-type").prop('checked',true);
        $(".pick-post-canopy-class-no-type").prop('checked',false);

        $("#canopy_answer_hidden_id").val("yes");

        $(".canopy-note-select-panel-class").css('display', 'block');

        var first_price = parseFloat($("#fifth-page-price-hidden-id").val());

        var second_price = parseFloat($("#sixth-pregenerated-price-hidden-val-id").val());

        var total_price = first_price + second_price;

        $("#sixth-total-price-panel-id").html(total_price.toFixed(2));

        $("#sixth-panel-price-hidden-id").val(total_price.toFixed(2));

        $("#pergola-canopy-price-id").html(second_price);



    } else if ($(this).val() == "no")

    {
        $(".pick-post-canopy-class-no-type").prop('checked',true);
        $(".pick-post-canopy-class-yes-type").prop('checked',false);

        $("#canopy_answer_hidden_id").val("no");

        $(".canopy-note-select-panel-class").css('display', 'none');

        $("#sixth-total-price-panel-id").html($("#fifth-page-price-hidden-id").val());

        $("#sixth-panel-price-hidden-id").val($("#fifth-page-price-hidden-id").val());

        $("#pergola-canopy-price-id").html(0);

    }

});

</script>
@if(Session::has('main_unique_session_key'))
    <script>
        var session_data_checking_for_louvered_panel = "active";
    </script>
@else
    <script>
        var session_data_checking_for_louvered_panel = "inactive";
    </script>
@endif
<script>

// page click btn (5th to 6th)

$("#sixth-page-to-next-id").click(function() {

    var check_radio_val = $('.checking-radio-panel-of-canopy-clas input[type=radio]:checked').val();





    if (check_radio_val == "" || check_radio_val == null || check_radio_val == "undefined")

    {

        current_fs = $(this).parent();

        next_fs = $(this).parent().next();



        //show the next fieldset

        next_fs.show();

        //hide the current fieldset with style

        current_fs.animate({
            opacity: 0
        }, {

            step: function(now) {

                // for making fielset appear animation

                opacity = 1 - now;



                current_fs.css({

                    'display': 'none',

                    'position': 'relative'

                });

                next_fs.css({
                    'opacity': opacity
                });

            },

            duration: 600

        });



    } else if (check_radio_val == "yes" || check_radio_val == "no")

    {

        if (check_radio_val == "yes")

        {

            var pick_slap_val = $("#pick-slap-mount-panel-load-id").val();

            if (pick_slap_val == "" || pick_slap_val == null)

            {

                error_pass_alert_show_msg("Please choose a slap type");

            } else

            {

                current_fs = $(this).parent();

                next_fs = $(this).parent().next();



                //show the next fieldset

                next_fs.show();

                //hide the current fieldset with style

                current_fs.animate({
                    opacity: 0
                }, {

                    step: function(now) {

                        // for making fielset appear animation

                        opacity = 1 - now;



                        current_fs.css({

                            'display': 'none',

                            'position': 'relative'

                        });

                        next_fs.css({
                            'opacity': opacity
                        });

                    },

                    duration: 600

                });

            }

        } else if (check_radio_val == "no")

        {

            current_fs = $(this).parent();

            next_fs = $(this).parent().next();



            //show the next fieldset

            next_fs.show();

            //hide the current fieldset with style

            current_fs.animate({
                opacity: 0
            }, {

                step: function(now) {

                    // for making fielset appear animation

                    opacity = 1 - now;



                    current_fs.css({

                        'display': 'none',

                        'position': 'relative'

                    });

                    next_fs.css({
                        'opacity': opacity
                    });

                },

                duration: 600

            });

        }







    }



    var seven_hide_price = $("#seventh-panel-price-hidden-id").val();
    if(session_data_checking_for_louvered_panel == 'inactive')
    {
        loading_seventh_page_datas_fx7();
    }
    else if(session_data_checking_for_louvered_panel == 'active')
    {
        if($("#pick-louvered-panel-hidden-session-id").val() == 0)
        {
            $("#lpanel-checkbox-id").css('display','none');
            $("#lpanel_answer_hidden_id").val('no');
            $("#lpanel-hide-radio-btn-panel-price-id").val(0);
            document.getElementById("left-lpanel-id").checked = false;
            document.getElementById("right-lpanel-id").checked = false;
            document.getElementById("front-lpanel-id").checked = false;
            document.getElementById("rear-lpanel-id").checked = false;
            $(".pick-lpanel-no-type-new").prop('checked',true);
            $(".pick-lpanel-yes-type-new").prop('checked',false);
            loading_seventh_page_datas_fx7();
        }
    }


});

// end of sixth page



// start of seventh page

function loading_seventh_page_datas_fx7()

{

    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    var second_page_store = $("#ladder-overhead-datas-show-id").val();

    var post_length_data = $("#fourth-page-post-length-id").val();

    $.ajax({

        url: "{{ route('satirtha.show-seventh-page-data') }}",

        type: "GET",

        data: {
            master_width: master_width,
            master_height: master_height,
            master_post: master_post,
            second_page_store: second_page_store,
            post_length_data_val: post_length_data
        },

        dataType: "json",

        success: function(event) {

            $(".checking-radio-panel-of-lpanel2-class").html(event.lpanel_radio_panel);

            $("#lpanel-wish-price-id").html(event.new_price);

            $("#lpanel-hide-radio-btn-panel-price-id").val(event.new_price);

            $("#seventh-total-price-panel-id").html(parseFloat($("#sixth-panel-price-hidden-id").val()).toFixed(2));

            $("#seventh-panel-price-hidden-id").val(parseFloat($("#sixth-panel-price-hidden-id").val()).toFixed(2));

            var p_louvered_price_val = parseFloat($("#sixth-panel-price-hidden-id").val());

            $("#pergola-price-id6").html(p_louvered_price_val);

            var lpanel_price = parseFloat(event.new_price).toFixed(2)

            $("#pergola-louvered-panel-price-id").html(0);

        },
        error: function(event) {

        }

    })

}



$('.checking-radio-panel-of-lpanel1-class input:radio').change(function() {

    if ($(this).val() == "yes")

    {
        $("#lpanel-checkbox-id").css('display','block');

        $(".pick-lpanel-yes-type-new").prop('checked',true);
        $(".pick-lpanel-no-type-new").prop('checked',false);

        var master_width = $("#master-home-width-id").val();

        var master_height = $("#master-home-height-id").val();

        var master_post = $("#master-home-post-id").val();

        var second_page_store = $("#ladder-overhead-datas-show-id").val();

        var post_length_data = $("#fourth-page-post-length-id").val();

        $("#lpanel_answer_hidden_id").val("yes");

        $.ajax({

            url: "{{ route('satirtha.show-seventh-page-data') }}",

            type: "GET",

            data: {
                master_width: master_width,
                master_height: master_height,
                master_post: master_post,
                second_page_store: second_page_store,
                post_length_data_val: post_length_data
            },

            dataType: "json",

            success: function(event) {

                $(".checking-radio-panel-of-lpanel2-class").html(event.lpanel_radio_panel);

                $("#lpanel-wish-price-id").html(event.new_price);

                // $("#lpanel-hide-radio-btn-panel-price-id").val(event.new_price);

                $("#lpanel-hide-radio-btn-panel-price-id").val(0);

                // var second_price = parseFloat(event.new_price);
                var second_price = 0;

                var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());

                var total_price = first_price + second_price;

                $("#seventh-total-price-panel-id").html(total_price.toFixed(2));

                $("#seventh-panel-price-hidden-id").val(total_price.toFixed(2));

                // $("#pergola-louvered-panel-price-id").html($("#lpanel-hide-radio-btn-panel-price-id").val());

                $("#pergola-louvered-panel-price-id").html(0);
                

            },
            error: function(event) {

            }

        })

        $(".checking-radio-panel-of-lpanel2-class").css('display', 'block');
        load_louvered_panel_single_fx();

    } else if ($(this).val() == "no")

    {
        $("#lpanel-checkbox-id").css('display','none');

        $(".pick-lpanel-no-type-new").prop('checked',true);
        $(".pick-lpanel-yes-type-new").prop('checked',false);

        $("#lpanel_answer_hidden_id").val("no");

        $("#lpanel-wish-price-id").html('0');

        $("#pergola-louvered-panel-price-id").html(0);

        $("#lpanel-hide-radio-btn-panel-price-id").val('0');

        $(".checking-radio-panel-of-lpanel2-class").css('display', 'none');

        $("#seventh-total-price-panel-id").html($("#sixth-panel-price-hidden-id").val());

        $("#seventh-panel-price-hidden-id").val($("#sixth-panel-price-hidden-id").val());

        $("#side1-lpanel-id").html(" Side1");
        $("#left-lpanel-id").attr('onclick','checkbox_lpanel_fx()');
        document.getElementById("left-lpanel-id").checked = false;
        $("#side2-lpanel-id").html(" Side2");
        $("#right-lpanel-id").attr('onclick','checkbox_lpanel_fx()');
        document.getElementById("right-lpanel-id").checked = false;
        $("#side3-lpanel-id").html(" Side3");
        $("#front-lpanel-id").attr('onclick','checkbox_lpanel_fx()');
        document.getElementById("front-lpanel-id").checked = false;
        $("#side4-lpanel-id").html(" Side4");
        $("#rear-lpanel-id").attr('onclick','checkbox_lpanel_fx()');
        document.getElementById("rear-lpanel-id").checked = false;

    }

});

function load_louvered_panel_single_fx()
{
    var wood_type = $("#master-home-wood-id").val();
    var width_type = $("#master-home-width-id").val();
    var height_type = $("#master-home-height-id").val();
    var post_length = $("#fourth-page-post-length-id").val();

    $.ajax({
        url: "{{ route('satirtha.louvered-panel-yes-shown') }}",
        type: "GET",
        data: {wood_type: wood_type, width_type: width_type, height_type: height_type, post_length: post_length },
        dataType: "json",
        success: function(event){
            $("#side1-lpanel-id").html(" Side1 ("+event.side13+" Price: "+event.side13_price+") ");
            $("#left-lpanel-id").attr('onclick','checkbox_lpanel_fx("side1",'+event.side13_price+')');
            $("#side2-lpanel-id").html(" Side2 ("+event.side24+" Price: "+event.side24_price+") ");
            $("#right-lpanel-id").attr('onclick','checkbox_lpanel_fx("side2",'+event.side24_price+')');
            $("#side3-lpanel-id").html(" Side3 ("+event.side13+" Price: "+event.side13_price+") ");
            $("#front-lpanel-id").attr('onclick','checkbox_lpanel_fx("side3",'+event.side13_price+')');
            $("#side4-lpanel-id").html(" Side4 ("+event.side24+" Price: "+event.side24_price+") ");
            $("#rear-lpanel-id").attr('onclick','checkbox_lpanel_fx("side4",'+event.side24_price+')');
            $("#lpanel-checkbox-side1-count-id").val(0);
            $("#lpanel-checkbox-side2-count-id").val(0);
            $("#lpanel-checkbox-side3-count-id").val(0);
            $("#lpanel-checkbox-side4-count-id").val(0);
        }, error: function(event){

        }
    })
}

function checkbox_lpanel_fx(side_part, side_price)
{
    if(side_part == "side1")
    {
        if($("#lpanel-checkbox-side1-count-id").val() == 0)
        {
            var change_status = 1;
            $("#lpanel-checkbox-side1-count-id").val(change_status);
            var lHiddenPrice = parseFloat($("#lpanel-hide-radio-btn-panel-price-id").val());
            var sidePrice = parseFloat(side_price);
            var change_price = lHiddenPrice + sidePrice;
            $("#lpanel-hide-radio-btn-panel-price-id").val(change_price);
            $("#pergola-louvered-panel-price-id").html(change_price);

            
            var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());
            var total_price = first_price + change_price;
            $("#seventh-total-price-panel-id").html(total_price.toFixed(2));
            $("#seventh-panel-price-hidden-id").val(total_price.toFixed(2));
        }

        else if($("#lpanel-checkbox-side1-count-id").val() == 1)
        {
            var change_status = 0;
            $("#lpanel-checkbox-side1-count-id").val(change_status);
            var lHiddenPrice = parseFloat($("#lpanel-hide-radio-btn-panel-price-id").val());
            var sidePrice = parseFloat(side_price);
            var change_price = lHiddenPrice - sidePrice;
            $("#lpanel-hide-radio-btn-panel-price-id").val(change_price);
            $("#pergola-louvered-panel-price-id").html(change_price);

            var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());
            var total_price = first_price + change_price;
            $("#seventh-total-price-panel-id").html(total_price.toFixed(2));
            $("#seventh-panel-price-hidden-id").val(total_price.toFixed(2));
        }
        
        $("#pergola-louvered-panel-price-id").html();
    }

    if(side_part == "side2")
    {
        if($("#lpanel-checkbox-side2-count-id").val() == 0)
        {
            var change_status = 1;
            $("#lpanel-checkbox-side2-count-id").val(change_status);
            var lHiddenPrice = parseFloat($("#lpanel-hide-radio-btn-panel-price-id").val());
            var sidePrice = parseFloat(side_price);
            var change_price = lHiddenPrice + sidePrice;
            $("#lpanel-hide-radio-btn-panel-price-id").val(change_price);
            $("#pergola-louvered-panel-price-id").html(change_price);

            var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());
            var total_price = first_price + change_price;
            $("#seventh-total-price-panel-id").html(total_price.toFixed(2));
            $("#seventh-panel-price-hidden-id").val(total_price.toFixed(2));
        }

        else if($("#lpanel-checkbox-side2-count-id").val() == 1)
        {
            var change_status = 0;
            $("#lpanel-checkbox-side2-count-id").val(change_status);
            var lHiddenPrice = parseFloat($("#lpanel-hide-radio-btn-panel-price-id").val());
            var sidePrice = parseFloat(side_price);
            var change_price = lHiddenPrice - sidePrice;
            $("#lpanel-hide-radio-btn-panel-price-id").val(change_price);
            $("#pergola-louvered-panel-price-id").html(change_price);

            var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());
            var total_price = first_price + change_price;
            $("#seventh-total-price-panel-id").html(total_price.toFixed(2));
            $("#seventh-panel-price-hidden-id").val(total_price.toFixed(2));
        }
        
    }

    if(side_part == "side3")
    {
        if($("#lpanel-checkbox-side3-count-id").val() == 0)
        {
            var change_status = 1;
            $("#lpanel-checkbox-side3-count-id").val(change_status);
            var lHiddenPrice = parseFloat($("#lpanel-hide-radio-btn-panel-price-id").val());
            var sidePrice = parseFloat(side_price);
            var change_price = lHiddenPrice + sidePrice;
            $("#lpanel-hide-radio-btn-panel-price-id").val(change_price);
            $("#pergola-louvered-panel-price-id").html(change_price);

            var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());
            var total_price = first_price + change_price;
            $("#seventh-total-price-panel-id").html(total_price.toFixed(2));
            $("#seventh-panel-price-hidden-id").val(total_price.toFixed(2));
        }
        else if($("#lpanel-checkbox-side3-count-id").val() == 1)
        {
            var change_status = 0;
            $("#lpanel-checkbox-side3-count-id").val(change_status);
            var lHiddenPrice = parseFloat($("#lpanel-hide-radio-btn-panel-price-id").val());
            var sidePrice = parseFloat(side_price);
            var change_price = lHiddenPrice - sidePrice;
            $("#lpanel-hide-radio-btn-panel-price-id").val(change_price);
            $("#pergola-louvered-panel-price-id").html(change_price);

            var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());
            var total_price = first_price + change_price;
            $("#seventh-total-price-panel-id").html(total_price.toFixed(2));
            $("#seventh-panel-price-hidden-id").val(total_price.toFixed(2));
        }
        
    }

    if(side_part == "side4")
    {
        if($("#lpanel-checkbox-side4-count-id").val() == 0)
        {
            var change_status = 1;
            $("#lpanel-checkbox-side4-count-id").val(change_status);
            var lHiddenPrice = parseFloat($("#lpanel-hide-radio-btn-panel-price-id").val());
            var sidePrice = parseFloat(side_price);
            var change_price = lHiddenPrice + sidePrice;
            $("#lpanel-hide-radio-btn-panel-price-id").val(change_price);
            $("#pergola-louvered-panel-price-id").html(change_price);

            var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());
            var total_price = first_price + change_price;
            $("#seventh-total-price-panel-id").html(total_price.toFixed(2));
            $("#seventh-panel-price-hidden-id").val(total_price.toFixed(2));
        }

        else if($("#lpanel-checkbox-side4-count-id").val() == 1)
        {
            var change_status = 0;
            $("#lpanel-checkbox-side4-count-id").val(change_status);
            var lHiddenPrice = parseFloat($("#lpanel-hide-radio-btn-panel-price-id").val());
            var sidePrice = parseFloat(side_price);
            var change_price = lHiddenPrice - sidePrice;
            $("#lpanel-hide-radio-btn-panel-price-id").val(change_price);
            $("#pergola-louvered-panel-price-id").html(change_price);

            var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());
            var total_price = first_price + change_price;
            $("#seventh-total-price-panel-id").html(total_price.toFixed(2));
            $("#seventh-panel-price-hidden-id").val(total_price.toFixed(2));
        }
        
    }
}


function my_seveth_click(main_price)

{

    var second_price = parseFloat(main_price);

    var first_price = parseFloat($("#sixth-panel-price-hidden-id").val());

    var total_price = first_price + second_price;

    $("#lpanel-wish-price-id").html(parseFloat(main_price).toFixed(2));

    $("#lpanel-hide-radio-btn-panel-price-id").html(parseFloat(main_price).toFixed(2));

    $("#seventh-total-price-panel-id").html(total_price.toFixed(2));

    $("#seventh-panel-price-hidden-id").val(total_price.toFixed(2));

}





// click next btn (7th to 8th page)

$("#seventh-page-to-next-id").click(function() {

    var lpanel_answer_hidden_id = $("#lpanel_answer_hidden_id").val();
    var lpanel_hidden_price_id = $("#lpanel-hide-radio-btn-panel-price-id").val();
 
    if(lpanel_answer_hidden_id == "yes" && lpanel_hidden_price_id == 0)
    {
        error_pass_alert_show_msg("Please choose atleast one louvered panel side");
    }
    else
    {
        current_fs = $(this).parent();

        next_fs = $(this).parent().next();



        //show the next fieldset

        next_fs.show();

        //hide the current fieldset with style

        current_fs.animate({
            opacity: 0
        }, {

            step: function(now) {

                // for making fielset appear animation

                opacity = 1 - now;



                current_fs.css({

                    'display': 'none',

                    'position': 'relative'

                });

                next_fs.css({
                    'opacity': opacity
                });

            },

            duration: 600

        });



        final_product_img_fx();
    }

})



// end of seventh page



// final product eighth page

function final_product_img_fx()

{

    var master_width = $("#master-home-width-id").val();

    var master_height = $("#master-home-height-id").val();

    var master_post = $("#master-home-post-id").val();

    var overhead_type_val = $("#ladder-overhead-datas-show-id").val();

    var post_length_val = $("#fourth-page-post-length-id").val();

    var slap_panel_val_type = $("#mount_answer_hidden_id").val();

    

    var main_wood_type = $("#master-home-wood-id").val();

    // mount bracket
    
        var slap_new_details = $("#pick-slap-mount-panel-name-load-id").val();
        var slap_bracket_status_val = $("#mount_answer_hidden_id").val();
        if(slap_new_details == "" || slap_new_details == null || slap_bracket_status_val == "no")
        {
            var slap_new_details = "no";
        }
        var mount_new_price =  $("#mount-hidden-panel-price-new-id").val();
   


        var canopy_new_details = $("#canopy_answer_hidden_id").val();
        var canopy_val_details = "yes";
        if(canopy_new_details == null || canopy_new_details == "" || canopy_new_details == "no")
        {
            var canopy_val_details = "no";
        }

        

    
        var louvered_panel_details = $("#lpanel_answer_hidden_id").val();
        var lpanel_val_details = "yes";
        if(louvered_panel_details == null || louvered_panel_details == "" || louvered_panel_details == "no")
        {
            var lpanel_val_details = "no";
        }

   

    $("#final-product-total-price-id").html($("#seventh-panel-price-hidden-id").val());



    $.ajax({

        url: "{{ route('satirtha.show-final-page-data') }}",

        type: "GET",

        data: {
            master_width: master_width,
            master_height: master_height,
            master_post: master_post,
            overhead_type_val: overhead_type_val,
            post_length_val: post_length_val
        },

        dataType: "json",

        success: function(event) {

            $("#final-product-width").html(event.width_data);

            $("#final-product-length").html(event.height_data);

            $("#final-product-post-length").html(event.length_data);

            $("#final-product-overhead").html(event.overhead_data);

            $(".final-product-img-final-class").html(event.final_prod_img);

            $(".last-footprint-img-class").html(event.final_footprint_img);

            $("#final-product-mount").html(slap_new_details);

            $("#final-product-canopy").html(canopy_val_details);

            // $("#final-product-lpanel").html($("#lpanel_answer_hidden_id").val());

            $("#final-product-lpanel").html(lpanel_val_details);


            $.ajax({

                url: "{{ route('satirtha.final-wood-product-type') }}",

                type: "GET",

                data: {
                    wood_type_id: main_wood_type
                },

                dataType: "json",

                success: function(event_res) {

                    $("#final-product-wood-type").html(event_res);

                },
                error: function(event_res) {



                }

            });





            insert_before_checkout_product();

        },
        error: function(event) {



        }

    })



}



$("#last-getting-next-id").click(function() {



    current_fs = $(this).parent();

    next_fs = $(this).parent().next();



    //show the next fieldset

    next_fs.show();

    //hide the current fieldset with style

    current_fs.animate({
        opacity: 0
    }, {

        step: function(now) {

            // for making fielset appear animation

            opacity = 1 - now;



            current_fs.css({

                'display': 'none',

                'position': 'relative'

            });

            next_fs.css({
                'opacity': opacity
            });

        },

        duration: 600

    });



})

// end if final product eigth page



// data insert before checking out

function insert_before_checkout_product()

{
    var master_width = $("#master-home-width-id").val();
    var master_height = $("#master-home-height-id").val();
    var master_post = $("#master-home-post-id").val();
    var overhead_type_val = $("#ladder-overhead-datas-show-id").val();
    var post_length_val = $("#fourth-page-post-length-id").val();
    var slap_panel_val_type = $("#mount_answer_hidden_id").val();
    var slap_new_details = $("#pick-slap-mount-panel-name-load-id").val();
    var mount_data = $("#pick-slap-mount-panel-load-id").val();


        // var canopy_val_type = $("#canopy_answer_hidden_id").val();
        // var canopy_val_details = "yes";


        // var lpanel_val_type = $("#lpanel_answer_hidden_id").val();
        // var lpanel_val_details = "yes";
        // var lpanel_main_data = $("#lpanel-hide-radio-btn-panel-price-id").val();
    // mount bracket
    
        var slap_new_details = $("#pick-slap-mount-panel-name-load-id").val();
        var slap_bracket_status_val = $("#mount_answer_hidden_id").val();
        var lpanel_val_details = "yes";
        // if(slap_new_details == "" || slap_new_details == null || slap_bracket_status_val == "no")
        // {
        //     var slap_new_details = "no";
        // }
        var mount_new_price =  $("#mount-hidden-panel-price-new-id").val();
   


        var canopy_new_details = $("#canopy_answer_hidden_id").val();
        var canopy_val_details = "yes";
        var canopy_price = $("#sixth-pregenerated-price-hidden-val-id").val();
        if(canopy_new_details == null || canopy_new_details == "" || canopy_new_details == "no")
        {
            var canopy_val_details = "no";
            var canopy_price = 0;
        }

        

    
        var louvered_panel_details = $("#lpanel_answer_hidden_id").val();
        var lpanel_main_data = $("#lpanel-hide-radio-btn-panel-price-id").val();
        var lpanel_val_details = "yes";
        var lpanel_side1 = $("#lpanel-checkbox-side1-count-id").val();
        var lpanel_side2 = $("#lpanel-checkbox-side2-count-id").val();
        var lpanel_side3 = $("#lpanel-checkbox-side3-count-id").val();
        var lpanel_side4 = $("#lpanel-checkbox-side4-count-id").val();
        if(louvered_panel_details == null || louvered_panel_details == "" || louvered_panel_details == "no")
        {
            var lpanel_side1 = $("#lpanel-checkbox-side1-count-id").val();
            var lpanel_side2 = $("#lpanel-checkbox-side2-count-id").val();
            var lpanel_side3 = $("#lpanel-checkbox-side3-count-id").val();
            var lpanel_side4 = $("#lpanel-checkbox-side4-count-id").val();
            var lpanel_main_data = 0;
            var lpanel_val_details = "no";
        }


    var total_price = $("#seventh-panel-price-hidden-id").val();
    var mount_panel_hide_price = $("#mount-hidden-panel-price-new-id").val();
    var main_wood_type = $("#master-home-wood-id").val();

    if($("#mount-brackets-datas-show-id").val() == "" || $("#mount-brackets-datas-show-id").val() == null)
    {
        var mount_brackets_type = 0;
    }
    else
    {
        var mount_brackets_type = $("#mount-brackets-datas-show-id").val();
    }

    $.ajax({

        url: "{{ route('satirtha.BeforeCheckoutFinalProduct') }}",

        type: "GET",

        data: {
            master_width: master_width,
            master_height: master_height,
            master_post: master_post,
            overhead_type_val: overhead_type_val,
            post_length_val: post_length_val,
            slap_mount_type: slap_new_details,
            mount_panel_hide_price: mount_panel_hide_price,
            canopy_type_data: canopy_val_details,
            canopy_price: canopy_price,
            lpanel_val_type: lpanel_val_details,
            lpanel_main_data: lpanel_main_data,
            total_price: total_price,
            main_wood_type: main_wood_type,
            lpanel_side1: lpanel_side1,
            lpanel_side2: lpanel_side2,
            lpanel_side3: lpanel_side3,
            lpanel_side4: lpanel_side4,
            mount_brackets_type: mount_brackets_type,
        },

        dataType: "json",

        success: function(event) {

            console.log(event);

        },
        error: function(event) {



        }

    })

}

function mount_brackets_type_change_fx()
{
    var mount_brackets = $("#mount-brackets-datas-show-id").val();
    if(mount_brackets == 1)
    {
        var mountB = "Concrete setup*";
        $("#mount-bracket-pick-slap-name-id").html(mountB);
    }
    else if(mount_brackets == 2)
    {
        var mountB = "Existing slap setup*";
        $("#mount-bracket-pick-slap-name-id").html(mountB);
    }
    else
    {
        var mountB = "Pick Slap*";
        $("#mount-bracket-pick-slap-name-id").html(mountB);
    }
}
</script>

@endsection