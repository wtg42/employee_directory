<?php

namespace Tests\Feature;

use App\Http\Livewire\NewDirectoryForm;
use App\Models\Department;
use App\Models\Directory;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Livewire\Livewire;
use Tests\TestCase;

class DirectoryTest extends TestCase
{
    // 測試完清空 Table
    // use RefreshDatabase;

    /**
     * Test route directory.index
     * @return void
     */
    public function testRouteDirectory()
    {
        $response = $this->get('/directory');

        $response->assertStatus(200);

        $response->assertSeeLivewire('directory-list');

        $response->assertSeeTextInOrder(['Directories List', '中文姓名']);
    }

    /**
     *  Test route directory.create with authenticated user
     *  @return void
     */
    public function testRouteDirectoryCreateLoginAndCreateNew()
    {
        $response = Sanctum::actingAs(User::factory()->create());

        $response = $this->get(route('directory.create'));

        $response->assertStatus(200);

        $response->assertViewIs('dashboard-directory-create');

        $response->assertSeeLivewire('new-directory-form');

        $response->assertSeeTextInOrder(['New Directory Form', '新增通訊錄', '中文姓名', '新增']);

        $_testEmployeeNum = rand(100000, 999999);
        Livewire::test(NewDirectoryForm::class)
            ->set('employee_number', $_testEmployeeNum)
            ->set('chinese_name', '喬' . rand(1, 999999))
            ->set('english_name', 'joe' . rand(1, 999999))
            ->set('email', rand(1, 999999) . '@gmail.com')
            ->set('phone', '0' . rand(900000000, 999999999))
            ->set('ext', rand(100, 999))
            ->set('dept', rand(1, Department::count()))
            ->call('submitForm');

        $this->assertTrue(Directory::whereEmployee_number($_testEmployeeNum)->exists());
    }

    /**
     *  Test route directory.create with authenticated user
     *  @return void
     */
    public function testRouteDirectoryCreateNoneLogin()
    {

        // 非登入狀態最終會導向登入頁面
        $response = $this->get(route('directory.create'))->assertRedirect(route('login'));

        $response->assertStatus(302);
    }
}
