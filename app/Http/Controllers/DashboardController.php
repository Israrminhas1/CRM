<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function Themeupdate($id, Request $req)
    {
        $theme = DB::table('theme_setting')
        ->select('*')
        ->where('user_id', auth()->user()->id)
        ->first();
        if ($theme == '' || $theme == null) {
            DB::table('theme_setting')->insert(
                ['theme' => $id, 'user_id' => auth()->user()->id]
            );
            echo true;
        } else {
            DB::table('theme_setting')->where('user_id', auth()->user()->id)->update(
                ['theme' => $id]
            );
            echo true;
        }
    }

    public function Themeupdate_rtl($id, Request $req)
    {
        $theme = DB::table('theme_setting')
        ->select('*')
        ->where('user_id', auth()->user()->id)
        ->first();
        if ($theme == '' || $theme == null) {
            DB::table('theme_setting')->insert(
                ['rtl_mode' => $id, 'user_id' => auth()->user()->id]
            );
            echo true;
        } else {
            DB::table('theme_setting')->where('user_id', auth()->user()->id)->update(
                ['rtl_mode' => $id]
            );
            echo true;
        }
    }

    public function Themeupdate_gradient($id, Request $req)
    {
        $theme = DB::table('theme_setting')
        ->select('*')
        ->where('user_id', auth()->user()->id)
        ->first();
        if ($theme == '' || $theme == null) {
            DB::table('theme_setting')->insert(
                ['gradient' => $id, 'user_id' => auth()->user()->id]
            );
            echo true;
        } else {
            DB::table('theme_setting')->where('user_id', auth()->user()->id)->update(
                ['gradient' => $id]
            );
            echo true;
        }
    }

    public function Themeupdate_sidebar($id, Request $req)
    {
        $theme = DB::table('theme_setting')
        ->select('*')
        ->where('user_id', auth()->user()->id)
        ->first();
        if ($theme == '' || $theme == null) {
            DB::table('theme_setting')->insert(
                ['light_sidebar' => $id, 'user_id' => auth()->user()->id]
            );
            echo true;
        } else {
            DB::table('theme_setting')->where('user_id', auth()->user()->id)->update(
                ['light_sidebar' => $id]
            );
            echo true;
        }
    }
    public function getPieChartData(){
        $purchasesitemssum = DB::table('project_purchases as i')
->select('w.item_name as itemname','w.cost_price as costprice',DB::raw('COUNT(w.item_name) as item'))
->join('projects as pp', 'i.project_id', '=', 'pp.id')
->join('project_purchases_item as p', 'i.id', '=', 'p.project_purchase_id')
->join('inventory_items as w', 'p.purchase_item_id', '=', 'w.id')
->where('pp.is_deleted','N')

->groupBy('w.item_name')
->groupBy('w.cost_price')
->get();
return $purchasesitemssum;
    }
    public function getMilestoneData(){
      
        
       
    
        $ids = DB::table('projects_milestones')
        ->select('project_id')
        ->where('is_deleted','N')
        ->orderBy('id', 'ASC')
        ->pluck('project_id')
        ->toArray();
        $ids = array_unique($ids);
     
        foreach($ids as $p){
            $milestonesid = DB::table('projects_milestones')
            ->select('project_id','milestone_status','milestone_ended','milestone_started')
            ->where('project_id',$p)
            ->where('is_deleted','N')
            ->orderBy('id', 'ASC')
            ->get();
        
      $check=['Up Coming', 'Currently Working' ,'On Hold','Completed','Terminated','Cancelled'];

      $data=NULL;
            foreach($milestonesid as $md){
        if($md->milestone_status==="Up Coming"){
            $data[0]= [
                "x" =>$md->milestone_status,
                "y"=>[1000 * strtotime($md->milestone_started),1000 * strtotime($md->milestone_ended)]
            ];
        }
        else if($md->milestone_status==="Currently Working"){
            $data[1]= [
                "x" =>$md->milestone_status,
                "y"=>[1000 * strtotime($md->milestone_started),1000 * strtotime($md->milestone_ended)]
            ];
        }
       else if($md->milestone_status==="Completed"){
            $data[2]= [
                "x" =>$md->milestone_status,
                "y"=>[1000 * strtotime($md->milestone_started),1000 * strtotime($md->milestone_ended)]
            ];
        }
       else if($md->milestone_status==="On Hold"){
            $data[3]= [
                "x" =>$md->milestone_status,
                "y"=>[1000 * strtotime($md->milestone_started),1000 * strtotime($md->milestone_ended)]
            ];
        }
       else if($md->milestone_status==="Terminated"){
            $data[4]= [
                "x" =>$md->milestone_status,
                "y"=>[1000 * strtotime($md->milestone_started),1000 * strtotime($md->milestone_ended)]
            ];
        }
      else if($md->milestone_status==="Cancelled"){
            $data[5]= [
                "x" =>$md->milestone_status,
                "y"=>[1000 * strtotime($md->milestone_started),1000 * strtotime($md->milestone_ended)]
            ];
        }
       
              
           
              
                 
                   
            }
            foreach($check as $c)
           if(array_search($c, array_column($data, 'x')) === false){
            if($c==="Up Coming"){
                $data[0]= [
                    "x" =>$c,
                    "y"=>[0,0]
                ];
            }
            if($c==="Currently Working"){
                $data[1]= [
                    "x" =>$c,
                    "y"=>[0,0]
                ];
            }
           if($c==="Completed"){
            $data[2]= [
                "x" =>$c,
                "y"=>[0,0]
            ];
            }
            if($c==="On Hold"){
            $data[3]= [
                "x" =>$c,
                "y"=>[0,0]
            ];
            }
            if($c==="Terminated"){
            $data[4]= [
                "x" =>$c,
                "y"=>[0,0]
            ];
            }
          if($c==="Cancelled"){
            $data[5]= [
                "x" =>$c,
                "y"=>[0,0]
            ];
            }
          
           }
         
           ksort($data);
          $data= array_values($data);
          
        $projects = DB::table('projects')
        ->select('name')
        ->where('id',$p)
        ->where('is_deleted','N')
        ->pluck('name')
        ->first();
    
                $myarray[] = [
                    "name" =>$projects,
                    "data"=>  $data

                ];
             
        }
       
   
      

        // foreach($milestones as $m){
         
        // $data[]=[
        //     "x"=>$m->milestone_status,
        //     "y"=>[1000 * strtotime($m->milestone_started),1000 * strtotime($m->milestone_ended)]
        // ]
            
    
           
        // }
        // $milliseconds = 1000 * strtotime('25-11-2009');
  return $myarray;
    }
}
