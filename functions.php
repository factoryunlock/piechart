<?php
function token_distribution_chart_shortcode() {
    // Enqueue React and ReactDOM from CDN
    wp_enqueue_script('react', 'https://unpkg.com/react@18.3.1/umd/react.production.min.js', array(), null, true);
    wp_enqueue_script('react-dom', 'https://unpkg.com/react-dom@18.3.1/umd/react-dom.production.min.js', array('react'), null, true);
    
    // Enqueue our chart assets
    wp_enqueue_style('token-chart-style', 'https://stellular-dieffenbachia-4a18bf.netlify.app/index-CICw4hhU.css', array(), null);
    wp_enqueue_script('token-chart-script', 'https://stellular-dieffenbachia-4a18bf.netlify.app/embed.js', array('react', 'react-dom'), null, true);
    
    // Generate unique ID for the container
    $chart_id = 'token-chart-' . uniqid();
    
    // Add required Tailwind classes to ensure proper styling
    add_action('wp_head', function() {
        echo '<style>
            .bg-gray-950 { background-color: rgb(3, 7, 18); }
            .text-white { color: white; }
            .rounded-lg { border-radius: 0.5rem; }
            .p-8 { padding: 2rem; }
        </style>';
    });
    
    // Return the HTML and initialization script
    return sprintf(
        '<div class="token-chart-container">
            <div id="%s" style="min-height: 600px;"></div>
            <script>
                window.addEventListener("load", function() {
                    if (typeof initTokenChart === "function") {
                        initTokenChart("%s");
                    } else {
                        console.error("Token chart initialization function not found");
                    }
                });
            </script>
        </div>',
        $chart_id,
        $chart_id
    );
}
add_shortcode('token_chart', 'token_distribution_chart_shortcode');

// Add this to prevent WordPress from adding <p> tags around the shortcode
remove_filter('the_content', 'wpautop');