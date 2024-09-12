<?php

namespace Tests\Feature;

use App\Models\ChecklistGroup;
use App\Models\User;
use App\Services\MenuService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminChecklistTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        // creating admin user
        $admin = User::factory()->create(['is_admin' => true]);

        // create a checklist group
        $response = $this->actingAs($admin)->post('admin/checklist_groups', [
            'name' => 'First Group',
        ]);
        $response->assertRedirect('welcome');

        // retrieving the group we made
        $group = ChecklistGroup::where('name', 'First Group')->first();
        $this->assertNotNull($group);

        // getting edit page of group
        $response = $this->actingAs($admin)->get('admin/checklist_groups/'. $group->id .'/edit');
        $response->assertOk();

        // updating the group
        $response = $this->actingAs($admin)->put('admin/checklist_groups/'. $group->id , [
            'name' => 'Updated First Group',
        ]);
        $response->assertRedirect('welcome');

        // get updated group
        $group = ChecklistGroup::where('name', 'Updated First Group')->first();
        $this->assertNotNull($group);

        $menu = (new MenuService())->get_menu();
        $this->assertEquals(1, $menu['admin_menu']->where('name', 'Updated First Group')->count());
        $this->assertEquals(0, $menu['user_menu']->where('name', 'Updated First Group')->count());
        $this->assertNull($menu['user_menu']->where('name', 'Updated First Group')->first());

    }
}
