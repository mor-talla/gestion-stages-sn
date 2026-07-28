<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestion Stages SN - Plateforme de stages au Sénégal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }

        .flag-stripe {
            background: linear-gradient(to right, #00853E 33%, #FDEF42 33%, #FDEF42 66%, #E31B23 66%);
            height: 4px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
        }

        .nav-glass {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            position: fixed;
            top: 4px;
            left: 0;
            right: 0;
            z-index: 9998;
            transition: all 0.3s ease;
        }

        .nav-glass.scrolled {
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        }

        .hero-gradient {
            background: linear-gradient(135deg, rgba(0,133,62,0.92) 0%, rgba(16,185,129,0.85) 50%, rgba(0,133,62,0.92) 100%),
                        url('https://images.unsplash.com/photo-1589497559716-1d94291b0e08?w=1600');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 400'%3E%3Ccircle cx='50%25' cy='50%25' r='150' fill='white' opacity='0.03'/%3E%3C/svg%3E") repeat;
            background-size: 400px 400px;
            animation: floatBg 20s linear infinite;
        }

        @keyframes floatBg {
            0% { transform: translate(0, 0); }
            100% { transform: translate(100px, 100px); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .floating-card {
            animation: floatY 3s ease-in-out infinite;
        }
        .floating-card-delay-1 { animation-delay: 0.5s; }
        .floating-card-delay-2 { animation-delay: 1s; }

        @keyframes floatY {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .btn-primary {
            background: linear-gradient(135deg, #FDEF42, #FCD34D);
            color: #065F46;
            transition: all 0.3s ease;
            box-shadow: 0 8px 30px rgba(253,239,66,0.3);
        }
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(253,239,66,0.4);
        }

        .btn-outline-white {
            border: 2px solid rgba(255,255,255,0.4);
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(8px);
            transition: all 0.3s ease;
        }
        .btn-outline-white:hover {
            background: rgba(255,255,255,0.25);
            border-color: white;
            transform: translateY(-3px);
        }

        .stat-card {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.15);
            transition: all 0.4s ease;
        }
        .stat-card:hover {
            transform: translateY(-8px) scale(1.02);
            background: rgba(255,255,255,0.2);
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }

        .section-title {
            position: relative;
            display: inline-block;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, #00853E, #FDEF42, #E31B23);
            border-radius: 4px;
        }

        .benefit-card {
            background: white;
            border-radius: 24px;
            padding: 32px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0,0,0,0.04);
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }
        .benefit-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 60px rgba(0,133,62,0.12);
            border-color: rgba(0,133,62,0.15);
        }
        .benefit-card .icon-wrapper {
            width: 72px;
            height: 72px;
            margin: 0 auto 20px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            transition: all 0.3s ease;
        }
        .benefit-card:hover .icon-wrapper {
            transform: scale(1.1) rotate(-5deg);
        }

        .testimonial-card {
            background: white;
            border-radius: 24px;
            padding: 28px;
            border: 1px solid rgba(0,0,0,0.04);
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
        }
        .testimonial-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        }

        .cta-section {
            background: linear-gradient(135deg, #00853E, #065F46);
            border-radius: 32px;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 200'%3E%3Ccircle cx='50%25' cy='50%25' r='100' fill='white' opacity='0.03'/%3E%3C/svg%3E") repeat;
            background-size: 200px 200px;
        }

        .animated-underline {
            position: relative;
            display: inline-block;
        }
        .animated-underline::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #FDEF42;
            transition: width 0.4s ease;
        }
        .animated-underline:hover::after {
            width: 100%;
        }

        .company-logo-placeholder {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 20px;
            color: white;
            flex-shrink: 0;
        }

        .fade-in {
            opacity: 0;
            animation: fadeInUp 0.8s ease forwards;
        }
        .fade-in-delay-1 { animation-delay: 0.1s; }
        .fade-in-delay-2 { animation-delay: 0.3s; }
        .fade-in-delay-3 { animation-delay: 0.5s; }
        .fade-in-delay-4 { animation-delay: 0.7s; }
        .fade-in-delay-5 { animation-delay: 0.9s; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .hero-gradient { min-height: 90vh; }
            .cta-section { padding: 40px 24px; }
        }
    </style>
