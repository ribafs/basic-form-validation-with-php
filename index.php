<?php
$errors = [];
$fields = ['name', 'address', 'email', 'howMany', 'favoriteFruit', 'brochure'];
$optionalFields = ['brochure'];
$values = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  foreach ($fields as $field) {
    if (empty($_POST[$field]) && !in_array($field, $optionalFields)) {
      $errors[] = $field;
    } else {
      $values[$field] = $_POST[$field];
    }
  }

  if (empty($errors)) {
    foreach ($fields as $field) {
      if ($field === "favoriteFruit") {
        printf("%s: %s<br />", $field, var_export($_POST[$field], TRUE));
      } else {
        printf("%s: %s<br />", $field, $_POST[$field]);
      }
    }
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fruit Survey</title>
  <style type="text/css">
    body {
      background-color: #FAFAF9;
      color: #111827;
      padding: 15px;
    }
    h1, h2 {
      margin-bottom: 10px;
    }
    h2 {
      margin-top: 10px;
    }
    .wrapper {
      background-color: #312E81;
      color: #ffffff;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
      width: 95%;
      padding: 15px;
      border-radius: 5px;
    }
    .wrapper div:last-child {
      grid-column: 2;
    }
    label, .field-label {
      padding-top: 10px;
      text-align: right;
    }
    input {
      padding: 10px 10px 10px 5px;
    }
    input, option {
      color: #1F2937;
      font-size: 1.1rem;
    }
    .error {
      color: #FF0000;
    }
  </style>
</head>
<body>
<h1>The World of Fruit</h1>
<h2>Fruit Survey</h2>
<form class="wrapper" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="name">Name</label>
  <div>
    <input type="text"
           name="name"
           id="name"
           value="<?php echo htmlspecialchars($values['name']);?>">

    <?php if (in_array('name', $errors)): ?>
      <span class="error">Missing</span>
    <?php endif; ?>
  </div>

  <label for="address">Address</label>
  <div>
    <input type="text"
           name="address"
           id="address"
           value="<?php echo htmlspecialchars($values['address']);?>">

    <?php if (in_array('address', $errors)): ?>
      <span class="error">Missing</span>
    <?php endif; ?>
  </div>

  <label for="email">Email</label>
  <div>
    <input type="text"
           name="email"
           id="email"
           value="<?php echo htmlspecialchars($values['email']);?>">

    <?php if (in_array('email', $errors)): ?>
      <span class="error">Missing</span>
    <?php endif; ?>
  </div>

  <div class="field-label">How many pieces of fruit do you eat per day?</div>
  <div>
    <label>
      <input type="radio"
             name="howMany"
             <?php if (isset($values['howMany']) && $values['howMany'] == "zero") echo "checked"; ?>
             value="zero">
      0
    </label>
    <label>
      <input type="radio"
             name="howMany"
             <?php if (isset($values['howMany']) && $values['howMany'] == "one") echo "checked"; ?>
             value="one">
      1
    </label>
    <label>
      <input type="radio"
             name="howMany"
             <?php if (isset($values['howMany']) && $values['howMany'] == "two") echo "checked"; ?>
             value="two">
      2
    </label>
    <label>
      <input type="radio"
             name="howMany"
             <?php if (isset($values['howMany']) && $values['howMany'] == "twoplus") echo "checked"; ?>
            value="twoplus">
      More than 2
    </label>

    <?php if (in_array('howMany', $errors)): ?>
      <span class="error">Missing</span>
    <?php endif; ?>
  </div>

  <label for="favoriteFruit">My favourite fruit</label>
  <div>
    <select name="favoriteFruit[]" id="favoriteFruit" size="4" multiple="">
      <?php
      $options = ["apple", "banana", "plum", "pomegranate", "strawberry", "watermelon"];
      foreach ($options as $option) {
        printf(
          '<option value="%s" %s>%s</option>',
          $option,
          (in_array($option, $values['favoriteFruit'])) ? "selected" : '',
          ucfirst($option)
        );
      }
      ?>
    </select>
    <?php if (in_array('favoriteFruit', $errors)): ?>
      <span class="error">Missing</span>
    <?php endif; ?>
  </div>

  <label for="brochure">Would you like a brochure?</label>
  <div>
    <input type="checkbox"
           name="brochure"
           id="brochure"
           <?php if (isset($values['brochure']) && $values['brochure'] == "Yes") echo "checked"; ?>
           value="Yes">
  </div>
  <div>
    <input type="submit" name="submit" value="Submit">
  </div>
</form>
</body>
</html>
