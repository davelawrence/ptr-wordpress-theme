<?php
function ptre_render_nearby_cities_shortcode( $atts ) {
  // Query Vaudreuil-Soulanges
  $vaudreuil = get_posts([
    'post_type'      => 'cities',
    'posts_per_page' => -1,
    'tax_query'      => [[
      'taxonomy' => 'cities_categories',
      'field'    => 'slug',
      'terms'    => 'vaudreuil-soulanges',
    ]],
  ]);

  // Query West Island
  $west = get_posts([
    'post_type'      => 'cities',
    'posts_per_page' => -1,
    'tax_query'      => [[
      'taxonomy' => 'cities_categories',
      'field'    => 'slug',
      'terms'    => 'west-island',
    ]],
  ]);

ob_start();
?>
<section class="nearby-cities">
  <div class="container-fluid px-0" style="background-color:#021A56;">
    <div class="container py-5 text-white">
      
      <!-- Title -->
      <h2 class="text-center mb-4">Get Real Estate Info for Nearby Cities</h2>
      
      <!-- Two‑column region lists -->
      <div class="row">
        
        <!-- Vaudreuil‑Soulanges -->
<div class="col-lg-6 mb-4">
  <h3 class="h5 mb-3">Homes for Sale in Vaudreuil‑Soulanges, QC</h3>
  <ul class="list-unstyled">
    <?php foreach( $vaudreuil as $city ): ?>
      <li class="mb-2">
        <a href="<?php echo esc_url( get_permalink( $city->ID ) ); ?>"
           class="text-white">
          <?php echo esc_html( get_the_title( $city->ID ) ); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

<!-- West Island -->
<div class="col-lg-6 mb-4">
  <h3 class="h5 mb-3">Homes for Sale in the West Island of Montreal</h3>
  <ul class="list-unstyled">
    <?php foreach( $west as $city ): ?>
      <li class="mb-2">
        <a href="<?php echo esc_url( get_permalink( $city->ID ) ); ?>"
           class="text-white">
          <?php echo esc_html( get_the_title( $city->ID ) ); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

        
      </div><!-- /.row -->
      
    </div><!-- /.container -->
  </div><!-- /.container-fluid -->
</section>
<?php
return ob_get_clean();

}
add_shortcode( 'nearby_cities', 'ptre_render_nearby_cities_shortcode' );

