<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Survey Tools</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Custom styles */
    body {
      background-color: #f4f4f4;
    }

    .container {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    h3.form-header {
      color: #333;
      margin-bottom: 30px;
    }

    .form-group label {
      font-weight: bold;
    }

    .form-matrix-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .form-matrix-th,
    .form-matrix-td {
      padding: 10px;
      border: 1px solid #ccc;
    }

    .form-matrix-th {
      font-weight: bold;
      text-align: center;
      background-color: #f0f0f0;
    }

    .form-matrix-td {
      text-align: center;
    }

    .form-radio {
      margin: 0;
      display: none;
    }

    .matrix-choice-label {
      display: block;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }

    .matrix-choice-label::before {
      content: '';
      display: inline-block;
      width: 20px;
      height: 20px;
      margin-right: 5px;
      border: 2px solid #007bff;
      border-radius: 50%;
      vertical-align: middle;
    }

    .form-radio:checked + .matrix-choice-label::before {
      background-color: #007bff;
    }

    .btn-submit {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3 class="form-header text-center">Survey Tools</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="spinner">Spinner:</label>
          <input type="number" id="spinner" name="spinner" class="form-control" value="0">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="ratingMatrix">Rating Matrix:</label>
          <table id="ratingMatrix" class="table form-matrix-table">
            <thead>
              <tr>
                <th>&nbsp;</th>
                <th>Very Satisfied</th>
                <th>Satisfied</th>
                <th>Somewhat Satisfied</th>
                <th>Not Satisfied</th>
              </tr>
            </thead>
            <tbody>
            <?php
                        // Include your database connection
                        include "../connect.php";
                        // Check connection
                        if ($con->connect_error) {
                            die("Connection failed: " . $con->connect_error);
                        }
                        $teacher_id = $_GET['teacher_id'];
                        $sql = "SELECT * FROM tbl_assign
                                JOIN user on tbl_assign.instructor_id = user.id
                                JOIN tbl_evaluation_form on tbl_assign.evaluation_form_id = tbl_evaluation_form.id
                                JOIN tbl_category on tbl_evaluation_form.category_id = tbl_category.id
                                JOIN tbl_question on tbl_evaluation_form.id = tbl_question.evaluation_form_id
                                WHERE tbl_assign.instructor_id = $teacher_id"; // Order by category for grouping
            
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                $currentCategory = null;
                $j = 1;
                ?>
              <tr>
                <?php   while ($row = $result->fetch_assoc()) {
                                if ($currentCategory !== $row["category_description"]) {
                                    // If category changed, display new category header
                                    $currentCategory = $row["category_description"];
                    ?>
                <th><?php echo $currentCategory;  }?></th>
                <td><input type="radio" name="serviceQuality" value="Very Satisfied" class="form-radio"><label class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
                <td><input type="radio" name="serviceQuality" value="Satisfied" class="form-radio"><label class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
                <td><input type="radio" name="serviceQuality" value="Somewhat Satisfied" class="form-radio"><label class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
                <td><input type="radio" name="serviceQuality" value="Not Satisfied" class="form-radio"><label class="matrix-choice-label matrix-radio-label" aria-hidden="true"></label></td>
              </tr>
              <?php } 
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
