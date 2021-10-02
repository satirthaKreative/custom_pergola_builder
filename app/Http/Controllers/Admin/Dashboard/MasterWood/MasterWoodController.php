<?php

namespace App\Http\Controllers\Admin\Dashboard\MasterWood;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\MasterWood\MasterWoodModel;

class MasterWoodController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(Request $request)
    {
        return view('backend.pages.master-wood.master-wood');
    }

    public function master_show_wood_fx(Request $request)
    {
        $showQuery = MasterWoodModel::get();
        if(count($showQuery) > 0)
        {
            $html['wood_tbl_html'] = "";
            $i = 0;
            foreach($showQuery as $sqOne)
            {
                if($sqOne->admin_action == 'yes' )
                {
                    $status = '<span class="text-success"><i class="fa fa-check"></i> Active</span>';
                    $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$sqOne->admin_action.'",'.$sqOne->id.') class="btn btn-sm btn-danger">Make it In-Active</a>';
                }
                else if($sqOne->admin_action == 'no' )
                {
                    $status = '<span class="text-danger"><i class="fa fa-times"></i> Deactive</span>';
                    $action_btn = '<a href="javascript: ;" onclick=make_btn_change("'.$sqOne->admin_action.'",'.$sqOne->id.') class="btn btn-sm btn-success">Make it Active</a>';
                }
                else
                {

                }

                $del_state = '<a href="javascript: ;" onclick=make_del_change('.$sqOne->id.') class="text-danger"><i class="fa fa-trash"></i></a>';

                $edit_state = '<a href="javascript: ;" onclick=make_edit_change('.$sqOne->id.') class="text-info"><i class="fa fa-edit"></i></a>';

                if($sqOne->wood_img != null || $sqOne->wood_img != "")
                {
                    $wood_img_new_file = '<img src="'.str_replace('public','storage/app/public',asset($sqOne->wood_img)).'" alt="wood type image" width="200px"/>';
                }
                else
                {
                    $wood_img_new_file = "";
                }


                $html['wood_tbl_html'] .= '<tr>
                            <td>'.++$i.'</td>
                            <td>'.$wood_img_new_file.'</td>
                            <td>'.$sqOne->wood_name.'</td>
                            <td>'.$sqOne->wood_descriptions.'</td>
                            <td>'.$status.'</td>
                            <td>'.$action_btn.' '.$edit_state.' '.$del_state.'</td>
                        </tr>';
            }

            $html['status_wood_tbl'] = "success";
        }
        else
        {
            $html['wood_tbl_html'] = '<tr>
                        <td colspan="5"><center class="text-danger"><i class="fa fa-times"></i> No data</center></td>
                    </tr>';
            $html['status_wood_tbl'] = "error";
        }
        
        echo json_encode($html);
    }

    // submit - wood details 
    public function master_wood_submit(Request $request)
    {
        if($request->hasFile('wood_img_name'))
        {
            $wood_img_file = $request->file('wood_img_name')->store('public/wood_img_file/master');
        }
        else
        {
            $wood_img_file = "";
        }

        $wood_name = $request->input('wood_name');
        $wood_price = $request->input('wood_price');

        if($wood_name == null || $wood_name == "")
        {
            $request->session()->flash('error_msg', 'wood name cannot be empty');
        }
        else if($wood_price == null || $wood_price == "")
        {
            $request->session()->flash('error_msg', 'wood price cannot be empty');
        }
        else
        {
            $insertArr = [
                "wood_name" => $wood_name, 
                "wood_img" => $wood_img_file, 
                "wood_price" => $wood_price,
                "wood_descriptions" => $request->input('wood_descriptions'),
                "admin_action" => 'yes', 
                "created_at" => date('Y-m-d'), 
                "updated_at" => date('Y-m-d'), 
            ];

            $insertQuery = MasterWoodModel::insert($insertArr);
            if($insertArr)
            {
                $request->session()->flash('success_msg', 'Successfully wood type inserted');
            }
            else
            {
                $request->session()->flash('error_msg', 'Something went wrong ! try again');
            }
        }
        return redirect()->back();
    }


    public function master_wood_action_get_show(Request $request)
    {
        $getId = $_GET['id'];

        $woodQuery = MasterWoodModel::where('id',$getId)->get();

        if(count($woodQuery) > 0)
        {
            foreach($woodQuery as $wQuery)
            {
                $html['wood_name'] = $wQuery->wood_name;
                $html['wood_price'] = $wQuery->wood_price;
                $html['wood_descrip'] = $wQuery->wood_descriptions;
                if($wQuery->wood_img == "" || $wQuery->wood_img == null)
                {
                    $html['wood_img'] = "";
                }
                else
                {
                    $html['wood_img'] = '<img src="'.str_replace("public","storage/app/public",asset($wQuery->wood_img)).'" alt="wood image" style="width: 200px"/>';
                }
            }
        }

        echo json_encode($html);
    }


    public function master_wood_submit_update(Request $request)
    {
        if($request->hasFile('wood_img_name'))
        {
            $wood_img_file = $request->file('wood_img_name')->store('public/wood_img_file/master');
        }
        else
        {
            $updateImgQuery = MasterWoodModel::where('id',$request->input('wood_hidden_type_name'))->get();
            foreach($updateImgQuery as $updateQuery)
            {
                $wood_img_path = $updateQuery->wood_img;
            }
            $wood_img_file = $wood_img_path;
        }

        $wood_name = $request->input('wood_name');
        $wood_price = $request->input('wood_price');

        if($wood_name == null || $wood_name == "")
        {
            $request->session()->flash('error_msg', 'wood name cannot be empty');
        }
        else if($wood_price == null || $wood_price == "")
        {
            $request->session()->flash('error_msg', 'wood price cannot be empty');
        }
        else
        {
            $insertArr = [
                "wood_name" => $wood_name, 
                "wood_img" => $wood_img_file, 
                "wood_price" => $wood_price,
                "wood_descriptions" => $request->input('wood_descriptions'),
                "admin_action" => 'yes', 
                "created_at" => date('Y-m-d'), 
                "updated_at" => date('Y-m-d'), 
            ];

            $insertQuery = MasterWoodModel::where('id',$request->input('wood_hidden_type_name'))->update($insertArr);
            if($insertArr)
            {
                $request->session()->flash('success_msg', 'Successfully wood type updated');
            }
            else
            {
                $request->session()->flash('error_msg', 'Something went wrong ! try again');
            }
        }
        return redirect()->back();
    }

    public function actionP(Request $request)
    {
        if($_GET['state'] == "yes")
        {
            $state = "no";
        }
        else if($_GET['state'] == "no")
        {
            $state = "yes";
        }
        $changeQuery = MasterWoodModel::where('id',$_GET['id'])->update(['admin_action' => $state]);
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

    public function actionDel(Request $request)
    {
        $delQuery = MasterWoodModel::where('id',$_GET['id'])->delete();
        if($delQuery)
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
