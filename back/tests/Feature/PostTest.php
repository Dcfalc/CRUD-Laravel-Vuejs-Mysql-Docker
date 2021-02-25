<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->get('/api/posts');

        // $response
        //     ->assertStatus(200)
        //     ->assertJson([
        //         'posts' => true,
        //     ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
            'posts' => [
                '*' => [
                    'id',
                    'author',
                    'title',
                    'text'
                ]
            ]
        ]);
    }

    public function test_store_ok()
    {
        $response = $this->post('/api/posts', 
            [
                'author' => 'autor',
                'title' => 'titulo',
                'text' => 'textoasdasdasdasd',
                'email' => 'email@email.com',
                'phone' => '12121212'
            ]);

        $response->assertStatus(201);      
    }

    public function test_store_error_required()
    {
        $response = $this->post('/api/posts');

        $response
            ->assertStatus(400)
            ->assertJsonStructure([
            'error' => [
                'author',
                'title',
                'text',
                'email',
                'phone'
            ]
        ]);
    }

    public function test_store_error_fields()
    {
        $response = $this->post('/api/posts',
            [
                'author' => 'au',
                'title' => 'asd',
                'text' => 'texto',
                'email' => 'email#email.com',
                'phone' => '123'
            ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([
            'error' => [
                'author',
                'title',
                'text',
                'email',
                'phone'
            ]
        ]);
    }

    public function test_show()
    {
        $response = $this->get('/api/posts/1');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
            'post' => [
                'id',
                'author',
                'title',
                'text',
                'email',
                'phone',
                'updated_at',
                'created_at'
            ]
        ]);
    }

    public function test_show_empty()
    {
        $response = $this->get('/api/posts/2000');

        $response->assertStatus(204);
    }

    public function test_update_ok()
    {
        $response = $this->put('/api/posts/1', 
            [
                'author' => 'autor',
                'title' => 'titulo',
                'text' => 'textoasdasdasdasd',
                'email' => 'email@email.com',
                'phone' => '12121212'
            ]);

        $response->assertStatus(200);
    }

    public function test_update_error_required()
    {
        $response = $this->put('/api/posts/1');

        $response
            ->assertStatus(400)
            ->assertJsonStructure([
            'error' => [
                'author',
                'title',
                'text',
                'email',
                'phone'
            ]
        ]);
    }

    public function test_update_error_fields()
    {
        $response = $this->put('/api/posts/1',
            [
                'author' => 'au',
                'title' => 'asd',
                'text' => 'texto',
                'email' => 'email#email.com',
                'phone' => '123'
            ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([
            'error' => [
                'author',
                'title',
                'text',
                'email',
                'phone'
            ]
        ]);
    }

    public function test_destroy_ok()
    {
        $response = $this->delete('/api/posts/1');

        $response->assertStatus(200);
    }

    public function test_destroy_error()
    {
        $response = $this->delete('/api/posts/200');

        $response->assertStatus(404);
    }
}
