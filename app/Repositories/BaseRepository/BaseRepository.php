<?php
namespace App\Repositories\BaseRepository;

use App\Repositories\BaseRepository\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class BaseRepository implements BaseRepositoryInterface
{
	protected $model;
	/**
	 * BaseRepository constructor.
	 * @param Model $model
	 */
	public function __construct(Model $model)
	{
	    $this->model = $model;
	}
	public function create(array $attributes)
	{
	    return $this->model->create($attributes);
	}
	public function find($id)
	{
	    return $this->model->find($id);
	}
	public function delete($id)
	{
	    $object = $this->model->find($id);
	   return $object->delete();
	}
	public function viewAll()
	{
	    return $this->model->all();
	}
}