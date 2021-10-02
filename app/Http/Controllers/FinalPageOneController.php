<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\FinalPageOneMailable;
use App\Mail\FinalPageTwoMailable;
use Illuminate\Support\Facades\Mail;


use App\Model\Admin\Video3D\Video3DModel;
use App\Model\Admin\MasterPostLength\MasterPostLengthModel;
use App\Model\Admin\PillerPost\PillerPostModel;
use App\Model\Admin\PickCanopy\PickCanopyModel;
use App\Model\Admin\MasterWidth\MasterWidthModel;
use App\Model\Admin\FinalProduct\FinalProductModel;
use App\Model\Admin\MasterHeight\MasterHeightModel;
use App\Model\Front\BeforeCheckoutFinalProductModel;
use App\Model\Admin\PickPostLength\PickPostLengthModel;
use App\Model\Admin\PickUpFootPrint\PickUpFootPrintModel;
use App\Model\Admin\PickLouveredPanel\PickLouveredPanelModel;
use App\Model\Admin\PickOverheadShades\PickOverheadShadesModel;
use App\Model\Admin\PickPostMountBracket\PickPostMountBracketModel;
use App\Model\Admin\MasterWood\MasterWoodModel;
use App\Model\Admin\MasterOverheadModel;


class FinalPageOneController extends Controller
{
    public function mailsending(Request $request)
    {
        if($request->session()->has('main_unique_session_key'))
            {
                $get_session_data = $request->session()->get('main_unique_session_key');
            }
            $mainQuery = BeforeCheckoutFinalProductModel::where('unique_session_id',$get_session_data)->get();
            foreach($mainQuery as $mQuery)
            {
                // wood query
                $getWoodQuery = MasterWoodModel::where('id',$mQuery->final_wood)->get();
                foreach($getWoodQuery as $getWQuery)
                {
                    $data['master_wood_length'] = $getWQuery->wood_name;
                }
                // width query
                $getWidthQuery = MasterWidthModel::where('id',$mQuery->final_width)->get();
                foreach($getWidthQuery as $getW)
                {
                    $data['master_width_length'] = $getW->master_width_length;
                }
    
                // height query
                $getHeightQuery = MasterHeightModel::where('id',$mQuery->final_length)->get();
                foreach($getHeightQuery as $getH)
                {
                    $data['master_height_length'] = $getH->master_height_length;
                }
    
                // overhead shades query
		$getOverheadShadesQuery = MasterOverheadModel::where('id',$mQuery->final_overhead)->get();
		foreach($getOverheadShadesQuery as $getOverHead)
                {
                   $data['overhead_shades'] = $getOverHead->overhead_shades_val;
                }


                //$getOverheadShadesQuery = PickOverheadShadesModel::where('id',$mQuery->final_overhead)->get();
                //foreach($getOverheadShadesQuery as $getOverHead)
                // {
                    // $data['overhead_shades'] = $getOverHead->img_standard_name;
                // }
    
                // piller post query
                $PillerPostModelQuery = PickPostLengthModel::where('id',$mQuery->final_post_length)->get();
                foreach($PillerPostModelQuery as $getP)
                {
                    $pillerActualLengthQuery = MasterPostLengthModel::where('id',$getP->posts_length)->get();
                    foreach($pillerActualLengthQuery as $pALQuery)
                    {
                        $data['piller_length'] = $pALQuery->master_post_length;
                    }
                    
                }
    		
		if($mQuery->final_post_mount == 0)
		{
                	$data['mount_count'] = "No";
		}
		else
		{
			$data['mount_count'] = ucwords($mQuery->final_post_mount_type);
		}
                $data['final_canopy_type'] = ucwords($mQuery->final_canopy_type);
                $data['final_lpanel_type'] = ucwords($mQuery->final_lpanel_type);
                $data['final_price'] = ucwords($mQuery->final_price);
                
                $pickMainIdQuery = PickPostLengthModel::where(['posts_length' => $mQuery->final_post_length, 'master_width' => $mQuery->final_width, 'master_height' => $mQuery->final_length, 'master_post' => $mQuery->final_no_posts, 'master_overhead_shades' => $mQuery->final_overhead, 'wood_type_id' => $mQuery->final_wood])->get();
                foreach($pickMainIdQuery as $pCMIQuery)
        		{
        		    $pickPostId = $pCMIQuery->id;
        		}
        		
    		    $fileImgQuery = FinalProductModel::where(['pick_footprint' => $pickPostId])->get();
    		    foreach($fileImgQuery as $fIQuery)
    		    {
    			    $data['new_final_product_img'] = $fIQuery->final_product_img;
    		        $data['new_final_footprint_img'] = $fIQuery->final_footprint_img;
    		    }
    
    
                
            }
            $data['new_username'] = $_GET['uname'];
            $data['new_useremail'] = $_GET['uemail'];
            $data['new_usercomment'] = $_GET['ucomment'];

            if(isset($_GET['info']) && $_GET['info'] != "")
            {
                $data['cc_emails'] = $_GET['info'];
                $cc_info = [];
                foreach($_GET['info'] as $info_cc_emails)
                {
                    $cc_info[] = "'".$info_cc_emails."'";
                }

                $cc_implode_info = implode(",",$cc_info);

                Mail::to($_GET['uemail'])->cc($_GET['info'])->send(new FinalPageOneMailable($data));
            }
            else
            {
                Mail::to($_GET['uemail'])->send(new FinalPageOneMailable($data));
            }
        
        echo json_encode("success");
    }


