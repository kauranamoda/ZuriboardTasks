<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $csvfile = 'customers.csv';

    $tempfile = tempnam(".", "tmp");



    // get the data 
    // creat a temporary file
    // update the data and save it to the temp file
    // delete the data file
    // rename the temp file 

    if (!$input = fopen($csvfile, 'r')) {
        die('could not open existing csv file');
    }


    if (!$output = fgetcsv($input) !== FALSE) {
        die('could not open temporary output file');
    }

    while(($data = fgetcsv($input)) !== FALSE) {
        if($data[0] == $_POST['email']) {
            $data[1] = $_POST['fullname'];
            $data[2] = $_POST['password'];
        }
        fputcsv($output, $data);
    }

    fclose($input);
    fclose($output);

    unlink($csvfile);
    rename($tempfile, $csvfile);

    echo 'done';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="../assets/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>

        <form class="form-control w-50" method="POST" action="">
            <h1 class="form-group">Reset Password</h1>
            <hr>
            <div class="form-row flex justify-content-center">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Reset</button>
                </div>

                <div class="form-group">
                    <p>Go back to Login!: <br><a href="login.html">Login page</a></p>
                </div>
            </div>
            
      </form>
   
    
</div>
</body>
</html>