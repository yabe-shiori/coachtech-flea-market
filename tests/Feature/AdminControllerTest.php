<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;
use App\Models\ItemImage;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;

class AdminControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testAdminCanViewItemList()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $items = Item::factory(3)->create();

        foreach ($items as $item) {
            ItemImage::factory()->create(['item_id' => $item->id]);
        }

        $response = $this->get(route('admin.item.index'));

        $response->assertStatus(200);

        foreach ($items as $item) {
            $response->assertSee($item->name);
            $response->assertSee($item->images->first()->image_path);
        }
    }

    public function testAdminCannotViewItemListWithoutLogin()
    {
        $items = Item::factory(3)->create();

        foreach ($items as $item) {
            ItemImage::factory()->create(['item_id' => $item->id]);
        }

        $response = $this->get(route('admin.item.index'));

        $response->assertRedirect(route('admin.login'));
    }

    public function testAdminCanViewCreatePage()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.create');
    }

    public function testAdminCanCreateAdmin()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $newAdminData = [
            'name' => 'Test Admin',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post(route('admin.store'), $newAdminData);

        $response->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('admins', [
            'name' => $newAdminData['name'],
            'email' => $newAdminData['email'],
        ]);
    }

    public function testAdminCanViewNotificationForm()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.showNotificationForm'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.notification');
    }

    public function testAdminCanSendNotificationEmail()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $user1 = User::factory()->create(['email' => 'user1@example.com']);
        $user2 = User::factory()->create(['email' => 'user2@example.com']);

        $subject = 'テスト件名';
        $content = 'テスト内容';

        Mail::fake();
        $response = $this->post(route('admin.sendNotification'), [
            'subject' => $subject,
            'content' => $content,
        ]);

        Mail::assertSent(NotificationEmail::class, function ($mail) use ($subject, $content) {
            return $mail->hasSubject($subject) &&
                $mail->content === $content;
        });

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('message', 'お知らせメールを送信しました。');
    }
}
