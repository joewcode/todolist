<?php
namespace App\Controllers;

use Rakit\Validation\Validator;
use App\Models\Task;


class IndexController extends Controller
{
	private $sortMap = array(
			'id' => 'id DESC',
			'na' => 'name ASC',
			'nz' => 'name DESC', 
			'ae' => 'email ASC', 
			'ez' => 'email DESC', 
			'sa' => 'status ASC', 
			'sz' => 'status DESC'
		);
	
	// index page
	public function index()
	{
		$total_rows = Task::count();
		$total_pages = ceil($total_rows / PAGINATE_STEP);
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$offset = ($page-1) * PAGINATE_STEP; 
		$sortId = isset($_GET['sort']) ? htmlspecialchars($_GET['sort']) : 'id';
		if ( !$sort = $this->sortMap[$sortId] ) {
			$sort = $this->sortMap['id'];
			$sortId = 'id';
		}
		$tasks = Task::orderByRaw($sort)->skip($offset)->take(PAGINATE_STEP)->get();
		echo twig()->render('index.html', [
			'tasks' => $tasks, 
			'auth' => auth(), 
			'currentPage' => $page,
			'paginator' => \App\paginate(PAGINATE_STEP, $page, $total_rows, $total_pages, '/', $sortId),
		]);
	}
	
	
}
