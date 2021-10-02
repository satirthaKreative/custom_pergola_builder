<?php

namespace App\Http\Controllers\Admin\Dashboard\SetUp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Setup\MountBracketModel;
use App\Model\Admin\PillerPost\PillerPostModel;

class MountBracketController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth:admin');
    }

    // show page
    public function index(Request $request)
    {
        return view('backend.pages.setup.mount-bracket');
    }

    // full details 
    public function fullDataFx(Request $request)
    {
        $fQuery = MountBracketModel::where(['admin_action' => 'yes'])->get();
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

                $mount_bracket_description = "";
                if($f1->mount_bracket_data != "")
                {
                    $mount_bracket_description = $f1->mount_bracket_data;
                    
                    if(strlen($mount_bracket_description) > 65)
                    {
                        $mount_bracket_description = substr($mount_bracket_description,0,65)."...";
                    }
                }

		if( $f1->video_link_data != null)
		{
			$video_link_data = '<video width="150"  controls><source src="'.str_replace("public","storage/app/public",asset($f1->video_link_data)).'" type="video/mp4"></video>';
		}
		else
		{
			$video_link_data = 'no video attached';
		}

		if( $f1->mount_bracket_img != null)
		{
			$mount_bracket_img = '<img src="'.str_replace("public","storage/app/public",asset($f1->mount_bracket_img)).'" alt="no image" width="32%" />';
		}
		else
		{
			$mount_bracket_img = 'no image attached';
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
                                            <td><a href="javascript:;" onclick=popup_window_fx('.$f1->id.',"'.$popupState.'")>'.$popupText.'</a></td>
                                            <td>'.$piller_name.' posts</td>
                                            <td>'.$video_link_data.'</td>
                                            <td>'.$mount_bracket_img.'</td>  
                                            <td>'.$mount_bracket_description.'</td>
                                            <td><a href="javascript: ;" onclick=canopy_edit_fx('.$f1->id.') class="text-info"><i class="fa fa-edit"></i></a> | <a href="javascript: ;" onclick=mount_del_fx('.$f1->id.') class="text-danger"><i class="fa fa-trash"></i></a></td>
                                        </tr>';
            }
        }
        else
        {
            $html['canopy_html'] = '<tr><td colspan=7 class="text-danger"><center><i class="fa fa-times"></i> No data added yet!</center></td></tr>';
        }

        echo json_encode($html);
    }

    /// post wish canopy submit
    public function postwish_mount_submit(Request $request)
    {
        $postwish_mount_video =  null;
        if($request->hasFile('mount_video_file_name'))
        {
            $postwish_mount_video = $request->file('mount_video_file_name')->store('public/postwish/mount/videos');
        }

        $postwish_mount_image = null;
        if($request->hasFile('mount_image_file_name'))
        {
            $postwish_mount_image = $request->file('mount_image_file_name')->store('public/postwish/mount/images');
        }


        $postwish_piller = $request->input('piller_post_name');

        // checking post wish piller
        $mainCheckingQuery = MountBracketModel::where(['piller_post_id' => $postwish_piller])->get();
        if(count($mainCheckingQuery) > 0)
        {
            $request->session()->flash('error_msg', 'Piller already added before!!!');
        }
        else
        {
            $insertArr = [
                'piller_post_id' => $postwish_piller,
                'video_link_data' => $postwish_mount_video,
                'mount_bracket_img' => $postwish_mount_image,
                'mount_bracket_data' => $request->input('mount_description_name'),
            ];

            $insertQuery = MountBracketModel::insert($insertArr);
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

    public function mount_edit_fx(Request $request)
    {
        $pillerQuery = PillerPostModel::where(['admin_action' => 'yes'])->get();
        $html['piller_html'] = '<option value="">Choose piller type</option>';
        foreach($pillerQuery as $piller_save)
        {
            $selected = "";
            $mainQuery = MountBracketModel::where('id',$_GET['edit_id'])->get();
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

        $mPQuery = MountBracketModel::where('id',$_GET['edit_id'])->get();
        $html['description'] = "";
        foreach($mPQuery as $mQ)
        {
            $html['description'] = $mQ->mount_bracket_data;
	        $html['video_files_id'] = $mQ->video_link_data;
            $html['img_files_id'] = $mQ->mount_bracket_img;
            $html['video_files'] = asset(str_replace('public','storage/app/public',$mQ->video_link_data));
            $html['img_files'] = asset(str_replace('public','storage/app/public',$mQ->mount_bracket_img));
            $html['imgId'] = $mQ->id;
        }


        echo json_encode($html);
    }

    public function mount_update_fx(Request $request)
    {
        
        
        if($request->hasFile('edit_canopy_video_file_name'))
        {
                $postwish_canopy_video = $request->file('edit_canopy_video_file_name')->store('public/postwish/mount/videos');
        }
        else
        {
            $mainQuery = MountBracketModel::where('id',$request->input('canopy_name_hidden_id'))->get();
            foreach($mainQuery as $mQuery)
            {
                $postwish_canopy_video = $mQuery->video_link_data;
            }
        }



        if($request->hasFile('mount_image_file_name'))
        {
            $mount_file_name = $request->file('mount_image_file_name')->store('public/postwish/mount/images');
        }
        else
        {
            $mainQuery = MountBracketModel::where('id',$request->input('canopy_name_hidden_id'))->get();
            foreach($mainQuery as $mQuery)
            {
                $mount_file_name = $mQuery->mount_bracket_img;
            }
        }


        $postwish_piller = $request->input('edit_piller_post_name');

            $insertArr = [
                'piller_post_id' => $postwish_piller,
                'video_link_data' => $postwish_canopy_video,
                'mount_bracket_data' => $request->input('edit_canopy_description_name'),
                'mount_bracket_img' => $mount_file_name
            ];

            $insertQuery = MountBracketModel::where('id',$request->input('canopy_name_hidden_id'))->update($insertArr);
            if($insertQuery)
            {
                $request->session()->flash('success_msg', 'Successfully updated');
            }
            else
            {
                $request->session()->flash('error_msg', 'Something went wrong! Try again');
            }
        return redirect()->back();
    }

    // mount delete function
    public function mount_delete_fx(Request $request)
    {
        $delQuery = MountBracketModel::where('id',$_GET['id'])->delete();
        $msg = "error";
        if($delQuery)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }


    public function mount_img_delete_fx(Request $request)
    {
        $updateQuery = MountBracketModel::where('id',$_GET['id'])->update(['mount_bracket_img' => null]);
        $msg = "error";
        if($updateQuery)
        {
            $msg = "success";
        }
        echo json_encode($msg);
    }

    public function mount_video_delete_fx(Request $request)
    {
        $updateQuery = MountBracketModel::where('id',$_GET['id'])->update(['video_link_data' => null]);
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
        $updateQuery = MountBracketModel::where('id',$_POST['popup_hidden_id'])->update($updateArr);
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
        $updateQuery = MountBracketModel::where('id',$_POST['popup_hidden_id'])->update($updateArr);
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
        $Query = MountBracketModel::where('id',$_GET['id'])->get();
        foreach($Query as $q1)
        {
            $html['popup_name'] = $q1->popup_name;
            $html['popup_details'] = $q1->popup_details;
        }
        echo json_encode($html);
    }
}
