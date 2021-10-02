<?php

namespace App\Http\Controllers\Front;

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
use App\Model\Admin\CombinationModel\CombinationModel;
use App\Model\Admin\MasterPostLength\MasterPostLengthModel;
use App\Model\Admin\MasterOverheadModel;
use App\Model\Admin\MasterWood\MasterWoodModel;


use App\Model\Admin\PostWish\PostWishLpanelModel;
use App\Model\Admin\lpanelTypeText;

use App\Model\Admin\PostWish\PostWishCanopyModel;
use App\Model\Admin\Setup\MountBracketModel;

use App\Model\Config\ConfigModel;
use App\Model\Config\ConfigOverheadShadesModel;
use App\Model\Config\ConfigPostLengthModel;
use App\Model\Config\ConfigCanopyModel;
use App\Model\Config\ConfigLouveredModel;
use App\Model\Config\ConfigMountModel;

class MainHomeController extends Controller
{
    public function panel_upper_view_fx(Request $request)
    {
        $hQuery = MasterHeightModel::where('id',$_GET['master_height'])->get();
        foreach($hQuery as $hQ)
        {
            $html['master_height'] = $hQ->master_height_length;
        }

        $WQuery = MasterWidthModel::where('id',$_GET['master_width'])->get();
        foreach($WQuery as $wQ)
        {
            $html['master_width'] = $wQ->master_width_length;
        }

        echo json_encode($html);
    }

    //
    public function index(Request $request)
    {
        return view('frontend.layouts.home');
    }

    // 
    public function showWoodPage(Request $request)
    {
        $woodQuery = MasterWoodModel::where(['id' => $_GET['wood_type_id'], 'admin_action' => 'yes'])->get();
        foreach($woodQuery as $wQuery)
        {
            $wood_name = $wQuery->wood_name;
        }

        echo json_encode($wood_name);
    }

    // master wood type
    public function choose_master_wood_fx(Request $request)
    {
        $masterWoodQuery = MasterWoodModel::where(['admin_action' => 'yes'])->get();
        $html = '<option value="">Choose a wood type</option>';
        if(count($masterWoodQuery) > 0)
        {
            

            foreach ($masterWoodQuery as $mW_Data) {
                $checked = "";
                if($request->session()->has('main_unique_session_key'))
                {
                    $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                        foreach($mQuery_check as $mQc)
                    {
                        if($mQc->final_wood == $mW_Data->id)
                        {
                            $checked = "selected";
                        }
                            
                    }
                }
                $html .= '<option value="'.$mW_Data->id.'" '.$checked.'>'.$mW_Data->wood_name.'</option>';
            }
        }

        echo json_encode($html);
    }

    // choose master wood type 
    public function choose_master_wood_data_change_fx(Request $request)
    {
        $masterChangingQuery = MasterWoodModel::where(['id' => $_GET['id_x'], 'admin_action' => 'yes'])->get();
        foreach($masterChangingQuery as $mCQuery)
        {
            if($mCQuery->wood_img == "" || $mCQuery->wood_img == null)
            {
                $html['image_file'] = 'No wood image';
            }
            else
            {
                $html['image_file'] = '<img src="'.str_replace("public","storage/app/public",asset($mCQuery->wood_img)).'" alt="no wood image" />';
            } 

            $html['wood_price'] = $mCQuery->wood_price;
            $html['wood_descriptions'] = $mCQuery->wood_descriptions;
        }
        echo json_encode($html);

    }

    // master width view
    public function choose_master_width_fx(Request $request)
    {
        
        $widthQuery = MasterWidthModel::orderBy('master_width_length','ASC')->get();
        $html = '<option value="">Choose a width</option>';
        if(count($widthQuery) > 0)
        {
            
            
            foreach($widthQuery as $wQuery)
            {

                $checked = "";
                if($request->session()->has('main_unique_session_key'))
                {
                    $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                    foreach($mQuery_check as $mQc)
                    {
                        if($mQc->final_width == $wQuery->id)
                        {
                            $checked = "selected";
                        }
                        
                    }
                }
                $html .= '<option value='.$wQuery->id.' '.$checked.'>'.$wQuery->master_width_length.'</option>';
            }
        }
        echo json_encode($html);
    }

    // main home
    public function show_3d_video_fx3(Request $request)
    {
        $mainQuery = Video3DModel::where(['master_width' => $_GET['master_width'] , 'master_height' => $_GET['master_height'], 'master_posts' => $_GET['master_post'] , 'master_overhead' => $_GET['overhead_val'] ])->get();
        
       
        if(count($mainQuery) > 0)
        {
            $i = 0;
            foreach($mainQuery as $mQuery)
            {
                if($mQuery->master_3D_video != "" || $mQuery->master_3D_video != null)
                {
                    $video_data = $mQuery->master_3D_video;
                }
                else
                {
                    $video_data = "";
                }
                
            }
        }
        else
        {
            $video_data = "";
        } 

        echo json_encode($video_data);
    }

    // master height view
    public function choose_master_height_fx(Request $request)
    {
        $widthQuery = MasterHeightModel::get();
        $html = '<option value="">Choose a length</option>';
        if(count($widthQuery) > 0)
        {
            foreach($widthQuery as $wQuery)
            {
                $checked = "";
                if($request->session()->has('main_unique_session_key'))
                {
                    $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                    foreach($mQuery_check as $mQc)
                    {
                        if($mQc->final_length == $wQuery->id)
                        {
                            $checked = "selected";
                        }
                        
                    }
                }
                $html .= '<option value='.$wQuery->id.' '.$checked.'>'.$wQuery->master_height_length.'</option>';
            }
        }
        echo json_encode($html);
    }

