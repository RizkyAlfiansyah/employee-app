<?php 

namespace App\Repository;

use App\Models\Employee;
use App\Repository\IEmployeeRepository;

class EmployeeRepository implements IEmployeeRepository
{   
    protected $employee = null;

    public function getAll()
    {
        return Employee::all();
    }

    public function getById($id)
    {
        return Employee::find($id);
    }

    public function createOrUpdate( $id = null, $collection = [] )
    {   
        if(is_null($id)) {
            $employee = new Employee();
            $employee->name = $collection['name'];
            $employee->salary = $collection['salary'];
            return $employee->save();
        }
        $employee = Employee::find($id);
        $employee->name = $collection['name'];
        $employee->email = $collection['salary'];
        return $employee->save();
    }
    
    public function delete($id)
    {
        return Employee::find($id)->delete();
    }
}

?>