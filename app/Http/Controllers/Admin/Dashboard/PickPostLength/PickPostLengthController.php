<?php

namespace App\Http\Controllers\Admin\Dashboard\PickPostLength;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\PickOverheadShades\PickOverheadShadesModel;
use App\Model\Admin\PickUpFootPrint\PickUpFootPrintModel;
use App\Model\Admin\PickPostLength\PickPostLengthModel;
use App\Model\Admin\MasterPostLength\MasterPostLengthModel;
use App\Model\Admin\MasterHeight\MasterHeightModel;
use App\Model\Admin\MasterWidth\MasterWidthModel;
use App\Model\Admin\PillerPost\PillerPostModel;
use App\Model\Admin\MasterOverheadModel;
use App\Model\Admin\MasterWood\MasterWoodModel;

// config
use App\Model\Config\ConfigModel;
use App\Model\Config\ConfigOverheadShadesModel;
use App\Model\Config\ConfigPostLengthModel;
use App\Model\Config\ConfigCanopyModel;
use App\Model\Config\ConfigLouveredModel;
use App\Model\Config\ConfigMountModel;

class PickPostLengthController extends Controller
{
        //
        public function __construct()
        {
            $this->middleware('auth:admin');
        }
    
    
        public function showPage(Request $request)
        {
            return view('backend.pages.pick-post-length.pick-post-length');
        }
    
        public function submitOverheadShades(Request $request)
        {
            $checkQuery = PickPostLengthModel::where(['master_width' => $request->input('master_width'), 'master_height' => $request->input('master_height'), 'master_post' => $request->input('master_post'), 'posts_length' => $request->input('post_length'), 'master_overhead_shades' => $request->input('ladder_spacing'), 'wood_type_id' => $request->input('wood_types_name') ])->get();
            if(count($checkQuery) > 0)
            {
                $request->session()->flash('error_msg', 'This post length already added before');
                return redirect()->back();
            }
            else
            {
                    if($request->hasFile('post_length_file'))
                    {
                        $our_story_img = $request->file('post_length_file')->store('public/post_length');
                    }
                    else
                    {
                        $our_story_img = "";
                    }
    
                
    
                    $insertArr = [
                        'master_width' => $request->input('master_width'),
                        'master_height' => $request->input('master_height'),
                        'master_post' => $request->input('master_post'),
                        'master_overhead_shades' => $request->input('ladder_spacing'),
                        'posts_length' => $request->input('post_length'), 
                        'price_details' => $request->input('post_length_price'), 
                        'wood_type_id' => $request->input('wood_types_name'),
                        'img_file' => $our_story_img, 
                        'admin_action' => 'yes', 
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                        
                    ];
                    $insertQuery = PickPostLengthModel::insert($insertArr);
                    if($insertQuery)
                    {
                        $request->session()->flash('success_msg', 'Successfully Inserted ');
                    }
                    else
                    {
                        $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
                    }
                    return redirect()->back();
            }
        }

        public function showMasterPostLength(Request $request)
        {
            $mainQuery = MasterPostLengthModel::get();
            $html['master_post_length_data'] = '<option value="">Choose pick post length</option>';
            if(count($mainQuery) > 0)
            {
                foreach($mainQuery as $mQuery)
                {
                    $html['master_post_length_data'] .= '<option value="'.$mQuery->id.'">'.$mQuery->master_post_length.' ft.</option>';
                }
                
            }
            echo  json_encode($html);
        }

