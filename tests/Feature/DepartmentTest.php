<?php

namespace Tests\Feature;

use App\Http\Livewire\DepartmentList;
use App\Http\Livewire\NewDepartmentForm;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Livewire\Livewire;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    /**
     * The department list test. (none login)
     *
     * @return void
     */
    public function testRouteDepartmentNoneLogin()
    {
        $response = $this->get(route('department.index'))->assertRedirect(route('login'));

        $response->assertStatus(302);
    }

    /**
     * The department list test. (login)
     *
     * @return void
     */
    public function testRouteDepartmentLogin()
    {
        $response = Sanctum::actingAs(User::factory()->make());

        $response = $this->get(route('department.index'));

        $response->assertStatus(200)->assertViewIs('dashboard-department-list');

        $response->assertSeeTextInOrder(['Departments List', '編號', '部門名稱']);

        // Department list remove item
        $randomDept = Department::inRandomOrder()->limit(1)->get('id')->first()['id'];
        var_dump('testRouteDepartmentLogin()->' . $randomDept);
        Livewire::test(DepartmentList::class)
            ->call('removeFromTableRow', $randomDept);
    }

    public function testRouteDepartmentCreateNoneLogin()
    {
        $response = $this->get(route('department.create'))->assertRedirect(route('login'));

        $response->assertStatus(302);
    }

    public function testRouteDepartmentCreateLogin()
    {
        $response = Sanctum::actingAs(User::factory()->create());

        $response = $this->get(route('department.create'));

        $response->assertStatus(200)->assertViewIs('dashboard-department-create');

        $response->assertSeeTextInOrder(['New Department Form', '新增部門', '新增']);

        $_randomDepartmentName = 'department-' . Str::random(5);
        Livewire::test(NewDepartmentForm::class)
            ->set('dept_name', $_randomDepartmentName)
            ->call('submitForm');
        $this->assertTrue(Department::whereDept_name($_randomDepartmentName)->exists());
    }
}
