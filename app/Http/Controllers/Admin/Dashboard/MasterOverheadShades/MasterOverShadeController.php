<?php

namespace App\Http\Controllers\Admin\Dashboard\MasterOverheadShades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\MasterOverheadModel;

class MasterOverShadeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index(Request $request)
    {
        return view('backend.pages.master-overhead.overhead-shades');
    }

    public function showP(Request $request)
    {
        $showQuery = MasterOverheadModel::get();
        if(count($showQuery) > 0)
        {
            $html = "";
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


                $html .= '<tr>
                            <td>'.++$i.'</td>
                            <td>'.$sqOne->overhead_shades_val.'</td>
                            <td>'.$status.'</td>
                            <td>'.$action_btn.' '.$edit_state.' '.$del_state.'</td>
                        </tr>';
            }
        }
        else
        {
            $html = '<tr>
                        <td colspan="4"><center class="text-danger"><i class="fa fa-times"></i> No data</center></td>
                    </tr>';
        }

        echo json_encode($html);
    }

    public function addP(Request $request)
    {
        $checkHeight = MasterOverheadModel::where('overhead_shades_val',strtolower($request->input('master_height')))->get();
        if(count($checkHeight) > 0)
        {
            $request->session()->flash('error_msg', 'This post length already added before');
            return redirect()->back();
        }
        else
        {
            $insertArr = [
                'overhead_shades_val' => strtolower($request->input('master_height')), 
                'admin_action' => 'yes', 
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
                
            ];
            $insertQuery = MasterOverheadModel::insert($insertArr);
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

    public function updateP(Request $request, $my_data)
    {
        $insertArr = [
            'overhead_shades_val' => strtolower($request->input('master_height')), 
            'admin_action' => 'yes', 
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
            
        ];
        $insertQuery = MasterOverheadModel::where('id',$my_data)->update($insertArr);
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

    public function showEditP(Request $request)
    {
        $changeQuery = MasterOverheadModel::where('id',$_GET['id'])->get();
        foreach($changeQuery as $cData)
        {
            $mainData = $cData->overhead_shades_val;
        }

        echo json_encode($mainData);
    }

    public function removeP(Request $request)
    {
        $changeQuery = MasterOverheadModel::where('id',$_GET['id'])->delete();
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
        $changeQuery = MasterOverheadModel::where('id',$_GET['id'])->update(['admin_action' => $state]);
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
