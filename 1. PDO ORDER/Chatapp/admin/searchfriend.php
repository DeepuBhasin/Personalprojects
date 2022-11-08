<?php
include('header.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search_field'])) {
    require './main.php';
    $id = $_SESSION['login_user']['id'];
    $response = $searchfriend->validateData($_GET, $id);
}
?>
<div class="section-container">
    <div class="section-title">
        <h2>Search User</h2>
    </div>
    <div class="section-form">
        <?php
        if (!isset($response['status'])) {
            include './../message.php';
        }
        ?>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="GET">
            <div class="section-form-item">
                <label for="search_field">Enter Name/Email Id *</label>
                <input type="text" id="search_field" name="search_field" class="input-form" placeholder="Enter Name/Email Id" required="true" />
            </div>
            <div class="section-form-button">
                <button type="submit" class="btn-success">Search</button>
            </div>
        </form>
    </div>
    <?php if (isset($response['status'])) : ?>
        <center>
        <table style="width: 900px; position:relative; left:-200px;">
            <thead>
                <tr>
                <th>Sri</th>
                <th>Name</th>
                <th>Email Id</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $c = 0;
                foreach ($response['data'] as $value) : ?>
                    <tr>
                        <td><?= ++$c; ?></td>
                        <td><?= $value['first_name'] ?> <?= $value['last_name'] ?></td>
                        <td><?= $value['email'] ?></td>
                        <td style="width: 400px;">
                            <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="viewfriendprofile.php?id=<?= $value['id'] ?>">View Profile</a>
                            <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="editprofile.php?id=<?= $value['id'] ?>&page=search">Edit Profile</a>
                            <a style="text-decoration:none; color:#000; padding:5px; background-color: white;" href="deleteprofile.php?id=<?= $value['id'] ?>&page=search">Delete Profile</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </center>
    <?php endif; ?>
</div>
<?php include('footer.php'); ?>