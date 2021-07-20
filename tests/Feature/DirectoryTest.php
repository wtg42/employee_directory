<?php

namespace Tests\Feature;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DirectoryTest extends TestCase
{
    /**
     * Test route directory.index
     *
     * @return void
     */
    public function testRouteDirectory()
    {
        $response = $this->get('/directory');

        $response->assertStatus(200);

        $response->assertSeeTextInOrder(['Directories List', '中文姓名']);
    }

    /**
     *  Test route directory.create with authenticated user
     *  @return void
     */
    public function testRouteDirectoryCreateLogin()
    {
        $response = Sanctum::actingAs(User::factory()->make());

        $response = $this->get(route('directory.create'));

        $response->assertStatus(200);

        $response->assertViewIs('dashboard-directory-create');

        $response->assertSeeTextInOrder(['New Directory Form', '新增通訊錄', '中文姓名', '新增']);
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
