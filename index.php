<?php
  $page_title = "Klyp Developer Test - Geraint Bateman";
  require_once( 'initialise.php' );
  require( PAGES . 'header.php' );

  if ( is_post_request() ) {

    $args = $_POST['colour_selector'];

    $curl = curl_init();
    $curl_api_url = 'http://www.omdbapi.com/?apikey=de7148ee&t=' . $args;
    
    curl_setopt_array( $curl, array(
      CURLOPT_URL => $curl_api_url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
      ),
    ));

    $response = curl_exec( $curl );
    $err = curl_error( $curl );

    curl_close( $curl );

    $movie_json_data = json_decode( $response, true );

  }

?>

  <form method="post">

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-10 offset-sm-1">
          <label for="colour_selector">Please select a colour:</label>
          <select name="colour_selector" id="colour_selector" required="">
            <option value="" disabled selected>Colours</option>
            <option value="red">Red</option>
            <option value="green">Green</option>
            <option value="blue">Blue</option>
            <option value="yellow">Yellow</option>
          </select>
          <input type="submit" name="submit" value="Retrieve Movies" class="btn btn-info">
        </div>
      </div>
      <?php if ( isset( $movie_json_data ) ) {
        change_background_colour( current( $movie_json_data ) ); ?>
        <div class="row">
          <div class="col-sm-10 offset-sm-1">
            <table>
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Year</th>
                  <th>Runtime</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php foreach ( $movie_json_data as $key => $value) {
                    if ( $key == 'Title' ) { echo ('<td>') . $value . '</td>'; }
                    if ( $key == 'Year' ) { echo ('<td>') . $value . '</td>'; }
                    if ( $key == 'Runtime' ) { echo ('<td>') . $value . '</td>'; }
                  } ?>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      <?php } ?>
    </div>

  </form>

<?php require( PAGES . 'footer.php' ); ?>