    // master posts view
    public function choose_master_post_fx(Request $request)
    {
        $choose_post_type_query = PickUpFootPrintModel::where(['height_master' => $_GET['master_height_name'], 'width_master' => $_GET['master_width_name'], 'wood_type_id' => $_GET['master_wood_name'] ])->get();
        $array_post_names = array();
        foreach($choose_post_type_query as $choosePostTypeQ)
        {
            $array_post_names[] = $choosePostTypeQ->posts_master;
        }
        
        $widthQuery = PillerPostModel::whereIn('id',$array_post_names)->get();

        
        $html = '<option value="">Choose posts</option>';
        if(count($widthQuery) > 0)
        {
            foreach($widthQuery as $wQuery)
            {
                $checked = "";
                if($request->session()->has('main_unique_session_key'))
                {
                    $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                    foreach($mQuery_check as $mQc)
                    {
                        if($mQc->final_no_posts == $wQuery->id)
                        {
                            $checked = "selected";
                        }
                        
                    }
                }
                $html .= '<option value='.$wQuery->id.' '.$checked.'>'.$wQuery->no_of_posts.' posts</option>';
            }
        }
        echo json_encode($html);
    }

    // change width look
    public function change_master_width_fx(Request $request)
    {
        $widthQuery = MasterWidthModel::where('id',$_GET['id'])->get();
        foreach($widthQuery as $wQ)
        {
            $main_data = $wQ->master_width_length;
        }
        echo json_encode($main_data);
    }

    // change height look
    public function change_master_height_fx(Request $request)
    {
        $widthQuery = MasterHeightModel::where('id',$_GET['id'])->get();
        foreach($widthQuery as $wQ)
        {
            $main_data = $wQ->master_height_length;
        }
        echo json_encode($main_data);
    }