        public function showPostLoadfx(Request $request)
        {
            $w_val = $_GET['w_id'];
            $h_val = $_GET['h_id'];

            if(isset($_GET['p_id']))
            {
                $postQuery1 = PickOverheadShadesModel::where(['master_width' => $w_val, 'master_height' => $h_val, 'master_post' => $_GET['p_id'], 'wood_type_id' => $_GET['wood_id'] ])->get();
                $html['master_overhead_shades'] = '<option value="">Choose Overhead Shades</option>';
                if(count($postQuery1) > 0)
                {
                    foreach($postQuery1 as $pQuery1)
                    {
                        $getPostQuery1 = MasterOverheadModel::where(['id' => $pQuery1->master_overhead_shades])->get();
                        foreach($getPostQuery1 as $gPQuery1)
                        {
                            $html['master_overhead_shades'] .= '<option value="'.$gPQuery1->id.'">'.$gPQuery1->overhead_shades_val.'</option>';
                        }
                        
                    }
                }
            }

            $postQuery = PickUpFootPrintModel::where(['width_master' => $w_val, 'height_master' => $h_val, 'wood_type_id' => $_GET['wood_id']])->get();
            $html['master_posts'] = '<option value="">Choose posts</option>';
            if(count($postQuery) > 0)
            {
                foreach($postQuery as $pQuery)
                {
                    $getPostQuery = PillerPostModel::where(['id' => $pQuery->posts_master])->get();
                    foreach($getPostQuery as $gPQuery)
                    {
                        $html['master_posts'] .= '<option value="'.$gPQuery->id.'">'.$gPQuery->no_of_posts.'</option>';
                    }
                }
            }
            echo  json_encode($html);
        }
    
    
        public function showOverheadShades(Request $request)
        {
            $showQuery = PickPostLengthModel::get();
            if(count($showQuery) > 0)
            {
                $html = "";
                $i = 0;
                foreach($showQuery as $sQuery)
                {
                    if($sQuery->admin_action == 'yes' )
                    {
                        $status = '<span class="text-success"><i class="fa fa-check"></i> Active</span>';
                        $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$sQuery->admin_action.'",'.$sQuery->id.') class="btn btn-sm btn-danger">Make it In-Active</a>';
                    }
                    else if($sQuery->admin_action == 'no' )
                    {
                        $status = '<span class="text-danger"><i class="fa fa-times"></i> Deactive</span>';
                        $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$sQuery->admin_action.'",'.$sQuery->id.') class="btn btn-sm btn-success">Make it Active</a>';
                    }
                    else
                    {
    
                    }
    
                    if($sQuery->img_file == "" || $sQuery->img_file == null)
                    {
                        $img_path = "No Image";
                    }
                    else
                    {
                        $change_path = str_replace('public','storage/app/public',$sQuery->img_file);
                        $img_path = '<img src="'.asset($change_path).'" alt="no image" width="100px" />';
                    }

                    $del_state = '<a href="javascript: ;" onclick=make_del_change('.$sQuery->id.') class="text-danger"><i class="fa fa-trash"></i></a>';

                    $edit_state = '<a href="javascript: ;" onclick=make_edit_change('.$sQuery->id.') class="text-info"><i class="fa fa-edit"></i></a>';

                        // master height
                        $fetchMasterHeight = MasterHeightModel::where(['id' => $sQuery->master_height])->get();
                        if(count($fetchMasterHeight) > 0)
                        {
                            foreach($fetchMasterHeight as $fetchH)
                            {
                                $html_master_height = $fetchH->master_height_length;
                            }
                        }

                        // master width
                        $fetchMasterWidth = MasterWidthModel::where(['id' => $sQuery->master_width])->get();
                        if(count($fetchMasterWidth) > 0)
                        {
                            foreach($fetchMasterWidth as $fetchW)
                            {
                                $html_master_width = $fetchW->master_width_length;
                            }
                        }

                        // master overhead Shade
                        $fetchMasterPost = PillerPostModel::where(['id' => $sQuery->master_post])->get();
                        if(count($fetchMasterPost) > 0)
                        {
                            foreach($fetchMasterPost as $fetchOP)
                            {
                                $html_master_post = $fetchOP->no_of_posts;
                            }
                        }

                        // master overhead Shade
                        $fetchMasterOverheadShades = MasterOverheadModel::where(['id' => $sQuery->master_overhead_shades])->get();
                        if(count($fetchMasterOverheadShades) > 0)
                        {
                            foreach($fetchMasterOverheadShades as $fetchO)
                            {
                                $html_master_overhead = $fetchO->overhead_shades_val;
                            }
                        }

                        // master post length
                        $fetchMasterPostLength = MasterPostLengthModel::where(['id' => $sQuery->posts_length])->get();
                        if(count($fetchMasterPostLength) > 0)
                        {
                            foreach($fetchMasterPostLength as $fetchOPL)
                            {
                                $html_master_post_length = $fetchOPL->master_post_length;
                            }
                        }


                        /// master wood select 
                        $fetchMasterWoodType = MasterWoodModel::where(['id' => $sQuery->wood_type_id])->get();
                        $master_wood_type = "No wood type";
                        if(count($fetchMasterWoodType) > 0)
                        {
                            foreach($fetchMasterWoodType as $masterW)
                            {
                                $master_wood_type = $masterW->wood_name;
                            }
                        }
                    
                        
                    
                    $html .= "<tr>
                                <td>".++$i."</td>
                                <td>".$img_path."</td>
                                <td>".$html_master_width."ft. <b>width</b> x ".$html_master_height."ft. <b>height</b> x ".$html_master_post." <b>post</b> x ".$html_master_overhead." <b>overhead shades</b></td>
                                <td> Size : ".$html_master_post_length." ft.</b></td>
                                <td>".$master_wood_type."</td>
                                <td>".$status."</td>
                                <td>".$action_btn." ".$del_state." ".$edit_state."</td>
                            </tr>";
                }
            }
            else
            {
                $html = '<tr>
                            <td colspan="5"><center class="text-danger"><i class="fa fa-times"></i> No Data</center></td>
                        </tr>';   
            }
    
            echo json_encode($html);
        }
    
