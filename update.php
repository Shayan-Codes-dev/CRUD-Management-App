<?php
include 'connect.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Fetch current user data
$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit;
}

$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    // Handle uploaded profile image
    if (!empty($_FILES['profile_image']['name'])) {
        $profile_image = $_FILES['profile_image']['name'];
        $tmp_name = $_FILES['profile_image']['tmp_name'];
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $ext = pathinfo($profile_image, PATHINFO_EXTENSION);
        $profile_image = uniqid() . '.' . $ext;
        move_uploaded_file($tmp_name, $upload_dir . $profile_image);
    } else {
        $profile_image = $row['profile_image'];
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $subjects = isset($_POST['subjects']) ? implode(',', $_POST['subjects']) : '';

    $sql = "UPDATE users SET 
                profile_image='$profile_image',
                name='$name',
                email='$email',
                gender='$gender',
                subject='$subjects',
                country='$country'
            WHERE id=$id";

    mysqli_query($conn, $sql);
    header("Location: index.php");
    exit;
}

// Prepare subjects array for checkboxes
$current_subjects = explode(',', $row['subject']);
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-header bg-warning text-white fw-bold text-center fs-5 rounded-top-4">
                    Update User
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">

                        <!-- Profile Image -->
                        <div class="mb-4 text-center">
                            <label class="form-label fw-semibold d-block">Profile Image</label>
                            <input type="file" name="profile_image" class="form-control form-control-lg mb-2" id="profileInput">
                            <?php if($row['profile_image']): ?>
                                <img id="preview" src="uploads/<?= htmlspecialchars($row['profile_image']) ?>" 
                                     class="rounded-circle mt-2" width="80" height="80" style="object-fit:cover;">
                            <?php else: ?>
                                <img id="preview" src="#" class="rounded-circle mt-2 d-none" width="80" height="80" style="object-fit:cover;">
                            <?php endif; ?>
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="name" class="form-control form-control-lg rounded-pill" value="<?= htmlspecialchars($row['name']) ?>" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg rounded-pill" value="<?= htmlspecialchars($row['email']) ?>" required>
                        </div>

                        <!-- Subjects -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold d-block">Subjects</label>
                            <?php
                            $all_subjects = ['English','Urdu','Maths'];
                            foreach($all_subjects as $subj):
                                $checked = in_array($subj, $current_subjects) ? 'checked' : '';
                            ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="subjects[]" value="<?= $subj ?>" id="subject<?= $subj ?>" <?= $checked ?>>
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
                                $checked = ($row['gender'] == $g) ? 'checked' : '';
                            ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="<?= $g ?>" id="gender<?= $g ?>" <?= $checked ?> required>
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
                                    $selected = ($row['country'] == $c) ? 'selected' : '';
                                ?>
                                    <option value="<?= $c ?>" <?= $selected ?>><?= $c ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary rounded-pill px-4">Back</a>
                            <button type="submit" name="submit" class="btn btn-success rounded-pill px-4">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS for profile preview -->
<script>
    const input = document.getElementById('profileInput');
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
