<?php

namespace App\Classes;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class DashboardClass
{
    private $task,$project;
    public function __construct(Project $project,Task $task)
    {
        $this->task = $task;
        $this->project = $project;
    }
    public function getDashboard(){
        try {
            $data = [];

            $getProject = $this->project->getProject();
            $getTotalProject = $this->project->getTotalProject();
            $getCompleteProject = $this->project->getCompleteProject();

            $getTask = $this->task->getTask();
            $getTotalTask = $this->task->getTotalTask();
            $getCompleteTask = $this->task->getCompleteTask();

            $data["Project"] = $getProject;
            $data["task"] = $getTask;
            $data["totalProject"] = $getTotalProject;
            $data["totalTask"] = $getTotalTask;
            $data["completeProject"] = $getCompleteProject;
            $data["completeTask"] = $getCompleteTask;

            if (isset($data) && !empty($data)){
                return response()->json(["status"=>true,"message"=>"dashboard Data Get Success","data"=>$data])->setStatusCode(200);
            }
            return response()->json(["status"=>true,"message"=>"error while get dashboard data"])->setStatusCode(400);
        }catch (\Exception $ex){
            Log::info("DashboardClass Error",["getDashboard"=>$ex->getMessage(),"line"=>$ex->getLine()]);
            return response()->json(["status"=>false,"message"=>"internal server Error"])->setStatusCode(500);
        }
    }
}
