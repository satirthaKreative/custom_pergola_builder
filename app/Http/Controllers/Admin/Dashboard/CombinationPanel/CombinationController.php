<?php

namespace App\Http\Controllers\Admin\Dashboard\CombinationPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\CombinationModel\CombinationModel;
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

class CombinationController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.pages.combination-product.combination-product');
    }

    /* config combination function */
    public function configCombinationFx(Request $request)
    {
        
                $mainQuery = PickPostLengthModel::where('id',$_GET['combination_id'])->get();
                foreach($mainQuery as $mQuery)
                {
                    $heightQuery = MasterHeightModel::where(['id' => $mQuery->master_height])->get();
                    foreach($heightQuery as $hQuery)
                    {
                        $height_length = $hQuery->master_height_length;
                    }

                    $widthQuery = MasterWidthModel::where(['id' => $mQuery->master_width])->get();
                    foreach($widthQuery as $wQuery)
                    {
                        $width_length = $wQuery->master_width_length;
                    }

                    $postQuery = PillerPostModel::where(['id' => $mQuery->master_post])->get();
                    foreach($postQuery as $pQuery)
                    {
                        $post_numbers = $pQuery->no_of_posts;
                    }

                    if($post_numbers === 4 || $post_numbers === "4")
                    {
                        $price4Query = ConfigModel::where(['id' => 1])->get();
                        foreach($price4Query as $p4Price)
                        {
                            $price = $p4Price->post4_price;
                        }
                        $html['main_price'] = $width_length*$height_length*$price;
                        $main_price = $width_length*$height_length*$price;
                        
                        // mount bracket price 
                        $mountBracketQuery = ConfigMountModel::where('id',1)->get();
                        if(count($mountBracketQuery) > 0)
                        {
                            foreach($mountBracketQuery as $mountQ)
                            {
                                $html['mount_bracket_price'] = $mountQ->mount_bracket4_price;
                            }
                        }

                        // canopy price
                        $canopyQuery = ConfigCanopyModel::where(['id' => 1])->get();
                        if(count($canopyQuery) > 0)
                        {
                            foreach($canopyQuery as $canopyQ)
                            {
                                $html['canopy_price'] = ($canopyQ->canopy_price*$height_length*$width_length);
                            }
                        }

                        // louvered price
                        $louveredQuery = ConfigLouveredModel::where(['id' => 1])->get();
                        if(count($louveredQuery) > 0)
                        {
                            foreach($louveredQuery as $louveredQ)
                            {
                                $html['louvered_panel_price'] = ($louveredQ->each_sqft_price*$height_length*$width_length);
                            }
                        }


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

                        // mount bracket price 
                        $mountBracketQuery = ConfigMountModel::where('id',1)->get();
                        if(count($mountBracketQuery) > 0)
                        {
                            foreach($mountBracketQuery as $mountQ)
                            {
                                $html['mount_bracket_price'] = $mountQ->mount_bracket4_price;
                            }
                        }

                        // canopy price
                        $canopyQuery = ConfigCanopyModel::where(['id' => 1])->get();
                        if(count($canopyQuery) > 0)
                        {
                            foreach($canopyQuery as $canopyQ)
                            {
                                $html['canopy_price'] = ($canopyQ->canopy_price*$height_length*$width_length);
                            }
                        }

                        // louvered price
                        $louveredQuery = ConfigLouveredModel::where(['id' => 1])->get();
                        if(count($louveredQuery) > 0)
                        {
                            foreach($louveredQuery as $louveredQ)
                            {
                                $html['louvered_panel_price'] = ($louveredQ->each_sqft_price*$height_length*$width_length);
                            }
                        }
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

                        // mount bracket price 
                        $mountBracketQuery = ConfigMountModel::where('id',1)->get();
                        if(count($mountBracketQuery) > 0)
                        {
                            foreach($mountBracketQuery as $mountQ)
                            {
                                $html['mount_bracket_price'] = $mountQ->mount_bracket6_price;
                            }
                        }

                        // canopy price
                        $canopyQuery = ConfigCanopyModel::where(['id' => 1])->get();
                        if(count($canopyQuery) > 0)
                        {
                            foreach($canopyQuery as $canopyQ)
                            {
                                $html['canopy_price'] = ($canopyQ->canopy_price*$height_length*$width_length);
                            }
                        }

                        // louvered price
                        $louveredQuery = ConfigLouveredModel::where(['id' => 1])->get();
                        if(count($louveredQuery) > 0)
                        {
                            foreach($louveredQuery as $louveredQ)
                            {
                                $html['louvered_panel_price'] = ($louveredQ->each_sqft_price*$height_length*$width_length);
                            }
                        }
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

                        // mount bracket price 
                        $mountBracketQuery = ConfigMountModel::where('id',1)->get();
                        if(count($mountBracketQuery) > 0)
                        {
                            foreach($mountBracketQuery as $mountQ)
                            {
                                $html['mount_bracket_price'] = $mountQ->mount_bracket8_price;
                            }
                        }

                        // canopy price
                        $canopyQuery = ConfigCanopyModel::where(['id' => 1])->get();
                        if(count($canopyQuery) > 0)
                        {
                            foreach($canopyQuery as $canopyQ)
                            {
                                $html['canopy_price'] = ($canopyQ->canopy_price*$height_length*$width_length);
                            }
                        }

                        // louvered price
                        $louveredQuery = ConfigLouveredModel::where(['id' => 1])->get();
                        if(count($louveredQuery) > 0)
                        {
                            foreach($louveredQuery as $louveredQ)
                            {
                                $html['louvered_panel_price'] = ($louveredQ->each_sqft_price*$height_length*$width_length);
                            }
                        }
                    }

                    

                }
        echo json_encode($html);
    }
    /* end of config combination function */

    public function showActualData(Request $request)
    {
        $mainQuery = PickPostLengthModel::orderBy('master_width','asc')->get();
        if(count($mainQuery) > 0)
        {
            $html['combination_data'] = "<option value=''>choose combination</option>";
            foreach($mainQuery as $mQuery)
            {
                $heightQuery = MasterHeightModel::where(['id' => $mQuery->master_height])->get();
                foreach($heightQuery as $hQuery)
                {
                    $mainHeight = $hQuery->master_height_length;
                }

                $widthQuery = MasterWidthModel::where(['id' => $mQuery->master_width])->get();
                foreach($widthQuery as $wQuery)
                {
                    $mainWidth = $wQuery->master_width_length;
                }

                $postQuery = PillerPostModel::where(['id' => $mQuery->master_post])->get();
                foreach($postQuery as $pQuery)
                {
                    $mainPost = $pQuery->no_of_posts;
                }

                $overHeadQuery = MasterOverheadModel::where(['id' => $mQuery->master_overhead_shades])->get();
                foreach($overHeadQuery as $ohQuery)
                {
                    $mainOverhead = $ohQuery->overhead_shades_val;
                }

                $postLengthQuery = MasterPostLengthModel::where(['id' => $mQuery->posts_length])->get();
                foreach($postLengthQuery as $phQuery)
                {
                    $mainPostLength = $phQuery->master_post_length;
                }

                $woodQuery = MasterWoodModel::where(['id' => $mQuery->wood_type_id])->get();
                $wood_full_name = "No wood type";
                if(count($woodQuery) > 0)
                {
                    foreach($woodQuery as $wQuery)
                    {
                        $wood_full_name = $wQuery->wood_name;
                    }
                }
                
                $html['combination_data'] .= "<option value='".$mQuery->id."'>".$mainHeight." ft. height X ".$mainWidth." ft. width X ".$mainPost." post X ".$mainPostLength." L X ".$mainOverhead." Overhead Shades (".$wood_full_name.")</option>";
            }

            

           
        }
        echo  json_encode($html);
    }

    public function addActualData(Request $request)
    {
        $combination_panel_val = $request->input('combination_name');

        $exist_price = $request->input('exist_price');
        
        $canopy_price = $request->input('canopy_price');

        $left_price = $request->input('lpanel_price');

        $mainQuery = CombinationModel::where('combination_id',$combination_panel_val)->get();
        if(count($mainQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This combination already added before');
            return redirect()->back();
        }
        else 
        {
            $insertArr = [
                'combination_id' => $combination_panel_val, 
                'existing_price' => $exist_price, 
                'canopy_price' => $canopy_price, 
                'left_price' => $left_price, 
                'created_at' => date('y-m-d'), 
                'updated_at' => date('Y-m-d')
            ];

            $insertQuery = CombinationModel::insert($insertArr);
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

    public function show_l_panel_data_fx(Request $request)
    {
        $finalQuery = CombinationModel::all();
        $html['finalCombination'] = "";
        $i = 0;
        foreach($finalQuery as $fQuery)
        {
            $mainQuery = PickPostLengthModel::where('id',$fQuery->combination_id)->get();
            if(count($mainQuery) > 0)
            {
                foreach($mainQuery as $mQuery)
                {
                    $heightQuery = MasterHeightModel::where(['id' => $mQuery->master_height])->get();
                    foreach($heightQuery as $hQuery)
                    {
                        $mainHeight = $hQuery->master_height_length;
                    }

                    $widthQuery = MasterWidthModel::where(['id' => $mQuery->master_width])->get();
                    foreach($widthQuery as $wQuery)
                    {
                        $mainWidth = $wQuery->master_width_length;
                    }

                    $postQuery = PillerPostModel::where(['id' => $mQuery->master_post])->get();
                    foreach($postQuery as $pQuery)
                    {
                        $mainPost = $pQuery->no_of_posts;
                    }

                    $overHeadQuery = MasterOverheadModel::where(['id' => $mQuery->master_overhead_shades])->get();
                    foreach($overHeadQuery as $ohQuery)
                    {
                        $mainOverhead = $ohQuery->overhead_shades_val;
                    }

                    $postLengthQuery = MasterPostLengthModel::where(['id' => $mQuery->posts_length])->get();
                    foreach($postLengthQuery as $phQuery)
                    {
                        $mainPostLength = $phQuery->master_post_length;
                    }
                    $combination_html = $mainHeight." ft. height X ".$mainWidth." ft. width X ".$mainPost." post X ".$mainPostLength." L X ".$mainOverhead." Overhead Shades";
                    
                    $woodQuery = MasterWoodModel::where(['id' => $mQuery->wood_type_id])->get();
                    $wood_full_name = "No wood type";
                    if(count($woodQuery) > 0)
                    {
                        foreach($woodQuery as $wQuery)
                        {
                            $wood_full_name = $wQuery->wood_name;
                        }
                    }
                }

            
            }

            // mount price
            $new_price = $fQuery->new_price;
            $exist_price = $fQuery->existing_price;

            // canopy details
            $canopy_price = $fQuery->canopy_price;
            $canopy_details = $fQuery->canopy_list;

            // lpanel 
            $left_price = $fQuery->left_price;
            $right_price = $fQuery->right_price;
            $rear_price = $fQuery->rear_price;
            $left_rear_price = $fQuery->left_rear_price;
            $right_rear_price = $fQuery->right_rear_price;
            $left_right_rear_price = $fQuery->left_right_rear_price;

                if($fQuery->admin_action == 'yes' )
                {
                    $status = '<span class="text-success"><i class="fa fa-check"></i> Active</span>';
                    $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$fQuery->admin_action.'",'.$fQuery->id.') class="btn btn-sm btn-danger">Make it In-Active</a>';
                }
                else if($fQuery->admin_action == 'no' )
                {
                    $status = '<span class="text-danger"><i class="fa fa-times"></i> Deactive</span>';
                    $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$fQuery->admin_action.'",'.$fQuery->id.') class="btn btn-sm btn-success">Make it Active</a>';
                }
                else
                {

                }

                


                $del_state = '<a href="javascript: ;" onclick=make_del_change('.$fQuery->id.') class="text-danger"><i class="fa fa-trash"></i></a>';

                $edit_state = '<a href="javascript: ;" onclick=make_edit_change('.$fQuery->id.') class="text-info"><i class="fa fa-edit"></i></a>';
                $html['finalCombination'] .= '<tr>
                                                <td>'.++$i.'</td>
                                                <td>'.$combination_html.'<br /> ('.$wood_full_name.')</td>
                                                
                                                <td>'.$status.'</td>
                                                <td>'.$action_btn.' '.$edit_state.' '.$del_state.'</td>
                                            </tr>';
        }

        echo json_encode($html);
    }

    public function edit_combination_panel(Request $request)
    {
        $edit_id = $_GET['id'];

        $finalQuery = CombinationModel::where('id',$edit_id)->get();
        foreach($finalQuery as $fQuery)
        {
            $mainQuery = PickPostLengthModel::get();
            if(count($mainQuery) > 0)
            {
                $html['combination_data'] = "<option value=''>choose combination</option>";
                foreach($mainQuery as $mQuery)
                {
                    $selected = "";
                    if($mQuery->id == $fQuery->combination_id)
                    {
                        $selected = "selected";
                    }
                    $heightQuery = MasterHeightModel::where(['id' => $mQuery->master_height])->get();
                    foreach($heightQuery as $hQuery)
                    {
                        $mainHeight = $hQuery->master_height_length;
                    }

                    $widthQuery = MasterWidthModel::where(['id' => $mQuery->master_width])->get();
                    foreach($widthQuery as $wQuery)
                    {
                        $mainWidth = $wQuery->master_width_length;
                    }

                    $postQuery = PillerPostModel::where(['id' => $mQuery->master_post])->get();
                    foreach($postQuery as $pQuery)
                    {
                        $mainPost = $pQuery->no_of_posts;
                    }

                    $overHeadQuery = MasterOverheadModel::where(['id' => $mQuery->master_overhead_shades])->get();
                    foreach($overHeadQuery as $ohQuery)
                    {
                        $mainOverhead = $ohQuery->overhead_shades_val;
                    }

                    $postLengthQuery = MasterPostLengthModel::where(['id' => $mQuery->posts_length])->get();
                    foreach($postLengthQuery as $phQuery)
                    {
                        $mainPostLength = $phQuery->master_post_length;
                    }

                    $woodQuery = MasterWoodModel::where(['id' => $mQuery->wood_type_id])->get();
                    $wood_full_name = "No wood type";
                    if(count($woodQuery) > 0)
                    {
                        foreach($woodQuery as $wQuery)
                        {
                            $wood_full_name = $wQuery->wood_name;
                        }
                    }
                    
                    $html['combination_data'] .= "<option value='".$mQuery->id."' ".$selected." >".$mainHeight." ft. height X ".$mainWidth." ft. width X ".$mainPost." post X ".$mainPostLength." L X ".$mainOverhead." Overhead Shades (".$wood_full_name.")</option>";
                }

            
            }


            // mount price
            $html['exist_price'] = $fQuery->existing_price;

            // canopy details
            $html['canopy_price'] = $fQuery->canopy_price;

            // lpanel 
            $html['left_price'] = $fQuery->left_price;


        } 

        echo json_encode($html);
    }


    public function submit_combination_panel(Request $request, $my_data)
    {
        $combination_panel_val = $request->input('combination_name');

        $exist_price = $request->input('exist_price');

        $canopy_price = $request->input('canopy_price');

        $left_price = $request->input('lpanel_price');

        $mainQuery = CombinationModel::where('id','!=',$my_data)->where('combination_id',$combination_panel_val)->get();
        if(count($mainQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This combination already added before');
            return redirect()->back();
        }
        else 
        {
            $insertArr = [
                'combination_id' => $combination_panel_val, 
                'existing_price' => $exist_price,  
                'canopy_price' => $canopy_price, 
                'left_price' => $left_price, 
                'created_at' => date('y-m-d'), 
                'updated_at' => date('Y-m-d')
            ];

            $insertQuery = CombinationModel::where('id',$my_data)->update($insertArr);
            if($insertQuery)
            {
                $request->session()->flash('success_msg', 'Successfully updated ');
            }
            else
            {
                $request->session()->flash('error_msg', 'Something went wrong ! Try  again later');
            }
            return redirect()->back();
        }


    }


    public function edit_combination_action_change(Request $request)
    {
        if($_GET['state'] == "yes")
        {
            $state = "no";
        }
        else if($_GET['state'] == "no")
        {
            $state = "yes";
        }
        $changeQuery = CombinationModel::where('id',$_GET['id'])->update(['admin_action' => $state]);
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

    public function del_combination_panel(Request $request)
    {
        $changeQuery = CombinationModel::where('id',$_GET['id'])->delete();
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
}
