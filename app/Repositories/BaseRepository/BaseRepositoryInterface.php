<?php 
namespace App\Repositories\BaseRepository;

interface BaseRepositoryInterface
{
    public function create(array $attributes);
    public function find($id);
    public function delete($id);
    public function viewAll();
}