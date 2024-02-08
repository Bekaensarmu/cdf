<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Client;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_clients_list(): void
    {
        $clients = Client::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.clients.index'));

        $response->assertOk()->assertSee($clients[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_client(): void
    {
        $data = Client::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.clients.store'), $data);

        $this->assertDatabaseHas('clients', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_client(): void
    {
        $client = Client::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
            'adress' => $this->faker->text(255),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'zipcode' => $this->faker->text(255),
            'telephone' => $this->faker->randomNumber(0),
            'DOB' => $this->faker->date(),
        ];

        $response = $this->putJson(route('api.clients.update', $client), $data);

        $data['id'] = $client->id;

        $this->assertDatabaseHas('clients', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_client(): void
    {
        $client = Client::factory()->create();

        $response = $this->deleteJson(route('api.clients.destroy', $client));

        $this->assertModelMissing($client);

        $response->assertNoContent();
    }
}
