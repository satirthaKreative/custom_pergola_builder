<?php

namespace App\Http\Controllers\Admin\Dashboard\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Config\ConfigModel;
use App\Model\Config\ConfigOverheadShadesModel;
use App\Model\Config\ConfigPostLengthModel;
use App\Model\Config\ConfigCanopyModel;
use App\Model\Config\ConfigLouveredModel;
use App\Model\Config\ConfigMountModel;



use App\Model\Admin\FinalProduct\FinalProductModel;
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

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function showPage(Request $request)
    {
        return view('backend.pages.config-page.config-page');
    }

    /// config wood type
    public function load_config_wood_fx(Request $request)
    {
        $woodQuery = MasterWoodModel::all();
        
        $html['wood_html'] = '<option value="">Choose wood type</option>';
        if(count($woodQuery) > 0)
        {
            foreach($woodQuery as $wQuery)
            {
                $html['wood_html'] .= '<option value="'.$wQuery->id.'">'.$wQuery->wood_name.'</option>';
            }
        }
        echo json_encode($html);
    }

    public function load_all_config_wood_fx(Request $request)
    {
        $html['post4_price'] = "";
        $html['post4d_price'] = "";
        $html['post6_price'] = "";
        $html['post8_price'] = "";
        $html['less100_price'] = "";
        $html['less100150_price'] = "";
        $html['greater150_price'] = "";

        $html['open_price'] = "";
        $html['regular_price'] = "";
        $html['sunblocker_price'] = "";

        $html['post9_price'] = "";
        $html['post12_price'] = "";

        $html['mount_bracket4_price'] = "";
        $html['mount_bracket6_price'] = "";
        $html['mount_bracket8_price'] = "";

        $html['canopy_price'] = "";

        $html['lpanel_price'] = "";
        // config pick a footprint
        $configPickFootprintQuery = ConfigModel::where(['wood_id' => $_GET['wood_id'] ])->get();
        if(count($configPickFootprintQuery) > 0)
        {
            foreach($configPickFootprintQuery as $configPFoot)
            {
                $html['post4_price'] = $configPFoot->post4_price;
                $html['post4d_price'] = $configPFoot->post4double_price;
                $html['post6_price'] = $configPFoot->post6_price;
                $html['post8_price'] = $configPFoot->post8_price;
                $html['less100_price'] = $configPFoot->less100_price;
                $html['less100150_price'] = $configPFoot->less100150_price;
                $html['greater150_price'] = $configPFoot->greater150_price;
            }
        }
        // config pick a overhead shades
        $configOverheadQuery = ConfigOverheadShadesModel::where(['wood_id' => $_GET['wood_id'] ])->get();
        if(count($configOverheadQuery) > 0)
        {
            foreach($configOverheadQuery as $configPOverhead)
            {
                $html['open_price'] = $configPOverhead->open_price;
                $html['regular_price'] = $configPOverhead->regular_price;
                $html['sunblocker_price'] = $configPOverhead->sunblocker_price;
            }
        }
        // config pick post length
        $configPickPostQuery = ConfigPostLengthModel::where(['wood_id' => $_GET['wood_id'] ])->get();
        if(count($configPickPostQuery) > 0)
        {
            foreach($configPickPostQuery as $configPPickPost)
            {
                $html['post9_price'] = $configPPickPost->post9Length_price;
                $html['post12_price'] = $configPPickPost->post12Length_price;
            }
        }
        // config canopy
        $configCanopyQuery = ConfigCanopyModel::where(['wood_id' => $_GET['wood_id'] ])->get();
        if(count($configCanopyQuery) > 0)
        {
            foreach($configCanopyQuery as $configPCanopy)
            {
                $html['canopy_price'] = $configPCanopy->canopy_price;
            }
        }
        // config louvered panel
        $configLouveredQuery = ConfigLouveredModel::where(['wood_id' => $_GET['wood_id'] ])->get();
        if(count($configLouveredQuery) > 0)
        {
            foreach($configLouveredQuery as $configPLpanel)
            {
                $html['lpanel_price'] = $configPLpanel->each_sqft_price;
            }
        }
        // config mount bracket
        $configMountBracketQuery = ConfigMountModel::where(['wood_id' => $_GET['wood_id'] ])->get();
        if(count($configMountBracketQuery) > 0)
        {
            foreach($configMountBracketQuery as $configPMount)
            {
                $html['mount_bracket4_price'] = $configPMount->mount_bracket4_price;
                $html['mount_bracket6_price'] = $configPMount->mount_bracket6_price;
                $html['mount_bracket8_price'] = $configPMount->mount_bracket8_price;
            }
        }

        echo json_encode($html);
    }

    public function update_config_fx(Request $request)
    {
        $countPickUp = ConfigModel::where('wood_id',$_GET['wood_id'])->count();
        $countOverhead = ConfigOverheadShadesModel::where('wood_id',$_GET['wood_id'])->count();
        $countPickPost = ConfigPostLengthModel::where('wood_id',$_GET['wood_id'])->count();
        $countBrackets = ConfigMountModel::where('wood_id',$_GET['wood_id'])->count();
        $countCanopy = ConfigCanopyModel::where('wood_id',$_GET['wood_id'])->count();
        $countLpanel = ConfigLouveredModel::where('wood_id',$_GET['wood_id'])->count();

        if($countPickPost == 0 && $countOverhead == 0 && $countPickPost == 0 && $countBrackets == 0 && $countCanopy == 0 && $countLpanel == 0)
        {
            $insertArrforFootprint = [
                'post4_price' => $_GET['post4_price'], 
                'post4double_price' => $_GET['post4d_price'], 
                'post6_price' => $_GET['post6_price'], 
                'post8_price' => $_GET['post8_price'],
                'less100_price' => $_GET['less100_price'],
                'less100150_price' => $_GET['less100150_price'],
                'greater150_price' => $_GET['greater150_price'],
                'wood_id' =>  $_GET['wood_id']
            ];

            $insertQueryFootprint = ConfigModel::insert($insertArrforFootprint);

            $insertArrforOverhead = [
                'regular_price' => $_GET['regular_price'], 
                'open_price' => $_GET['open_price'], 
                'sunblocker_price' => $_GET['sunblocker_price'],
                'wood_id' => $_GET['wood_id']
            ];

            $insertQueryOverhead = ConfigOverheadShadesModel::insert($insertArrforOverhead);

            $insertArrforPostLength = [
                'post9Length_price' => $_GET['post9_price'], 
                'post12Length_price' => $_GET['post12_price'], 
                'wood_id' => $_GET['wood_id']
            ];

            $insertQueryPostLength = ConfigPostLengthModel::insert($insertArrforPostLength);

            $insertArrforBrackets = [
                'mount_bracket4_price' => $_GET['bracket4_price'], 
                'mount_bracket6_price' => $_GET['bracket6_price'], 
                'mount_bracket8_price' => $_GET['bracket8_price'], 
                'wood_id' => $_GET['wood_id']
            ];
            $insertQueryBrackets = ConfigMountModel::insert($insertArrforBrackets);

            $insertArrforCanopy = [
                'canopy_price' => $_GET['canopy_price'], 
                'wood_id' => $_GET['wood_id']
            ];

            $insertQueryCanopy = ConfigCanopyModel::insert($insertArrforCanopy);

            $insertArrforLpanel = [
                'each_sqft_price' => $_GET['lpnael_price'], 
                'wood_id' => $_GET['wood_id']
            ];

            $insertQueryLpanel = ConfigLouveredModel::insert($insertArrforLpanel);

            if($insertQueryFootprint && $insertQueryLpanel && $insertQueryBrackets && $insertQueryOverhead && $insertQueryCanopy && $insertQueryPostLength)
            {
                $msg = "insertSuccess";
            }
            else
            {
                $msg = "insertError";
            }
        }
        else
        {
            $insertArrforFootprint = [
                'post4_price' => $_GET['post4_price'], 
                'post4double_price' => $_GET['post4d_price'], 
                'post6_price' => $_GET['post6_price'], 
                'post8_price' => $_GET['post8_price'],
                'less100_price' => $_GET['less100_price'],
                'less100150_price' => $_GET['less100150_price'],
                'greater150_price' => $_GET['greater150_price'],
            ];

            $insertQueryFootprint = ConfigModel::where(['wood_id' =>  $_GET['wood_id']])->update($insertArrforFootprint);

            $insertArrforOverhead = [
                'regular_price' => $_GET['regular_price'], 
                'open_price' => $_GET['open_price'], 
                'sunblocker_price' => $_GET['sunblocker_price'],
            ];

            $insertQueryOverhead = ConfigOverheadShadesModel::where(['wood_id' =>  $_GET['wood_id']])->update($insertArrforOverhead);

            $insertArrforPostLength = [
                'post9Length_price' => $_GET['post9_price'], 
                'post12Length_price' => $_GET['post12_price'], 
            ];

            $insertQueryPostLength = ConfigPostLengthModel::where(['wood_id' =>  $_GET['wood_id']])->update($insertArrforPostLength);

            $insertArrforBrackets = [
                'mount_bracket4_price' => $_GET['bracket4_price'], 
                'mount_bracket6_price' => $_GET['bracket6_price'], 
                'mount_bracket8_price' => $_GET['bracket8_price'], 
            ];
            $insertQueryBrackets = ConfigMountModel::where(['wood_id' =>  $_GET['wood_id']])->update($insertArrforBrackets);

            $insertArrforCanopy = [
                'canopy_price' => $_GET['canopy_price'], 
            ];

            $insertQueryCanopy = ConfigCanopyModel::where(['wood_id' =>  $_GET['wood_id']])->update($insertArrforCanopy);

            $insertArrforLpanel = [
                'each_sqft_price' => $_GET['lpnael_price'], 
            ];

            $insertQueryLpanel = ConfigLouveredModel::where(['wood_id' =>  $_GET['wood_id']])->update($insertArrforLpanel);

            if($insertQueryFootprint && $insertQueryLpanel && $insertQueryBrackets && $insertQueryOverhead && $insertQueryCanopy && $insertQueryPostLength)
            {
                $msg = "updateSuccess";
            }
            else
            {
                $msg = "updateError";
            }
        }

        echo json_encode($msg);
    }
    /// end of config wood type

    // mount bracket
    // public function submit_mount4_config_fx(Request $request)
    // {
    //     $checkQuery = ConfigMountModel::all();
    //     if(count($checkQuery) > 0)
    //     {
    //         $updateArr = [
    //             'mount_bracket4_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigMountModel::where('id',1)->update($updateArr);
    //     }
    //     else if(count($checkQuery) == 0)
    //     {
    //         $insertArr = [
    //             'mount_bracket4_price' => $_GET['price_val'],
    //             'mount_bracket6_price' => 0,
    //             'mount_bracket8_price' => 0,
    //         ];
    //         $mainQuery = ConfigMountModel::insert($insertArr);
    //     }

    //     $msg = "error";
    //     if($mainQuery)
    //     {
    //         // mount Panel 
    //         $showPickPostLengthQuery = PickPostLengthModel::get();
    //         if(count($showPickPostLengthQuery) > 0)
    //         {
    //             foreach($showPickPostLengthQuery as $showPPLQuery)
    //             {
    //                 $heightQuery = MasterHeightModel::where(['id' => $showPPLQuery->master_height])->get();
    //                 foreach($heightQuery as $hQuery)
    //                 {
    //                     $height_length = $hQuery->master_height_length;
    //                 }

    //                 $widthQuery = MasterWidthModel::where(['id' => $showPPLQuery->master_width])->get();
    //                 foreach($widthQuery as $wQuery)
    //                 {
    //                     $width_length = $wQuery->master_width_length;
    //                 }

    //                 $postQuery = PillerPostModel::where(['id' => $showPPLQuery->master_post])->get();
    //                 foreach($postQuery as $pQuery)
    //                 {
    //                     $post_numbers = $pQuery->no_of_posts;
    //                 }

    //                 $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                 foreach($priceConfigPostQuery as $pConfigPrice4)
    //                 {
    //                     $priceC4 = $pConfigPrice4->post4_price;
    //                     $priceC4d = $pConfigPrice4->post4double_price;
    //                     $priceC6 = $pConfigPrice4->post6_price;
    //                     $priceC8 = $pConfigPrice4->post8_price;
    //                 } 

    //                 if($post_numbers === 4 || $post_numbers === "4" || $post_numbers === "4 double")
    //                 {
    //                     $mainMountPrice = $_GET['price_val'];
    //                     $updateMountPrice = [
    //                         'existing_price' => $mainMountPrice
    //                     ];
    //                     $mount_update_query = CombinationModel::where('combination_id',$showPPLQuery->id)->update($updateMountPrice);
    //                 }
                    
                        
    //             }
    //         }
    //         // end of mount panel

    //         $msg = "success";
    //     }

    //     echo json_encode($msg);
    // }

    // public function submit_mount6_config_fx(Request $request)
    // {
    //     $checkQuery = ConfigMountModel::all();
    //     if(count($checkQuery) > 0)
    //     {
    //         $updateArr = [
    //             'mount_bracket6_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigMountModel::where('id',1)->update($updateArr);
    //     }
    //     else if(count($checkQuery) == 0)
    //     {
    //         $insertArr = [
    //             'mount_bracket6_price' => $_GET['price_val'],
    //             'mount_bracket4_price' => 0,
    //             'mount_bracket8_price' => 0,
    //         ];
    //         $mainQuery = ConfigMountModel::insert($insertArr);
    //     }

    //     $msg = "error";
    //     if($mainQuery)
    //     {
    //                     // mount Panel 
    //                     $showPickPostLengthQuery = PickPostLengthModel::get();
    //                     if(count($showPickPostLengthQuery) > 0)
    //                     {
    //                         foreach($showPickPostLengthQuery as $showPPLQuery)
    //                         {
    //                             $heightQuery = MasterHeightModel::where(['id' => $showPPLQuery->master_height])->get();
    //                             foreach($heightQuery as $hQuery)
    //                             {
    //                                 $height_length = $hQuery->master_height_length;
    //                             }
            
    //                             $widthQuery = MasterWidthModel::where(['id' => $showPPLQuery->master_width])->get();
    //                             foreach($widthQuery as $wQuery)
    //                             {
    //                                 $width_length = $wQuery->master_width_length;
    //                             }
            
    //                             $postQuery = PillerPostModel::where(['id' => $showPPLQuery->master_post])->get();
    //                             foreach($postQuery as $pQuery)
    //                             {
    //                                 $post_numbers = $pQuery->no_of_posts;
    //                             }
            
    //                             $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                             foreach($priceConfigPostQuery as $pConfigPrice4)
    //                             {
    //                                 $priceC4 = $pConfigPrice4->post4_price;
    //                                 $priceC4d = $pConfigPrice4->post4double_price;
    //                                 $priceC6 = $pConfigPrice4->post6_price;
    //                                 $priceC8 = $pConfigPrice4->post8_price;
    //                             } 
            
    //                             if($post_numbers === 6 || $post_numbers === "6")
    //                             {
    //                                 $mainMountPrice = $_GET['price_val'];
    //                                 $updateMountPrice = [
    //                                     'existing_price' => $mainMountPrice
    //                                 ];
    //                                 $mount_update_query = CombinationModel::where('combination_id',$showPPLQuery->id)->update($updateMountPrice);
    //                             }
                                
                                    
    //                         }
    //                     }
    //                     // end of mount panel
    //         $msg = "success";
    //     }

    //     echo json_encode($msg);
    // }

    // public function submit_mount8_config_fx(Request $request)
    // {
    //     $checkQuery = ConfigMountModel::all();
    //     if(count($checkQuery) > 0)
    //     {
    //         $updateArr = [
    //             'mount_bracket8_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigMountModel::where('id',1)->update($updateArr);
    //     }
    //     else if(count($checkQuery) == 0)
    //     {
    //         $insertArr = [
    //             'mount_bracket8_price' => $_GET['price_val'],
    //             'mount_bracket6_price' => 0,
    //             'mount_bracket4_price' => 0,
    //         ];
    //         $mainQuery = ConfigMountModel::insert($insertArr);
    //     }

    //     $msg = "error";
    //     if($mainQuery)
    //     {
    //                     // mount Panel 
    //                     $showPickPostLengthQuery = PickPostLengthModel::get();
    //                     if(count($showPickPostLengthQuery) > 0)
    //                     {
    //                         foreach($showPickPostLengthQuery as $showPPLQuery)
    //                         {
    //                             $heightQuery = MasterHeightModel::where(['id' => $showPPLQuery->master_height])->get();
    //                             foreach($heightQuery as $hQuery)
    //                             {
    //                                 $height_length = $hQuery->master_height_length;
    //                             }
            
    //                             $widthQuery = MasterWidthModel::where(['id' => $showPPLQuery->master_width])->get();
    //                             foreach($widthQuery as $wQuery)
    //                             {
    //                                 $width_length = $wQuery->master_width_length;
    //                             }
            
    //                             $postQuery = PillerPostModel::where(['id' => $showPPLQuery->master_post])->get();
    //                             foreach($postQuery as $pQuery)
    //                             {
    //                                 $post_numbers = $pQuery->no_of_posts;
    //                             }
            
    //                             $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                             foreach($priceConfigPostQuery as $pConfigPrice4)
    //                             {
    //                                 $priceC4 = $pConfigPrice4->post4_price;
    //                                 $priceC4d = $pConfigPrice4->post4double_price;
    //                                 $priceC6 = $pConfigPrice4->post6_price;
    //                                 $priceC8 = $pConfigPrice4->post8_price;
    //                             } 
            
    //                             if($post_numbers === 8 || $post_numbers === "8")
    //                             {
    //                                 $mainMountPrice = $_GET['price_val'];
    //                                 $updateMountPrice = [
    //                                     'existing_price' => $mainMountPrice
    //                                 ];
    //                                 $mount_update_query = CombinationModel::where('combination_id',$showPPLQuery->id)->update($updateMountPrice);
    //                             }
                                
                                    
    //                         }
    //                     }
    //                     // end of mount panel
    //         $msg = "success";
    //     }

    //     echo json_encode($msg);
    // }
    // // louvered panel
    // public function submit_lpanel_config_fx(Request $request)
    // {
    //     $checkQuery = ConfigLouveredModel::all();
    //     if(count($checkQuery) > 0)
    //     {
    //         $updateArr = [
    //             'each_sqft_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigLouveredModel::where('id',1)->update($updateArr);
    //     }
    //     else if(count($checkQuery) == 0)
    //     {
    //         $insertArr = [
    //             'each_sqft_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigLouveredModel::insert($insertArr);
    //     }

    //     $msg = "error";
    //     if($mainQuery)
    //     {
    //         // Louvered Panel 
    //         $showPickPostLengthQuery = PickPostLengthModel::get();
    //         if(count($showPickPostLengthQuery) > 0)
    //         {
    //             foreach($showPickPostLengthQuery as $showPPLQuery)
    //             {
    //                 $heightQuery = MasterHeightModel::where(['id' => $showPPLQuery->master_height])->get();
    //                 foreach($heightQuery as $hQuery)
    //                 {
    //                     $height_length = $hQuery->master_height_length;
    //                 }

    //                 $widthQuery = MasterWidthModel::where(['id' => $showPPLQuery->master_width])->get();
    //                 foreach($widthQuery as $wQuery)
    //                 {
    //                     $width_length = $wQuery->master_width_length;
    //                 }

    //                 $postQuery = PillerPostModel::where(['id' => $showPPLQuery->master_post])->get();
    //                 foreach($postQuery as $pQuery)
    //                 {
    //                     $post_numbers = $pQuery->no_of_posts;
    //                 }

    //                 $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                 foreach($priceConfigPostQuery as $pConfigPrice4)
    //                 {
    //                     $priceC4 = $pConfigPrice4->post4_price;
    //                     $priceC4d = $pConfigPrice4->post4double_price;
    //                     $priceC6 = $pConfigPrice4->post6_price;
    //                     $priceC8 = $pConfigPrice4->post8_price;
    //                 } 

    //                 $mainlpanelPrice = $height_length*$width_length*($_GET['price_val']);
    //                 $updateLpanelPrice = [
    //                     'left_price' => $mainlpanelPrice
    //                 ];
    //                 $canopy_update_query = CombinationModel::where('combination_id',$showPPLQuery->id)->update($updateLpanelPrice);
                    
                        
    //             }
    //         }
    //         // end of lauvered panel
    //         $msg = "success";
    //     }

    //     echo json_encode($msg);
    // }
    // // canopy
    // public function submit_canopy_config_fx(Request $request)
    // {
    //     $checkQuery = ConfigCanopyModel::all();
    //     if(count($checkQuery) > 0)
    //     {
    //         $updateArr = [
    //             'canopy_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigCanopyModel::where('id',1)->update($updateArr);
    //     }
    //     else if(count($checkQuery) == 0)
    //     {
    //         $insertArr = [
    //             'canopy_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigCanopyModel::insert($insertArr);
    //     }

    //     $msg = "error";
    //     if($mainQuery)
    //     {
    //         // canopy 
    //         $showPickPostLengthQuery = PickPostLengthModel::get();
    //         if(count($showPickPostLengthQuery) > 0)
    //         {
    //             foreach($showPickPostLengthQuery as $showPPLQuery)
    //             {
    //                 $heightQuery = MasterHeightModel::where(['id' => $showPPLQuery->master_height])->get();
    //                 foreach($heightQuery as $hQuery)
    //                 {
    //                     $height_length = $hQuery->master_height_length;
    //                 }

    //                 $widthQuery = MasterWidthModel::where(['id' => $showPPLQuery->master_width])->get();
    //                 foreach($widthQuery as $wQuery)
    //                 {
    //                     $width_length = $wQuery->master_width_length;
    //                 }

    //                 $postQuery = PillerPostModel::where(['id' => $showPPLQuery->master_post])->get();
    //                 foreach($postQuery as $pQuery)
    //                 {
    //                     $post_numbers = $pQuery->no_of_posts;
    //                 }

    //                 $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                 foreach($priceConfigPostQuery as $pConfigPrice4)
    //                 {
    //                     $priceC4 = $pConfigPrice4->post4_price;
    //                     $priceC4d = $pConfigPrice4->post4double_price;
    //                     $priceC6 = $pConfigPrice4->post6_price;
    //                     $priceC8 = $pConfigPrice4->post8_price;
    //                 } 

    //                 $mainCanopyPrice = $height_length*$width_length*($_GET['price_val']);
    //                 $updateCanopyPrice = [
    //                     'canopy_price' => $mainCanopyPrice
    //                 ];
    //                 $canopy_update_query = CombinationModel::where('combination_id',$showPPLQuery->id)->update($updateCanopyPrice);
                    
                        
    //             }
    //         }
    //         // end of canopy
    //         $msg = "success";
    //     }

    //     echo json_encode($msg);
    // }

    // // post length 
    // public function submit_post9length_config_fx(Request $request)
    // {
    //     $checkQuery = ConfigPostLengthModel::all();
    //     if(count($checkQuery) > 0)
    //     {
    //         $updateArr = [
    //             'post9Length_price' => $_GET['price_val'],
    //             'post12Length_price' => $_GET['length12_val'],
    //         ];
    //         $mainQuery = ConfigPostLengthModel::where('id',1)->update($updateArr);
    //     }
    //     else if(count($checkQuery) == 0)
    //     {
    //         $insertArr = [
    //             'post9Length_price' => $_GET['price_val'],
    //             'post12Length_price' => 0,
    //         ];
    //         $mainQuery = ConfigPostLengthModel::insert($insertArr);
    //     }

    //     $msg = "error";
    //     if($mainQuery)
    //     {

    //         $getting_post_length_id_Query = MasterPostLengthModel::where('master_post_length',9)->get();
    //             foreach($getting_post_length_id_Query as $gettingPostLengthId)
    //             {
    //                 $post_length_main_id = $gettingPostLengthId->id;
    //             }

    //             // for 4 posts
    //             $pickMainPostLengthQuery = PickPostLengthModel::where('posts_length',$post_length_main_id)->get();
    //             if(count($pickMainPostLengthQuery) > 0)
    //             {
    //                 foreach($pickMainPostLengthQuery as $pMQuery)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts


    //             $getting_post_length_id_Query2 = MasterPostLengthModel::where('master_post_length',12)->get();
    //             foreach($getting_post_length_id_Query2 as $gettingPostLengthId2)
    //             {
    //                 $post_length_main_id2 = $gettingPostLengthId2->id;
    //             }

    //             // for 4 posts
    //             $pickMainPostLengthQuery2 = PickPostLengthModel::where('posts_length',$post_length_main_id2)->get();
    //             if(count($pickMainPostLengthQuery2) > 0)
    //             {
    //                 foreach($pickMainPostLengthQuery2 as $pMQuery2)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery2->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery2->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery2->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['length12_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['length12_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['length12_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['length12_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts

    //         $msg = "success";
    //     }

    //     echo json_encode($msg);
    // }

    // public function submit_post12length_config_fx(Request $request)
    // {
    //     $checkQuery = ConfigPostLengthModel::all();
    //     if(count($checkQuery) > 0)
    //     {
    //         $updateArr = [
    //             'post12Length_price' => $_GET['price_val'],
    //             'post9Length_price' => $_GET['length9_val'],
    //         ];
    //         $mainQuery = ConfigPostLengthModel::where('id',1)->update($updateArr);
    //     }
    //     else if(count($checkQuery) == 0)
    //     {
    //         $insertArr = [
    //             'post12Length_price' => $_GET['price_val'],
    //             'post9Length_price' => 0,
    //         ];
    //         $mainQuery = ConfigPostLengthModel::insert($insertArr);
    //     }

    //     $msg = "error";
    //     if($mainQuery)
    //     {

    //         $getting_post_length_id_Query = MasterPostLengthModel::where('master_post_length',12)->get();
    //             foreach($getting_post_length_id_Query as $gettingPostLengthId)
    //             {
    //                 $post_length_main_id = $gettingPostLengthId->id;
    //             }

    //             // for 4 posts
    //             $pickMainPostLengthQuery = PickPostLengthModel::where('posts_length',$post_length_main_id)->get();
    //             if(count($pickMainPostLengthQuery) > 0)
    //             {
    //                 foreach($pickMainPostLengthQuery as $pMQuery)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts

    //             $getting_post_length_id_Query2 = MasterPostLengthModel::where('master_post_length',9)->get();
    //             foreach($getting_post_length_id_Query2 as $gettingPostLengthId2)
    //             {
    //                 $post_length_main_id2 = $gettingPostLengthId2->id;
    //             }

    //             // for 4 posts
    //             $pickMainPostLengthQuery2 = PickPostLengthModel::where('posts_length',$post_length_main_id2)->get();
    //             if(count($pickMainPostLengthQuery2) > 0)
    //             {
    //                 foreach($pickMainPostLengthQuery2 as $pMQuery2)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery2->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery2->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery2->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['length9_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['length9_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['length9_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['length9_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickPostLengthModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts

    //         $msg = "success";
    //     }

    //     echo json_encode($msg);
    // }

    // // pick a footprint
    // public function showConfigPickFootprint(Request $request)
    // {
    //     $showQuery = ConfigModel::all();
    //     $html['msg_state'] = 'error';
    //     if(count($showQuery) > 0)
    //     {
    //         $html['msg_state'] = 'success';
    //         foreach($showQuery as $sQuery)
    //         {
    //             $html['msg_post4'] = $sQuery->post4_price;
    //             $html['msg_post6'] = $sQuery->post6_price;
    //             $html['msg_post4d'] = $sQuery->post4double_price;
    //             $html['msg_post8'] = $sQuery->post8_price;
    //         }
    //     }

    //     $showOverQuery = ConfigOverheadShadesModel::all();
    //     $html['shades_msg_state'] = 'error';
    //     if(count($showOverQuery) > 0)
    //     {
    //         $html['shades_msg_state'] = 'success';
    //         foreach($showOverQuery as $sQuery)
    //         {
    //             $html['regular_price'] = $sQuery->regular_price;
    //             $html['open_price'] = $sQuery->open_price;
    //             $html['sunblocker_price'] = $sQuery->sunblocker_price;
    //         }
    //     }

    //     $showPostQuery = ConfigPostLengthModel::all();
    //     $html['post_msg_state'] = 'error';
    //     if(count($showPostQuery) > 0)
    //     {
    //         $html['post_msg_state'] = 'success';
    //         foreach($showPostQuery as $sQuery)
    //         {
    //             $html['postlength9_price'] = $sQuery->post9Length_price;
    //             $html['postlength12_price'] = $sQuery->post12Length_price;
    //         }
    //     }

    //     $showCanopyQuery = ConfigCanopyModel::all();
    //     $html['canopy_msg_state'] = 'error';
    //     if(count($showCanopyQuery) > 0)
    //     {
    //         $html['canopy_msg_state'] = 'success';
    //         foreach($showCanopyQuery as $sQuery)
    //         {
    //             $html['canopy_price'] = $sQuery->canopy_price;
    //         }
    //     }

    //     $showMountQuery = ConfigMountModel::all();
    //     $html['post_msg_mount'] = 'error';
    //     if(count($showMountQuery) > 0)
    //     {
    //         $html['post_msg_mount'] = 'success';
    //         foreach($showMountQuery as $sQuery)
    //         {
    //             $html['mount_bracket4_price'] = $sQuery->mount_bracket4_price;
    //             $html['mount_bracket6_price'] = $sQuery->mount_bracket6_price;
    //             $html['mount_bracket8_price'] = $sQuery->mount_bracket8_price;
    //         }
    //     }

    //     $showLpanelQuery = ConfigLouveredModel::all();
    //     $html['post_msg_lpanel'] = 'error';
    //     if(count($showLpanelQuery) > 0)
    //     {
    //         $html['post_msg_lpanel'] = 'success';
    //         foreach($showLpanelQuery as $sQuery)
    //         {
    //             $html['each_sqft_price'] = $sQuery->each_sqft_price;
    //         }
    //     }

    //     echo json_encode($html);
    // }

    // public function config_post4double_submit(Request $request)
    // {
    //     $checkQuery = ConfigModel::all();
    //     if(count($checkQuery) > 0)
    //     {
    //         $updateArr = [
    //             'post4double_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigModel::where('id',1)->update($updateArr);
    //     }
    //     else if(count($checkQuery) == 0)
    //     {
    //         $insertArr = [
    //             'post4_price' => 0,
    //             'post6_price' => 0,
    //             'post4double_price' => $_GET['price_val'],
    //             'post8_price' => 0,
    //         ];
    //         $mainQuery = ConfigModel::insert($insertArr);
    //     }

    //     $msg = "error";
    //     if($mainQuery)
    //     {
    //         // for 4 double posts
    //         $pickMainQuery = PickUpFootPrintModel::get();
    //         if(count($pickMainQuery) > 0)
    //         {
    //             foreach($pickMainQuery as $pMQuery)
    //             {
    //                 //  width model 
    //                 $selectWidth = MasterWidthModel::where(['id' => $pMQuery->width_master])->get();
    //                 foreach($selectWidth as $sWidth)
    //                 {
    //                     $width_length = $sWidth->master_width_length;
    //                 }

    //                 // height model
    //                 $selectHeight = MasterHeightModel::where(['id' => $pMQuery->height_master])->get();
    //                 foreach($selectHeight as $sHeight)
    //                 {
    //                     $height_length = $sHeight->master_height_length;
    //                 }

    //                 // piller model
    //                 $selectPost = PillerPostModel::where(['id' => $pMQuery->posts_master])->get();
    //                 foreach($selectPost as $sPost)
    //                 {
    //                     $post_numbers = $sPost->no_of_posts;
    //                 }


    //                 if($post_numbers === "4 double")
    //                 {
                        
    //                     $post4double_price = $_GET['price_val'];
    //                     $main_price_4double_post = (($width_length*$height_length*$_GET['four_val'])+$post4double_price);

    //                     $updateArr1 = [
    //                         'price_master' => $main_price_4double_post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr1);
    //                 }
    //                 else if($post_numbers === "4" || $post_numbers === 4)
    //                 {
                        
    //                     $main_price_4post = ($width_length*$height_length*$_GET['four_val']);

    //                     $updateArr2 = [
    //                         'price_master' => $main_price_4post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr2);
    //                 }
    //                 else if($post_numbers === "6" || $post_numbers === 6)
    //                 {
                        
    //                     $main_price_6post = ($width_length*$height_length*$_GET['six_val']);

    //                     $updateArr3 = [
    //                         'price_master' => $main_price_6post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr3);
    //                 }
    //                 else if($post_numbers === "8" || $post_numbers === 8)
    //                 {
                        
    //                     $main_price_8post = (($width_length*$height_length*$_GET['six_val'])+$_GET['eight_val']);

    //                     $updateArr4 = [
    //                         'price_master' => $main_price_8post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr4);
    //                 }
    //             }
    //         }
    //         // end of 4 double posts
    //         $msg = "success";
    //     }

    //     echo json_encode($msg);
    // }

    // public function config_post8_submit(Request $request)
    // {
    //     $checkQuery = ConfigModel::all();
    //     if(count($checkQuery) > 0)
    //     {
    //         $updateArr = [
    //             'post8_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigModel::where('id',1)->update($updateArr);
    //     }
    //     else if(count($checkQuery) == 0)
    //     {
    //         $insertArr = [
    //             'post4_price' => 0,
    //             'post6_price' => 0,
    //             'post4double_price' => 0,
    //             'post8_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigModel::insert($insertArr);
    //     }

    //     $msg = "error";
    //     if($mainQuery)
    //     {
            

    //         // for 8 posts
    //         $pickMainQuery = PickUpFootPrintModel::get();
    //         if(count($pickMainQuery) > 0)
    //         {
    //             foreach($pickMainQuery as $pMQuery)
    //             {
    //                 //  width model 
    //                 $selectWidth = MasterWidthModel::where(['id' => $pMQuery->width_master])->get();
    //                 foreach($selectWidth as $sWidth)
    //                 {
    //                     $width_length = $sWidth->master_width_length;
    //                 }

    //                 // height model
    //                 $selectHeight = MasterHeightModel::where(['id' => $pMQuery->height_master])->get();
    //                 foreach($selectHeight as $sHeight)
    //                 {
    //                     $height_length = $sHeight->master_height_length;
    //                 }

    //                 // piller model
    //                 $selectPost = PillerPostModel::where(['id' => $pMQuery->posts_master])->get();
    //                 foreach($selectPost as $sPost)
    //                 {
    //                     $post_numbers = $sPost->no_of_posts;
    //                 }


    //                 if($post_numbers === 8 || $post_numbers === "8")
    //                 {
    //                     $post8_price = $_GET['price_val'];
    //                     $main_price_8post = (($width_length*$height_length*$_GET['six_val'])+$post8_price);

    //                     $updateArr1 = [
    //                         'price_master' => $main_price_8post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr1);
    //                 }
    //                 else if($post_numbers === 6 || $post_numbers === "6")
    //                 {
    //                     $main_price_6post = ($width_length*$height_length*$_GET['six_val']);

    //                     $updateArr2 = [
    //                         'price_master' => $main_price_6post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr2);
    //                 }
    //                 else if($post_numbers === 4 || $post_numbers === "4")
    //                 {
    //                     $main_price_4post = ($width_length*$height_length*$_GET['four_val']);

    //                     $updateArr3 = [
    //                         'price_master' => $main_price_4post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr3);
    //                 }
    //                 else if($post_numbers === "4 double")
    //                 {
    //                     $main_price_4double_post = (($width_length*$height_length*$_GET['four_val'])+$_GET['four4d_val']);

    //                     $updateArr4 = [
    //                         'price_master' => $main_price_4double_post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr4);
    //                 }
    //             }
    //         }
    //         // end of 8 posts
    //         $msg = "success";
    //     }

    //     echo json_encode($msg);
    // }

    // public function config_post4_submit(Request $request)
    // {
    //     $checkQuery = ConfigModel::all();
    //     if(count($checkQuery) > 0)
    //     {
    //         $updateArr = [
    //             'post4_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigModel::where('id',1)->update($updateArr);
    //     }
    //     else if(count($checkQuery) == 0)
    //     {
    //         $insertArr = [
    //             'post4_price' => $_GET['price_val'],
    //             'post6_price' => 0,
    //             'post4double_price' => 0,
    //             'post8_price' => 0,
    //         ];
    //         $mainQuery = ConfigModel::insert($insertArr);
    //     }

    //     $msg = "error";
    //     if($mainQuery)
    //     {
    //         // for 4 posts
    //         $pickMainQuery = PickUpFootPrintModel::get();
    //         if(count($pickMainQuery) > 0)
    //         {
    //             foreach($pickMainQuery as $pMQuery)
    //             {
    //                 //  width model 
    //                 $selectWidth = MasterWidthModel::where(['id' => $pMQuery->width_master])->get();
    //                 foreach($selectWidth as $sWidth)
    //                 {
    //                     $width_length = $sWidth->master_width_length;
    //                 }

    //                 // height model
    //                 $selectHeight = MasterHeightModel::where(['id' => $pMQuery->height_master])->get();
    //                 foreach($selectHeight as $sHeight)
    //                 {
    //                     $height_length = $sHeight->master_height_length;
    //                 }

    //                 // piller model
    //                 $selectPost = PillerPostModel::where(['id' => $pMQuery->posts_master])->get();
    //                 foreach($selectPost as $sPost)
    //                 {
    //                     $post_numbers = $sPost->no_of_posts;
    //                     $post_numbers1 = $sPost->id;
    //                 }


    //                 if($post_numbers === '4')
    //                 {
    //                     $post4_price = $_GET['price_val'];
    //                     $main_price_4post = $width_length*$height_length*$post4_price;

    //                     $updateArr1 = [
    //                         'price_master' => $main_price_4post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr1);
    //                 }
    //                 else if($post_numbers === '4 double')
    //                 {
    //                     $main_price_4double_post = (($width_length*$height_length*$_GET['price_val'])+$_GET['price_val4d']);
    //                     $updateArr2 = [
    //                         'price_master' => $main_price_4double_post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr2);
    //                 }
    //                 else if($post_numbers === '6')
    //                 {
    //                     $main_price_6post = ($width_length*$height_length*$_GET['six_val']);
    //                     $updateArr3 = [
    //                         'price_master' => $main_price_6post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr3);
    //                 }
    //                 else if($post_numbers === '8')
    //                 {
    //                     $main_price_8post = (($width_length*$height_length*$_GET['six_val'])+$_GET['eight_val']);
    //                     $updateArr4 = [
    //                         'price_master' => $main_price_8post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr4);
    //                 }
    //             }
    //         }
    //         // end of 4 posts

    //         $msg = "success";
    //     }

    //     echo json_encode($msg);
       
    // }


    // public function config_post6_submit(Request $request)
    // {
    //     $checkQuery = ConfigModel::all();
    //     if(count($checkQuery) > 0)
    //     {
    //         $updateArr = [
    //             'post6_price' => $_GET['price_val'],
    //         ];
    //         $mainQuery = ConfigModel::where('id',1)->update($updateArr);
    //     }
    //     else if(count($checkQuery) == 0)
    //     {
    //         $insertArr = [
    //             'post6_price' => $_GET['price_val'],
    //             'post4_price' => 0,
    //             'post4double_price' => 0,
    //             'post8_price' => 0,
    //         ];
    //         $mainQuery = ConfigModel::insert($insertArr);
    //     }

    //     $msg = "error";
    //     if($mainQuery)
    //     {
    //         // for 6 posts
    //         $pickMainQuery = PickUpFootPrintModel::get();
    //         if(count($pickMainQuery) > 0)
    //         {
    //             foreach($pickMainQuery as $pMQuery)
    //             {
    //                 //  width model 
    //                 $selectWidth = MasterWidthModel::where(['id' => $pMQuery->width_master])->get();
    //                 foreach($selectWidth as $sWidth)
    //                 {
    //                     $width_length = $sWidth->master_width_length;
    //                 }

    //                 // height model
    //                 $selectHeight = MasterHeightModel::where(['id' => $pMQuery->height_master])->get();
    //                 foreach($selectHeight as $sHeight)
    //                 {
    //                     $height_length = $sHeight->master_height_length;
    //                 }

    //                 // piller model
    //                 $selectPost = PillerPostModel::where(['id' => $pMQuery->posts_master])->get();
    //                 foreach($selectPost as $sPost)
    //                 {
    //                     $post_numbers = $sPost->no_of_posts;
    //                 }


    //                 if($post_numbers === 6 || $post_numbers === "6")
    //                 {
    //                     $post6_price = $_GET['price_val'];
    //                     $main_price_6post = $width_length*$height_length*$post6_price;

    //                     $updateArr1 = [
    //                         'price_master' => $main_price_6post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr1);
    //                 }
    //                 else if($post_numbers === "4" || $post_numbers === 4)
    //                 {
    //                     $post4_price = $_GET['four_val'];
    //                     $main_price_4post = $width_length*$height_length*$post4_price;

    //                     $updateArr2 = [
    //                         'price_master' => $main_price_4post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr2);
    //                 }
    //                 else if($post_numbers === "4 double")
    //                 {
    //                     $post4_price = $_GET['four_val'];
    //                     $post4d_price = $_GET['price_val4d'];
    //                     $main_price_4dpost = (($width_length*$height_length*$post4_price)+$post4d_price);

    //                     $updateArr3 = [
    //                         'price_master' => $main_price_4dpost
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr3);
    //                 }
    //                 else if($post_numbers === "8" || $post_numbers === 8)
    //                 {
    //                     $post6_price = $_GET['price_val'];
    //                     $post8_price = $_GET['eight_val'];
    //                     $main_price_8post = (($width_length*$height_length*$post6_price)+$post8_price);

    //                     $updateArr4 = [
    //                         'price_master' => $main_price_8post
    //                     ];
    //                     $insertQuery = PickUpFootPrintModel::where('id',$pMQuery->id)->update($updateArr4);
    //                 }

    //             }
    //         }
    //         // end of 6 posts
    //         $msg = "success";
    //     }

    //     echo json_encode($msg);
    // }


    // /// end pick a footprint

    // // pick a overhead shades
    //     // regular
    //     public function submit_regular_config_fx(Request $request)
    //     {
    //         $checkQuery = ConfigOverheadShadesModel::all();
    //         if(count($checkQuery) > 0)
    //         {
    //             $updateArr = [
    //                 'regular_price' => $_GET['price_val'],
    //                 'open_price' => $_GET['open_val'],
    //                 'sunblocker_price' => $_GET['sunblocker_val'],
    //             ];
    //             $mainQuery = ConfigOverheadShadesModel::where('id',1)->update($updateArr);
    //         }
    //         else if(count($checkQuery) == 0)
    //         {
    //             $insertArr = [
    //                 'regular_price' => $_GET['price_val'],
    //                 'open_price' => 0,
    //                 'sunblocker_price' => 0,
    //             ];
    //             $mainQuery = ConfigOverheadShadesModel::insert($insertArr);
    //         }

    //         $msg = "error";
    //         if($mainQuery)
    //         {
    //             $getting_shades_id_Query = MasterOverheadModel::where('overhead_shades_val','regular')->get();
    //             foreach($getting_shades_id_Query as $gettingShadesId)
    //             {
    //                 $shades_main_id = $gettingShadesId->id;
    //             }

    //             // for 4 posts
    //             $pickMainOverheadQuery = PickOverheadShadesModel::where('master_overhead_shades',$shades_main_id)->get();
    //             if(count($pickMainOverheadQuery) > 0)
    //             {
    //                 foreach($pickMainOverheadQuery as $pMQuery)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts

    //             $getting_shades_id_Query2 = MasterOverheadModel::where('overhead_shades_val','open')->get();
    //             foreach($getting_shades_id_Query2 as $gettingShadesId2)
    //             {
    //                 $shades_main_id2 = $gettingShadesId2->id;
    //             }

    //             // for 4 posts
    //             $pickMainOverheadQuery2 = PickOverheadShadesModel::where('master_overhead_shades',$shades_main_id2)->get();
    //             if(count($pickMainOverheadQuery2) > 0)
    //             {
    //                 foreach($pickMainOverheadQuery2 as $pMQuery2)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery2->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery2->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery2->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['open_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['open_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['open_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['open_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts

    //             $getting_shades_id_Query3 = MasterOverheadModel::where('overhead_shades_val','sunblocker')->get();
    //             foreach($getting_shades_id_Query3 as $gettingShadesId3)
    //             {
    //                 $shades_main_id3 = $gettingShadesId3->id;
    //             }

    //             // for 4 posts
    //             $pickMainOverheadQuery3 = PickOverheadShadesModel::where('master_overhead_shades',$shades_main_id3)->get();
    //             if(count($pickMainOverheadQuery3) > 0)
    //             {
    //                 foreach($pickMainOverheadQuery3 as $pMQuery3)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery3->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery3->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery3->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['sunblocker_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['sunblocker_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['sunblocker_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['sunblocker_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts



    //             $msg = "success";
    //         }

    //     echo json_encode($msg);
    //     }

    //     // open
    //     public function submit_open_config_fx(Request $request)
    //     {
    //         $checkQuery = ConfigOverheadShadesModel::all();
    //         if(count($checkQuery) > 0)
    //         {
    //             $updateArr = [
    //                 'regular_price' => $_GET['regular_val'],
    //                 'open_price' => $_GET['price_val'],
    //                 'sunblocker_price' => $_GET['sunblocker_val'],
    //             ];
    //             $mainQuery = ConfigOverheadShadesModel::where('id',1)->update($updateArr);
    //         }
    //         else if(count($checkQuery) == 0)
    //         {
    //             $insertArr = [
    //                 'regular_price' => 0,
    //                 'open_price' => $_GET['price_val'],
    //                 'sunblocker_price' => 0,
    //             ];
    //             $mainQuery = ConfigOverheadShadesModel::insert($insertArr);
    //         }

    //         $msg = "error";
    //         if($mainQuery)
    //         {
                

    //             $getting_shades_id_Query = MasterOverheadModel::where('overhead_shades_val','open')->get();
    //             foreach($getting_shades_id_Query as $gettingShadesId)
    //             {
    //                 $shades_main_id = $gettingShadesId->id;
    //             }

    //             // for 4 posts
    //             $pickMainOverheadQuery = PickOverheadShadesModel::where('master_overhead_shades',$shades_main_id)->get();
    //             if(count($pickMainOverheadQuery) > 0)
    //             {
    //                 foreach($pickMainOverheadQuery as $pMQuery)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts

    //             $getting_shades_id_Query2 = MasterOverheadModel::where('overhead_shades_val','regular')->get();
    //             foreach($getting_shades_id_Query2 as $gettingShadesId2)
    //             {
    //                 $shades_main_id2 = $gettingShadesId2->id;
    //             }

    //             // for 4 posts
    //             $pickMainOverheadQuery2 = PickOverheadShadesModel::where('master_overhead_shades',$shades_main_id2)->get();
    //             if(count($pickMainOverheadQuery2) > 0)
    //             {
    //                 foreach($pickMainOverheadQuery2 as $pMQuery2)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery2->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery2->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery2->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['regular_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['regular_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['regular_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['regular_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts

                
    //             $getting_shades_id_Query3 = MasterOverheadModel::where('overhead_shades_val','sunblocker')->get();
    //             foreach($getting_shades_id_Query3 as $gettingShadesId3)
    //             {
    //                 $shades_main_id3 = $gettingShadesId3->id;
    //             }

    //             // for 4 posts
    //             $pickMainOverheadQuery3 = PickOverheadShadesModel::where('master_overhead_shades',$shades_main_id3)->get();
    //             if(count($pickMainOverheadQuery3) > 0)
    //             {
    //                 foreach($pickMainOverheadQuery3 as $pMQuery3)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery3->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery3->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery3->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['sunblocker_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['sunblocker_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['sunblocker_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['sunblocker_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts

    //             $msg = "success";
    //         }

    //     echo json_encode($msg);
    //     }

    //     // sunblocker
    //     public function submit_sunblocker_config_fx(Request $request)
    //     {
    //         $checkQuery = ConfigOverheadShadesModel::all();
    //         if(count($checkQuery) > 0)
    //         {
    //             $updateArr = [
    //                 'sunblocker_price' => $_GET['price_val'],
    //                 'regular_price' => $_GET['regular_val'],
    //                 'open_price' => $_GET['open_val'],
    //             ];
    //             $mainQuery = ConfigOverheadShadesModel::where('id',1)->update($updateArr);
    //         }
    //         else if(count($checkQuery) == 0)
    //         {
    //             $insertArr = [
    //                 'regular_price' => 0,
    //                 'open_price' => 0,
    //                 'sunblocker_price' => $_GET['price_val'],
    //             ];
    //             $mainQuery = ConfigOverheadShadesModel::insert($insertArr);
    //         }

    //         $msg = "error";
    //         if($mainQuery)
    //         {
                
    //             $getting_shades_id_Query = MasterOverheadModel::where('overhead_shades_val','sunblocker')->get();
    //             foreach($getting_shades_id_Query as $gettingShadesId)
    //             {
    //                 $shades_main_id = $gettingShadesId->id;
    //             }

    //             // for 4 posts
    //             $pickMainOverheadQuery = PickOverheadShadesModel::where('master_overhead_shades',$shades_main_id)->get();
    //             if(count($pickMainOverheadQuery) > 0)
    //             {
    //                 foreach($pickMainOverheadQuery as $pMQuery)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['price_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts
    //             $getting_shades_id_Query2 = MasterOverheadModel::where('overhead_shades_val','regular')->get();
    //             foreach($getting_shades_id_Query2 as $gettingShadesId2)
    //             {
    //                 $shades_main_id2 = $gettingShadesId2->id;
    //             }

    //             // for 4 posts
    //             $pickMainOverheadQuery2 = PickOverheadShadesModel::where('master_overhead_shades',$shades_main_id2)->get();
    //             if(count($pickMainOverheadQuery2) > 0)
    //             {
    //                 foreach($pickMainOverheadQuery2 as $pMQuery2)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery2->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery2->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery2->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['regular_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['regular_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['regular_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['regular_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery2->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts

    //             $getting_shades_id_Query3 = MasterOverheadModel::where('overhead_shades_val','open')->get();
    //             foreach($getting_shades_id_Query3 as $gettingShadesId3)
    //             {
    //                 $shades_main_id3 = $gettingShadesId3->id;
    //             }

    //             // for 4 posts
    //             $pickMainOverheadQuery3 = PickOverheadShadesModel::where('master_overhead_shades',$shades_main_id3)->get();
    //             if(count($pickMainOverheadQuery3) > 0)
    //             {
    //                 foreach($pickMainOverheadQuery3 as $pMQuery3)
    //                 {
    //                     //  width model 
    //                     $selectWidth = MasterWidthModel::where(['id' => $pMQuery3->master_width])->get();
    //                     foreach($selectWidth as $sWidth)
    //                     {
    //                         $width_length = $sWidth->master_width_length;
    //                     }

    //                     // height model
    //                     $selectHeight = MasterHeightModel::where(['id' => $pMQuery3->master_height])->get();
    //                     foreach($selectHeight as $sHeight)
    //                     {
    //                         $height_length = $sHeight->master_height_length;
    //                     }

    //                     // piller model
    //                     $selectPost = PillerPostModel::where(['id' => $pMQuery3->master_post])->get();
    //                     foreach($selectPost as $sPost)
    //                     {
    //                         $post_numbers = $sPost->no_of_posts;
    //                     }

                        
    //                     $priceConfigPostQuery = ConfigModel::where(['id' => 1])->get();
    //                     foreach($priceConfigPostQuery as $pConfigPrice4)
    //                     {
    //                         $priceC4 = $pConfigPrice4->post4_price;
    //                         $priceC4d = $pConfigPrice4->post4double_price;
    //                         $priceC6 = $pConfigPrice4->post6_price;
    //                         $priceC8 = $pConfigPrice4->post8_price;
    //                     }
                        


    //                     if($post_numbers === 4 || $post_numbers === "4")
    //                     {
    //                         $post_number_4post_price = ((($width_length*$height_length*$priceC4)*$_GET['open_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === "4 double")
    //                     {
    //                         $post_number_4double_post_price = (((($width_length*$height_length*$priceC4)+$priceC4d)*$_GET['open_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_4double_post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 6 || $post_numbers === "6")
    //                     {
    //                         $post_number_6post_price = ((($width_length*$height_length*$priceC6)*$_GET['open_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_6post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                     else if($post_numbers === 8 || $post_numbers === "8")
    //                     {
    //                         $post_number_8post_price = (((($width_length*$height_length*$priceC6)+$priceC8)*$_GET['open_val'])/100);
    //                         $updateArr = [
    //                             'price_details' => $post_number_8post_price
    //                         ];
    //                         $insertQuery = PickOverheadShadesModel::where('id',$pMQuery3->id)->update($updateArr);
    //                     }
    //                 }
    //             }
    //             // end of 4 posts


    //             $msg = "success";
    //         }

    //     echo json_encode($msg);
    //     }
    // // end of pick a overhead shades


    
}
