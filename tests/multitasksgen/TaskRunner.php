<?php

class TaskRunner
{
    protected $tasks;

    public function __construct()
    {
        //init tasks list
        $this->tasks = new SplQueue;
    }

    public function addTask(Generator $task)
    {
        //add task at the end of the queue
        $this->tasks->enqueue($task);
    }

    public function run()
    {
        $i = 1;

        //while there is at least one task to execute
        while (!$this->tasks->isEmpty())
        {
            //we remove the first task and get it in a var
            $task = $this->tasks->dequeue();

            //we can stop a task sending an exception with throw
            if ($i == 5)
            {
                $task->throw(new Exception('stop task'));
            }
            
            //we execute next step of the task (the task is a generator and we use it as a coroutine)
            $task->send('hello world');//it will trigger the next yield in the task

            //if the task is not over (means there are remaining yield in the task) we put it back at then end of the queue
            if ($task->valid()) //valid is a method from iterator to check if there is another iteration next
            {
                $this->addTask($task);
            }
            
            $i++;
        }
    }
}