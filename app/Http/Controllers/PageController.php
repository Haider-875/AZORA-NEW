<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Homepage.
     */
    public function home()
    {
        return view('pages.home', [
            'title' => 'Azora Solution | Website Development, Local SEO & AI Automation Services',
            'metaDescription' => 'Azora Solution engineers custom high-converting business websites, local SEO growth systems, and AI front-office automation to help US businesses scale.',
            'canonical' => url('/'),
            'activeNav' => 'home',
        ]);
    }

    /**
     * About Us.
     */
    public function about()
    {
        return view('pages.about', [
            'title' => 'About Azora Solution | American Engineering & Digital Growth Architecture',
            'metaDescription' => 'Learn about Azora Solution — our mission, leadership, US engineering values, and dedication to growing American businesses.',
            'canonical' => url('/about'),
            'activeNav' => 'about',
        ]);
    }

    /**
     * Services Overview.
     */
    public function services()
    {
        return view('pages.services', [
            'title' => 'Digital Solutions & Engineering Services | Azora Solution',
            'metaDescription' => 'Explore custom website development, local SEO dominance, AI front-office voice agents, and custom enterprise business software.',
            'canonical' => url('/services'),
            'activeNav' => 'services',
        ]);
    }

    /**
     * Plans & Pricing.
     */
    public function plans()
    {
        return view('pages.plans', [
            'title' => 'Pricing & Plans | Transparent Website & SEO Packages | Azora Solution',
            'metaDescription' => 'Transparent, high-ROI plans for Website Development and Local SEO. No long-term lock-ins, enterprise-grade engineering.',
            'canonical' => url('/plans'),
            'activeNav' => 'plans',
        ]);
    }

    /**
     * Plans & Services combo page alias.
     */
    public function plansServices()
    {
        return view('pages.plans-services', [
            'title' => 'Plans & Services | Azora Solution',
            'metaDescription' => 'Explore full pricing tiers and enterprise digital services tailored for ambitious businesses.',
            'canonical' => url('/plans-services'),
            'activeNav' => 'plans',
        ]);
    }

    /**
     * Portfolio / Client Success.
     */
    public function portfolio()
    {
        return view('pages.portfolio', [
            'title' => 'Client Success Stories & Portfolio | Azora Solution',
            'metaDescription' => 'See how Azora Solution transforms local businesses with custom website architecture, organic local rankings, and AI front-office systems.',
            'canonical' => url('/portfolio'),
            'activeNav' => 'portfolio',
        ]);
    }

    /**
     * Get a Quote / Interactive Proposal Generator.
     */
    public function quote(Request $request)
    {
        return view('pages.quote', [
            'title' => 'Request a Rapid Quote | Custom Web & Marketing Proposal | Azora Solution',
            'metaDescription' => 'Request an itemized proposal for custom web development, local SEO, or AI automation. Direct response within 15 minutes.',
            'canonical' => url('/quote'),
            'activeNav' => 'quote',
            'preselectedType' => $request->query('type', ''),
            'preselectedProduct' => $request->query('product', ''),
        ]);
    }

    /**
     * Success confirmation page.
     */
    public function success()
    {
        return view('pages.success', [
            'title' => 'Proposal Requested Successfully | Azora Solution',
            'metaDescription' => 'Thank you for reaching out to Azora Solution. Your proposal request has been received by our engineering team.',
            'canonical' => url('/success'),
            'activeNav' => '',
        ]);
    }
}