</head>
<body>
    <!-- Bandeau drapeau -->
    <div class="flag-stripe"></div>

    <!-- Navigation -->
    <nav class="nav-glass" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('landing') }}" class="flex items-center space-x-3 group">
                    @php
                        $logoPath = null;
                        if (file_exists(public_path('storage/logos/en-haut.jpg'))) {
                            $logoPath = asset('storage/logos/en-haut.jpg');
                        } elseif (file_exists(public_path('storage/logos/logo-sn.png'))) {
                            $logoPath = asset('storage/logos/logo-sn.png');
                        } elseif (file_exists(public_path('images/logo-sn.png'))) {
                            $logoPath = asset('images/logo-sn.png');
                        }
                    @endphp
                    @if($logoPath)
                        <img src="{{ $logoPath }}" alt="Logo" class="h-10 w-auto group-hover:scale-105 transition duration-300">
                    @else
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-green-500 to-yellow-500 flex items-center justify-center text-white font-extrabold text-lg shadow-lg">GS</div>
                    @endif
                    <div>
                        <span class="text-xl font-extrabold text-green-700 tracking-tight">Gestion Stages</span>
                        <span class="text-xs font-bold text-yellow-600 block -mt-0.5">🇸🇳 SÉNÉGAL</span>
                    </div>
                </a>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#benefits" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-green-700 transition">Avantages</a>
                    <a href="#companies" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-green-700 transition">Entreprises</a>
                    <a href="#testimonials" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-green-700 transition">Témoignages</a>
                    <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-gray-700 hover:text-green-700 transition">
                        <i class="fas fa-sign-in-alt mr-1.5"></i> Connexion
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 transition shadow-sm hover:shadow-md">
                        <i class="fas fa-user-plus mr-1.5"></i> Inscription
                    </a>
                </div>

                <!-- Menu Mobile -->
                <div class="md:hidden flex items-center">
                    <button id="mobileMenuBtn" class="p-2 rounded-xl hover:bg-gray-100 transition">
                        <i class="fas fa-bars text-xl text-gray-600"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden bg-white border-t border-gray-100 py-2 px-4 shadow-lg">
            <a href="#benefits" class="block py-2.5 text-gray-600 hover:text-green-600 border-b border-gray-50">Avantages</a>
            <a href="#companies" class="block py-2.5 text-gray-600 hover:text-green-600 border-b border-gray-50">Entreprises</a>
            <a href="#testimonials" class="block py-2.5 text-gray-600 hover:text-green-600 border-b border-gray-50">Témoignages</a>
            <a href="{{ route('login') }}" class="block py-2.5 text-gray-600 hover:text-green-600 border-b border-gray-50">
                <i class="fas fa-sign-in-alt mr-2"></i> Connexion
            </a>
            <a href="{{ route('register') }}" class="block py-2.5 text-green-600 font-semibold">
                <i class="fas fa-user-plus mr-2"></i> Inscription
            </a>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-gradient" id="hero">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 hero-content w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Texte -->
                <div>
                    <div class="inline-flex items-center bg-white/20 backdrop-blur-sm rounded-full px-4 py-1.5 text-sm text-white font-medium border border-white/20 mb-6 fade-in">
                        <span class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></span>
                        🇸🇳 Plateforme officielle du Sénégal
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight fade-in fade-in-delay-1">
                        Trouvez votre <br>
                        <span class="text-yellow-300 relative">
                            stage idéal
                            <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 300 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 5 L300 5" stroke="#FDEF42" stroke-width="3" stroke-dasharray="8 8"/>
                            </svg>
                        </span>
                        <br>au Sénégal
                    </h1>
                    <p class="text-lg text-green-100/90 mt-6 max-w-lg fade-in fade-in-delay-2">
                        La plateforme qui connecte les étudiants talentueux aux meilleures entreprises sénégalaises. 
                        Des milliers d'opportunités de stage vous attendent.
                    </p>
                    <div class="flex flex-wrap gap-4 mt-8 fade-in fade-in-delay-3">
                        <a href="{{ route('register') }}" class="btn-primary px-8 py-3.5 rounded-xl font-semibold text-base flex items-center">
                            <i class="fas fa-rocket mr-2"></i>
                            Démarrer maintenant
                        </a>
                        <a href="#companies" class="btn-outline-white px-8 py-3.5 rounded-xl font-medium text-white text-base flex items-center">
                            <i class="fas fa-play-circle mr-2"></i>
                            Voir les entreprises
                        </a>
                    </div>
                    <div class="flex items-center gap-6 mt-8 fade-in fade-in-delay-4">
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gradient-to-br from-green-400 to-blue-400 flex items-center justify-center text-white font-bold text-xs">AM</div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gradient-to-br from-yellow-400 to-red-400 flex items-center justify-center text-white font-bold text-xs">FM</div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gradient-to-br from-purple-400 to-pink-400 flex items-center justify-center text-white font-bold text-xs">DS</div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gradient-to-br from-blue-400 to-cyan-400 flex items-center justify-center text-white font-bold text-xs">+2k</div>
                        </div>
                        <div class="text-white/80">
                            <p class="text-sm font-semibold">2 000+ étudiants</p>
                            <p class="text-xs text-green-200">déjà inscrits</p>
                        </div>
                    </div>
                </div>

                <!-- Visuel Droite -->
                <div class="relative lg:block fade-in fade-in-delay-3">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Carte 1 -->
                        <div class="bg-white/15 backdrop-blur-md rounded-2xl p-5 floating-card border border-white/20">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-green-500/30 flex items-center justify-center text-2xl">💼</div>
                                <div>
                                    <p class="text-white font-bold text-lg">{{ $totalStages ?? '100+' }}</p>
                                    <p class="text-green-200 text-xs">Stages disponibles</p>
                                </div>
                            </div>
                        </div>
                        <!-- Carte 2 -->
                        <div class="bg-white/15 backdrop-blur-md rounded-2xl p-5 floating-card floating-card-delay-1 border border-white/20">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-blue-500/30 flex items-center justify-center text-2xl">🏢</div>
                                <div>
                                    <p class="text-white font-bold text-lg">{{ $totalEntreprises ?? '50+' }}</p>
                                    <p class="text-green-200 text-xs">Entreprises</p>
                                </div>
                            </div>
                        </div>
                        <!-- Carte 3 -->
                        <div class="bg-white/15 backdrop-blur-md rounded-2xl p-5 floating-card floating-card-delay-2 border border-white/20 col-span-2">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-yellow-500/30 flex items-center justify-center text-2xl">📈</div>
                                <div>
                                    <p class="text-white font-bold text-lg">+45%</p>
                                    <p class="text-green-200 text-xs">Taux de placement en 2025</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Badge flottant -->
                    <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl shadow-2xl p-4 hidden lg:flex items-center gap-3 animate-pulse">
                        <div class="w-12 h-12 rounded-xl bg-yellow-100 flex items-center justify-center text-2xl">⭐</div>
                        <div>
                            <p class="font-bold text-gray-800 text-sm">4.8/5</p>
                            <p class="text-xs text-gray-500">Note des utilisateurs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS BANNER -->
    <section class="bg-white border-b border-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <p class="text-3xl font-bold text-green-700">{{ $totalStages ?? '0' }}</p>
                    <p class="text-sm text-gray-500">Stages proposés</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-blue-700">{{ $totalEntreprises ?? '0' }}</p>
                    <p class="text-sm text-gray-500">Entreprises partenaires</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-yellow-700">{{ $totalEtudiants ?? '0' }}</p>
                    <p class="text-sm text-gray-500">Étudiants inscrits</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-purple-700">{{ $totalCandidatures ?? '0' }}</p>
                    <p class="text-sm text-gray-500">Candidatures</p>
                </div>
            </div>
        </div>
    </section>

    <!-- BENEFITS SECTION -->
    <section id="benefits" class="py-20 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-green-600 font-semibold text-sm uppercase tracking-wider">Pourquoi nous choisir</span>
                <h2 class="section-title text-3xl md:text-4xl font-extrabold text-gray-800 mt-2">
                    Une plateforme conçue pour <br class="hidden md:block">votre réussite
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto mt-4">Découvrez les avantages de la plateforme de stages leader au Sénégal</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="benefit-card fade-in">
                    <div class="icon-wrapper bg-green-50 text-green-600">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Recherche intelligente</h3>
                    <p class="text-gray-500 text-sm">Trouvez le stage parfait grâce à nos filtres avancés par secteur, ville, type et durée.</p>
                </div>

                <div class="benefit-card fade-in fade-in-delay-1">
                    <div class="icon-wrapper bg-blue-50 text-blue-600">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Candidature rapide</h3>
                    <p class="text-gray-500 text-sm">Postulez en quelques clics avec votre CV et lettre de motivation intégrés.</p>
                </div>

                <div class="benefit-card fade-in fade-in-delay-2">
                    <div class="icon-wrapper bg-yellow-50 text-yellow-600">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Suivi en temps réel</h3>
                    <p class="text-gray-500 text-sm">Suivez l'avancement de vos candidatures et recevez des notifications instantanées.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                <div class="benefit-card fade-in fade-in-delay-3">
                    <div class="icon-wrapper bg-purple-50 text-purple-600">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Réseau professionnel</h3>
                    <p class="text-gray-500 text-sm">Connectez-vous avec les meilleures entreprises sénégalaises et développez votre réseau.</p>
                </div>

                <div class="benefit-card fade-in fade-in-delay-4">
                    <div class="icon-wrapper bg-red-50 text-red-600">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Sécurité garantie</h3>
                    <p class="text-gray-500 text-sm">Plateforme sécurisée avec des données protégées et des offres vérifiées.</p>
                </div>

                <div class="benefit-card fade-in fade-in-delay-5">
                    <div class="icon-wrapper bg-indigo-50 text-indigo-600">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Support dédié</h3>
                    <p class="text-gray-500 text-sm">Une équipe à votre écoute pour vous accompagner à chaque étape de votre parcours.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- COMPANIES SECTION (ENTREPRISES PARTENAIRES) -->
    <section id="companies" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-blue-600 font-semibold text-sm uppercase tracking-wider">Nos partenaires</span>
                <h2 class="section-title text-3xl md:text-4xl font-extrabold text-gray-800 mt-2">
                    Entreprises qui recrutent
                </h2>
                <p class="text-gray-500 max-w-2xl mx-auto mt-4">Découvrez les entreprises de confiance qui proposent des stages</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $companies = [
                        ['name' => 'Sonatel S.A', 'sector' => 'Télécommunications', 'color' => 'from-green-400 to-green-600', 'bg' => 'green'],
                        ['name' => 'Orange Sénégal', 'sector' => 'Télécommunications', 'color' => 'from-orange-400 to-orange-600', 'bg' => 'orange'],
                        ['name' => 'Ecobank Sénégal', 'sector' => 'Banque & Finance', 'color' => 'from-blue-400 to-blue-600', 'bg' => 'blue'],
                        ['name' => 'Sunu Assurances', 'sector' => 'Assurances', 'color' => 'from-red-400 to-red-600', 'bg' => 'red'],
                        ['name' => 'TIGO Sénégal', 'sector' => 'Télécommunications', 'color' => 'from-purple-400 to-purple-600', 'bg' => 'purple'],
                        ['name' => 'Free Sénégal', 'sector' => 'Télécommunications', 'color' => 'from-yellow-400 to-yellow-600', 'bg' => 'yellow'],
                        ['name' => 'Axa Sénégal', 'sector' => 'Assurances', 'color' => 'from-indigo-400 to-indigo-600', 'bg' => 'indigo'],
                        ['name' => 'TotalEnergies Sénégal', 'sector' => 'Énergie', 'color' => 'from-red-500 to-red-700', 'bg' => 'red'],
                        ['name' => 'Coca-Cola Sénégal', 'sector' => 'Agroalimentaire', 'color' => 'from-red-400 to-red-600', 'bg' => 'red'],
                        ['name' => 'Nestlé Sénégal', 'sector' => 'Agroalimentaire', 'color' => 'from-blue-400 to-blue-600', 'bg' => 'blue'],
                    ];
                @endphp
                @foreach($companies as $company)
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-lg transition hover:-translate-y-2 duration-300 flex items-center gap-4">
                        <div class="company-logo-placeholder bg-gradient-to-br {{ $company['color'] }}">
                            {{ strtoupper(substr($company['name'], 0, 2)) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">{{ $company['name'] }}</h4>
                            <p class="text-xs text-gray-500">{{ $company['sector'] }}</p>
                            <div class="flex items-center mt-1 text-xs text-green-600">
                                <i class="fas fa-circle text-[6px] mr-1.5"></i>
                                Recrute actuellement
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
 
<!-- TESTIMONIALS -->
<!-- TESTIMONIALS -->
<section id="testimonials" class="py-20 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-purple-600 font-semibold text-sm uppercase tracking-wider">Témoignages</span>
            <h2 class="section-title text-3xl md:text-4xl font-extrabold text-gray-800 mt-2">
                Ils ont trouvé leur stage
            </h2>
            <p class="text-gray-500 max-w-2xl mx-auto mt-4">Retours d'expérience de la promotion L2 Réseaux ISI</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- ============================================ -->
            <!-- 1. Baba Niang -->
            <!-- ============================================ -->
            <div class="testimonial-card hover:shadow-xl transition-all duration-300">
                <div class="flex items-center gap-3 mb-3">
                    <!-- PHOTO : Place ton image ici -->
                    <!-- <img src="{{ asset('images/avatars/baba-niang.jpg') }}" alt="Baba Niang" class="w-12 h-12 rounded-full object-cover border-2 border-blue-400"> -->
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">BN</div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Baba Niang</p>
                        <p class="text-xs text-gray-500">L2 Réseaux - ISI</p>
                        <div class="flex items-center text-yellow-400 text-xs">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed italic">
                    "Stage dev web chez Sonatel. Plateforme simple et efficace."
                </p>
                <div class="mt-2 flex items-center gap-2 text-xs">
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full">✅ Stage trouvé</span>
                    <span class="text-gray-400">Sonatel</span>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- 2. Mor Talla Dieng - MEILLEUR ÉTUDIANT -->
            <!-- ============================================ -->
            <div class="testimonial-card hover:shadow-xl transition-all duration-300 border-2 border-yellow-400 relative">
                <div class="flex items-center gap-3 mb-3">
                    <!-- PHOTO : Place ton image ici -->
                    <!-- <img src="{{ asset('images/avatars/mor-talla-dieng.jpg') }}" alt="Mor Talla Dieng" class="w-12 h-12 rounded-full object-cover border-2 border-yellow-400"> -->
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">MTD</div>
                    <div>
                        <div class="flex items-center gap-2">
                            <p class="font-bold text-gray-800 text-sm">Mor Talla Dieng</p>
                            <span class="bg-yellow-400 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">⭐ Meilleur étudiant</span>
                        </div>
                        <p class="text-xs text-gray-500">L2 Réseaux - ISI</p>
                        <div class="flex items-center text-yellow-400 text-xs">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed italic">
                    "Stage réseau chez Orange. Plateforme au top, suivi parfait."
                </p>
                <div class="mt-2 flex items-center gap-2 text-xs">
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">🏆 Excellence</span>
                    <span class="text-gray-400">Orange Sénégal</span>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- 3. Anta Gueye -->
            <!-- ============================================ -->
            <div class="testimonial-card hover:shadow-xl transition-all duration-300">
                <div class="flex items-center gap-3 mb-3">
                    <!-- PHOTO : Place ton image ici -->
                    <!-- <img src="{{ asset('images/avatars/anta-gueye.jpg') }}" alt="Anta Gueye" class="w-12 h-12 rounded-full object-cover border-2 border-pink-400"> -->
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-pink-400 to-rose-600 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">AG</div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Anta Gueye</p>
                        <p class="text-xs text-gray-500">L2 Réseaux - ISI</p>
                        <div class="flex items-center text-yellow-400 text-xs">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed italic">
                    "Stage sécurité réseau chez TIGO. Candidature rapide."
                </p>
                <div class="mt-2 flex items-center gap-2 text-xs">
                    <span class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full">🔒 Sécurité</span>
                    <span class="text-gray-400">TIGO Sénégal</span>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- 4. Sokhna Ndiaye -->
            <!-- ============================================ -->
            <div class="testimonial-card hover:shadow-xl transition-all duration-300">
                <div class="flex items-center gap-3 mb-3">
                    <!-- PHOTO : Place ton image ici -->
                    <!-- <img src="{{ asset('images/avatars/sokhna-ndiaye.jpg') }}" alt="Sokhna Ndiaye" class="w-12 h-12 rounded-full object-cover border-2 border-purple-400"> -->
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-indigo-600 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">SN</div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Sokhna Ndiaye</p>
                        <p class="text-xs text-gray-500">L2 Réseaux - ISI</p>
                        <div class="flex items-center text-yellow-400 text-xs">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed italic">
                    "Stage réseau chez Free. Très pratique et bien organisé."
                </p>
                <div class="mt-2 flex items-center gap-2 text-xs">
                    <span class="bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full">🌐 Réseaux</span>
                    <span class="text-gray-400">Free Sénégal</span>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- 5. Cheikh Ndiaye "SIPION" - Banque -->
            <!-- ============================================ -->
            <div class="testimonial-card hover:shadow-xl transition-all duration-300">
                <div class="flex items-center gap-3 mb-3">
                    <!-- PHOTO : Place ton image ici -->
                    <!-- <img src="{{ asset('images/avatars/cheikh-ndiaye.jpg') }}" alt="Cheikh Ndiaye" class="w-12 h-12 rounded-full object-cover border-2 border-orange-400"> -->
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-red-600 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">CN</div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Cheikh Ndiaye <span class="text-xs text-gray-400">"SIPION"</span></p>
                        <p class="text-xs text-gray-500">ISM - Informatique</p>
                        <div class="flex items-center text-yellow-400 text-xs">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed italic">
                    "Stage en finance numérique chez Ecobank. Plateforme professionnelle."
                </p>
                <div class="mt-2 flex items-center gap-2 text-xs">
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">🏦 Banque</span>
                    <span class="text-gray-400">Ecobank Sénégal</span>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- 6. Karamakho Diop (avis négatif) -->
            <!-- ============================================ -->
            <div class="testimonial-card hover:shadow-xl transition-all duration-300 border-2 border-red-200">
                <div class="flex items-center gap-3 mb-3">
                    <!-- PHOTO : Place ton image ici -->
                    <!-- <img src="{{ asset('images/avatars/karamakho-diop.jpg') }}" alt="Karamakho Diop" class="w-12 h-12 rounded-full object-cover border-2 border-red-400"> -->
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">KD</div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm">Karamakho Diop</p>
                        <p class="text-xs text-gray-500">L2 Réseaux - ISI</p>
                        <div class="flex items-center text-yellow-400 text-xs">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed italic">
                    "Certaines offres ne sont pas à jour. Mais le support corrige vite."
                </p>
                <div class="mt-2 flex items-center gap-2 text-xs">
                    <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded-full">⚠️ À améliorer</span>
                    <span class="text-gray-400">Mise à jour</span>
                </div>
            </div>
        </div>

        <!-- Témoignage collectif du groupe L2 Réseaux -->
        <div class="mt-12 bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-6 border border-green-100 max-w-2xl mx-auto text-center">
            <div class="flex items-center justify-center gap-2 mb-2">
                <span class="text-2xl">👥</span>
                <span class="text-sm font-bold text-gray-700">Promotion L2 Réseaux ISI</span>
            </div>
            <p class="text-gray-600 text-sm italic">
                "Nous avons tous trouvé des stages grâce à la plateforme. Merci Gestion Stages SN !"
            </p>
            
        </div>

        
        </div>
    </div>
</section>

        <!-- Témoignage collectif du groupe L2 Réseaux -->
        
            
           

        <!-- Mini stats -->
        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-2xl mx-auto">
            <div class="bg-white rounded-xl p-3 text-center shadow-sm border">
                <p class="text-xl font-bold text-green-600">1500</p>
                <p class="text-xs text-gray-500">Stagiaires</p>
            </div>
            <div class="bg-white rounded-xl p-3 text-center shadow-sm border">
                <p class="text-xl font-bold text-blue-600">50</p>
                <p class="text-xs text-gray-500">Entreprises</p>
            </div>
            <div class="bg-white rounded-xl p-3 text-center shadow-sm border">
                <p class="text-xl font-bold text-yellow-600">8.8</p>
                <p class="text-xs text-gray-500">Note</p>
            </div>
            <div class="bg-white rounded-xl p-3 text-center shadow-sm border">
                <p class="text-xl font-bold text-purple-600">98%</p>
                <p class="text-xs text-gray-500">Satisfaits</p>
            </div>
        </div>
    </div>
</section>
    
    

    <!-- CTA FINAL -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="cta-section relative">
                <div class="relative z-10 text-center text-white">
                    <h2 class="text-3xl md:text-4xl font-extrabold mb-4">
                        Prêt à décoller votre carrière ?
                    </h2>
                    <p class="text-green-100/90 max-w-2xl mx-auto mb-8">
                        Rejoignez des milliers d'étudiants qui ont trouvé leur stage idéal. 
                        Créez votre compte gratuitement en moins de 2 minutes.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('register') }}" class="bg-yellow-400 text-green-900 px-8 py-3.5 rounded-xl font-bold hover:bg-yellow-300 transition shadow-lg hover:shadow-xl flex items-center">
                            <i class="fas fa-user-plus mr-2"></i>
                            S'inscrire maintenant
                        </a>
                        <a href="{{ route('stages.index') }}" class="bg-white/20 backdrop-blur-sm text-white border border-white/30 px-8 py-3.5 rounded-xl font-medium hover:bg-white/30 transition flex items-center">
                            <i class="fas fa-search mr-2"></i>
                            Explorer les stages
                        </a>
                    </div>
                    <p class="text-green-200 text-sm mt-4">🔒 Inscription gratuite • 100% sécurisé</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="text-xl font-extrabold text-green-400">Gestion Stages</span>
                        <span class="text-xs font-bold text-yellow-500">SN</span>
                    </div>
                    <p class="text-sm text-gray-400 mt-2">Plateforme de mise en relation entre étudiants et entreprises du Sénégal.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-3">Liens rapides</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('stages.index') }}" class="hover:text-green-400 transition">Stages</a></li>
                        <li><a href="{{ route('entreprises.index') }}" class="hover:text-green-400 transition">Entreprises</a></li>
                        <li><a href="#" class="hover:text-green-400 transition">À propos</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-3">Contact</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i> contact@gestionstages.sn</li>
                        <li><i class="fas fa-phone mr-2"></i> +221 76 244 33 25</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Dakar,,Kaolack,Diorbel,KF, Sénégal</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-white mb-3">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-green-400 transition text-xl"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-green-400 transition text-xl"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-green-400 transition text-xl"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-gray-400 hover:text-green-400 transition text-xl"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-500">
                © {{ date('Y') }} Gestion Stages Sénégal. Tous droits réservés.
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });

        // Mobile menu
        document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    </script>
</body>
</html>