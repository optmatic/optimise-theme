<?php

/**
 * Optimise Learning — Headless Index
 * ----------------------------------
 * Minimal fallback for root domain access.
 * Suggests use of REST API and links to admin login.
 */

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Optimise Learning | Headless CMS</title>
    <style>
        :root {
            --lightBackground: #e6f3ff;
            --lightAccent: #ffc857;
            --darkAccent: #fcb321;
            --primaryText: #003366;
            --secondaryText: #075985;
            --tertiaryText: #174870;
            --darkerPrimary: #2b6290;
            --lightestBlue: #e6f3ff;
            --darkText: #113351;
            --lightText: #ffffff;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--lightestBlue);
            color: var(--darkText);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 2rem;
            text-align: center;
        }

        h1 {
            font-size: 1.75rem;
            color: var(--primaryText);
        }

        p {
            font-size: 1rem;
            margin-top: 1rem;
            color: var(--tertiaryText);
        }

        code {
            background: rgba(0,0,0,0.05);
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-size: 0.95rem;
        }

        a {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 0.6rem 1.2rem;
            background: var(--darkAccent);
            color: var(--primaryText);
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            transition: background 0.2s ease;
        }

        a:hover {
            background: var(--lightAccent);
        }
    </style>
</head>
<body>
    <h1>Optimise Learning – Headless WordPress</h1>
    <p>This site is managed via a headless CMS.<br>
    Use the REST API to access content at: <code>/wp-json/wp/v2/posts</code></p>
    <a href="/wp-admin">Go to Admin Login</a>
</body>
</html>
