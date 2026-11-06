<?php

namespace Tests\Feature;

use Tests\TestCase;

class SeoMetadataTest extends TestCase
{
    public function test_home_page_includes_json_ld_structured_data(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('application/ld+json', false);
        $response->assertSee('ProfessionalService');
        $response->assertSee('Morrisville');
        $response->assertSee('27560');
        $response->assertSee('+19843888298');
    }

    public function test_canonical_url_is_rendered_on_marketing_pages(): void
    {
        $pages = ['/', '/about', '/services', '/plans', '/portfolio', '/quote'];

        foreach ($pages as $p) {
            $response = $this->get($p);
            $response->assertStatus(200);
            $response->assertSee('<link rel="canonical" href="', false);
        }
    }

    public function test_open_graph_meta_tags_rendered(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('property="og:type" content="website"', false);
        $response->assertSee('property="og:site_name" content="Azora Solution"', false);
        $response->assertSee('property="og:title"', false);
        $response->assertSee('property="og:description"', false);
        $response->assertSee('property="og:image"', false);
    }

    public function test_sitemap_xml_is_valid_xml_with_valid_dates(): void
    {
        $sitemapPath = public_path('sitemap.xml');
        $this->assertFileExists($sitemapPath);

        $xmlContent = file_get_contents($sitemapPath);
        $this->assertStringNotContainsString('{{', $xmlContent, 'Sitemap should not contain unparsed blade tags.');

        $xml = simplexml_load_string($xmlContent);
        $this->assertNotFalse($xml, 'Sitemap must parse as valid XML.');
        $this->assertGreaterThan(5, count($xml->url));

        foreach ($xml->url as $urlEntry) {
            $this->assertNotEmpty((string)$urlEntry->loc);
            $this->assertMatchesRegularExpression('/^\d{4}-\d{2}-\d{2}$/', (string)$urlEntry->lastmod);
        }
    }

    public function test_robots_txt_disallows_sensitive_paths(): void
    {
        $robotsPath = public_path('robots.txt');
        $this->assertFileExists($robotsPath);

        $robotsContent = file_get_contents($robotsPath);
        $this->assertStringContainsString('Disallow: /dashboard', $robotsContent);
        $this->assertStringContainsString('Disallow: /admin', $robotsContent);
        $this->assertStringContainsString('Disallow: /api/', $robotsContent);
        $this->assertStringContainsString('Sitemap:', $robotsContent);
    }
}

