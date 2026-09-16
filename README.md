# WordPress Custom Theme — Job & Video Media Site

A custom WordPress theme for a job listing and video media platform.  
Built as a freelance project, with client-specific content replaced for portfolio purposes.

## Features

- Custom post type: Job listings
- Custom taxonomies: Employment type, job type, area (47 prefectures), video category
- Multiple video support (up to 5 YouTube videos per job post) with modal playback
- Job search & filter (employment type, job type, area, keyword)
- ACF (Advanced Custom Fields) integration
- Contact Form 7 + Multi-Step Forms for application and inquiry forms
- Yoast SEO integration with custom title filter
- Fully responsive (PC / SP)

## Tech Stack

- WordPress
- PHP
- SCSS (Dart Sass, BEM methodology)
- Vanilla JavaScript
- ACF (Free)
- Contact Form 7
- Yoast SEO

## Theme Structure

```
media-job-theme/
├── sass/
│   ├── abstracts/       # Variables, mixins
│   ├── base/            # Reset, typography
│   ├── components/      # Cards, buttons, header, footer...
│   └── pages/           # Page-specific styles
├── js/
│   ├── navigation.js
│   └── video-modal.js
├── inc/
│   └── post-types.php   # Custom post types & taxonomies
├── template-parts/
│   └── job-list.php
├── acf-json/            # ACF field group definitions
└── functions.php
```

## Author

[haruiro](https://github.com/haruiro)
