<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion Stages SN</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* ===== PARTIE GAUCHE : FORMULAIRE ===== */
        .login-left {
            width: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: white;
            position: relative;
            z-index: 2;
        }

        .login-left .login-card {
            max-width: 420px;
            width: 100%;
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-left .logo {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-left .logo img {
            height: 60px;
            margin-bottom: 8px;
        }

        .login-left .logo h1 {
            font-size: 24px;
            font-weight: 800;
            color: #065F46;
        }

        .login-left .logo h1 span {
            color: #F59E0B;
        }

        .login-left .logo p {
            font-size: 14px;
            color: #6B7280;
        }

        .login-left .flag-stripe {
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, #00853E 33%, #FDEF42 33%, #FDEF42 66%, #E31B23 66%);
            margin: 0 auto 8px;
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-group .input-wrapper {
            position: relative;
        }

        .form-group .input-wrapper i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            font-size: 16px;
        }

        .form-group .input-wrapper input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border: 2px solid #E5E7EB;
            border-radius: 14px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #FAFAFA;
        }

        .form-group .input-wrapper input:focus {
            border-color: #10B981;
            box-shadow: 0 0 0 4px rgba(16,185,129,0.1);
            background: white;
            outline: none;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            margin-bottom: 24px;
        }

        .form-options label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #4B5563;
            cursor: pointer;
        }

        .form-options a {
            color: #10B981;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .form-options a:hover {
            color: #059669;
            text-decoration: underline;
        }

        .btn-primary {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #065F46, #10B981);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(16,185,129,0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16,185,129,0.35);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
            color: #9CA3AF;
            font-size: 13px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #E5E7EB;
        }

        .social-buttons {
            display: flex;
            gap: 12px;
        }

        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            border: 2px solid #E5E7EB;
            background: white;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: #374151;
        }

        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .social-btn.google:hover {
            border-color: #DB4437;
            background: #FEF2F2;
        }

        .social-btn.github:hover {
            border-color: #333;
            background: #F3F4F6;
        }

        .social-btn i {
            font-size: 20px;
        }

        .social-btn.google i { color: #DB4437; }
        .social-btn.github i { color: #333; }

        .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6B7280;
        }

        .register-link a {
            color: #10B981;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .register-link a:hover {
            color: #059669;
            text-decoration: underline;
        }

        .alert-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #991B1B;
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error i {
            color: #DC2626;
        }

        .alert-success {
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            color: #065F46;
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success i {
            color: #10B981;
        }

        /* ===== PARTIE DROITE : IMAGE DE COUVERTURE ===== */
        .login-right {
            width: 55%;
            background: linear-gradient(135deg, #065F46, #10B981);
            background-image: url('{{ asset('images/classe.jpg') }}');
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
            min-height: 100vh;
        }

        .login-right .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(6,95,70,0.85), rgba(16,185,129,0.75));
            z-index: 1;
        }

        .login-right .content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            max-width: 500px;
        }

        .login-right .content h2 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .login-right .content h2 span {
            color: #FCD34D;
        }

        .login-right .content p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.7;
        }

        .login-right .content .features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 24px;
        }

        .login-right .content .features .feature-item {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(10px);
            padding: 14px 16px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.1);
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .login-right .content .features .feature-item i {
            font-size: 18px;
            color: #FCD34D;
        }

        .login-right .content .flag {
            font-size: 64px;
            margin-bottom: 20px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .login-left {
                width: 100%;
                padding: 40px 24px;
            }
            .login-right {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .login-left .login-card {
                padding: 0;
            }
            .social-buttons {
                flex-direction: column;
            }
            .login-right .content .features {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">

        <!-- ===== PARTIE GAUCHE : FORMULAIRE ===== -->
        <div class="login-left">
            <div class="login-card">
                <div class="logo">
                    <div class="flag-stripe"></div>
                    <img src="{{ asset('storage/logos/moi.jpg') }}" alt="Logo" style="height:60px;">
                    <h1>Gestion <span>Stages</span></h1>
                    <p>🇸🇳 Sénégal • Plateforme de stages</p>
                </div>

                @if(session('error'))
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" placeholder="votre@email.sn" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Mot de passe</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="form-options">
                        <label>
                            <input type="checkbox" name="remember"> Se souvenir de moi
                        </label>
                        <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
                    </button>
                </form>

                <div class="divider">ou</div>

                <div class="social-buttons">
                    <a href="{{ route('social.redirect', 'google') }}" class="social-btn google">
                        <i class="fab fa-google"></i> Google
                    </a>
                    <a href="{{ route('social.redirect', 'github') }}" class="social-btn github">
                        <i class="fab fa-github"></i> GitHub
                    </a>
                </div>

                <div class="register-link">
                    Pas encore de compte ? <a href="{{ route('register') }}">S'inscrire</a>
                </div>
            </div>
        </div>

        <!-- ===== PARTIE DROITE : IMAGE DE COUVERTURE ===== -->
        <div class="login-right">
            <div class="overlay"></div>
            <div class="content">
                <div class="flag">🇸🇳</div>
                <h2>Bienvenue sur <span>Gestion Stages</span></h2>
                <p>La plateforme de référence pour les stages au Sénégal. Connectez-vous et trouvez votre opportunité.</p>
                <div class="features">
                    <div class="feature-item">
                        <i class="fas fa-briefcase"></i>
                        <span>Des milliers de stages</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-building"></i>
                        <span>Entreprises de confiance</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-file-signature"></i>
                        <span>Candidatures rapides</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Suivi en temps réel</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>