	public function mailsendingFootprint(Request $request)
	{
		if($request->session()->has('main_unique_session_key'))
            {
                $get_session_data = $request->session()->get('main_unique_session_key');
            }
            $mainQuery = BeforeCheckoutFinalProductModel::where('unique_session_id',$get_session_data)->get();
            foreach($mainQuery as $mQuery)
            {
                // wood query
                $getWoodQuery = MasterWoodModel::where('id',$mQuery->final_wood)->get();
                foreach($getWoodQuery as $getWQuery)
                {
                    $data['master_wood_length'] = $getWQuery->wood_name;
                }
                // width query
                $getWidthQuery = MasterWidthModel::where('id',$mQuery->final_width)->get();
                foreach($getWidthQuery as $getW)
                {
                    $data['master_width_length'] = $getW->master_width_length;
                }
    
                // height query
                $getHeightQuery = MasterHeightModel::where('id',$mQuery->final_length)->get();
                foreach($getHeightQuery as $getH)
                {
                    $data['master_height_length'] = $getH->master_height_length;
                }
    
                // overhead shades query
                $getOverheadShadesQuery = PickOverheadShadesModel::where('id',$mQuery->final_overhead)->get();
                foreach($getOverheadShadesQuery as $getOverHead)
                {
                    $data['overhead_shades'] = $getOverHead->img_standard_name;
                }
    
                // piller post query
                $PillerPostModelQuery = PickPostLengthModel::where('id',$mQuery->final_post_length)->get();
                foreach($PillerPostModelQuery as $getP)
                {
                    $pillerActualLengthQuery = MasterPostLengthModel::where('id',$getP->posts_length)->get();
                    foreach($pillerActualLengthQuery as $pALQuery)
                    {
                        $data['piller_length'] = $pALQuery->master_post_length;
                    }
                    
                }
    
                $data['mount_count'] = ucwords($mQuery->final_post_mount_type);
                $data['final_canopy_type'] = ucwords($mQuery->final_canopy_type);
                $data['final_lpanel_type'] = ucwords($mQuery->final_lpanel_type);
                $data['final_price'] = ucwords($mQuery->final_price);
                
                $pickMainIdQuery = PickPostLengthModel::where(['posts_length' => $mQuery->final_post_length, 'master_width' => $mQuery->final_width, 'master_height' => $mQuery->final_length, 'master_post' => $mQuery->final_no_posts, 'master_overhead_shades' => $mQuery->final_overhead, 'wood_type_id' => $mQuery->final_wood])->get();
                foreach($pickMainIdQuery as $pCMIQuery)
        		{
        		    $pickPostId = $pCMIQuery->id;
        		}
        		
    		    $fileImgQuery = FinalProductModel::where(['pick_footprint' => $pickPostId])->get();
    		    foreach($fileImgQuery as $fIQuery)
    		    {
    			    $data['new_final_product_img'] = $fIQuery->final_product_img;
    		        $data['new_final_footprint_img'] = $fIQuery->final_footprint_img;
    		    }
    
    
                
            }
            $data['new_username'] = $_GET['uname'];
            $data['new_useremail'] = $_GET['uemail'];
            $data['new_usercomment'] = $_GET['ucomment'];

            if(isset($_GET['info']) && $_GET['info'] != "")
            {
                $data['cc_emails'] = $_GET['info'];
                $cc_info = [];
                foreach($_GET['info'] as $info_cc_emails)
                {
                    $cc_info[] = "'".$info_cc_emails."'";
                }

                $cc_implode_info = implode(",",$cc_info);

                Mail::to($_GET['uemail'])->cc($_GET['info'])->send(new FinalPageTwoMailable($data));
            }
            else
            {
                Mail::to($_GET['uemail'])->send(new FinalPageTwoMailable($data));
            }
            
        
        echo json_encode('success');

	}
}
