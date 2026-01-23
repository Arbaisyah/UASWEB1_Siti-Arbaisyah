<?php
if (!isset($_SESSION['user'])) {
    echo "Session user tidak ditemukan";
    exit;
}

$user = $_SESSION['user'];
?>


<style>
    .profile-wrapper {
    display: flex;
    justify-content: center;
}
.profile-card {
    max-width: 450px;
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    margin-top: 20px;
}

.profile-header {
    text-align: center;
    margin-bottom: 20px;
}

.profile-avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #3498db;
    color: white;
    font-size: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    font-weight: bold;
}

.profile-header h2 {
    margin: 5px 0;
}

.profile-info {
    margin-top: 15px;
}

.profile-info div {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.profile-info span {
    color: #555;
}

.profile-btn {
    margin-top: 20px;
    display: inline-block;
    padding: 10px 18px;
    background: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 20px;
    transition: 0.3s;
}

.profile-btn:hover {
    background: #2980b9;
}
</style>

<div class="profile-wrapper">
    <div class="profile-card">
        <div class="profile-header">
            <div class="profile-avatar">
                <?= strtoupper(substr($user['name'], 0, 1)); ?>
            </div>
            <h2><?= htmlspecialchars($user['name']) ?></h2>
            <small><?= htmlspecialchars($user['role']) ?></small>
        </div>

        <div class="profile-info">
            <div>
                <b>Email</b>
                <span><?= htmlspecialchars($user['email']) ?></span>
            </div>
            <div>
                <b>Role</b>
                <span><?= htmlspecialchars($user['role']) ?></span>
            </div>
        </div>

        <a href="dashboard.php?page=edit_profile" class="profile-btn">
            ✏️ Edit Profile
        </a>
    </div>
</div>
