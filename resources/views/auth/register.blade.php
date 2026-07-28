<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Gestion Stages SN</title>
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

        .register-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* ===== PARTIE GAUCHE : FORMULAIRE ===== */
        .register-left {
            width: 45%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: white;
            position: relative;
            z-index: 2;
        }

        .register-left .register-card {
            max-width: 440px;
            width: 100%;
            animation: fadeInUp 0.6s ease forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-left .logo {
            text-align: center;
            margin-bottom: 28px;
        }

        .register-left .logo img {
            height: 55px;
            margin-bottom: 6px;
        }

        .register-left .logo h1 {
            font-size: 22px;
            font-weight: 800;
            color: #065F46;
        }

        .register-left .logo h1 span {
            color: #F59E0B;
        }

        .register-left .logo p {
            font-size: 13px;
            color: #6B7280;
        }

        .register-left .flag-stripe {
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, #00853E 33%, #FDEF42 33%, #FDEF42 66%, #E31B23 66%);
            margin: 0 auto 8px;
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 4px;
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
            font-size: 15px;
        }

        .form-group .input-wrapper input,
        .form-group .input-wrapper select {
            width: 100%;
            padding: 10px 14px 10px 40px;
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #FAFAFA;
        }

        .form-group .input-wrapper input:focus,
        .form-group .input-wrapper select:focus {
            border-color: #10B981;
            box-shadow: 0 0 0 4px rgba(16,185,129,0.1);
            background: white;
            outline: none;
        }

        .role-selector {
            display: flex;
            gap: 10px;
            margin-top: 4px;
        }

        .role-selector label {
            flex: 1;
            padding: 10px;
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            text-align: center;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #FAFAFA;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .role-selector label i {
            font-size: 20px;
            color: #9CA3AF;
            transition: color 0.3s;
        }

        .role-selector input[type="radio"] {
            display: none;
        }

        .role-selector input[type="radio"]:checked + label {
            border-color: #10B981;
            background: #F0FDF4;
            box-shadow: 0 0 0 4px rgba(16,185,129,0.1);
        }

        .role-selector input[type="radio"]:checked + label i {
            color: #10B981;
        }

        .role-selector label:hover {
            border-color: #10B981;
            background: #F9FAFB;
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
            margin-top: 6px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16,185,129,0.35);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 20px 0;
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
            padding: 10px;
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
            font-size: 18px;
        }

        .social-btn.google i { color: #DB4437; }
        .social-btn.github i { color: #333; }

        .login-link {
            text-align: center;
            margin-top: 18px;
            font-size: 14px;
            color: #6B7280;
        }

        .login-link a {
            color: #10B981;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .login-link a:hover {
            color: #059669;
            text-decoration: underline;
        }

        .alert-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #991B1B;
            padding: 10px 14px;
            border-radius: 12px;
            margin-bottom: 16px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-error i {
            color: #DC2626;
        }

        /* ===== PARTIE DROITE : IMAGE DE COUVERTURE ===== */
        .register-right {
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

        .register-right .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(6,95,70,0.85), rgba(16,185,129,0.75));
            z-index: 1;
        }

        .register-right .content {
            position: relative;
            z-index: 2;
            color: white;
            text-align: center;
            max-width: 500px;
        }

        .register-right .content h2 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .register-right .content h2 span {
            color: #FCD34D;
        }

        .register-right .content p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.7;
        }

        .register-right .content .features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 24px;
        }

        .register-right .content .features .feature-item {
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

        .register-right .content .features .feature-item i {
            font-size: 18px;
            color: #FCD34D;
        }

        .register-right .content .flag {
            font-size: 64px;
            margin-bottom: 20px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .register-left {
                width: 100%;
                padding: 32px 20px;
            }
            .register-right {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .register-left .register-card {
                padding: 0;
            }
            .role-selector {
                flex-direction: column;
            }
            .social-buttons {
                flex-direction: column;
            }
            .register-right .content .features {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">

        <!-- ===== PARTIE GAUCHE : FORMULAIRE ===== -->
        <div class="register-left">
            <div class="register-card">
                <div class="logo">
                    <div class="flag-stripe"></div>
                    <img src="{{ asset('storage/logos/moi.jpg') }}" alt="Logo" style="height:55px;">
                    <h1>Gestion <span>Stages</span></h1>
                    <p>🇸🇳 Créez votre compte</p>
                </div>

                @if($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Rôle -->
                    <div class="form-group">
                        <label>Je suis</label>
                     <div class="role-selector">
    <input type="radio" name="role" value="etudiant" id="role_etudiant" checked>
    <label for="role_etudiant">
        <i class="fas fa-user-graduate"></i>
        Étudiant
    </label>
    <!-- Le choix Entreprise est masqué car réservé à l'admin -->
    <div style="flex:1; padding:10px; border:2px dashed #E5E7EB; border-radius:12px; text-align:center; font-size:12px; color:#9CA3AF; display:flex; flex-direction:column; align-items:center; gap:4px;">
        <i class="fas fa-building" style="color:#9CA3AF;"></i>
        <span>Entreprise</span>
        <span style="font-size:10px; color:#EF4444;">(Réservé à l'admin)</span>
    </div>
</div>
                    </div>

                    <!-- Nom -->
                    <div class="form-group">
                        <label>Nom complet</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" name="name" placeholder="Votre nom" value="{{ old('name') }}" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" placeholder="votre@email.sn" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <!-- Téléphone -->
                    <div class="form-group">
                        <label>Téléphone</label>
                        <div class="input-wrapper">
                            <i class="fas fa-phone"></i>
                            <input type="text" name="telephone" placeholder="77 123 45 67" value="{{ old('telephone') }}" required>
                        </div>
                    </div>

                    <!-- Mot de passe -->
                    <div class="form-group">
                        <label>Mot de passe</label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <!-- Confirmation -->
                    <div class="form-group">
                        <label>Confirmer</label>
                        <div class="input-wrapper">
                            <i class="fas fa-check-circle"></i>
                            <input type="password" name="password_confirmation" placeholder="Confirmez" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="fas fa-user-plus mr-2"></i> Créer mon compte
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

                <div class="login-link">
                    Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
                </div>
            </div>
        </div>

        <!-- ===== PARTIE DROITE : IMAGE DE COUVERTURE ===== -->
        <div class="register-right">
            <div class="overlay"></div>
            <div class="content">
                <div class="flag">🇸🇳</div>
                <h2>Rejoignez <span>Gestion Stages</span></h2>
                <p>Créez votre compte et accédez à des milliers d'opportunités de stage au Sénégal.</p>
                <div class="features">
                    <div class="feature-item">
                        <i class="fas fa-rocket"></i>
                        <span>Démarrez votre carrière</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-building"></i>
                        <span>Entreprises de confiance</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-file-signature"></i>
                        <span>Postulez facilement</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-user-graduate"></i>
                        <span>Rejoignez +1000 étudiants</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>