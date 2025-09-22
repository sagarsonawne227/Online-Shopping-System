<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - E-commerce Website</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .about-section {
            padding: 40px;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .about-section h2 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .about-section p {
            font-size: 18px;
            line-height: 1.6;
        }

        .developer {
            margin-top: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .developer img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .developer-info {
            max-width: 400px;
            text-align: left;
        }

        .developer-info h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .developer-info p {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<main>
    <section class="about-section">
        <h2>About Our Store</h2>
        <p>
            Welcome to our e-commerce platform! We offer top-quality fashion and tech products at affordable prices.
            Our goal is to deliver a smooth and satisfying online shopping experience with modern features and secure checkout.
        </p>

        <div class="developer">
            <img src="image/developer.jpg" alt="Developer Photo">
            <div class="developer-info">
                <h3>Sagar Sonawane</h3>
                <p>
                    Developer and Designer of this website.<br>
                    Currently studying at <strong>Matoshri College of Engineering and Research Center, Nashik</strong>.<br>
                    Passionate about full-stack development and e-commerce solutions.
                </p>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>

</body>
</html>
