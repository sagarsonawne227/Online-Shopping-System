<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - E-commerce Website</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <section>
        <h2>Get in Touch</h2>
        <form action="send_message.php" method="post">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="5" required></textarea><br><br>

            <button type="submit">Send Message</button>
        </form>
    </section>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
