<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use App\Models\Report;
use App\Models\Subscriber;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SafirPlatformTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\Database\Seeders\SafirPlatformSeeder::class);
    }
    public function test_root_redirects_to_localized_home(): void
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }

    public function test_localized_homepages_render_successfully(): void
    {
        foreach (['ar', 'en', 'tr'] as $locale) {
            $response = $this->get("/{$locale}");
            $response->assertStatus(200);
            $response->assertSee('SAFIR');
        }
    }

    public function test_embassies_page_renders_successfully(): void
    {
        $response = $this->get('/en/embassies');
        $response->assertStatus(200);
        $response->assertSee('Institutional Liaison');

        $arResponse = $this->get('/ar/embassies');
        $arResponse->assertStatus(200);
    }

    public function test_corporates_page_renders_successfully(): void
    {
        $response = $this->get('/en/corporates');
        $response->assertStatus(200);
        $response->assertSee('Market Entry');
    }

    public function test_reports_center_renders_and_filters(): void
    {
        $response = $this->get('/en/reports');
        $response->assertStatus(200);

        $filtered = $this->get('/en/reports?category=macro_markets');
        $filtered->assertStatus(200);
    }

    public function test_single_report_page_renders(): void
    {
        $report = Report::first();
        if ($report) {
            $response = $this->get("/en/reports/{$report->slug}");
            $response->assertStatus(200);
            $response->assertSee($report->getLocalized('title', 'en'));
        } else {
            $this->assertTrue(true);
        }
    }

    public function test_inquiry_submission_creates_record(): void
    {
        $data = [
            'name' => 'Diplomatic Trade Counsellor',
            'organization' => 'Embassy Commercial Section',
            'country' => 'Qatar',
            'email' => 'counsellor@qatar-embassy.test',
            'phone' => '+974 4400 0000',
            'service_type' => 'embassy',
            'details' => 'Requesting bilateral commercial briefings and institutional ministerial meetings in Ankara.',
        ];

        $response = $this->post('/inquiries', $data);
        $response->assertStatus(302);

        $this->assertDatabaseHas('inquiries', [
            'email' => 'counsellor@qatar-embassy.test',
            'country' => 'Qatar',
        ]);
    }

    public function test_newsletter_subscriber_creates_record(): void
    {
        $data = [
            'email' => 'subscriber.test@safirbusinesshub.test',
            'full_name' => 'Investor Director',
            'organization' => 'Gulf Sovereign Fund',
        ];

        $response = $this->postJson('/subscribers', $data);
        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('subscribers', [
            'email' => 'subscriber.test@safirbusinesshub.test',
        ]);
    }
}