        public function overheadShadesActionChange(Request $request)
        {
            if($_GET['state'] == "yes")
            {
                $state = "no";
            }
            else if($_GET['state'] == "no")
            {
                $state = "yes";
            }
            $changeQuery = PickPostLengthModel::where('id',$_GET['id'])->update(['admin_action' => $state]);
            if($changeQuery)
            {
                $msg = "success";
            }
            else
            {
                $msg = "error";
            }
    
            echo json_encode($msg);
        }


        // del fx
        public function delActionChange(Request $request)
        {
            $changeQuery = PickPostLengthModel::where('id',$_GET['id'])->delete();
            if($changeQuery)
            {
                $msg = "success";
            }
            else
            {
                $msg = "error";
            }

            echo json_encode($msg);
        }

        // view edit fx
        public function viewEditActionChange(Request $request)
        {
            $editQuery = PickPostLengthModel::where('id',$_GET['id'])->get();
            foreach($editQuery as $eQuery)
            {
                    $postQuery = PickUpFootPrintModel::where(['width_master' => $eQuery->master_width, 'height_master' => $eQuery->master_height, 'wood_type_id' => $eQuery->wood_type_id ])->get();
                        $html['master_posts'] = '<option value="">Choose posts</option>';
                        if(count($postQuery) > 0)
                        {
                            
                            foreach($postQuery as $pQuery)
                            {
                                $selected = "";
                                if($pQuery->posts_master == $eQuery->master_post)
                                {
                                    $selected = "selected";
                                }
                                $getPostQuery = PillerPostModel::where(['id' => $pQuery->posts_master])->get();
                                foreach($getPostQuery as $gPQuery)
                                {
                                    
                                    $html['master_posts'] .= '<option value="'.$gPQuery->id.'" '.$selected.'>'.$gPQuery->no_of_posts.'</option>';
                                }
                                
                            }
                        }

                    // master height
                    $fetchMasterHeight = MasterHeightModel::get();
                    $html['master_height'] = '<option value="">Choose height</option>';
                    if(count($fetchMasterHeight) > 0)
                    {
                        
                        foreach($fetchMasterHeight as $fetchH)
                        {
                            $selected1 = "";
                            if($fetchH->id == $eQuery->master_height)
                            {
                                $selected1 = "selected";
                            }
                            $html['master_height'] .= '<option value="'.$fetchH->id.'" '.$selected1.'>'.$fetchH->master_height_length.'</option>';
                        }
                    }

                    // master width
                    $fetchMasterWidth = MasterWidthModel::get();
                    $html['master_width'] = '<option value="">Choose width</option>';
                    if(count($fetchMasterWidth) > 0)
                    {
                        
                        foreach($fetchMasterWidth as $fetchW)
                        {
                            $selected2 = "";
                            if($fetchW->id == $eQuery->master_width)
                            {
                                $selected2 = "selected";
                            }
                            $html['master_width'] .= '<option value="'.$fetchW->id.'" '.$selected2.'>'.$fetchW->master_width_length.'</option>';
                        }
                    }

                    
                    

                    // master overhead Shade
                    $postQuery1 = PickOverheadShadesModel::where(['master_width' => $eQuery->master_width, 'master_height' => $eQuery->master_height, 'master_post' => $eQuery->master_post, 'wood_type_id' => $eQuery->wood_type_id])->get();
                    $html['master_overhead_shades'] = '<option value="">Choose Overhead Shades</option>';
                    if(count($postQuery1) > 0)
                    {
                        foreach($postQuery1 as $pQuery1)
                        {
                            $selected3 = "";
                            if($pQuery1->master_overhead_shades == $eQuery->master_overhead_shades)
                            {
                                $selected3 = "selected";
                            }
                            $getPostQuery1 = MasterOverheadModel::where(['id' => $pQuery1->master_overhead_shades])->get();
                            foreach($getPostQuery1 as $gPQuery1)
                            {
                                
                                $html['master_overhead_shades'] .= '<option value="'.$gPQuery1->id.'" '.$selected3.'>'.$gPQuery1->overhead_shades_val.'</option>';
                            }
                            
                        }
                    }

                    $fetchMasterPostQuery = MasterPostLengthModel::get();
                    $html['master_post_length_data'] = '<option value="">Choose pick post length</option>';
                    if(count($fetchMasterPostQuery) > 0)
                    {
                        foreach($fetchMasterPostQuery as $mFtechQuery)
                        {
                            $selected4 = "";
                            if($mFtechQuery->id == $eQuery->posts_length)
                            {
                                $selected4 = "selected";
                            }
                            $html['master_post_length_data'] .= '<option value="'.$mFtechQuery->id.'" '.$selected4.'>'.$mFtechQuery->master_post_length.' ft.</option>';
                        }
                        
                    }

                    //  wood master
                    $masterWoodQuery = MasterWoodModel::where(['admin_action' => 'yes'])->get();
                    $html['master_wood_query'] = "<option value=''>Choose Wood Query</option>";
                    if(count($masterWoodQuery) > 0)
                    {
                        foreach($masterWoodQuery as $mWquery)
                        {
                            $selected7 = "";
                                if($mWquery->id == $eQuery->wood_type_id)
                                {
                                    $selected7 = "selected";
                                }
                                
                                $html['master_wood_query'] .= '<option value="'.$mWquery->id.'" '.$selected7.'>'.$mWquery->wood_name.'</option>';
                        }
                    }

                    $html['price_details'] = $eQuery->price_details;
                    $html['img_details'] = '<img src="'.asset(str_replace('public','storage/app/public',$eQuery->img_file)).'" alt="no image" width="100px"/>';
            }
            echo json_encode($html);
        }

