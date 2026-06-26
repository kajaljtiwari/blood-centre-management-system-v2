<?php
$conn = new mysqli("localhost", "root", "", "bbdms");
$result = $conn->query("SELECT * FROM notices ORDER BY created_at DESC LIMIT 5");
?>

<style>
.notice-board {
    background: #fff8e1;
    border: 1px solid #ffcc80;
    padding: 15px;
    border-radius: 8px;
    margin: 20px 0;
}
.notice-board ul {
    list-style: none;
    padding: 0;
}
.notice-board li {
    margin-bottom: 10px;
}
.notice-board small {
    display: block;
    color: #888;
    font-size: 12px;
}
</style>

<div class="notice-board">
    <h3>📰 Latest Notices</h3>
    <ul>
        <?php while($row = $result->fetch_assoc()): ?>
            <li>
                <strong><?= htmlspecialchars($row['title']) ?>:</strong><br>
                <?= nl2br(htmlspecialchars($row['message'])) ?>
                <small>(<?= $row['created_at'] ?>)</small>
            </li>
        <?php endwhile; ?>
    </ul>
</div>
