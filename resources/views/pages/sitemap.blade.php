<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">


    <url>
        <loc>https://safeaquatech.com/</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/water-purifier-for-home</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/ro-installation-near-me</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/water-filter-for-home</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/water-softener</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/water-purifier</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/soft-water-conditioner</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/ro-water-plant</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/water-purifiers</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/about</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/service</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/product</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/blog</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://safeaquatech.com/contact</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>0.80</priority>
    </url>
    @foreach ($data as $sitemap)
    <url>
        <loc>https://www.safeaquatech.com/{{ $sitemap->slug_url }}/{{ $sitemap->random_id }}</loc>
        <lastmod>2024-03-04T07:23:27+00:00</lastmod>
        <priority>0.80</priority>
    </url>
    @endforeach


</urlset>
