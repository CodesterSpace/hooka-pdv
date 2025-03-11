<?php
include ('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    if($action == 'mdp'){
        $ad_id = $_POST["ad_id"];
        $opassword = $_POST["opassword"];
        $npassword = $_POST["password"];

        // Fetch the old password hash from the database
        $stmt = $con->prepare("SELECT password FROM admin WHERE ad_id = ?");
        $stmt->bind_param("i", $ad_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();

        if (!$admin) {
            $response = array("error" => "Invalid Staff ID.");
        } else {
            // Verify the old password
            $hashed_opassword = $admin["password"];
            if (password_verify($opassword, $hashed_opassword)) {
                // Hash the new password
                $hashed_npassword = password_hash($npassword, PASSWORD_DEFAULT);
                // Update the password in the database
                $stmt = $con->prepare("UPDATE admin SET password = ? WHERE ad_id = ?");
                $stmt->bind_param("si", $hashed_npassword, $ad_id); // Correction du nom de la variable
                $stmt->execute();
                // Redirect to a success page or do something else
                $response = array("success" => "Password updated successfully.");
            } else {
                $response = array("error" => "Incorrect old password.");
            }
        }
        echo json_encode($response);
        exit();	
    }elseif($action == 'profile'){
        $ad_id = mysqli_real_escape_string($con, $_POST['ad_id']);

        // Récupère les autres valeurs du formulaire
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $telephone = mysqli_real_escape_string($con, $_POST['telephone']);
        $ad_img = mysqli_real_escape_string($con, $_POST['ad_img']);
        $updated_at = date('Y-m-d H:i:s'); // Add this line to get the current timestamp
        
        // Image upload
        if (!empty($_FILES["image"]["name"])) {
            $image = $_FILES["image"]["name"];
            $imagePath = 'assets/img/profiles/' . $image;
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
        } else {
            // Set default image filename
            $image = $ad_img;
        }      
        
        // Prépare la requête SQL
        $stmt = mysqli_prepare($con, "UPDATE admin SET
                ad_name = ?,
                ad_telephone = ?,
                ad_img = ?,
                updated_at = ?
                WHERE ad_id = ?");
        mysqli_stmt_bind_param($stmt, "ssssi", $username, $telephone, $image, $updated_at, $ad_id);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "Profile Modifer Avec Succes.";
            // Retarder la redirection de 5 secondes
        } else {
            echo "Erreur: " . mysqli_error($con);
        }
        // Rediriger vers une autre page
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit;
        mysqli_stmt_close($stmt);
        exit();	
    }
}
?>