<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome On Board {{ $name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            line-height: 1.5;
        }
        .content ul li {
            font-size: 16px;
            line-height: 1.5;
        }
        .footer {
            background: #f1f1f1;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome to DPRESIDENTIAL LUXXETOUR</h1>
        </div>
        <div class="content">
            <p>Dear {{ $name }},</p>
            <p>Welcome to <strong>DPRESIDENTIAL LUXXETOUR</strong>! We're thrilled to have you as a part of our community.</p>
            <p>At DPRESIDENTIAL LUXXETOUR, we offer a seamless and convenient car hire and booking experience, whether you're looking for a quick ride across town or planning a special event. With our wide range of vehicles and professional drivers, we ensure that every trip is comfortable, reliable, and stress-free.</p>
            <p><strong>Here's what you can expect from us:</strong></p>
            <ul>
                <li>Easy Booking: Book a car in just a few clicks through our user-friendly platform.</li>
                <li>Variety of Vehicles: From economy to luxury cars, we have a fleet that suits every occasion.</li>
                <li>24/7 Support: Our customer service team is available around the clock to assist you.</li>
                <li>Safety First: All our vehicles are sanitized, well-maintained, and driven by trained professionals to ensure your safety and comfort.</li>
            </ul>
            {{-- <p>Ready to get started? Simply visit our platform or download our app to explore our fleet and make your first booking. As a thank-you for joining us, we’re excited to offer you a special discount on your first ride! Use promo code <strong>{{ $promo_code }}</strong> at checkout.</p> --}}
            <p>If you have any questions or need assistance, feel free to contact us at [support@dpresidentialluxxetour.com].</p>
            <p>Thank you for choosing <strong>DPRESIDENTIAL LUXXETOUR</strong> – we look forward to driving with you!</p>
            <p>Best regards,<br>DPRESIDENTIAL LUXXETOUR</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} DPRESIDENTIAL LUXXETOUR. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
