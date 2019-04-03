<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitLinksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_submit_a_new_link()
    {
        $response = $this->post('/', [
            'title' => 'Example Title',
            'url' => 'http://example.com',
            'description' => 'Example description.',
        ]);

        $this->assertDatabaseHas('links', [
            'title' => 'Example Title'
        ]);

        $response
            ->assertStatus(302)
            ->assertHeader('Location', url('/'));

        $this
            ->get('/')
            ->assertSee('Example Title');
    }

    /** @test */
    function link_is_not_created_if_validation_fails()
    {
        $response = $this->post('/');

        $response->assertSessionHasErrors(['title', 'url', 'description']);
    }

    /** @test */
        function max_length_succeeds_when_under_max()
        {
            $url = 'http://';
            $url .= str_repeat('a', 255 - strlen($url));

            $data = [
                'title' => str_repeat('a', 255),
                'url' => $url,
                'description' => str_repeat('a', 255),
            ];

            $this->post('/', $data);

            $this->assertDatabaseHas('links', $data);
        }

}