        // edit fx
        public function editActionChange(Request $request, $edit_id)
        {
            $checkQuery = PickPostLengthModel::where('id','!=',$edit_id)->where(['master_width' => $request->input('master_width'), 'master_height' => $request->input('master_height'), 'master_post' => $request->input('master_post'), 'posts_length' => $request->input('post_length'), 'master_overhead_shades' => $request->input('ladder_spacing'), 'wood_type_id' => $request->input('wood_types_name') ])->get();
            if(count($checkQuery) > 0)
            {
                $request->session()->flash('error_msg', 'This post length already added before');
                return redirect()->back();
            }
            else
            {
                    if($request->hasFile('post_length_file'))
                    {
                        $our_story_img = $request->file('post_length_file')->store('public/post_length');
                        $insertArr = [
                            'master_width' => $request->input('master_width'),
                            'master_height' => $request->input('master_height'),
                            'master_post' => $request->input('master_post'),
                            'master_overhead_shades' => $request->input('ladder_spacing'),
                            'posts_length' => $request->input('post_length'),
                            'price_details' => $request->input('post_length_price'), 
                            'wood_type_id' => $request->input('wood_types_name'),
                            'img_file' => $our_story_img, 
                            'admin_action' => 'yes', 
                            'updated_at' => date('Y-m-d H:i:s')
                            
                        ];
                        $insertQuery = PickPostLengthModel::where('id',$edit_id)->update($insertArr);
                    }
                    else
                    {
                        $insertArr = [
                            'master_width' => $request->input('master_width'),
                            'master_height' => $request->input('master_height'),
                            'master_post' => $request->input('master_post'),
                            'master_overhead_shades' => $request->input('ladder_spacing'),
                            'posts_length' => $request->input('post_length'),
                            'price_details' => $request->input('post_length_price'), 
                            'wood_type_id' => $request->input('wood_types_name'),
                            'admin_action' => 'yes', 
                            'updated_at' => date('Y-m-d H:i:s')
                            
                        ];
                        $insertQuery = PickPostLengthModel::where('id',$edit_id)->update($insertArr);
                    }
    
                
    
                    
                    if($insertQuery)
                    {
                        $request->session()->flash('success_msg', 'Successfully Updated ');
                    }
                    else
                    {
                        $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
                    }
                    return redirect()->back();
            }
        }


