<?php
namespace App\Controllers;

use Rakit\Validation\Validator;
use App\Models\Task;


class TaskController extends Controller
{
	// new task to database
	public function createTask()
	{
		if ( $this->taskValidate() ) {
			Task::create([
					'name' => htmlspecialchars($_POST['inputTaskName']),
					'email' => htmlspecialchars($_POST['inputTaskMail']),
					'text' => htmlspecialchars($_POST['inputTaskText'])
				]);
		}
		// to index
			header('Location: /');
	}
	
	// get and view one task
	public function editTask($id)
	{
		if ( \App\is_admin() ) {
			$task = Task::whereId( (int)$id )->first();
			echo twig()->render('edit.html', ['task' => $task]);
		} else {
			header('Location: /?err=auth');
		}
	}
	
	// set new data to task database
	public function updateTask($id)
	{
		if ( \App\is_admin() ) {
			$task = Task::whereId( (int)$id )->first();
			if ( !$task ) {
				header('Location: /?err=tasl-undefined');
				return false;
			}
			if ( $this->taskValidate() ) {
				$task->update([
						'name' => htmlspecialchars($_POST['inputTaskName']),
						'email' => htmlspecialchars($_POST['inputTaskMail']),
						'text' => htmlspecialchars($_POST['inputTaskText'])
					]);
				// to index
				header('Location: /');
			}
		} else {
			header('Location: /?err=auth');
		}
	}
	
	// delete task
	public function deleteTask($id)
	{
		if ( \App\is_admin() ) {
			Task::destroy( (int)$id );
			header('Location: /');
		} else {
			header('Location: /?err=auth');
		}
	}
	
	// confirm task
	public function confirmTask($id)
	{
		if ( \App\is_admin() ) {
			Task::whereId( (int)$id )->update(['status' => 1]);
			header('Location: /');
		} else {
			header('Location: /?err=auth');
		}
	}
	
	private function taskValidate()
	{
		$validator = new Validator;
		$validation = $validator->make($_POST, [
				'inputTaskName' => 'required|min:1',
				'inputTaskMail' => 'required|email',
				'inputTaskText' => 'required|min:1|max:2000'
			]);
		$validation->validate();
		if ( !$validation->fails()) {
			return true;
		} else {
			$errors = $validation->errors();
			echo '<pre>';
			print_r($errors->firstOfAll());
			echo '</pre>';
			return false;
		}
	}
	
}
