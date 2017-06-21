<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Task;
use App\Entities\User;
use Doctrine\ORM\EntityManagerInterface;

class TaskController extends Controller
{
    public function getIndex(EntityManagerInterface $em)
    {
        // $tasks = $em->getRepository(Task::class)->findAll();
        // $tasks = $em->createQueryBuilder()
        //             ->select('task')
        //             ->from(Task::class, 'task')
        //             ->getQuery()
        //             ->getResult();
        /* @var User $user */
        
        $user = \Auth::user();

        $tasks = $user->getTasks();

        return view('tasks', [
            'tasks' => $tasks
        ]);         
        return view('tasks', [
            'tasks' => $tasks
        ]);
    }
    
    public function getAdd(EntityManagerInterface $em)
    {
        $user = $em->getRepository(User::class)->findAll();

        return view('add', [
            'user' => $user
        ]);
    }

    public function postAdd(Request $request, EntityManagerInterface $em)
    {
        $this->validate($request, [
            'name'        => 'required|unique:App\Entities\Task,name',
            'description' => 'required',
        ]);

        $task = new Task(
            $request->get('name'),
            $request->get('description')
        );
        // $user = $em->getRepository(User::class)->find($request->get('userId'));
        // $task->setUser($user);

        $task->setUser(\Auth::user());

        $em->persist($task);
        $em->flush();
        return redirect('view-index')->with('success_message', 'Task added successfully!');
    }

    public function getToggle(EntityManagerInterface $em, $taskId)
    {
        /* @var Task $task */
        $task = $em->getRepository(Task::class)->find($taskId);

        $task->toggleStatus();
        $newStatus = ($task->isDone()) ? 'done' : 'not done';

        $em->flush();

        return redirect('/view-index')->with('success_message', 'Task successfully marked as ' . $newStatus);
    }

    public function getDelete(EntityManagerInterface $em, $taskId)
    {
        $task = $em->getRepository(Task::class)->find($taskId);

        $em->remove($task);
        $em->flush();

        return redirect('/view-index')->with('success_message', 'Task successfully removed.');
    }

    public function getEdit(EntityManagerInterface $em, $taskId)
    {
        $task = $em->getRepository(Task::class)->find($taskId);
        $user = $em->getRepository(User::class)->findAll();
        
        return view('edit', [
            'task' => $task,
            'user' => $user,
        ]);
    }

    public function postEdit(Request $request, EntityManagerInterface $em, $taskId)
    {
        /* @var Task $task */
        $task = $em->getRepository(Task::class)->find($taskId);

        $task->setName($request->get('name'));
        $task->setDescription($request->get('description'));

        $user = $em->getRepository(User::class)->find($request->get('userId'));
        $task->setUser($user);

        $em->flush();

        return redirect('/view-index')->with('success_message', 'Task modified successfully.');
    }
}
