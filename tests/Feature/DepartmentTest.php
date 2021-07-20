<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
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
    }

    public function testRouteDepartmentCreateNoneLogin()
    {
        $response = $this->get(route('department.create'))->assertRedirect(route('login'));

        $response->assertStatus(302);
    }

    public function testRouteDepartmentCreateLogin()
    {
        $response = Sanctum::actingAs(User::factory()->make());

        $response = $this->get(route('department.create'));

        $response->assertStatus(200)->assertViewIs('dashboard-department-create');

        $response->assertSeeTextInOrder(['New Department Form', '新增部門', '新增']);
    }
}
