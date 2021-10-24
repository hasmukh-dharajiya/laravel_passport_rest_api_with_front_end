<?php

namespace App\Classes;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskClass
{
    private $task;
    public function __construct(Task $task)
    {
        $this->task = $task;
    }
    public function getTask()
    {
        try {
            $data = $this->task->getTask();
            if (isset($data) && !empty($data)) {
                return response()->json(['status' => true, 'message' => 'task get success', 'data' => $data])->setStatusCode(200);
            }
            return response()->json(['status' => false, 'message' => 'error while get task'])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("TaskClassClass Error", ["getTask" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(['status' => false, 'message' => 'internal server error'])->setStatusCode(500);
        }
    }
    public function addTask($name, $due_date, $responsible_user, $status)
    {
        try {
            $addProduct = $this->task->addTask($name, $due_date, $responsible_user, $status);
            if ($addProduct) {
                return response()->json(['status' => true, 'message' => 'task add success'])->setStatusCode(200);
            }
            return response()->json(['status' => false, 'message' => 'error while add task'])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("TaskClass Error", ["addTask" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(['status' => false, 'message' => 'internal server error'])->setStatusCode(500);
        }
    }
    public function getSingleTask($id)
    {
        try {
            $data = $this->task->getSingleTask($id);
            if (isset($data) && !empty($data)) {
                return response()->json(['status' => true, 'message' => 'task get success', 'data' => $data])->setStatusCode(200);
            }
            return response()->json(['status' => false, 'message' => 'error while get task'])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("TaskClassClass Error", ["getTask" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(['status' => false, 'message' => 'internal server error'])->setStatusCode(500);
        }
    }
    public function updateTask($id,$name, $due_date, $responsible_user, $status)
    {
        try {
            $updateProduct = $this->task->updateTask($id,$name, $due_date, $responsible_user, $status);
            if ($updateProduct) {
                return response()->json(['status' => true, 'message' => 'task update success'])->setStatusCode(200);
            }
            return response()->json(['status' => false, 'message' => 'error while update task'])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("TaskClass Error", ["addTask" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(['status' => false, 'message' => 'internal server error'])->setStatusCode(500);
        }
    }
    public function deleteTask($id)
    {
        try {
            $data = $this->task->deleteTask($id);
            if ($data) {
                return response()->json(['status' => true, 'message' => 'task delete success'])->setStatusCode(200);
            }
            return response()->json(['status' => false, 'message' => 'error while delete task'])->setStatusCode(400);
        } catch (\Exception $ex) {
            Log::info("TaskClassClass Error", ["getTask" => $ex->getMessage(), "line" => $ex->getLine()]);
            return response()->json(['status' => false, 'message' => 'internal server error'])->setStatusCode(500);
        }
    }
}
