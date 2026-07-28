<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gestion de Stages - Sénégal')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        
        .flag-stripe {
            background: linear-gradient(to right, #00853E 33%, #FDEF42 33%, #FDEF42 66%, #E31B23 66%);
            height: 4px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
        }
        
        .nav-gradient {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        
        .nav-link {
            position: relative;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, #00853E, #10B981);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .nav-link.active::after {
            width: 100%;
        }
        
        .avatar-ring {
            border: 2px solid transparent;
            background-image: linear-gradient(white, white), 
                              linear-gradient(135deg, #00853E, #FDEF42, #E31B23);
            background-origin: border-box;
            background-clip: content-box, border-box;
        }
        
        .dropdown-enter {
            animation: dropdownFade 0.2s ease forwards;
        }
        
        @keyframes dropdownFade {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .badge-role {
            font-size: 10px;
            font-weight: 600;
            padding: 2px 10px;
            border-radius: 20px;
            letter-spacing: 0.3px;
        }
    </style>
</head>
<body class="bg-gray-50/80 antialiased">
    <!-- Bandeau drapeau -->
    <div class="flag-stripe"></div>

    <!-- Navbar -->
    <nav class="nav-gradient sticky top-0 z-50 pt-[4px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    @php
                        $logoPath = null;
                        if (file_exists(public_path('storage/logos/enhaut.jpg'))) {
                            $logoPath = asset('storage/logos/enhaut.jpg');
                        } elseif (file_exists(public_path('storage/logos/logo-sn.png'))) {
                            $logoPath = asset('storage/logos/logo-sn.png');
                        } elseif (file_exists(public_path('images/logo-sn.png'))) {
                            $logoPath = asset('images/logo-sn.png');
                        }
                    @endphp
                    @if($logoPath)
                        <img src="{{ $logoPath }}" alt="Logo" class="h-10 w-auto group-hover:scale-105 transition duration-300">
                    @else
                        <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-green-500 to-yellow-500 flex items-center justify-center text-white font-extrabold text-lg shadow-lg">
                            GS
                        </div>
                    @endif
                    <div>
                        <span class="text-xl font-extrabold text-green-700 tracking-tight">
                            Gestion Stages
                        </span>
                        <span class="text-xs font-bold text-yellow-600 block -mt-0.5">🇸🇳 SÉNÉGAL</span>
                    </div>
                </a>

                <!-- Menu Desktop -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('dashboard') }}" 
                       class="nav-link px-4 py-2 text-gray-600 hover:text-green-600 {{ request()->routeIs('dashboard') ? 'text-green-600' : '' }}">
                        <i class="fas fa-home mr-1.5 text-sm"></i> Accueil
                    </a>
                    <a href="{{ route('stages.index') }}" 
                       class="nav-link px-4 py-2 text-gray-600 hover:text-green-600 {{ request()->routeIs('stages.*') ? 'text-green-600' : '' }}">
                        <i class="fas fa-briefcase mr-1.5 text-sm"></i> Stages
                    </a>
                    <a href="{{ route('entreprises.index') }}" 
                       class="nav-link px-4 py-2 text-gray-600 hover:text-green-600 {{ request()->routeIs('entreprises.*') ? 'text-green-600' : '' }}">
                        <i class="fas fa-building mr-1.5 text-sm"></i> Entreprises
                    </a>
                    @auth
                        <a href="{{ route('candidatures.index') }}" 
                           class="nav-link px-4 py-2 text-gray-600 hover:text-green-600 {{ request()->routeIs('candidatures.*') ? 'text-green-600' : '' }}">
                            <i class="fas fa-file-signature mr-1.5 text-sm"></i> Candidatures
                        </a>
                    @endauth

                    @auth
                        <!-- Dropdown Utilisateur -->
                        <div class="relative ml-2">
                            <button id="dropdownUserButton" 
                                    class="flex items-center space-x-3 px-3 py-2 rounded-xl hover:bg-gray-100/80 transition">
                                <div class="avatar-ring w-9 h-9 rounded-full overflow-hidden flex items-center justify-center bg-gradient-to-br from-green-100 to-yellow-100">
                                    <span class="text-sm font-bold text-green-700">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                    </span>
                                </div>
                                <div class="text-left hidden lg:block">
                                    <p class="text-sm font-semibold text-gray-800 leading-tight">{{ Auth::user()->name }}</p>
                                    <span class="badge-role 
                                        @if(Auth::user()->role == 'admin') bg-yellow-100 text-yellow-700
                                        @elseif(Auth::user()->role == 'entreprise') bg-blue-100 text-blue-700
                                        @else bg-green-100 text-green-700 @endif">
                                        @if(Auth::user()->role == 'admin') 👑 Admin
                                        @elseif(Auth::user()->role == 'entreprise') 🏢 Entreprise
                                        @else 🎓 Étudiant @endif
                                    </span>
                                </div>
                                <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                            </button>

                            <div id="dropdownUser" class="absolute right-0 mt-2 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 hidden overflow-hidden dropdown-enter">
                                <div class="p-4 border-b border-gray-100 bg-gray-50/50">
                                    <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 transition">
                                        <i class="fas fa-user-circle w-5 text-green-500"></i> Mon profil
                                    </a>
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-yellow-50 hover:text-yellow-700 transition">
                                            <i class="fas fa-crown w-5 text-yellow-500"></i> Administration
                                        </a>
                                    @endif
                                    <hr class="my-1 border-gray-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition">
                                            <i class="fas fa-sign-out-alt w-5 text-red-500"></i> Déconnexion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium text-gray-700 hover:text-green-600 transition">
                            <i class="fas fa-sign-in-alt mr-1.5"></i> Connexion
                        </a>
                        <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 transition shadow-sm hover:shadow-md">
                            <i class="fas fa-user-plus mr-1.5"></i> Inscription
                        </a>
                    @endauth
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
            <a href="{{ route('dashboard') }}" class="block py-2.5 text-gray-600 hover:text-green-600 border-b border-gray-50">
                <i class="fas fa-home mr-2"></i> Accueil
            </a>
            <a href="{{ route('stages.index') }}" class="block py-2.5 text-gray-600 hover:text-green-600 border-b border-gray-50">
                <i class="fas fa-briefcase mr-2"></i> Stages
            </a>
            <a href="{{ route('entreprises.index') }}" class="block py-2.5 text-gray-600 hover:text-green-600 border-b border-gray-50">
                <i class="fas fa-building mr-2"></i> Entreprises
            </a>
            @auth
                <a href="{{ route('candidatures.index') }}" class="block py-2.5 text-gray-600 hover:text-green-600 border-b border-gray-50">
                    <i class="fas fa-file-signature mr-2"></i> Mes candidatures
                </a>
                <a href="{{ route('profile.edit') }}" class="block py-2.5 text-gray-600 hover:text-green-600 border-b border-gray-50">
                    <i class="fas fa-user mr-2"></i> Mon profil
                </a>
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block py-2.5 text-yellow-600 hover:text-yellow-700 border-b border-gray-50">
                        <i class="fas fa-crown mr-2"></i> Admin
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left py-2.5 text-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2.5 text-gray-600 hover:text-green-600 border-b border-gray-50">
                    <i class="fas fa-sign-in-alt mr-2"></i> Connexion
                </a>
                <a href="{{ route('register') }}" class="block py-2.5 text-green-600 font-semibold">
                    <i class="fas fa-user-plus mr-2"></i> Inscription
                </a>
            @endauth
        </div>
    </nav>

    <!-- Messages flash -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl flex items-center justify-between shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl flex items-center justify-between shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 text-xl mr-3"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="text-xl font-extrabold text-green-700">Gestion Stages</span>
                        <span class="text-xs font-bold text-yellow-600">SN</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Plateforme de mise en relation entre étudiants et entreprises du Sénégal.</p>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700 mb-3">Liens rapides</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('stages.index') }}" class="text-gray-500 hover:text-green-600 transition">Stages</a></li>
                        <li><a href="{{ route('entreprises.index') }}" class="text-gray-500 hover:text-green-600 transition">Entreprises</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-600 transition">À propos</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700 mb-3">Contact</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><i class="fas fa-envelope mr-2"></i> contact@gestionstages.sn</li>
                        <li><i class="fas fa-phone mr-2"></i> +221 77 123 45 67</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Dakar, Sénégal</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700 mb-3">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-green-600 transition text-xl"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-green-600 transition text-xl"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-green-600 transition text-xl"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-gray-400 hover:text-green-600 transition text-xl"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-100 mt-6 pt-6 text-center text-sm text-gray-400">
                © {{ date('Y') }} Gestion Stages Sénégal. Tous droits réservés.
            </div>
        </div>
    </footer>

    <script>
        // Dropdown user
        document.getElementById('dropdownUserButton')?.addEventListener('click', function(e) {
            e.stopPropagation();
            document.getElementById('dropdownUser').classList.toggle('hidden');
        });
        
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('dropdownUser');
            const button = document.getElementById('dropdownUserButton');
            if (dropdown && button && !button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // Mobile menu
        document.getElementById('mobileMenuBtn')?.addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });

        // Navigation active state
        document.querySelectorAll('.nav-link').forEach(link => {
            if (link.href === window.location.href) {
                link.classList.add('active');
            }
        });
    </script>
</body>
</html>