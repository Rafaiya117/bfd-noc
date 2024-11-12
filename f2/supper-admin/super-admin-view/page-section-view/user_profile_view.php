<?php
include '../super-admin-view/page-section/header.php';
include '../super-admin-view/page-section/navbar.php';
?>
<body>
    <div class="container">
        <div class="profile">
            <img src="https://img.freepik.com/premium-vector/social-avatar-stories-gradient-frame_41737-3.jpg" alt="Profile Picture">
            <h2><?= $my_profile['username']?></h2>
            <p>Email:<?= $my_profile['email']?> </p>
            <p>Designation: <?= $my_profile['designation']?></p>
            <p>Joined: <?= $my_profile['created_at']?></p>
            <a href="Useredit_profile.php?id=<?= $my_profile['id']?>" class="btn">Edit Profile</a>
        </div>
    </div>
</body>

<?php
	include '../super-admin-view/page-section/footer.php';
?>