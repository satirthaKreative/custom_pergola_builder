<?php

namespace App\Http\Controllers\Admin\Dashboard\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Video3D\Video3DModel;
use App\Model\Admin\PickCanopy\PickCanopyModel;
use App\Model\Admin\PillerPost\PillerPostModel;
use App\Model\Admin\MasterWidth\MasterWidthModel;
use App\Model\Admin\MasterHeight\MasterHeightModel;
use App\Model\Admin\PickPostLength\PickPostLengthModel;
use App\Model\Admin\PickUpFootPrint\PickUpFootPrintModel;
use App\Model\Admin\PickLouveredPanel\PickLouveredPanelModel;
use App\Model\Admin\PickOverheadShades\PickOverheadShadesModel;
use App\Model\Admin\PickPostMountBracket\PickPostMountBracketModel;
use App\Model\Front\BeforeCheckoutFinalProductModel;
use App\Model\Admin\FinalProduct\FinalProductModel;
use App\Model\Front\Billing_Model;
use App\Model\Front\Shipping_Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\BillingMail;
use App\Model\Admin\CombinationModel\CombinationModel;
use App\Model\Admin\MasterPostLength\MasterPostLengthModel;
use App\Model\Admin\MasterOverheadModel;
use App\Model\Admin\PaymentModel;
use App\Model\Admin\MasterWood\MasterWoodModel;

class PaymentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showpage(Request $request)
    {
        return view('backend.pages.payment-order-details.pay-order-details');
    }

    public function showActionPage(Request $request)
    {
        $mainQuery = PaymentModel::get();
        if(count($mainQuery) > 0){
            $html['order_details'] = "";
            $i = 0;
            foreach($mainQuery as $mQuery)
            {

                $billingQuery = Billing_Model::where('final_checkout_session_id',$mQuery->user_id)->get();
                foreach($billingQuery as $billQuery)
                {
                    $user_name = $billQuery->f_name." ".$billQuery->l_name; 
                    $checkout_id = $billQuery->final_checkout_id;

                    $html['checkout_id'] = $checkout_id;
                    

                }

                $mainCheckoutId = BeforeCheckoutFinalProductModel::where(['id' => $checkout_id])->get();

                foreach($mainCheckoutId as $checkMainQ)
                {
                    $main_price = $checkMainQ->final_price;
                }
                
                $html['order_details'] .= '<tr>
                <td>'.++$i.'</td>
                <td>'.$mQuery->order_details_id.'</td>
                <td>'.$user_name.'</td>
                <td>$ '.$main_price.'</td>
                <td>'.$mQuery->pay_flow_status.'</td>
                <td>
                    <select name="order_details_status" id="order_details_status'.$mQuery->id.'" onchange=order_details_status_fx('.$mQuery->id.')>
                        <option value="processing">processing</option>
                        <option value="shippment">shippment</option>
                        <option value="success">success</option>
                    </select>
                    <a href="javascript:;" onclick=order_full_details_fx('.$mQuery->id.')><span class="text-info"><i class="fa fa-eye"></i></span></a>
                </td>
              </tr>';
            }
        }
        echo json_encode($html);
    }


    public function changeAction(Request $request)
    {
        $billingQuery = PaymentModel::where('id',$_GET['id'])->update(['pay_flow_status' => $_GET['order_details_status']]);

        if($billingQuery)
        {
            $msg = "success";
        }
        else
        {
            $msg = "error";
        }
        echo json_encode($msg);
    }

    public function order_full_details_fx(Request $request)
    {
        $mainOrderFullQuery = PaymentModel::where('id',$_GET['id'])->get();

        if(count($mainOrderFullQuery) > 0)
        {
            foreach ($mainOrderFullQuery as $key_value0) {
                // billing 
                $billingQuery = Billing_Model::where('final_checkout_session_id',$key_value0->user_id)->orderBy('id','DESC')->limit(1)->get();
                foreach($billingQuery as $billQuery)
                {
                    $user_name = $billQuery->f_name." ".$billQuery->l_name; 
                    $checkout_id = $billQuery->final_checkout_id;

                    /// billing address
                    $client_address = $billQuery->company_name." ".$billQuery->street1_address." ".$billQuery->street2_address." ".$billQuery->city." ".$billQuery->country." ".$billQuery->zipcode; 

                    // client Note
                    $client_note = $billQuery->extra_note;

                }
                
                // checkout before
                $mainCheckoutId = BeforeCheckoutFinalProductModel::where(['id' => $checkout_id])->get();
                foreach($mainCheckoutId as $checkMainQ)
                {
                    $main_price = $checkMainQ->final_price;

                    // master width
                    $MasterWidthQuery = MasterWidthModel::where('id',$checkMainQ->final_width)->get();
                    foreach($MasterWidthQuery as $mWidthQuery)
                    {
                        $master_width = $mWidthQuery->master_width_length;
                    }

                    // master height
                    $MasterHeightQuery = MasterHeightModel::where('id',$checkMainQ->final_length)->get();
                    $master_height = "";
                    foreach($MasterHeightQuery as $mHeightQuery)
                    {
                        $master_height = $mHeightQuery->master_height_length;
                    }

                    // master piller 
                    $MasterPillerQuery = PillerPostModel::where('id',$checkMainQ->final_no_posts)->get();
                    foreach($MasterPillerQuery as $mPillerQuery)
                    {
                        $master_piller = $mPillerQuery->no_of_posts;
                    }

                    // master overhead 
                    $MasterOverheadQuery = MasterOverheadModel::where('id',$checkMainQ->final_overhead)->get();
                    foreach($MasterOverheadQuery as $mOverheadQuery)
                    {
                        $master_overhead = $mOverheadQuery->overhead_shades_val;
                    }

                    // master post length 
                    $MasterPostLengthQuery = MasterPostLengthModel::where('id',$checkMainQ->final_post_length)->get();
                    foreach($MasterPostLengthQuery as $mPostLengthQuery)
                    {
                        $master_post_length = $mPostLengthQuery->master_post_length;
                    }

                    // master wood type 
                    $MasterWoodTypeQuery = MasterWoodModel::where('id',$checkMainQ->final_wood)->get();
                    if(count($MasterWoodTypeQuery) > 0)
                    {
                        foreach($MasterWoodTypeQuery as $mWoodTypeQuery)
                        {
                            $master_wood_name = $mWoodTypeQuery->wood_name;
                        }      
                    }
                    else
                    {
                        $master_wood_name = "No wood type";
                    }

                    // canopy 
                    if($checkMainQ->final_post_mount == 0)
                    {
                        $mount_bracket_type_price_share = "No";
                    }
                    else
                    {
                        $mount_bracket_type_price_share = $checkMainQ->final_post_mount_type;
                    }

                    $html = '<tr><td><strong>Master Width :</strong></td><td>'.$master_width.' ft.</td></tr>';
                    $html .= '<tr><td><strong>Master Height :</strong></td><td>'.$master_height.' ft.</td></tr>';
                    $html .= '<tr><td><strong>Master Piller No. :</strong></td><td>'.$master_piller.' posts</td></tr>';
                    $html .= '<tr><td><strong>Master Overhead :</strong></td><td>'.$master_overhead.'</td></tr>';
                    $html .= '<tr><td><strong>Master Post Length :</strong></td><td>'.$master_post_length.' ft.</td></tr>';
                    $html .= '<tr><td><strong>Need Canopy :</strong></td><td>'.ucwords($checkMainQ->final_canopy_type).'</td></tr>';
                    $html .= '<tr><td><strong>Need Post-Mount :</strong></td><td>'.ucwords($mount_bracket_type_price_share).'</td></tr>';
                    $html .= '<tr><td><strong>Need Louvered :</strong></td><td>'.ucwords($checkMainQ->final_lpanel_type).'</td></tr>';
                    $html .= '<tr><td><strong>Wood Type :</strong></td><td>'.ucwords($master_wood_name).'</td></tr>';
                    $html .= '<tr><td><strong>Client Address :</strong></td><td>'.$client_address.'</td></tr>';
                    $html .= '<tr><td><strong>Client Extra Note :</strong></td><td>'.$client_note.'</td></tr>';

                    echo json_encode($html);
                }
            
            
                
           
            }
        }
    }
}
