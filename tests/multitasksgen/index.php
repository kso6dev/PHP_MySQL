<?php

function autoload($classname)
{
    if (file_exists($file = $classname . '.php'))
    {
        require $file;
    }
}
spl_autoload_register('autoload');

echo '<h1>Multitâches à l\'aide de Generateurs</h1>';


$taskrunner = new TaskRunner();
function task1()
{
    for ($i = 0; $i < 5; $i++)
    {
        try
        {
            $data = yield;
            echo '<p>Task <strong>1</strong>, iteration ', $i, ', sended value = ', $data, '</p>';
        }
        catch (Exception $e)
        {
            echo '<p>Task <strong>1</strong> stopped with exception: ', $e->getMessage(), '</p>';
            return;//il faut utiliser le return pour sortir de la boucle!
        }
    }
}

function task2()
{
    for ($i = 0; $i < 7; $i++)
    {
        try
        {
            $data = yield;
            echo '<p>Task <strong>2</strong>, iteration ', $i, ', sended value = ', $data, '</p>';
        }
        catch (Exception $e)
        {
            echo '<p>Task <strong>2</strong> stopped with exception: ', $e->getMessage(), '</p>';
            return;//il faut utiliser le return pour sortir de la boucle!
        }
    }
}

function task3()
{
    for ($i = 0; $i < 2; $i++)
    {
        try
        {
            $data = yield;
            echo '<p>Task <strong>3</strong>, iteration ', $i, ', sended value = ', $data, '</p>';
        }
        catch (Exception $e)
        {
            echo '<p>Task <strong>3</strong> stopped with exception: ', $e->getMessage(), '</p>';
            return;//il faut utiliser le return pour sortir de la boucle!
        }
    }
}

$taskrunner->addTask(task1());
$taskrunner->addTask(task2());
$taskrunner->addTask(task3());
$taskrunner->run();
echo '<br>fin';