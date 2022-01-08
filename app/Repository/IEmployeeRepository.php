<?php 
namespace App\Repository;

interface IEmployeeRepository
{
    public function getAll();

    public function getById($id);

    public function createOrUpdate( $id = null, $collection = [] );

    public function delete($id);
}

?>