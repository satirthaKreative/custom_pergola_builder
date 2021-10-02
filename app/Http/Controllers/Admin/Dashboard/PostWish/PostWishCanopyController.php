<?php

namespace App\Http\Controllers\Admin\Dashboard\PostWish;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\PillerPost\PillerPostModel;
use App\Model\Admin\PostWish\PostWishCanopyModel;

class PostWishCanopyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // show page 
    public function showPage(Request $request)
    {
        return view('backend.pages.post-wish.canopy');
    }

    // full details 
    public function fullDataFx(Request $request)
    {
        $fQuery = PostWishCanopyModel::where(['admin_action' => 'yes'])->get();
        if(count($fQuery) > 0)
        {
            $html['canopy_html'] = "";
            $i = 0;
            foreach($fQuery as $f1)
            {
                $pillerQuery = PillerPostModel::where('id',$f1->piller_post_id)->get();

                foreach($pillerQuery as $pQuery)
                {
                    $piller_name = $pQuery->no_of_posts;
                }

                $canopy_description = "";
                if($f1->canopy_type_text_description != "")
                {
                    $canopy_description = $f1->canopy_type_text_description;
                }

                $canopy_video = 'No Video';
                if($f1->video_link_data != null)
                {
                    $canopy_video = '<video width="150"  controls>
                                        <source src="'.str_replace("public","storage/app/public",asset($f1->video_link_data)).'" type="video/mp4">
                                    </video>';
                }

                $canopy_image = 'No Image';
                if($f1->image_link_data != null)
                {
                    $canopy_image = '<img width="150px" src="'.str_replace("public","storage/app/public",asset($f1->image_link_data)).'" alt="No Image"/>';
                }

                $popupText = "Add PopUp Details";
                $popupState = "Add";
                if($f1->popup_details != null)
                {
                    $popupText = "Edit PopUp Details";
                    $popupState = "Edit";
                }

                $html['canopy_html'] .= '<tr>
                                            <td>'.++$i.'</td>
                                            <td>'.$piller_name.' posts</td>
                                            <td><a href="javascript:;" onclick=popup_window_fx('.$f1->id.',"'.$popupState.'")>'.$popupText.'</a></td>
                                            <td>'.$canopy_video.'</td>
                                            <td>'.$canopy_image.'</td>
                                            <td>'.$canopy_description.'</td>
                                            <td><a href="javascript: ;" onclick=canopy_edit_fx('.$f1->id.') class="text-info"><i class="fa fa-edit"></i></a> | <a href="javascript: ;" onclick=canopy_del_fx('.$f1->id.') class="text-danger"><i class="fa fa-trash"></i></a></td>
                                        </tr>';
            }
        }
        else
        {
            $html['canopy_html'] = '<tr><td colspan=6 class="text-danger"><center><i class="fa fa-times"></i> No data added yet!</center></td></tr>';
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
    public function postwish_canopy_submit(Request $request)
    {
        // $getsize = $request->file('canopy_video_file_name')->getClientSize();
        // $request->session()->flash('error_msg', 'it is '.$getsize.' more ');
        $postwish_canopy_video =  "";
        if($request->hasFile('canopy_video_file_name'))
        {
            // if($request->file('canopy_video_file_name')->getSize() > 2048)
            // {
            //     $request->session()->flash('error_msg', 'file not more than 2 mb');
            //     return redirect()->back();
            // }
            // else
            // {
                $postwish_canopy_video = $request->file('canopy_video_file_name')->store('public/postwish/canopy/videos');
            // }
        }
        $postwish_canopy_image =  "";
        if($request->hasFile('canopy_image_file_name'))
        {
            // if($request->file('canopy_video_file_name')->getSize() > 2048)
            // {
            //     $request->session()->flash('error_msg', 'file not more than 2 mb');
            //     return redirect()->back();
            // }
            // else
            // {
                $postwish_canopy_image = $request->file('canopy_image_file_name')->store('public/postwish/canopy/images');
            // }
        }
        $postwish_piller = $request->input('piller_post_name');

        // checking post wish piller
        $mainCheckingQuery = PostWishCanopyModel::where(['piller_post_id' => $postwish_piller])->get();
        if(count($mainCheckingQuery) > 0)
        {
            $request->session()->flash('error_msg', 'Piller already added before!!!');
        }
        else
        {
            $insertArr = [
                'piller_post_id' => $postwish_piller,
                'video_link_data' => $postwish_canopy_video,
                'image_link_data' => $postwish_canopy_image,
                'canopy_type_text_description' => $request->input('canopy_description_name'),
            ];

            $insertQuery = PostWishCanopyModel::insert($insertArr);
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


    public function canopy_edit_fx(Request $request)
    {
        $pillerQuery = PillerPostModel::where(['admin_action' => 'yes'])->get();
        $html['piller_html'] = '<option value="">Choose piller type</option>';
        foreach($pillerQuery as $piller_save)
        {
            $selected = "";
            $mainQuery = PostWishCanopyModel::where('id',$_GET['edit_id'])->get();
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

        $mPQuery = PostWishCanopyModel::where('id',$_GET['edit_id'])->get();
        $html['description'] = "";
        foreach($mPQuery as $mQ)
        {
            $html['description'] = $mQ->canopy_type_text_description;
            $html['video_files_id'] = $mQ->video_link_data;
            $html['img_files_id'] = $mQ->image_link_data;
            $html['video_files'] = asset(str_replace('public','storage/app/public',$mQ->video_link_data));
            $html['img_files'] = asset(str_replace('public','storage/app/public',$mQ->image_link_data));
            $html['imgId'] = $mQ->id;
        }


        echo json_encode($html);
    }


    public function canopy_del_fx(Request $request)
    {
        $delQuery = PostWishCanopyModel::where('id',$_GET['edit_id'])->delete();
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

    public function postwish_canopy_update_submit(Request $request)
    {
         // $getsize = $request->file('canopy_video_file_name')->getClientSize();
        // $request->session()->flash('error_msg', 'it is '.$getsize.' more ');
        
        if($request->hasFile('edit_canopy_video_file_name'))
        {
            // if($request->file('canopy_video_file_name')->getSize() > 2048)
            // {
            //     $request->session()->flash('error_msg', 'file not more than 2 mb');
            //     return redirect()->back();
            // }
            // else
            // {
                $postwish_canopy_video = $request->file('edit_canopy_video_file_name')->store('public/postwish/canopy/videos');
            // }
        }
        else
        {
            $mainQuery = PostWishCanopyModel::where('id',$request->input('canopy_name_hidden_id'))->get();
            foreach($mainQuery as $mQuery)
            {
                $postwish_canopy_video = $mQuery->video_link_data;
            }
        }

        if($request->hasFile('edit_canopy_image_file_name'))
        {
            // if($request->file('canopy_video_file_name')->getSize() > 2048)
            // {
            //     $request->session()->flash('error_msg', 'file not more than 2 mb');
            //     return redirect()->back();
            // }
            // else
            // {
                $postwish_canopy_image = $request->file('edit_canopy_image_file_name')->store('public/postwish/canopy/images');
            // }
        }
        else
        {
            $mainQuery = PostWishCanopyModel::where('id',$request->input('canopy_name_hidden_id'))->get();
            foreach($mainQuery as $mQuery)
            {
                $postwish_canopy_image = $mQuery->image_link_data;
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
                'video_link_data' => $postwish_canopy_video,
                'image_link_data' => $postwish_canopy_image,
                'canopy_type_text_description' => $request->input('edit_canopy_description_name'),
            ];

            $insertQuery = PostWishCanopyModel::where('id',$request->input('canopy_name_hidden_id'))->update($insertArr);
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

    public function canopy_img_delete_fx(Request $request)
    {
        $updateQuery = PostWishCanopyModel::where('id',$_GET['id'])->update(['image_link_data' => null]);
        $msg = "error";
        if($updateQuery)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }

    public function canopy_video_delete_fx(Request $request)
    {
        $updateQuery = PostWishCanopyModel::where('id',$_GET['id'])->update(['video_link_data' => null]);
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
        $updateQuery = PostWishCanopyModel::where('id',$_POST['popup_hidden_id'])->update($updateArr);
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
        $updateQuery = PostWishCanopyModel::where('id',$_POST['popup_hidden_id'])->update($updateArr);
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
        $Query = PostWishCanopyModel::where('id',$_GET['id'])->get();
        foreach($Query as $q1)
        {
            $html['popup_name'] = $q1->popup_name;
            $html['popup_details'] = $q1->popup_details;
        }
        echo json_encode($html);
    }

}
