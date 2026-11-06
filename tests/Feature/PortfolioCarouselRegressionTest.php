<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortfolioCarouselRegressionTest extends TestCase
{
    public function test_portfolio_page_renders_paymate_carousel_component(): void
    {
        $response = $this->get('/portfolio');

        $response->assertStatus(200);

        // Assert core carousel structure
        $response->assertSee('pm-car', false);
        $response->assertSee('pm-car-strip', false);
        $response->assertSee('pm-car-card', false);

        // Assert all 6 sector case studies are rendered
        $response->assertSee('Tri-County Restaurant Group');
        $response->assertSee('Urban Boutique &amp; Apparel', false);
        $response->assertSee('Metro Mechanical &amp; Plumbing', false);
        $response->assertSee('Northside Family Medical');
        $response->assertSee('Apex Commercial Supply');
        $response->assertSee('Coastal Performance Lab');

        // Assert carousel script and stylesheet are included
        $response->assertSee('paymate-carousel.css');
        $response->assertSee('paymate-carousel.js');
    }

    public function test_portfolio_carousel_images_are_all_present_and_accessible(): void
    {
        $carouselImages = [
            'assets/img/portfolio/case-restaurant.jpg',
            'assets/img/portfolio/case-boutique.jpg',
            'assets/img/portfolio/case-trades.jpg',
            'assets/img/portfolio/case-medical.jpg',
            'assets/img/portfolio/case-fitness.jpg',
            'assets/img/portfolio/case-supply.jpg',
        ];

        foreach ($carouselImages as $img) {
            $this->assertFileExists(public_path($img), "Carousel card image [{$img}] must exist.");
            $this->assertGreaterThan(10000, filesize(public_path($img)), "Carousel card image [{$img}] must not be empty.");
        }
    }
}
