<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class HistoricalGetDataRequestTest extends TestCase
{

    /** @test */
    public function request_should_fail_when_no_email_is_provided()
    {
        $response = $this->postJson(route('gethistoricaldata'), [
                'symbol' => 'AMRN',
                'start_date' => '2023-04-01',
                'end_date' => '2023-04-31',
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function request_should_fail_when_invalid_email_is_provided()
    {
        $response = $this->postJson(route('gethistoricaldata'), [
                'symbol' => 'AMRN',
                'start_date' => '2023-04-01',
                'end_date' => '2023-04-31',
                'email' => 'test email'
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('email');
    }

    /** @test */
    public function request_should_fail_when_no_symbol_is_provided()
    {
        $response = $this->postJson(route('gethistoricaldata'), [
                'start_date' => '2023-04-01',
                'end_date' => '2023-04-31',
                'email' => 'test@gmail.com'
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('symbol');
    }

    /** @test */
    public function request_should_fail_when_no_start_date_is_provided()
    {
        $response = $this->postJson(route('gethistoricaldata'), [
                'symbol' => 'AMRN',
                'end_date' => '2023-04-31',
                'email' => 'test@gmail.com'
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('start_date');
    }

    /** @test */
    public function request_should_fail_when_invalid_start_date_is_provided()
    {
        $response = $this->postJson(route('gethistoricaldata'), [
                'symbol' => 'AMRN',
                'start_date' => 'test',
                'end_date' => '2023-04-31',
                'email' => 'test@gmail.com'
            ]);

        $response->assertStatus(
            Response::HTTP_UNPROCESSABLE_ENTITY
        );

        $response->assertJsonValidationErrors('start_date');
    }

     /** @test */
     public function request_should_fail_when__start_date_is_provided_greater_than_end_date()
     {
         $response = $this->postJson(route('gethistoricaldata'), [
                 'symbol' => 'AMRN',
                 'start_date' => '2023-05-01',
                 'end_date' => '2023-04-31',
                 'email' => 'test@gmail.com'
             ]);

         $response->assertStatus(
             Response::HTTP_UNPROCESSABLE_ENTITY
         );

         $response->assertJsonValidationErrors('end_date');
     }

     /** @test */
     public function request_should_fail_when_start_date_end_date_are_provided_greater_than_current_date()
     {
         $response = $this->postJson(route('gethistoricaldata'), [
                 'symbol' => 'AMRN',
                 'start_date' => date("Y-m-d", strtotime("+2 day")),
                 'end_date' => '2023-05-31',
                 'email' => 'test@gmail.com'
             ]);
         $response->assertStatus(
             Response::HTTP_UNPROCESSABLE_ENTITY
         );

         $response->assertJsonValidationErrors('start_date');
     }

     /** @test */
     public function request_should_fail_when_no_end_date_is_provided()
     {
         $response = $this->postJson(route('gethistoricaldata'), [
                 'symbol' => 'AMRN',
                 'start_date' => date("Y-m-d", strtotime("+2 day")),
                 'end_date' => date("Y-m-d", strtotime("+10 day")),
                 'email' => 'test@gmail.com'
             ]);
         $response->assertStatus(
             Response::HTTP_UNPROCESSABLE_ENTITY
         );

         $response->assertJsonValidationErrors('end_date');
     }

     /** @test */
     public function request_should_pass_when_all_data_is_provided_correctly_and_verify_frontend_page_correctly()
     {
         $response = $this->postJson(route('gethistoricaldata'), [
                 'symbol' => 'AMRN',
                 'start_date' => '2023-04-01',
                 'end_date' => '2023-04-30',
                 'email' => 'areeb@nextgeni.com',
                 'company_name' => 'Test Company'
             ]);
        $response->assertValid();
        $response->assertSuccessful();
        $response->assertViewHasAll([ //check frontend view correctly
            'data',
            'date',
        ]);
     }
}
