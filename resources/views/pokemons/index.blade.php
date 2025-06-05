@extends('layouts.app')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Inter:wght@300;400;500;600;700&display=swap');
    
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        background: linear-gradient(135deg, #0f0f23 0%, #1a1a2e 50%, #16213e 100%);
        font-family: 'Inter', sans-serif;
        min-height: 100vh;
        color: #ffffff;
        overflow-x: hidden;
    }
    
    .stars {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }
    
    .star {
        position: absolute;
        background: #ffffff;
        border-radius: 50%;
        animation: twinkle 2s infinite;
    }
    
    @keyframes twinkle {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 1; }
    }
    
    .main-container {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        min-height: 100vh;
        transform-style: preserve-3d;
    }    
    .header {
        text-align: center;
        margin-bottom: 40px;
        position: relative;
    }
    
    .main-title {
        font-family: 'Orbitron', monospace;
        font-size: 3.5rem;
        font-weight: 900;
        background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #feca57);
        background-size: 300% 300%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: gradientShift 4s ease-in-out infinite;
        text-shadow: 0 0 30px rgba(255, 255, 255, 0.1);
        margin-bottom: 10px;
    }
    
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .subtitle {
        font-size: 1.2rem;
        color: #a0a3bd;
        font-weight: 300;
        letter-spacing: 2px;
    }      .search-container {
        max-width: 600px;
        margin: 0 auto 40px auto;
        position: relative;
        z-index: 9999;
    }
    
    .search-wrapper {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(25px);
        border: 2px solid rgba(255, 255, 255, 0.25);
        border-radius: 30px;
        padding: 10px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2), 
                    0 5px 15px rgba(78, 205, 196, 0.1);
        position: relative;
        z-index: 10000;
    }
    
    .search-wrapper:focus-within {
        border-color: #4ecdc4;
        box-shadow: 0 0 0 4px rgba(78, 205, 196, 0.3),
                    0 20px 50px rgba(0, 0, 0, 0.3),
                    0 0 30px rgba(78, 205, 196, 0.2);
        transform: translateY(-3px);
        background: rgba(255, 255, 255, 0.2);
    }
      .search-input {
        flex: 1;
        background: none;
        border: none;
        padding: 15px 20px;
        font-size: 1.1rem;
        color: #ffffff;
        outline: none;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
    }
    
    .search-input::placeholder {
        color: #a0a3bd;
        font-weight: 400;
    }
    
    .search-btn {
        background: linear-gradient(45deg, #4ecdc4, #45b7d1);
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(78, 205, 196, 0.2);
    }
    
    .search-btn:hover {
        transform: scale(1.1) rotate(10deg);
        box-shadow: 0 8px 25px rgba(78, 205, 196, 0.5);
        background: linear-gradient(45deg, #45b7d1, #4ecdc4);
    }
    
    .search-btn:active {
        transform: scale(0.95);
    }    #suggestions {
        position: absolute;
        top: 100%;
        left: 8px;
        right: 8px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 10001;
        display: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        margin-top: 5px;
    }
    
    .suggestion-item {
        padding: 12px 20px;
        cursor: pointer;
        color: #1a1a2e;
        font-weight: 500;
        transition: all 0.2s ease;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .suggestion-item:last-child {
        border-bottom: none;
    }
    
    .suggestion-item:hover {
        background: rgba(78, 205, 196, 0.2);
        color: #0f0f23;
        transform: translateX(5px);
    }
    
    .pokemon-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        padding: 30px;
        margin: 0 auto;
        max-width: 500px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        transition: all 0.4s ease;
        animation: cardSlideIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        z-index: 1;
    }
    
    @keyframes cardSlideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .pokemon-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
    }
    
    .pokemon-image-container {
        position: relative;
        text-align: center;
        margin-bottom: 25px;
        transform-style: preserve-3d;
    }
    
    .pokemon-image {
        width: 200px;
        height: 200px;
        object-fit: contain;
        border-radius: 20px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        padding: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transform-origin: center;
        will-change: transform;
        opacity: 0;
        animation: imageLoad 0.6s ease-out 0.3s forwards;
    }
    
    @keyframes imageLoad {
        from { opacity: 0; transform: scale(0.8); }
        to { opacity: 1; transform: scale(1); }
    }
    
    .pokemon-image:hover {
        transform: scale(1.05) rotate(2deg);
    }
    
    .pokemon-name {
        font-family: 'Orbitron', monospace;
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 15px;
        background: linear-gradient(45deg, #ff6b6b, #4ecdc4);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-transform: capitalize;
    }
    
    .pokemon-id {
        font-size: 1.1rem;
        color: #a0a3bd;
        font-weight: 300;
        margin-left: 10px;
    }
    
    .image-toggle-buttons {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 25px;
    }
    
    .toggle-btn {
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .toggle-btn.active {
        background: linear-gradient(45deg, #4ecdc4, #45b7d1);
        border-color: #4ecdc4;
        box-shadow: 0 5px 15px rgba(78, 205, 196, 0.4);
    }
    
    .toggle-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
    }
    
    .pokemon-types {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 25px;
        flex-wrap: wrap;
    }
    
    .pokemon-type {
        background: linear-gradient(45deg, #ff6b6b, #feca57);
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.3);
        animation: typeFloat 3s ease-in-out infinite;
    }
    
    /* Cores específicas para tipos de Pokémon */
    .pokemon-type.fire { background: linear-gradient(45deg, #FF6B47, #FF4757); }
    .pokemon-type.water { background: linear-gradient(45deg, #3742FA, #70A1FF); }
    .pokemon-type.grass { background: linear-gradient(45deg, #2ED573, #7BED9F); }
    .pokemon-type.electric { background: linear-gradient(45deg, #FFA502, #FFDD59); }
    .pokemon-type.psychic { background: linear-gradient(45deg, #FF6B9D, #F8B500); }
    .pokemon-type.ice { background: linear-gradient(45deg, #40E0D0, #AFEEEE); }
    .pokemon-type.dragon { background: linear-gradient(45deg, #8B00FF, #DA70D6); }
    .pokemon-type.dark { background: linear-gradient(45deg, #2C3E50, #34495E); }
    .pokemon-type.fairy { background: linear-gradient(45deg, #FF69B4, #FFB6C1); }
    .pokemon-type.fighting { background: linear-gradient(45deg, #C0392B, #E74C3C); }
    .pokemon-type.poison { background: linear-gradient(45deg, #8E44AD, #9B59B6); }
    .pokemon-type.ground { background: linear-gradient(45deg, #D2691E, #F4A460); }
    .pokemon-type.flying { background: linear-gradient(45deg, #87CEEB, #B0E0E6); }
    .pokemon-type.bug { background: linear-gradient(45deg, #8FBC8F, #98FB98); }
    .pokemon-type.rock { background: linear-gradient(45deg, #A0522D, #D2691E); }
    .pokemon-type.ghost { background: linear-gradient(45deg, #663399, #9966CC); }
    .pokemon-type.steel { background: linear-gradient(45deg, #708090, #B0C4DE); }
    .pokemon-type.normal { background: linear-gradient(45deg, #A8A878, #C6C6A7); }
    
    @keyframes typeFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-3px); }
    }
    
    .pokemon-stats {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 25px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .stats-title {
        text-align: center;
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #4ecdc4;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
        padding: 8px 0;
    }
    
    .stat-name {
        font-weight: 500;
        color: #ffffff;
        min-width: 120px;
    }
    
    .stat-bar-container {
        flex: 1;
        margin: 0 15px;
        height: 8px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }
    
    .stat-bar {
        height: 100%;
        background: linear-gradient(90deg, #4ecdc4, #45b7d1);
        border-radius: 10px;
        transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        animation: statGlow 2s ease-in-out infinite alternate;
    }
    
    @keyframes statGlow {
        from { box-shadow: 0 0 5px rgba(78, 205, 196, 0.5); }
        to { box-shadow: 0 0 15px rgba(78, 205, 196, 0.8), 0 0 25px rgba(78, 205, 196, 0.4); }
    }
    
    .stat-value {
        color: #4ecdc4;
        font-weight: 600;
        font-size: 1.1rem;
        min-width: 40px;
        text-align: right;
    }
    
    .pokemon-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 25px;
    }
    
    .info-item {
        background: rgba(255, 255, 255, 0.05);
        padding: 15px;
        border-radius: 15px;
        text-align: center;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }
    
    .info-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(78, 205, 196, 0.2);
    }
    
    .info-label {
        color: #a0a3bd;
        font-size: 0.9rem;
        margin-bottom: 5px;
    }
    
    .info-value {
        color: #ffffff;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-top: 40px;
    }
    
    .pagination-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
        padding: 12px 20px;
        border-radius: 15px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .pagination-btn:hover {
        background: linear-gradient(45deg, #4ecdc4, #45b7d1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(78, 205, 196, 0.4);
    }
    
    .pagination-btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }
    
    .error-message {
        text-align: center;
        color: #ff6b6b;
        font-size: 1.2rem;
        font-weight: 600;
        padding: 30px;
        background: rgba(255, 107, 107, 0.1);
        border: 1px solid rgba(255, 107, 107, 0.3);
        border-radius: 15px;
        backdrop-filter: blur(10px);
    }
    
    /* Garantir que o autocomplete sempre apareça na frente */
    .search-container * {
        position: relative;
        z-index: inherit;
    }
    
    #suggestions {
        position: absolute !important;
        z-index: 10001 !important;
    }
    
    /* Reduzir z-index de outros elementos */
    .pokemon-card {
        z-index: 1 !important;
    }
    
    .main-container {
        z-index: 2 !important;
    }
    
    .header {
        z-index: 3 !important;
    }
    
    @media (max-width: 768px) {
        .main-title {
            font-size: 2.5rem;
        }
        
        .pokemon-card {
            margin: 0 10px;
            padding: 20px;
        }
        
        .pokemon-image {
            width: 150px;
            height: 150px;
        }
        
        .pokemon-name {
            font-size: 2rem;
        }
        
        .pokemon-info {
            grid-template-columns: 1fr;
        }
    }
</style>
<div class="stars" id="stars"></div>

<div class="main-container">
    <div class="header">
        <h1 class="main-title">POKÉDEX</h1>
        <p class="subtitle">Explore o mundo dos Pokémon</p>
    </div>

    <div class="search-container">
        <form class="search-wrapper" method="get" autocomplete="off" onsubmit="event.preventDefault(); window.location.href='/pokemons/' + this.search.value.toLowerCase();">
            <input type="text" id="search" name="search" class="search-input" placeholder="Buscar Pokémon..." autocomplete="off" value="{{ request('search') }}">
            <button type="submit" class="search-btn">🔍</button>
            <div id="suggestions"></div>
        </form>
    </div>

    @if($details)
        <div class="pokemon-card">
            <div class="image-toggle-buttons">
                <button type="button" onclick="showNormal()" id="btn-normal" class="toggle-btn active">Normal</button>
                <button type="button" onclick="showShiny()" id="btn-shiny" class="toggle-btn">Shiny</button>
            </div>
            
            <div class="pokemon-image-container">
                <div id="normal">
                    <img class="pokemon-image" src="{{ $details['sprites']['other']['home']['front_default'] }}" alt="{{ $details['name'] }}">
                </div>
                <div id="shiny" style="display: none;">
                    <img class="pokemon-image" src="{{ $details['sprites']['other']['home']['front_shiny'] }}" alt="{{ $details['name'] }}">
                </div>
            </div>
            
            <div class="pokemon-name">
                {{ ucfirst($details['name']) }}
                <span class="pokemon-id">#{{ str_pad($details['id'], 3, '0', STR_PAD_LEFT) }}</span>
            </div>
            
            <div class="pokemon-types">
                @foreach ($types as $type)
                    <span class="pokemon-type">{{ $type }}</span>
                @endforeach
            </div>
            
            <div class="pokemon-stats">
                <h3 class="stats-title">Estatísticas Base</h3>
                @foreach ($stats as $i => $stat)
                    <div class="stat-item">
                        <span class="stat-name">{{ $stat }}</span>
                        <div class="stat-bar-container">
                            <div class="stat-bar" style="width: {{ min(100, ($details['stats'][$i]['base_stat'] / 200) * 100) }}%;"></div>
                        </div>
                        <span class="stat-value">{{ $details['stats'][$i]['base_stat'] }}</span>
                    </div>
                @endforeach
            </div>
            
            <div class="pokemon-info">
                <div class="info-item">
                    <div class="info-label">Peso</div>
                    <div class="info-value">{{ $details['weight'] / 10 }} kg</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Altura</div>
                    <div class="info-value">{{ $details['height'] / 10 }} m</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Experiência Base</div>
                    <div class="info-value">{{ $details['base_experience'] }}</div>
                </div>
            </div>
        </div>
    @elseif(request('search'))
        <div class="error-message">
            Pokémon não encontrado. Tente outro nome!
        </div>
    @endif

    @if($paginator && $paginator->hasPages())
        <div class="pagination-container">
            @if ($paginator->onFirstPage())
                <span class="pagination-btn disabled">← Anterior</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn">← Anterior</a>
            @endif
            
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn">Próximo →</a>
            @else
                <span class="pagination-btn disabled">Próximo →</span>
            @endif
        </div>
    @endif
</div>
<script>
// Criar estrelas animadas no fundo
function createStars() {
    const starsContainer = document.getElementById('stars');
    const numberOfStars = 50;
    
    for (let i = 0; i < numberOfStars; i++) {
        const star = document.createElement('div');
        star.className = 'star';
        star.style.left = Math.random() * 100 + '%';
        star.style.top = Math.random() * 100 + '%';
        star.style.width = Math.random() * 3 + 1 + 'px';
        star.style.height = star.style.width;
        star.style.animationDelay = Math.random() * 2 + 's';
        starsContainer.appendChild(star);
    }
}

function showNormal() {
    document.getElementById('normal').style.display = 'block';
    document.getElementById('shiny').style.display = 'none';
    document.getElementById('btn-normal').classList.add('active');
    document.getElementById('btn-shiny').classList.remove('active');
}

function showShiny() {
    document.getElementById('normal').style.display = 'none';
    document.getElementById('shiny').style.display = 'block';
    document.getElementById('btn-shiny').classList.add('active');
    document.getElementById('btn-normal').classList.remove('active');
}

// Aplicar cores específicas aos tipos de Pokémon
function applyTypeColors() {
    const typeElements = document.querySelectorAll('.pokemon-type');
    const typeColorMap = {
        'fogo': 'fire',
        'água': 'water', 
        'grama': 'grass',
        'elétrico': 'electric',
        'psíquico': 'psychic',
        'gelo': 'ice',
        'dragão': 'dragon',
        'sombrio': 'dark',
        'fada': 'fairy',
        'lutador': 'fighting',
        'veneno': 'poison',
        'terra': 'ground',
        'voador': 'flying',
        'inseto': 'bug',
        'pedra': 'rock',
        'fantasma': 'ghost',
        'aço': 'steel',
        'normal': 'normal'
    };
    
    typeElements.forEach(element => {
        const typeName = element.textContent.toLowerCase();
        if (typeColorMap[typeName]) {
            element.classList.add(typeColorMap[typeName]);
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // Criar estrelas
    createStars();
    
    // Aplicar cores aos tipos
    applyTypeColors();
    
    // Configurar busca e autocomplete
    const input = document.getElementById('search');
    const suggestions = document.getElementById('suggestions');
    
    input.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        if (query.length === 0) {
            suggestions.style.display = 'none';
            suggestions.innerHTML = '';
            return;
        }
        
        fetch('/pokemons-autocomplete?q=' + encodeURIComponent(query))
            .then(res => res.json())
            .then(data => {
                if (data.length === 0) {
                    suggestions.style.display = 'none';
                    suggestions.innerHTML = '';
                    return;
                }
                
                suggestions.innerHTML = data.map(name => `<div class='suggestion-item'>${name}</div>`).join('');
                suggestions.style.display = 'block';
                
                Array.from(suggestions.children).forEach(item => {
                    item.onclick = function() {
                        input.value = this.textContent;
                        suggestions.style.display = 'none';
                        input.form.dispatchEvent(new Event('submit'));
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching suggestions:', error);
                suggestions.style.display = 'none';
            });
    });
    
    // Fechar sugestões ao clicar fora
    document.addEventListener('click', function(e) {
        if (!suggestions.contains(e.target) && e.target !== input) {
            suggestions.style.display = 'none';
        }
    });
    
    // Animação das barras de stats
    const statBars = document.querySelectorAll('.stat-bar');
    statBars.forEach((bar, index) => {
        setTimeout(() => {
            bar.style.width = bar.style.width || '0%';
        }, index * 200);
    });
});
</script>
@endsection