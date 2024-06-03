<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Swismax</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .contact-header {
            background: url('https://via.placeholder.com/1500x500') no-repeat center center;
            background-size: cover;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .contact-header h1 {
            font-size: 3.5rem;
            margin-bottom: 10px;
        }

        .contact-header p {
            font-size: 1.5rem;
        }

        .contact-section {
            padding: 50px 0;
        }

        .contact-info {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 5px;
            margin-bottom: 30px;
        }

        .contact-info h5 {
            margin-bottom: 15px;
        }

        .contact-info p {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .contact-form {
            padding: 30px;
            border-radius: 5px;
            background: #f8f9fa;
        }

        .footer {
            background: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="container">
       <img src="../uploads/contact_image.jpg" alt="">
    </div>

    <!-- Contact Section -->
    <div class="container contact-section">
        <div class="row">
            <div class="col-md-4">
                <div class="contact-info">
                    <h5>Our Address</h5>
                    <p>123 Swismax Street,<br> Suite 456,<br> Zurich, Switzerland</p>
                    <h5>Phone</h5>
                    <p>+41 22 123 4567</p>
                    <h5>Email</h5>
                    <p>info@swismax.com</p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="contact-form">
                    <h5>Send Us a Message</h5>
                    <form>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2024 Swismax. All rights reserved.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