        // wood types 
        public function wood_types_fx(Request $request)
        {
            $selectWood = MasterWoodModel::where(['admin_action' => 'yes'])->get();
            $html['wood_types_name'] = "<option value=''>Choose wood types</option>";
            if(count($selectWood) > 0)
            {
                foreach($selectWood as $sWood)
                {
                    $html['wood_types_name'] .= "<option value='".$sWood->id."'>".$sWood->wood_name."</option>";
                }
            }

            echo json_encode($html);
        }




        /* pick a post length */

        public function pickPostLengthFx(Request $request)
        {
            $post_id = $_GET['post_id'];
            $width_id = $_GET['width_val'];
            $height_id = $_GET['height_val'];

            //  width model 
            $selectWidth = MasterWidthModel::where(['id' => $width_id])->get();
            foreach($selectWidth as $sWidth)
            {
                $width_length = $sWidth->master_width_length;
            }

            // height model
            $selectHeight = MasterHeightModel::where(['id' => $height_id])->get();
            foreach($selectHeight as $sHeight)
            {
                $height_length = $sHeight->master_height_length;
            }

            // piller model
            $selectPost = PillerPostModel::where(['id' => $post_id])->get();
            foreach($selectPost as $sPost)
            {
                $post_numbers = $sPost->no_of_posts;
            }


            $html['post_l'] = $post_numbers;

            if($post_numbers === 4 || $post_numbers === "4")
            {
                $price4Query = ConfigModel::where(['id' => 1])->get();
                foreach($price4Query as $p4Price)
                {
                    $price = $p4Price->post4_price;
                }
                $html['main_price'] = $width_length*$height_length*$price;
                $main_price = $width_length*$height_length*$price;
            }
            else if($post_numbers === "4 double")
            {
                $price4dQuery = ConfigModel::where(['id' => 1])->get();
                foreach($price4dQuery as $p4Priced)
                {
                    $price = $p4Priced->post4_price;
                    $price4d = $p4Priced->post4double_price;
                }
                $html['lmain_price'] = $price4d;
                $html['main_price'] = (($width_length*$height_length*$price)+$price4d);
                $main_price = (($width_length*$height_length*$price)+$price4d);
            }
            else if($post_numbers == '6' || $post_numbers == 6)
            {
                $price6Query = ConfigModel::where(['id' => 1])->get();
                foreach($price6Query as $p6Price)
                {
                    $price = $p6Price->post6_price;
                }
                $html['main_price'] = $width_length*$height_length*$price;
                $main_price = $width_length*$height_length*$price;
            }
            else if($post_numbers == '8' || $post_numbers == 8)
            {
                $price4Query = ConfigModel::where(['id' => 1])->get();
                foreach($price4Query as $p4Price)
                {
                    $price = $p4Price->post6_price;
                    $price8 = $p4Price->post8_price;
                }
                $html['main_price'] = (($width_length*$height_length*$price)+$price8);
                $main_price = (($width_length*$height_length*$price)+$price8);
            }

            // overhead shades
            $pickPostLengthQ = MasterPostLengthModel::where('id',$_GET['master_post_length'])->get();
            foreach($pickPostLengthQ as $pickLengthQ)
            {
                $pickPostLengthQData = $pickLengthQ->master_post_length;
            }

            if($pickPostLengthQData == 9)
            {
                $configOverQ = ConfigPostLengthModel::where(['id' => 1])->get();
                if(count($configOverQ) > 0)
                {
                    foreach($configOverQ as $cOQ)
                    {
                        $html['last_main_price'] = (($main_price * $cOQ->post9Length_price)/100);
                    }
                }
            }
            else if($pickPostLengthQData == 12)
            {
                $configOverQ = ConfigPostLengthModel::where(['id' => 1])->get();
                if(count($configOverQ) > 0)
                {
                    foreach($configOverQ as $cOQ)
                    {
                        $html['last_main_price'] = (($main_price * $cOQ->post12Length_price)/100);
                    }
                }
            }

            echo json_encode($html);
        }
}
