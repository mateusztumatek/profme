<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request){
        $report = Report::create([
            'elem_id' => $request->elem_id,
            'elem_type' => $request->elem_type,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'seen' => 0,
            'accepted' => 0,
        ]);

        return back()->with(['message' => 'zgloszenie numer: '. $report->id . ' zostało przyjęte, przepraszamy za utrudnienia ']);
    }

    public function accept(Request $request){
        if(isset($request->reports)){
            foreach ($request->reports as $rep){
                $report = Report::findOrFail($rep);
                if($report->elem_type == 'post'){
                    $post = $report->getElement();
                    $post->status = 'reported';
                    $post->update();
                }
                if($report->elem_type == 'employee'){
                    $employee = $report->getElement();
                    $employee->active = 0;
                    $employee->update();
                }
                if($report->elem_type == 'education'){
                    $education = $report->getElement();
                    $education->active = 0;
                    $education->update();
                }
                if($report->elem_type == 'image'){
                    $image = $report->getElement();
                    $image->active = 0;
                    $image->update();
                }
            }
        }



        $report->seen = 1;
        $report->accepted = 1;
        $report->update();
        $reports = Report::getReports();
        return view('Admin.reports_index', compact('reports'))->render();
    }

    public function getOtherReports(Report $report){
        $reports = $report->getOtherReports();
        return view('Admin.other_reports_modal', compact('reports'))->render();
    }

    public function delete(Request $request){
        if(isset($request->reports)){

            foreach ($request->reports as $report){
               $rep = Report::findOrFail($report);
                if(!empty($other_reports = $rep->getOtherReports())){
                    foreach ($other_reports as $r){
                        $r->delete();
                    }
                }
                $rep->delete();
            }
            $reports = Report::getReports();
            return view('Admin.reports_index', compact('reports'))->render();

        }
    }

    public function markSeen(Request $request){
        foreach ($request->reports as $report){
            $rep = Report::findOrFail($report);
            if(!empty($other_reports = $rep->getOtherReports())){
                foreach ($other_reports as $r){
                    $r->seen = 1;
                    $r->update();
                }
            }

            $rep->seen = 1;
            $rep->update();
        }
        $reports = Report::getReports();
        return view('Admin.reports_index', compact('reports'))->render();
    }
    public function markUnSeen(Request $request){
        foreach ($request->reports as $report){
            $rep = Report::findOrFail($report);
            if(!empty($other_reports = $rep->getOtherReports())){
                foreach ($other_reports as $r){
                    $r->seen = 0;
                    $r->update();
                }
            }
            $rep->seen = 0;
            $rep->update();
        }
        $reports = Report::getReports();
        return view('Admin.reports_index', compact('reports'))->render();
    }

    public function AllMarkSeen(){
        $reports = Report::where('seen', 0)->get();
        foreach ($reports as $report){
            $report->seen = 1;
            $report->update();
        }
        $reports = Report::getReports();
        return view('Admin.reports_index', compact('reports'))->render();

    }

    public function unaccept(Request $request){
        if(isset($request->reports)){
            foreach ($request->reports as $rep){
                $report = Report::findOrFail($rep);
                if($report->elem_type == 'post'){
                    $post = $report->getElement();
                    $post->status = 'expectant';
                    $post->update();
                }
                if($report->elem_type == 'employee'){
                    $employee = $report->getElement();
                    $employee->active = 1;
                    $employee->update();
                }
                if($report->elem_type == 'education'){
                    $education = $report->getElement();
                    $education->active = 1;
                    $education->update();
                }
                if($report->elem_type == 'image'){
                    $image = $report->getElement();
                    $image->active = 1;
                    $image->update();
                }
            }
        }



        $report->seen = 1;
        $report->accepted = 0;
        $report->update();
        $reports = Report::getReports();
        return view('Admin.reports_index', compact('reports'))->render();

    }
}
