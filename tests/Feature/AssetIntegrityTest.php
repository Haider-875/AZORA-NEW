<?php

namespace Tests\Feature;

use Tests\TestCase;

class AssetIntegrityTest extends TestCase
{
    public function test_all_blade_asset_references_exist_on_disk(): void
    {
        $viewsPath = resource_path('views');
        $bladeFiles = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($viewsPath));

        $referencedAssets = [];

        foreach ($bladeFiles as $file) {
            if ($file->isDir() || !str_ends_with($file->getFilename(), '.blade.php')) {
                continue;
            }

            $content = file_get_contents($file->getPathname());

            // Match asset('...') or asset("...")
            preg_match_all("/asset\(\s*['\"]([^'\"]+)['\"]\s*\)/", $content, $matches);

            if (!empty($matches[1])) {
                foreach ($matches[1] as $assetPath) {
                    // Ignore data URIs or external links if any
                    if (!str_starts_with($assetPath, 'http') && !str_starts_with($assetPath, 'data:')) {
                        $referencedAssets[] = [
                            'path' => $assetPath,
                            'source' => $file->getFilename(),
                        ];
                    }
                }
            }
        }

        $this->assertNotEmpty($referencedAssets, 'At least one asset should be referenced in Blade views.');

        $missingAssets = [];
        foreach ($referencedAssets as $ref) {
            $fullPath = public_path($ref['path']);
            if (!file_exists($fullPath)) {
                $missingAssets[] = "{$ref['path']} (referenced in {$ref['source']})";
            }
        }

        $this->assertEmpty($missingAssets, "The following referenced assets are missing from public/:\n" . implode("\n", $missingAssets));
    }

    public function test_all_portfolio_and_case_study_images_exist(): void
    {
        $requiredImages = [
            'assets/img/portfolio/northforkauto.jpg',
            'assets/img/portfolio/caresourceindy.jpg',
            'assets/img/portfolio/futurefindshop.jpg',
            'assets/img/portfolio/case-restaurant.jpg',
            'assets/img/portfolio/case-boutique.jpg',
            'assets/img/portfolio/case-trades.jpg',
            'assets/img/portfolio/case-medical.jpg',
            'assets/img/portfolio/case-fitness.jpg',
            'assets/img/portfolio/case-supply.jpg',
        ];

        foreach ($requiredImages as $img) {
            $this->assertFileExists(public_path($img), "Portfolio image {$img} must exist.");
        }
    }

    public function test_pruned_legacy_assets_no_longer_exist_in_public(): void
    {
        $prunedPaths = [
            'assets/img/products',
            'assets/img/terminals',
            'assets/js/imgdata.js',
            'assets/js/dashboard.js',
            'assets/js/catalog-sync.js',
            'assets/js/lead-store.js',
        ];

        foreach ($prunedPaths as $p) {
            $this->assertFileDoesNotExist(public_path($p), "Legacy path {$p} should be pruned.");
        }
    }

    public function test_backup_zip_archive_exists_and_is_valid(): void
    {
        $zipPath = storage_path('app/backups/legacy-pruned-assets.zip');
        $this->assertFileExists($zipPath, 'The legacy pruned assets backup archive must exist.');
        $this->assertGreaterThan(1000000, filesize($zipPath), 'The backup zip archive must be at least 1MB.');
    }
}