    // price wish combination look
    public function choose_master_post_wish_price_fx(Request $request)
    {
        
        $check_price = PickUpFootPrintModel::where(['width_master' => $_GET['master_width'], 'height_master' => $_GET['master_height'], 'posts_master' => $_GET['master_post'],'wood_type_id' => $_GET['master_wood'] ])->get();
        
        
        $html['master_price'] = 0;
        $html['master_img'] = '';
        if(count($check_price) > 0)
        {
            // width
            $width_main_query = MasterWidthModel::where('id',$_GET['master_width'])->get();
            foreach($width_main_query as $widthMainQ)
            {
                $widthMain = $widthMainQ->master_width_length;
            }

            // height
            $height_main_query = MasterHeightModel::where('id',$_GET['master_height'])->get();
            foreach($height_main_query as $heightMainQ)
            {
                $heightMain = $heightMainQ->master_height_length;
            }


            // main part
            foreach($check_price as $cQuery)
            {
                $configQuery = ConfigModel::where('wood_id',$_GET['master_wood'])->get();
                foreach($configQuery as $configQ)
                {
                    // $html['mastre_p_master'] = $cQuery->posts_master;
                    if($cQuery->posts_master == 1)
                    { 
                        if(($widthMain * $heightMain) <= 100)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->less100_price) + (4 * $configQ->post4_price) ;
                        }

                        if(($widthMain * $heightMain) <= 150 && ($widthMain * $heightMain) > 100)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->less100150_price) + (4 * $configQ->post4_price) ;
                        }

                        if(($widthMain * $heightMain) > 150)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->greater150_price) + (4 * $configQ->post4_price) ;
                        }
                    }
                    else if($cQuery->posts_master == 2)
                    {
                        if(($widthMain * $heightMain) <= 100)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->less100_price) + (4 * $configQ->post4_price) ;
                        }

                        if(($widthMain * $heightMain) <= 150 && ($widthMain * $heightMain) > 100)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->less100150_price) + (4 * $configQ->post4_price) ;
                        }

                        if(($widthMain * $heightMain) > 150)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->greater150_price) + (4 * $configQ->post4_price) ;
                        }
                    }
                    else if($cQuery->posts_master == 5)
                    {
                        if(($widthMain * $heightMain) <= 100)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->less100_price) + (6 * $configQ->post6_price) ;
                        }

                        if(($widthMain * $heightMain) <= 150 && ($widthMain * $heightMain) > 100)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->less100150_price) + (6 * $configQ->post6_price) ;
                        }

                        if(($widthMain * $heightMain) > 150)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->greater150_price) + (6 * $configQ->post6_price) ;
                        }
                    }
                    else if($cQuery->posts_master == 4)
                    {
                        if(($widthMain * $heightMain) <= 100)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->less100_price) + (8 * $configQ->post8_price) ;
                        }

                        if(($widthMain * $heightMain) <= 150 && ($widthMain * $heightMain) > 100)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->less100150_price) + (8 * $configQ->post8_price) ;
                        }

                        if(($widthMain * $heightMain) > 150)
                        {
                            $html['master_price'] = (($widthMain * $heightMain) * $configQ->greater150_price) + (8 * $configQ->post8_price) ;
                        }
                    }
                }
                
                if($cQuery->img_master != "" || $cQuery->img_master != null)
                {
                    $html['master_img'] = '<img src="'.str_replace("public","storage/app/public",asset($cQuery->img_master)).'" src="no image" />';
                }
                else if($cQuery->img_master == "" || $cQuery->img_master == null)
                {
                    $html['master_img'] = '';
                }
            }
        }


        /// get canopy video
        $canopyVideoQuery = PostWishCanopyModel::where('piller_post_id',$_GET['master_post'])->get();
        $html['canopy_video'] = "";
        $html['canopy_msg_html'] = "";

        if(count($canopyVideoQuery) > 0)
        {
            foreach($canopyVideoQuery as $cpVQuery)
            {
                $html['canopy_video'] = '<video width="320" height="240" controls autoplay loop>
                                            <source src="'.str_replace('public','storage/app/public',asset($cpVQuery->video_link_data)).'" type="video/mp4">
                                        </video>';
                $html['canopy_msg_html'] = $cpVQuery->canopy_type_text_description;
            }
        }

        /// lpanel video
        $lpanelVideoQuery = PostWishLpanelModel::where('piller_post_id',$_GET['master_post'])->get();
        $html['lpanel_video'] = "";
        $html['lpanel_msg_html'] = "";
        if(count($lpanelVideoQuery) > 0)
        {
            foreach($lpanelVideoQuery as $lpVQuery)
            {
                $html['lpanel_video'] = '<video width="320" height="240" controls autoplay loop>
                                            <source src="'.str_replace('public','storage/app/public',asset($lpVQuery->video_link_data)).'" type="video/mp4">
                                        </video>';
                $html['lpanel_msg_html'] = $lpVQuery->lpanel_data;
            }
        }

        echo json_encode($html);
    }

    // end of first page


    /// For second page data's

    public function show_overheads_fx2(Request $request)
    {
        $findQuery = PickOverheadShadesModel::where(['master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'], 'master_post' => $_GET['master_post'], 'wood_type_id' => $_GET['master_wood'], 'admin_action'  => 'yes'])->get();
        $html['overhead_types'] = "<option value=''>Choose a overhead shades</option>";
        if(count($findQuery) > 0)
        {
            
            foreach($findQuery as $fQuery)
            {
                $checked = "";
                if($request->session()->has('main_unique_session_key'))
                {
                    if($_GET['master_hidden_overhead_shades_value'] == 1)
                    {
                        $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                        foreach($mQuery_check as $mQc)
                        {
                            if($mQc->final_overhead == $fQuery->id)
                            {
                                $checked = "selected";
                            }
                            
                        }
                    }
                }

                
                $gettingQuery = MasterOverheadModel::where('id',$fQuery->master_overhead_shades)->get();
                foreach($gettingQuery as $gQuery)
                {
                    $html['overhead_types'] .= "<option value=".$gQuery->id." ".$checked.">".$gQuery->overhead_shades_val."</option>";
                }
            }
        }
        echo json_encode($html);
    }

    public function choose_overheads_fx2(Request $request)
    {
        $findQuery = PickOverheadShadesModel::where(['admin_action' => 'yes', 'master_overhead_shades' => $_GET['id'], 'master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'],'master_post' => $_GET['master_post'], 'wood_type_id' => $_GET['master_wood'] ])->get();
        $html['overhead_price'] = 0;
        $html['overhead_type'] = "";
        if(count($findQuery) > 0)
        {
            // overhead shades
            $overheadShadesQ = MasterOverheadModel::where('id',$_GET['id'])->get();
            foreach($overheadShadesQ as $overSQ)
            {
                $overheadQ = $overSQ->overhead_shades_val;
            }

            $main_price = $_GET['pickAFootprint_price'];

            if($overheadQ == "regular")
            {
                $configOverQ = ConfigOverheadShadesModel::where(['wood_id' => $_GET['master_wood']])->get();
                if(count($configOverQ) > 0)
                {
                    foreach($configOverQ as $cOQ)
                    {
                        $html_last_main_price = ((($cOQ->regular_price)*$main_price)/100);
                    }
                }
            }
            else if($overheadQ == "open")
            {
                $configOverQ = ConfigOverheadShadesModel::where(['wood_id' => $_GET['master_wood']])->get();
                if(count($configOverQ) > 0)
                {
                    foreach($configOverQ as $cOQ)
                    {
                        $html_last_main_price = ((($cOQ->open_price)*$main_price)/100);
                    }
                }
            }
            else if($overheadQ == "sunblocker")
            {
                $configOverQ = ConfigOverheadShadesModel::where(['wood_id' => $_GET['master_wood']])->get();
                if(count($configOverQ) > 0)
                {
                    foreach($configOverQ as $cOQ)
                    {
                        $html_last_main_price = ((($cOQ->sunblocker_price)*$main_price)/100);
                    }
                }
            }


            foreach($findQuery as $fQuery)
            {
                $html['overhead_type'] = $overheadQ;
                $html['overhead_price'] = $html_last_main_price;
                if($fQuery->img_file == null || $fQuery->img_file == '')
                {
                    $html['overhead_img'] = '';
                }
                else if($fQuery->img_file != null || $fQuery->img_file != '')
                {
                    $html['overhead_img'] = '<img src="'.str_replace("public","storage/app/public",asset($fQuery->img_file)).'" src="no image" />';
                }
                
            }
        }
        echo json_encode($html);
    }

    /// end of Second page

    // start of fourth page
    public function show_pick_post_length_fx4(Request $request)
    {
        $chooseQuery = PickPostLengthModel::where(['master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'], 'master_post' => $_GET['master_post'], 'master_overhead_shades' => $_GET['second_page_store'], 'wood_type_id' => $_GET['master_wood'] ])->get();
        $html = '<option value="">Choose a post length</option>';
        if(count($chooseQuery) > 0)
        {
            foreach($chooseQuery as $cQuery)
            {    
                $checked = "";
                if($request->session()->has('main_unique_session_key'))
                {
                    if($_GET['master_hidden_post_length_value'] == 1)
                    {
                        $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                        foreach($mQuery_check as $mQc)
                        {
                            if($mQc->final_post_length == $cQuery->id)
                            {
                                $checked = "selected";
                            }
                        }
                    }
                }
                $fetchTheFinalOne = MasterPostLengthModel::where(['id' => $cQuery->posts_length])->get();
                foreach($fetchTheFinalOne as $fQueryLenght)
                {
                    $html .= '<option value='.$fQueryLenght->id.' '.$checked.'>'.$fQueryLenght->master_post_length.' ft.</option>';
                }
            }
        }
        echo json_encode($html);
    }

    public function choose_pick_post_length_fx4(Request $request)
    {
        $master_width = $_GET['master_width']; $master_height = $_GET['master_height']; $master_post = $_GET['master_post']; $overhead_val = $_GET['overhead_val'];
        $chooseSessionCallQuery = PickPostLengthModel::where(['admin_action' => 'yes',  'posts_length' => $_GET['id'], 'master_width' => $master_width, 'master_height' => $master_height, 'master_post' => $master_post, 'master_overhead_shades' => $overhead_val, 'wood_type_id' => $_GET['master_wood'] ])->get();
        {
            foreach($chooseSessionCallQuery as $chooseSCallQuery)
            {
                $get_main_post_tbl_id = $chooseSCallQuery->id;
                $request->session()->put('final_product_combination_session_id', $get_main_post_tbl_id);
            }
        }

        // overhead shades
        $pickPostLengthQ = MasterPostLengthModel::where('id',$_GET['id'])->get();
        foreach($pickPostLengthQ as $pickLengthQ)
        {
            $pickPostLengthQData = $pickLengthQ->master_post_length;
        }

        $main_price = $_GET['pickAFootprint_price'];

            if($pickPostLengthQData == 9)
            {
                $configOverQ = ConfigPostLengthModel::where(['wood_id' => $_GET['master_wood'] ])->get();
                if(count($configOverQ) > 0)
                {
                    foreach($configOverQ as $cOQ)
                    {
                        $html_post_wish_last_main_price = (($main_price * $cOQ->post9Length_price)/100);
                    }
                }
            }
            else if($pickPostLengthQData == 12)
            {
                $configOverQ = ConfigPostLengthModel::where(['wood_id' => $_GET['master_wood'] ])->get();
                if(count($configOverQ) > 0)
                {
                    foreach($configOverQ as $cOQ)
                    {
                        $html_post_wish_last_main_price = (($main_price * $cOQ->post12Length_price)/100);
                    }
                }
            }


        $chooseQuery = PickPostLengthModel::where(['admin_action' => 'yes', 'id' => $get_main_post_tbl_id])->get();
        
        if(count($chooseQuery) > 0)
        {
            foreach($chooseQuery as $cQuery)
            {   
                $html['fourth_price'] = $html_post_wish_last_main_price;
                if($cQuery->img_file == null || $cQuery->img_file == "")
                {
                    $html['fourth_img'] = '';
                }
                else if($cQuery->img_file != null || $cQuery->img_file != "")
                {
                    $html['fourth_img'] = '<img src="'.str_replace("public","storage/app/public",asset($cQuery->img_file)).'" src="no image" />';
                }
            }
        }
        echo json_encode($html);
    }
    // end of fourth page

    // fifth start page
    public function show_pick_post_mount_fx5(Request $request)
    {
        $html['choose_bracket'] = "";
        $choosePostOfMount = PillerPostModel::where('id',$_GET['master_post'])->get();
        if(count($choosePostOfMount) > 0)
        {
            foreach($choosePostOfMount as $chPMountQuery)
            {
                $choosePost = $chPMountQuery->no_of_posts;

                if($choosePost === "4")
                {
                    $chooseConfigMountQuery = ConfigMountModel::where('wood_id',$_GET['master_wood'])->get();
                    foreach($chooseConfigMountQuery as $hConfigQ)
                    {
                        $configMount = $hConfigQ->mount_bracket4_price;
                    }
                    $html['choose_bracket_post'] = $choosePost;
                    $html['choose_bracket'] = "4 brackets";
                }
                else if($choosePost === "4 double")
                {
                    $chooseConfigMountQuery = ConfigMountModel::where('wood_id',$_GET['master_wood'])->get();
                    foreach($chooseConfigMountQuery as $hConfigQ)
                    {
                        $configMount = $hConfigQ->mount_bracket4_price;
                    }
                    $html['choose_bracket_post'] = $choosePost;
                    $html['choose_bracket'] = "4 brackets";
                }
                else if($choosePost === "6")
                {
                    $chooseConfigMountQuery = ConfigMountModel::where('wood_id',$_GET['master_wood'])->get();
                    foreach($chooseConfigMountQuery as $hConfigQ)
                    {
                        $configMount = $hConfigQ->mount_bracket6_price;
                    }
                    $html['choose_bracket_post'] = $choosePost;
                    $html['choose_bracket'] = "6 brackets";
                }
                else if($choosePost === "8")
                {
                    $chooseConfigMountQuery = ConfigMountModel::where('wood_id',$_GET['master_wood'])->get();
                    foreach($chooseConfigMountQuery as $hConfigQ)
                    {
                        $configMount = $hConfigQ->mount_bracket8_price;
                    }
                    $html['choose_bracket_post'] = $choosePost;
                    $html['choose_bracket'] = "8 brackets";
                }
            }
        }
        $html['post_mount_price'] = $configMount;
        
       
        // $chooseQuery = PickPostLengthModel::where(['posts_length' => $_GET['post_length_data_val'], 'master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'], 'master_post' => $_GET['master_post'], 'master_overhead_shades' => $_GET['second_page_store'] ])->get();
        // $html['post_mount_price'] = 0;
        // if(count($chooseQuery) > 0)
        // {
        //     $checked = "";
                
        //     foreach($chooseQuery as $cQuery)
        //     {    

        //         $chooseMainQuery = CombinationModel::where('combination_id',$cQuery->id)->get();

        //         foreach($chooseMainQuery as $cQuery1)
        //         {
        //             $html['post_mount_price'] = $html['post_mount_price']+$cQuery1->existing_price;
        //         }

                // if($request->session()->has('main_unique_session_key'))
                // {
                //     $mQuery_check = BeforeCheckoutFinalProductModel::where('unique_session_id',$request->session()->get('main_unique_session_key'))->get();
                //     foreach($mQuery_check as $mQc)
                //     {
                //         if($mQc->final_post_mount == $cQuery->id)
                //         {
                //             $checked = "selected";
                //         }
                        
                //     }
                // }
                
        //     }
        // }
        echo json_encode($html);
    }

    public function choose_pick_post_mount_fx5(Request $request)
    {
        $chooseQuery = PickPostMountBracketModel::where(['id' => $_GET['id'] ,'admin_action' => 'yes'])->get();
        foreach($chooseQuery as $cQuery)
        {
            $html['price_list'] = $cQuery->price_details;
        }
        echo json_encode($html);
    }
    // end of fifth page

    // start of sixth page
    public function show_pick_canopy_fx6(Request $request)
    {
        $chooseQuery = PickPostLengthModel::where(['posts_length' => $_GET['post_length_data_val'], 'master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'], 'master_post' => $_GET['master_post'], 'master_overhead_shades' => $_GET['second_page_store'], 'wood_type_id' => $_GET['master_wood'] ])->get();
        $html['canopy_html'] = '';
        $html['canopy_price'] = 0;
        $html['choose_canopy_post'] = "";
        if(count($chooseQuery) > 0)
        {
            $checked = "";
                
            foreach($chooseQuery as $cQuery)
            {    
                $master_width_query = MasterWidthModel::where('id',$_GET['master_width'])->get();
                foreach($master_width_query as $widthQuery)
                {
                    $html_master_width_data = $widthQuery->master_width_length;
                }

                $master_height_query = MasterHeightModel::where('id',$_GET['master_height'])->get();
                foreach($master_height_query as $heightQuery)
                {
                    $html_master_height_data = $heightQuery->master_height_length;
                }

                
                $configCanopyQuery = ConfigCanopyModel::where('wood_id',$_GET['master_wood'])->get();
                foreach($configCanopyQuery as $conCanopy)
                {
                    $html['canopy_html'] .= '<input type="hidden" name="" id="sixth-pregenerated-price-hidden-val-id" value="'.$conCanopy->canopy_price * $html_master_width_data * $html_master_height_data.'" />';

                    $html['canopy_price'] = $conCanopy->canopy_price * $html_master_width_data * $html_master_height_data;
                }

                $choosePostOfMount = PillerPostModel::where('id',$_GET['master_post'])->get();

                if(count($choosePostOfMount) > 0)
                {
                    foreach($choosePostOfMount as $chPMountQuery)
                    {
                        $choosePost = $chPMountQuery->no_of_posts;

                        if($choosePost === "4")
                        {
                            $chooseConfigMountQuery = ConfigCanopyModel::where('wood_id',$_GET['master_wood'])->get();
                            foreach($chooseConfigMountQuery as $hConfigQ)
                            {
                                $configMount = $hConfigQ->mount_bracket4_price;
                            }
                            $html['choose_canopy_post'] = $choosePost;
                            $html['choose_bracket'] = "4 brackets";
                        }
                        else if($choosePost === "4 double")
                        {
                            $chooseConfigMountQuery = ConfigCanopyModel::where('wood_id',$_GET['master_wood'])->get();
                            foreach($chooseConfigMountQuery as $hConfigQ)
                            {
                                $configMount = $hConfigQ->mount_bracket4_price;
                            }
                            $html['choose_canopy_post'] = $choosePost;
                            $html['choose_bracket'] = "4 brackets";
                        }
                        else if($choosePost === "6")
                        {
                            $chooseConfigMountQuery = ConfigCanopyModel::where('wood_id',$_GET['master_wood'])->get();
                            foreach($chooseConfigMountQuery as $hConfigQ)
                            {
                                $configMount = $hConfigQ->mount_bracket6_price;
                            }
                            $html['choose_canopy_post'] = $choosePost;
                            $html['choose_bracket'] = "6 brackets";
                        }
                        else if($choosePost === "8")
                        {
                            $chooseConfigMountQuery = ConfigCanopyModel::where('wood_id',$_GET['master_wood'])->get();
                            foreach($chooseConfigMountQuery as $hConfigQ)
                            {
                                $configMount = $hConfigQ->mount_bracket8_price;
                            }
                            $html['choose_canopy_post'] = $choosePost;
                            $html['choose_bracket'] = "8 brackets";
                        }
                    }
                }

                // $chooseMainQuery = CombinationModel::where('combination_id',$cQuery->id)->get();

                // foreach($chooseMainQuery as $cQuery1)
                // {
                //     $html['canopy_html'] .= '<p>'.ucwords($cQuery1->canopy_list).'</p>
                //     <input type="hidden" name="" id="sixth-pregenerated-price-hidden-val-id" value="'.$cQuery1->canopy_price.'" />
                //     ';

                //     // <h4>Price <span>$<span id="sixth-price-panel-id">'.$cQuery1->canopy_price.'</span></span></h4>

                //     $html['canopy_price'] = $cQuery1->canopy_price;
                // }

            }
        }
        echo json_encode($html);
    }
    // start of sixth page

    // start of seventh page
    public function show_pick_lpanel_fx7(Request $request)
    {

        $chooseQuery = PickPostLengthModel::where(['posts_length' => $_GET['post_length_data_val'], 'master_width' => $_GET['master_width'], 'master_height' => $_GET['master_height'], 'master_post' => $_GET['master_post'], 'master_overhead_shades' => $_GET['second_page_store'] ])->get();
        $html['lpanel_radio_panel'] = "";
        if(count($chooseQuery) > 0)
        {
            $checked = "";
                
            foreach($chooseQuery as $cQuery)
            {    

                $chooseMainQuery = CombinationModel::where('combination_id',$cQuery->id)->get();
                
                

                foreach($chooseMainQuery as $cQuery1)
                {
                    // $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" checked onclick=my_seveth_click("'.$cQuery1->left_price.'") > Left </li>';
                    // $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" onclick=my_seveth_click("'.$cQuery1->rear_price.'") > Rear</li>';
                    // $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" onclick=my_seveth_click("'.$cQuery1->right_price.'") > Right </li>';
                    // $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" onclick=my_seveth_click("'.$cQuery1->left_rear_price.'") > Left + Rear</li>';
                    // $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" onclick=my_seveth_click("'.$cQuery1->right_rear_price.'") > Right + Rear</li>';
                    // $html['lpanel_radio_panel'] .= '<li><input type="radio" name="bracket" onclick=my_seveth_click("'.$cQuery1->left_right_rear_price.'") > Left + Right + Rear</li>';

                    $html['new_price'] = $cQuery1->left_price;
                }


                $choosePostOfMount = PillerPostModel::where('id',$_GET['master_post'])->get();

                if(count($choosePostOfMount) > 0)
                {
                    foreach($choosePostOfMount as $chPMountQuery)
                    {
                        $choosePost = $chPMountQuery->no_of_posts;

                        if($choosePost === "4")
                        {
                            $chooseConfigMountQuery = ConfigLouveredModel::where('wood_id',$_GET['master_wood'])->get();
                            foreach($chooseConfigMountQuery as $hConfigQ)
                            {
                                $configMount = $hConfigQ->mount_bracket4_price;
                            }
                            $html['choose_lpanel_post'] = $choosePost;
                            $html['choose_lpanel'] = "4 brackets";
                        }
                        else if($choosePost === "4 double")
                        {
                            $chooseConfigMountQuery = ConfigLouveredModel::where('wood_id',$_GET['master_wood'])->get();
                            foreach($chooseConfigMountQuery as $hConfigQ)
                            {
                                $configMount = $hConfigQ->mount_bracket4_price;
                            }
                            $html['choose_lpanel_post'] = $choosePost;
                            $html['choose_lpanel'] = "4 brackets";
                        }
                        else if($choosePost === "6")
                        {
                            $chooseConfigMountQuery = ConfigLouveredModel::where('wood_id',$_GET['master_wood'])->get();
                            foreach($chooseConfigMountQuery as $hConfigQ)
                            {
                                $configMount = $hConfigQ->mount_bracket6_price;
                            }
                            $html['choose_lpanel_post'] = $choosePost;
                            $html['choose_lpanel'] = "6 brackets";
                        }
                        else if($choosePost === "8")
                        {
                            $chooseConfigMountQuery = ConfigLouveredModel::where('wood_id',$_GET['master_wood'])->get();
                            foreach($chooseConfigMountQuery as $hConfigQ)
                            {
                                $configMount = $hConfigQ->mount_bracket8_price;
                            }
                            $html['choose_lpanel_post'] = $choosePost;
                            $html['choose_lpanel'] = "8 brackets";
                        }
                    }
                }

            }
        }


        echo json_encode($html);
    }
    // end of seventh page

    // final page
    public function showFinalPage(Request $request)
    {
        $master_width = $_GET['master_width'];
        $master_height = $_GET['master_height']; 
        $master_post = $_GET['master_post'];
        $overhead_type_val = $_GET['overhead_type_val'];
        $post_length_val = $_GET['post_length_val'];


        $piller_count_query = PillerPostModel::where('id',$master_post)->get();
        foreach($piller_count_query as $pillerQuery)
        {
            $html['posts_no'] = $pillerQuery->no_of_posts;
        }

        $master_width_query = MasterWidthModel::where('id',$master_width)->get();
        foreach($master_width_query as $widthQuery)
        {
            $html['width_data'] = $widthQuery->master_width_length;
        }

        $master_height_query = MasterHeightModel::where('id',$master_height)->get();
        foreach($master_height_query as $heightQuery)
        {
            $html['height_data'] = $heightQuery->master_height_length;
        }

        $master_final_product_page_query = FinalProductModel::where('pick_footprint',$request->session()->get('final_product_combination_session_id'))->get();
        if(count($master_final_product_page_query) > 0)
        {
            foreach($master_final_product_page_query as $finalPQuery)
            {
                $html['final_prod_img'] = "";
                $html['final_footprint_img'] = "";
                if($finalPQuery->final_product_img != "" || $finalPQuery->final_product_img != null){
                    $html['final_prod_img'] = '<img src="'.str_replace('public','storage/app/public',asset($finalPQuery->final_product_img)).'"  alt=""/>';
                }
                if($finalPQuery->final_footprint_img != "" || $finalPQuery->final_footprint_img != null){
                    $html['final_footprint_img'] = '<img src="'.str_replace('public','storage/app/public',asset($finalPQuery->final_footprint_img)).'"  alt=""/>';
                }
            }
        }

        $post_length_query = MasterPostLengthModel::where('id',$post_length_val)->get();
        foreach($post_length_query as $pQuery)
        {
            $html['length_data'] = $pQuery->master_post_length;
        }

        $overhead_query = MasterOverheadModel::where('id',$overhead_type_val)->get();
        foreach($overhead_query as $pOverQuery)
        {
            $html['overhead_data'] = $pOverQuery->overhead_shades_val;
        }

        echo json_encode($html);

    }
    // end of final page



    /// first page wood select
    public function choose_master_wish_wood_fx(Request $request)
    {
        $master_wood_type = MasterWoodModel::where(['admin_action'=> 'yes'])->get();
        $html['wood_types'] = "";
        foreach($master_wood_type as $mwtype)
        {
            $html['wood_types'] .= '<option value="'.$mwtype->id.'">'.$mwtype->wood_name.'</option>';
        }

        echo json_encode($html);
    }

    /// end of  first page wood select admin


    /// mount bracket type

    public function choose_pick_post_mount_video_image_fx5(Request $request)
    {
        $pillerPostsIdQuery = PillerPostModel::where('no_of_posts',$_GET['choose_brackets'])->get();
        foreach($pillerPostsIdQuery as $pId)
        {
            $postId = $pId->id;
        } 
        $mountBracketQuery = MountBracketModel::where('piller_post_id',$postId)->get();
        foreach($mountBracketQuery as $mBracketQuery)
        {
            $html['video_link_id'] = $mBracketQuery->video_link_data;
            $html['image_link_id'] = $mBracketQuery->mount_bracket_img;
            $html['video_link'] = str_replace('public','storage/app/public',asset($mBracketQuery->video_link_data));
            $html['image_link'] = str_replace('public','storage/app/public',asset($mBracketQuery->mount_bracket_img));
            $html['mount_description'] = $mBracketQuery->mount_bracket_data;

            $html['popup_name'] = $mBracketQuery->popup_name;
            $html['popup_details'] = $mBracketQuery->popup_details;
        }
        
        echo json_encode($html);
    }

    /// end of mount bracket type


    /// canopy type

    public function choose_pick_post_canopy_video_image_fx6(Request $request)
    {
        $pillerPostsIdQuery = PillerPostModel::where('no_of_posts',$_GET['choose_brackets'])->get();
        foreach($pillerPostsIdQuery as $pId)
        {
            $postId = $pId->id;
        } 
        $mountBracketQuery = PostWishCanopyModel::where('piller_post_id',$postId)->get();
        foreach($mountBracketQuery as $mBracketQuery)
        {
            $html['video_link_id'] = $mBracketQuery->video_link_data;
            $html['image_link_id'] = $mBracketQuery->image_link_data;
            $html['video_link'] = str_replace('public','storage/app/public',asset($mBracketQuery->video_link_data));
            $html['image_link'] = str_replace('public','storage/app/public',asset($mBracketQuery->image_link_data));
            // $html['mount_description'] = $mBracketQuery->mount_bracket_data;

            $html['popup_name'] = $mBracketQuery->popup_name;
            $html['popup_details'] = $mBracketQuery->popup_details;
        }
        
        echo json_encode($html);
    }

    /// end of canopy type


    /// lpanel type

    public function choose_pick_post_lpanel_video_image_fx7(Request $request)
    {
        $pillerPostsIdQuery = PillerPostModel::where('no_of_posts',$_GET['choose_brackets'])->get();
        foreach($pillerPostsIdQuery as $pId)
        {
            $postId = $pId->id;
        } 
        $mountBracketQuery = PostWishLpanelModel::where('piller_post_id',$postId)->get();
        foreach($mountBracketQuery as $mBracketQuery)
        {
            $html['lpanel_video_link_id'] = $mBracketQuery->video_link_data;
            $html['lpanel_image_link_id'] = $mBracketQuery->image_link_data;
            $html['lpanel_video_link'] = str_replace('public','storage/app/public',asset($mBracketQuery->video_link_data));
            $html['lpanel_image_link'] = str_replace('public','storage/app/public',asset($mBracketQuery->image_link_data));
            // $html['mount_description'] = $mBracketQuery->mount_bracket_data;

            $html['popup_name'] = $mBracketQuery->popup_name;
            $html['popup_details'] = $mBracketQuery->popup_details;
        }
        
        echo json_encode($html);
    }

    /// end of lpanel type


    public function choose_master_width_new_session_fx(Request $request)
    {
        $widthQuery = MasterWidthModel::get();
        $html = '<option value="">Choose a width</option>';
        if(count($widthQuery) > 0)
        {
            foreach($widthQuery as $wQuery)
            {
                $html .= '<option value='.$wQuery->id.'>'.$wQuery->master_width_length.'</option>';
            }
        }
        echo json_encode($html);
    }

    public function choose_master_height_new_session_fx(Request $request)
    {
        $widthQuery = MasterHeightModel::get();
        $html = '<option value="">Choose a length</option>';
        if(count($widthQuery) > 0)
        {
            foreach($widthQuery as $wQuery)
            {
                $html .= '<option value='.$wQuery->id.'>'.$wQuery->master_height_length.'</option>';
            }
        }
        echo json_encode($html);
    }

    public function choose_master_post_new_session_fx(Request $request)
    {
        $choose_post_type_query = PickUpFootPrintModel::where(['height_master' => $_GET['master_height_name'], 'width_master' => $_GET['master_width_name'], 'wood_type_id' => $_GET['master_wood_name'] ])->get();
        $array_post_names = array();
        foreach($choose_post_type_query as $choosePostTypeQ)
        {
            $array_post_names[] = $choosePostTypeQ->posts_master;
        }
        
        $widthQuery = PillerPostModel::whereIn('id',$array_post_names)->get();

        
        $html = '<option value="">Choose posts</option>';
        if(count($widthQuery) > 0)
        {
            foreach($widthQuery as $wQuery)
            {
                $html .= '<option value='.$wQuery->id.'>'.$wQuery->no_of_posts.' posts</option>';
            }
        }
        echo json_encode($html);
    }


    /// louvered panel
    public function show_louvered_panel_yes_fx(Request $request)
    {
        $wood_type = $_GET['wood_type'];
        $width_type = $_GET['width_type'];
        $height_type = $_GET['height_type'];
        $post_length = $_GET['post_length'];
        $piller_count = $_GET['piller_counts'];

        // wood type 
        $woodQuery = MasterWoodModel::where(['id' => $wood_type])->get();
        if(count($woodQuery) > 0)
        {
            foreach($woodQuery as $woodQ)
            {
                $wood_name = $woodQ->wood_name;
            }
        }

        // width type
        $widthQuery = MasterWidthModel::where(['id' => $width_type])->get();
        if(count($widthQuery) > 0)
        {
            foreach($widthQuery as $widthQ)
            {
                $width_name = $widthQ->master_width_length;
            }
        }

        // height type
        $heightQuery = MasterHeightModel::where(['id' => $height_type])->get();
        if(count($heightQuery) > 0)
        {
            foreach($heightQuery as $lengthQ)
            {
                $height_name = $lengthQ->master_height_length;
            }
        }

        // post lenght
        $postLengthQuery = MasterPostLengthModel::where(['id' => $post_length])->get();
        if(count($postLengthQuery) > 0)
        {
            foreach($postLengthQuery as $pLQuery)
            {
                $postLengh = $pLQuery->master_post_length;
            }
        }

        // Louvered Panel
        $configLouveredQuery = ConfigLouveredModel::where(['wood_id' => $wood_type ])->get();
        foreach($configLouveredQuery as $configLQ)
        {
            $ConfiglQPrice = $configLQ->each_sqft_price;
        }

        // side1 & side3 => width * postLength 
        // $html['side13'] = $width_name." ft. * ".$postLengh."ft." ;
        if($piller_count == 1)
        {
            $html['side13'] = $width_name." ft." ;
            $html['side13_price'] = $width_name * $ConfiglQPrice;

            // side2 & side4 => height * postLength
            // $html['side24'] = $height_name." ft. * ".$postLengh."ft." ;
            $html['side24'] = $height_name." ft.";
            $html['side24_price'] = $height_name * $ConfiglQPrice;
        }
        else if($piller_count == 2)
        {
            $html['side13'] = $width_name." ft." ;
            $html['side13_price'] = $width_name * $ConfiglQPrice;

            // side2 & side4 => height * postLength
            // $html['side24'] = $height_name." ft. * ".$postLengh."ft." ;
            $html['side24'] = $height_name." ft.";
            $html['side24_price'] = $height_name * $ConfiglQPrice;
        }
        else if($piller_count == 5)
        {
            $html['side13'] = $height_name." ft." ;
            $html['side13_price'] = round((($height_name * $ConfiglQPrice)/2),2);

            // side2 & side4 => height * postLength
            // $html['side24'] = $height_name." ft. * ".$postLengh."ft." ;
            $html['side24'] = $width_name." ft.";
            $html['side24_price'] = round((($width_name * $ConfiglQPrice)/2),2);
        }
        else if($piller_count == 4)
        {
            $html['side13'] = $height_name." ft." ;
            $html['side13_price'] = round((($height_name * $ConfiglQPrice)/3),2);

            // side2 & side4 => height * postLength
            // $html['side24'] = $height_name." ft. * ".$postLengh."ft." ;
            $html['side24'] = $width_name." ft.";
            $html['side24_price'] = round((($width_name * $ConfiglQPrice)/3),2);
        }
        

        echo json_encode($html);
    }

}