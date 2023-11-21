<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Check if country parameter is provided in the GET request
$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookupType = isset($_GET['lookup']) ? $_GET['lookup'] : '';

// Database connection
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if ($lookupType === 'cities') {
    // Lookup Cities
    $stmt = $conn->prepare("SELECT cities.name AS city_name, cities.district, cities.population
                            FROM cities
                            JOIN countries ON cities.countrycode = countries.code
                            WHERE countries.name = :country");
} else {
    // Default: Lookup Country
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name = :country");
}

$stmt->bindParam(':country', $country, PDO::PARAM_STR);
$stmt->execute();

// Fetch the results
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<?php if (isset($country) && !isset($context)): ?>
  <table id="tableCountries" class="display">
    <caption><h2>TABLE SHOWING COUNTRIES</h2></caption>
    <thead>
      <tr>
        <th class="mth1">Name</th>
        <th class="mth2">Continent</th>
        <th class="mth3">Independence</th>
        <th class="mth4">Name of State</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($results as $country): ?>
        <tr>
          <td><?php echo $country["name"]; ?></td>
          <td><?php echo $country["continent"]; ?></td>
          <td><?php echo $country["independence_year"]; ?></td>
          <td><?php echo $country["head_of_state"]; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<?php if (isset($context)): ?>
  <table id="tableCities" class="display" style="display: none;">
    <caption><h2>TABLE SHOWING CITIES</h2></caption>
    <thead>
      <tr>
        <th class="oomf">Name</th>
        <th class="oomf">District</th>
        <th class="oomf">Population</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($city as $city): ?>
        <tr>
          <td><?php echo $city["name"]; ?></td>
          <td><?php echo $city["district"]; ?></td>
          <td><?php echo $city["population"]; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

