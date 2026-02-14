<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed - {{ companyName() }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .failed-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            max-width: 450px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        .failed-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: shake 0.5s ease-in-out;
        }
        .failed-icon i {
            font-size: 50px;
            color: white;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="failed-card">
        <div class="failed-icon">
            <i class="fas fa-times"></i>
        </div>
        <h2 class="text-danger mb-3">Payment Failed</h2>
        <p class="text-muted mb-4">
            Sorry, your payment could not be processed. 
            Please try again or contact our customer service.
        </p>
        
        <div class="bg-light rounded p-3 mb-4">
            <p class="mb-0 small text-muted">
                <i class="fas fa-info-circle me-1"></i>
                If your balance has been deducted, the payment will be refunded within 1-3 business days.
            </p>
        </div>

        <div class="d-grid gap-2">
            <a href="javascript:history.back()" class="btn btn-danger">
                <i class="fas fa-redo me-2"></i>Try Again
            </a>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                <i class="fas fa-home me-2"></i>Back to Home
            </a>
        </div>

        <hr class="my-4">
        
        <p class="mb-0 small text-muted">
            Need help? Contact us at<br>
            <a href="https://wa.me/6281234567890" class="text-success">
                <i class="fab fa-whatsapp me-1"></i>WhatsApp
            </a>
        </p>
    </div>
</body>
</html>
