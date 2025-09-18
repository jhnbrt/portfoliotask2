<?php include 'db.php'; ?>

<?php
// Insert new post
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title   = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Portfolio Blog</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>My Portfolio Blog</h1>
</header>

<section class="new-post">
    <h2>Add New Post</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Post Title" required>
        <textarea name="content" placeholder="Write your blog content here..." required></textarea>
        <button type="submit">Publish</button>
    </form>
</section>

<hr>

<section class="posts">
    <h2>Latest Posts</h2>
    <?php
    $result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
    while($row = $result->fetch_assoc()):
    ?>
        <article class="post">
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <small>Posted on <?php echo $row['created_at']; ?></small>
            <p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
        </article>
    <?php endwhile; ?>
</section>

</body>
</html>
