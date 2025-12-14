<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    // Handle uploaded profile image
    $profile_image = $_FILES['profile_image']['name'];
    $tmp_name = $_FILES['profile_image']['tmp_name'];
    $upload_dir = 'uploads/';

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    if ($profile_image) {
        $ext = pathinfo($profile_image, PATHINFO_EXTENSION);
        $profile_image = uniqid() . '.' . $ext;
        move_uploaded_file($tmp_name, $upload_dir . $profile_image);
    } else {
        $profile_image = '';
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $subjects = isset($_POST['subjects']) ? implode(',', $_POST['subjects']) : '';

    $sql = "INSERT INTO users (profile_image, name, email, gender, subject, country) 
            VALUES ('$profile_image', '$name', '$email', '$gender', '$subjects', '$country')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-primary text-white fw-bold text-center fs-5 rounded-top-4">
                    Add New User
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">

                        <!-- Profile Image -->
                        <div class="mb-4 text-center">
                            <label class="form-label fw-semibold d-block">Profile Image</label>
                            <input type="file" name="profile_image" class="form-control form-control-lg mb-2" required>
                            <img id="preview" src="#" alt="Profile Preview" class="rounded-circle mt-2 d-none" width="80" height="80" style="object-fit:cover;">
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control form-control-lg rounded-pill" placeholder="Enter full name" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg rounded-pill" placeholder="Enter email" required>
                        </div>

                        <!-- Subjects -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold d-block">Subjects</label>
                            <?php
                            $all_subjects = ['English','Urdu','Maths'];
                            foreach($all_subjects as $subj):
                            ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="subjects[]" value="<?= $subj ?>" id="subject<?= $subj ?>">
                                    <label class="form-check-label fw-semibold" for="subject<?= $subj ?>"><?= $subj ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Gender -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold d-block">Gender</label>
                            <?php
                            $all_genders = ['Male','Female','Other'];
                            foreach($all_genders as $g):
                            ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="<?= $g ?>" id="gender<?= $g ?>" required>
                                    <label class="form-check-label fw-semibold" for="gender<?= $g ?>"><?= $g ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Country -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Country</label>
                            <select name="country" class="form-select form-select-lg rounded-pill" required>
                                <option value="">Select Country</option>
                                <?php
                                $countries = ['Pakistan','India','USA','UK','Canada','Other'];
                                foreach($countries as $c):
                                ?>
                                    <option value="<?= $c ?>"><?= $c ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary rounded-pill px-4">Back</a>
                            <button type="submit" name="submit" class="btn btn-success rounded-pill px-4">Save User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS Preview Image -->
<script>
    const input = document.querySelector('input[name="profile_image"]');
    const preview = document.getElementById('preview');

    input.addEventListener('change', function(){
        const file = this.files[0];
        if(file){
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        }
    });
</script>

<?php include 'footer.php'; ?>
