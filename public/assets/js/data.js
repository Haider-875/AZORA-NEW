/* Azora Solutions — Catalog & Services Shared Data (Hardware Removed) */
window.AZ_DATA = {
  products: [], // Hardware fleet removed as per requirement
  services: [
    {
      id: 'website-starter',
      name: 'Website Starter Plan',
      category: 'Web Design',
      lease: '$99/mo',
      icon: 'globe',
      blurb: 'A professional business website built to establish credibility and convert traffic.',
      features: [
        'Mobile responsive design',
        'Up to 5 website pages',
        'Contact & quote forms',
        'Basic SEO setup',
        'Security & speed optimization'
      ]
    },
    {
      id: 'website-growth',
      name: 'Website Growth Plan',
      category: 'Web Design',
      lease: '$185/mo',
      icon: 'globe',
      blurb: 'A complete growth-focused website built to turn visitors into calls, leads and customers.',
      features: [
        'Everything in Starter',
        'Up to 10 website pages',
        'Conversion-focused design',
        'Advanced SEO structure',
        'Google Business integration',
        'Monthly website updates'
      ]
    },
    {
      id: 'website-premium',
      name: 'Website Premium Plan',
      category: 'Web Design',
      lease: '$249/mo',
      icon: 'globe',
      blurb: 'A high-performance digital presence for businesses ready to compete and scale.',
      features: [
        'Everything in Growth',
        'Unlimited website sections',
        'Advanced conversion optimization',
        'Advanced analytics setup',
        'Priority website support',
        'Ongoing improvements'
      ]
    },
    {
      id: 'marketing-starter',
      name: 'Local Marketing Starter Plan',
      category: 'Marketing & SEO',
      lease: '$285/mo',
      icon: 'trend',
      blurb: 'A strong local marketing foundation to help nearby customers discover and trust your business.',
      features: [
        'Google Business Profile optimization',
        'Local SEO optimization',
        'Local keyword research',
        'Citation & directory setup',
        'Monthly performance report',
        'Monthly strategy review'
      ]
    },
    {
      id: 'marketing-growth',
      name: 'Growth Marketing & Local SEO Plan',
      category: 'Marketing & SEO',
      lease: '$365/mo',
      icon: 'trend',
      blurb: 'A stronger growth campaign combining local SEO, deeper optimization and ongoing strategy.',
      features: [
        'Everything in Local Starter',
        'Advanced keyword targeting',
        'On-page SEO optimization',
        'Content strategy',
        'Local competitor research',
        'Monthly ROI & ranking report'
      ]
    },
    {
      id: 'marketing-premium',
      name: 'Market Leader Marketing Plan',
      category: 'Marketing & SEO',
      lease: '$399/mo',
      icon: 'trend',
      blurb: 'Our highest-tier growth plan for businesses that want stronger visibility, more leads and continued optimization.',
      features: [
        'Everything in Growth',
        'Advanced local SEO campaign',
        'Content & landing page strategy',
        'Competitor monitoring',
        'Lead generation optimization',
        'Priority strategy & support'
      ]
    },
    {
      id: 'ai-voice-receptionist',
      name: 'AI Voice Receptionist',
      category: 'AI Automation',
      lease: 'Custom',
      icon: 'spark',
      blurb: '24/7 intelligent voice answering that captures calls, books appointments and routes VIP leads.',
      features: [
        '24/7 call answering & greeting',
        'Natural conversational speech',
        'Appointment booking integration',
        'Instant SMS & email call summaries',
        'Custom business knowledge training'
      ]
    },
    {
      id: 'ai-whatsapp-concierge',
      name: 'WhatsApp AI Concierge',
      category: 'AI Automation',
      lease: 'Custom',
      icon: 'chat',
      blurb: 'Automated WhatsApp front-office assistant delivering instantaneous quotes and customer support.',
      features: [
        'Instant response to inquiries',
        'Automated quoting & qualification',
        'CRM & lead sync',
        'Multi-lingual support',
        'Human escalation triggers'
      ]
    }
  ],
  websitePlans: [
    {
      id: 'website-starter',
      tier: 'Starter',
      name: 'Website Starter',
      price: '$99',
      period: '/month',
      badge: 'Starter',
      popular: false,
      bestFor: 'Local brands',
      desc: 'Everything a small business needs to establish a professional and credible online presence.',
      features: [
        'Professional business website',
        'Mobile responsive design',
        'Up to 5 website pages',
        'Contact & quote forms',
        'Basic SEO setup',
        'Security & speed optimization'
      ],
      ctaText: 'Get Started',
      ctaHref: '/quote?type=plan&product=website-starter'
    },
    {
      id: 'website-growth',
      tier: 'Growth',
      name: 'Website Growth',
      price: '$185',
      period: '/month',
      badge: 'Most Popular',
      popular: true,
      bestFor: 'Growing teams',
      desc: 'A complete growth-focused website built to turn visitors into calls, leads and customers.',
      features: [
        'Everything in Starter',
        'Up to 10 website pages',
        'Conversion-focused design',
        'Advanced SEO structure',
        'Google Business integration',
        'Monthly website updates'
      ],
      ctaText: 'Choose Growth',
      ctaHref: '/quote?type=plan&product=website-growth'
    },
    {
      id: 'website-premium',
      tier: 'Premium',
      name: 'Website Premium',
      price: '$249',
      period: '/month',
      badge: 'Premium',
      popular: false,
      bestFor: 'Scaling brands',
      desc: 'A premium digital presence for businesses ready to compete, scale and stand out in their market.',
      features: [
        'Everything in Growth',
        'Unlimited website sections',
        'Advanced conversion optimization',
        'Advanced analytics setup',
        'Priority website support',
        'Ongoing improvements'
      ],
      ctaText: 'Go Premium',
      ctaHref: '/quote?type=plan&product=website-premium'
    }
  ],
  marketingPlans: [
    {
      id: 'marketing-starter',
      tier: 'Local Starter',
      name: 'Local Starter',
      price: '$285',
      period: '/month',
      badge: 'Launch',
      popular: false,
      bestFor: 'Local brands',
      desc: 'A strong local marketing foundation to help nearby customers discover and trust your business.',
      features: [
        'Google Business Profile optimization',
        'Local SEO optimization',
        'Local keyword research',
        'Citation & directory setup',
        'Monthly performance report',
        'Monthly strategy review'
      ],
      ctaText: 'Get Started',
      ctaHref: '/quote?type=plan&product=marketing-starter'
    },
    {
      id: 'marketing-growth',
      tier: 'Growth',
      name: 'Marketing Growth',
      price: '$365',
      period: '/month',
      badge: 'Most Popular',
      popular: true,
      bestFor: 'Growing teams',
      desc: 'A stronger growth campaign combining local SEO, deeper optimization and ongoing strategy.',
      features: [
        'Everything in Local Starter',
        'Advanced keyword targeting',
        'On-page SEO optimization',
        'Content strategy',
        'Local competitor research',
        'Monthly ROI & ranking report'
      ],
      ctaText: 'Choose Growth',
      ctaHref: '/quote?type=plan&product=marketing-growth'
    },
    {
      id: 'marketing-premium',
      tier: 'Market Leader',
      name: 'Market Leader',
      price: '$399',
      period: '/month',
      badge: 'Market Leader',
      popular: false,
      bestFor: 'Scaling brands',
      desc: 'Our highest-tier growth plan for businesses that want stronger visibility, more leads and continued optimization.',
      features: [
        'Everything in Growth',
        'Advanced local SEO campaign',
        'Content & landing page strategy',
        'Competitor monitoring',
        'Lead generation optimization',
        'Priority strategy & support'
      ],
      ctaText: 'Go Premium',
      ctaHref: '/quote?type=plan&product=marketing-premium'
    }
  ]
};
