<?php

namespace App\Classes;

use App\Models\Project;
use Illuminate\Support\Facades\Log;

class ProjectClass
{
    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    public function getProject()
    {
        try {
            $data = $this->project->getProject();
            if (isset($data) && !empty($data)) {
                return response()->json(['status' => true, 'message' => 'project get success', 'data' => $data])->setStatusCode(200);
            }
            return response()->json(['status' => false, 'message' => 'error while get project'])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("TaskClassClass Error", ["getProject" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(['status' => false, 'message' => 'internal server error'])->setStatusCode(500);
        }
    }

    public function addProject($name, $budget, $responsible_user, $status)
    {
        try {
            $addProduct = $this->project->addProject($name, $budget, $responsible_user, $status);
            if ($addProduct) {
                return response()->json(['status' => true, 'message' => 'project add success'])->setStatusCode(200);
            }
            return response()->json(['status' => false, 'message' => 'error while add project'])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("ProjectClass Error", ["addProject" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(['status' => false, 'message' => 'internal server error'])->setStatusCode(500);
        }
    }

    public function getSingleProject($id)
    {
        try {
            $data = $this->project->getSingleProject($id);
            if (isset($data) && !empty($data)) {
                return response()->json(['status' => true, 'message' => 'project get success', 'data' => $data])->setStatusCode(200);
            }
            return response()->json(['status' => false, 'message' => 'error while get project'])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("TaskClassClass Error", ["getProject" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(['status' => false, 'message' => 'internal server error'])->setStatusCode(500);
        }
    }

    public function updateProject($id, $name, $budget, $responsible_user, $status)
    {
        try {
            $updateProduct = $this->project->updateProject($id, $name, $budget, $responsible_user, $status);
            if ($updateProduct) {
                return response()->json(['status' => true, 'message' => 'project update success'])->setStatusCode(200);
            }
            return response()->json(['status' => false, 'message' => 'error while update project'])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("ProjectClass Error", ["addProject" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(['status' => false, 'message' => 'internal server error'])->setStatusCode(500);
        }
    }

    public function deleteProject($id)
    {
        try {
            $data = $this->project->deleteProject($id);
            if ($data) {
                return response()->json(['status' => true, 'message' => 'project delete success'])->setStatusCode(200);
            }
            return response()->json(['status' => false, 'message' => 'error while delete project'])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("TaskClassClass Error", ["getProject" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(['status' => false, 'message' => 'internal server error'])->setStatusCode(500);
        }
    }
}
