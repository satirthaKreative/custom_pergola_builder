<?php

namespace App\Http\Controllers\Admin\Dashboard\PostWish;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\PillerPost\PillerPostModel;
use App\Model\Admin\PostWish\PostWishLpanelModel;
use App\Model\Admin\lpanelTypeText;
use App\Model\Admin\PickLouveredPanel\PickLouveredPanelModel;

class PostWishLpanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // show page 
    public function showPage(Request $request)
    {
        return view('backend.pages.post-wish.lpanel');
    }

    // full details 
    public function fullDataFx(Request $request)
    {
        $fQuery = PostWishLpanelModel::where(['admin_action' => 'yes'])->get();
        if(count($fQuery) > 0)
        {
            $html['lpanel_html'] = "";
            $i = 0;
            foreach($fQuery as $f1)
            {
                $pillerQuery = PillerPostModel::where('id',$f1->piller_post_id)->get();

                foreach($pillerQuery as $pQuery)
                {
                    $piller_name = $pQuery->no_of_posts;
                }

                $video_data = "No Video";
                if($f1->video_link_data != null)
                {
                    $video_data = '<video width="150"  controls>
                                        <source src="'.str_replace("public","storage/app/public",asset($f1->video_link_data)).'" type="video/mp4">
                                    </video>';
                }

                $lpanel_image = 'No Image';
                if($f1->image_link_data != null)
                {
                    $lpanel_image = '<img width="150px" src="'.str_replace("public","storage/app/public",asset($f1->image_link_data)).'" alt="No Image"/>';
                }

                $popupText = "Add PopUp Details";
                $popupState = "Add";
                if($f1->popup_details != null)
                {
                    $popupText = "Edit PopUp Details";
                    $popupState = "Edit";
                }
                $html['lpanel_html'] .= '<tr>
                                            <td>'.++$i.'</td>
                                            <td>'.$piller_name.' posts</td>
                                            <td><a href="javascript:;" onclick=popup_window_fx('.$f1->id.',"'.$popupState.'")>'.$popupText.'</a></td>
                                            <td>'.$video_data.'</td>
                                            <td>'.$lpanel_image.'</td>
                                            <td>'.$f1->lpanel_data.'</td>  
                                            <td><a href="javascript: ;" onclick=lpanel_edit_fx('.$f1->id.') class="text-info"><i class="fa fa-edit"></i></a> | <a href="javascript: ;" onclick=lpanel_del_fx('.$f1->id.') class="text-danger"><i class="fa fa-trash"></i></a></td>
                                        </tr>';
            }
        }
        else
        {
            $html['lpanel_html'] = '<tr><td colspan=5 class="text-danger"><center><i class="fa fa-times"></i> No data added yet!</center></td></tr>';
        }

        echo json_encode($html);
    }


    /// piller post

    public function pillerPostFx(Request $request)
    {
        $pillerQuery = PillerPostModel::where(['admin_action' => 'yes'])->get();
        $html['piller_html'] = '<option value="">Choose piller type</option>';
        foreach($pillerQuery as $piller_save)
        {
            $html['piller_html'] .= '<option value='.$piller_save->id.'>'.$piller_save->no_of_posts.'</option>';
        }

        echo json_encode($html);
    }


    /// post wish canopy submit
    public function postwish_lpanel_submit(Request $request)
    {
        // $getsize = $request->file('canopy_video_file_name')->getClientSize();
        // $request->session()->flash('error_msg', 'it is '.$getsize.' more ');
        $postwish_lpanel_video =  null;
        if($request->hasFile('lpanel_video_file_name'))
        {
            // if($request->file('canopy_video_file_name')->getSize() > 2048)
            // {
            //     $request->session()->flash('error_msg', 'file not more than 2 mb');
            //     return redirect()->back();
            // }
            // else
            // {
                $postwish_lpanel_video = $request->file('lpanel_video_file_name')->store('public/postwish/lpanel/videos');
            // }
        }

        $postwish_lpanel_image = null;
        if($request->hasFile('lpanel_image_file_name'))
        {
            $postwish_lpanel_image = $request->file('lpanel_image_file_name')->store('public/postwish/lpanel/images');
        }

        $postwish_piller = $request->input('piller_post_name');

        // checking post wish piller
        $mainCheckingQuery = PostWishLpanelModel::where(['piller_post_id' => $postwish_piller])->get();
        if(count($mainCheckingQuery) > 0)
        {
            $request->session()->flash('error_msg', 'Piller already added before!!!');
        }
        else
        {
            $insertArr = [
                'piller_post_id' => $postwish_piller,
                'video_link_data' => $postwish_lpanel_video,
                'image_link_data' => $postwish_lpanel_image,
                'lpanel_data' => $request->input('description'),
            ];

            $insertQuery = PostWishLpanelModel::insert($insertArr);
            if($insertQuery)
            {
                $request->session()->flash('success_msg', 'Successfully added');
            }
            else
            {
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
            }
        }
        return redirect()->back();
    }


    public function lpanel_edit_fx(Request $request)
    {
        $pillerQuery = PillerPostModel::where(['admin_action' => 'yes'])->get();
        $html['piller_html'] = '<option value="">Choose piller type</option>';
        foreach($pillerQuery as $piller_save)
        {
            $selected = "";
            $mainQuery = PostWishLpanelModel::where('id',$_GET['edit_id'])->get();
            foreach($mainQuery as $mQuery)
            {
                $piller_id = $mQuery->piller_post_id;
                if($piller_save->id == $piller_id)
                {
                    $selected = "selected";
                }
            }
            
            
            $html['piller_html'] .= '<option value='.$piller_save->id.' '.$selected.'>'.$piller_save->no_of_posts.'</option>';
        }

        $maQuery = PostWishLpanelModel::where('id',$_GET['edit_id'])->get();
        foreach($maQuery as $mQ)
        {
            $html['descriptions'] = $mQ->lpanel_data;
	        $html['video_files_id'] = $mQ->video_link_data;
            $html['img_files_id'] = $mQ->image_link_data;
            $html['video_files'] = asset(str_replace('public','storage/app/public',$mQ->video_link_data));
            $html['img_files'] = asset(str_replace('public','storage/app/public',$mQ->image_link_data));
            $html['imgId'] = $mQ->id;
        }

        echo json_encode($html);
    }


    public function lpanel_del_fx(Request $request)
    {
        $delQuery = PostWishLpanelModel::where('id',$_GET['edit_id'])->delete();
        if($delQuery)
        {
            $html = 'success_msg';
        }
        else
        {
            $html = 'error_msg';
        }

        echo json_encode($html);
    }

    public function postwish_lapnel_update_submit(Request $request)
    {
         // $getsize = $request->file('canopy_video_file_name')->getClientSize();
        // $request->session()->flash('error_msg', 'it is '.$getsize.' more ');
        
        if($request->hasFile('edit_lpanel_video_file_name'))
        {
            // if($request->file('canopy_video_file_name')->getSize() > 2048)
            // {
            //     $request->session()->flash('error_msg', 'file not more than 2 mb');
            //     return redirect()->back();
            // }
            // else
            // {
                $postwish_lpanel_video = $request->file('edit_lpanel_video_file_name')->store('public/postwish/lpanel/videos');
            // }
        }
        else
        {
            $mainQuery = PostWishLpanelModel::where('id',$request->input('lpanel_name_hidden_id'))->get();
            foreach($mainQuery as $mQuery)
            {
                $postwish_lpanel_video = $mQuery->video_link_data;
            }
        }

        if($request->hasFile('edit_lpanel_image_file_name'))
        {
            // if($request->file('canopy_video_file_name')->getSize() > 2048)
            // {
            //     $request->session()->flash('error_msg', 'file not more than 2 mb');
            //     return redirect()->back();
            // }
            // else
            // {
                $postwish_lpanel_image = $request->file('edit_lpanel_image_file_name')->store('public/postwish/lpanel/images');
            // }
        }
        else
        {
            $mainQuery = PostWishLpanelModel::where('id',$request->input('lpanel_name_hidden_id'))->get();
            foreach($mainQuery as $mQuery)
            {
                $postwish_lpanel_image = $mQuery->image_link_data;
            }
        }


        $postwish_piller = $request->input('edit_piller_post_name');

        // checking post wish piller
        // $mainCheckingQuery = PostWishCanopyModel::where(['piller_post_id' => $postwish_piller])->get();
        // if(count($mainCheckingQuery) > 0)
        // {
        //     $request->session()->flash('error_msg', 'Piller already added before!!!');
        // }
        // else
        // {
            $insertArr = [
                'piller_post_id' => $postwish_piller,
                'video_link_data' => $postwish_lpanel_video,
                'image_link_data' => $postwish_lpanel_image,
                'lpanel_data' => $request->input('edit_description'),
            ];

            $insertQuery = PostWishLpanelModel::where('id',$request->input('lpanel_name_hidden_id'))->update($insertArr);
            if($insertQuery)
            {
                $request->session()->flash('success_msg', 'Successfully updated');
            }
            else
            {
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
            }
        // }
        return redirect()->back();
    }


    /// lpanel text type
    public function load_lpanel_type_text_fx(Request $request)
    {
        $lpanelTypeTextQuery = lpanelTypeText::where(['admin_action' => 'active'])->get();
        if(count($lpanelTypeTextQuery) > 0)
        {
            $html['lpanelText'] = "";
            $i = 0;
            foreach($lpanelTypeTextQuery as $lTypeTextQuery)
            {
                
                // lpanel type text
                $lpQuery = PickLouveredPanelModel::where('id',$lTypeTextQuery->lpanel_id)->get();
                
                $newLpanel = "";
                foreach($lpQuery as $lpq)
                {
                    $newLpanel = $lpq->l_panel_name;
                }
                // <a href="javascript: ;" onclick=lpanel_type_text_edit_fx('.$lTypeTextQuery->id.') class="text-info"><i class="fa fa-edit"></i></a> |
                $html['lpanelText'] .= '<tr>
                                            <td>'.++$i.'</td>
                                            <td>'.$newLpanel.'</td>
                                            <td>'.$lTypeTextQuery->lpanel_text.'</td>
                                            <td> <a href="javascript: ;" onclick=lpanel_type_text_del_fx('.$lTypeTextQuery->id.') class="text-danger"><i class="fa fa-trash"></i></a></td>
                                        </tr>';
            }
        }
        else
        {
            $html['lpanelText'] = '<tr><td colspan="4"><center class="text-danger"><i class="fa fa-times"></i> No data added yet</center></td></tr>';
        }
        echo json_encode($html);
    }

    /// louvered submited 
    public function louvered_type_text_fx(Request $request)
    {
        $lpanel_name = $request->input('louvered_types_name');
        $lpanel_description = $request->input('louvered_description');

        $checkingLpanelQuery = lpanelTypeText::where(['lpanel_id' => $lpanel_name])->get();
        if(count($checkingLpanelQuery) > 0)
        {
            $request->session()->flash('error_msg', 'This panel already added before!!!');
        }
        else
        {
            $insertArr = [
                'lpanel_id' => $lpanel_name,
                'lpanel_text' => $lpanel_description,
            ];

            $insertQuery = lpanelTypeText::insert($insertArr);
            if($insertQuery)
            {
                $request->session()->flash('success_msg', 'Successfully inserted');
            }
            else
            {
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
            }
            return redirect()->back();
        }
    }

    public function choose_lpanel_type_text_fx(Request $request)
    {
        $lpQuery = PickLouveredPanelModel::get();

        $html['lpanel_html'] = '<option value="">Choose louvered panel</option>';
        foreach($lpQuery as $lQuery)
        {
            $html['lpanel_html'] .= '<option value="'.$lQuery->id.'">'.$lQuery->l_panel_name.'</option>';
        }

        echo json_encode($html);
    }

    public function del_lpanel_type_text_fx(Request $request)
    {
        $delQuery = lpanelTypeText::where('id',$_GET['edit_id'])->delete();
        if($delQuery)
        {
            $html = 'success_msg';
        }
        else
        {
            $html = 'error_msg';
        }

        echo json_encode($html);
    }

    // post wish image delete
    public function lpanel_img_delete_fx(Request $request)
    {
        $updateQuery = PostWishLpanelModel::where('id',$_GET['id'])->update(['image_link_data' => null]);
        $msg = "error";
        if($updateQuery)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }

    public function lpanel_video_delete_fx(Request $request)
    {
        $updateQuery = PostWishLpanelModel::where('id',$_GET['id'])->update(['video_link_data' => null]);
        $msg = "error";
        if($updateQuery)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }

    /// popup panel 

    public function editPopUpfx(Request $request)
    {
        $updateArr = [
            'popup_name' => $_POST['popup_name'],
            'popup_details' => $_POST['edit_popup_description_name'],
        ];
        $updateQuery = PostWishLpanelModel::where('id',$_POST['popup_hidden_id'])->update($updateArr);
        if($updateQuery)
        {
            $request->session()->flash('success_msg', 'Successfully updated');
        }
        else
        {
            $request->session()->flash('error_msg', 'Something went wrong! Try again');
        }
        return redirect()->back();
    }

    public function addPopUpfx(Request $request)
    {
        $updateArr = [
            'popup_name' => $_POST['popup_name'],
            'popup_details' => $_POST['popup_description_name'],
        ];
        $updateQuery = PostWishLpanelModel::where('id',$_POST['popup_hidden_id'])->update($updateArr);
        if($updateQuery)
        {
            $request->session()->flash('success_msg', 'Successfully updated');
        }
        else
        {
            $request->session()->flash('error_msg', 'Something went wrong! Try again');
        }
        return redirect()->back();
    }

    public function editWindowfx(Request $request)
    {
        $Query = PostWishLpanelModel::where('id',$_GET['id'])->get();
        foreach($Query as $q1)
        {
            $html['popup_name'] = $q1->popup_name;
            $html['popup_details'] = $q1->popup_details;
        }
        echo json_encode($html);
    }
}
