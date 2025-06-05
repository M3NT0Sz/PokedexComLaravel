# 🌟 Pokédex Laravel

<p align="center">
  <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png" width="200" alt="Pikachu">
</p>

<p align="center">
  <strong>Uma Pokédex moderna e interativa construída com Laravel</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/PokeAPI-v2-green?style=for-the-badge" alt="PokeAPI">
</p>

## 📋 Sobre o Projeto

A **Pokédex Laravel** é uma aplicação web moderna que permite explorar o universo Pokémon de forma interativa e visualmente atrativa. Desenvolvida com Laravel e integrada à PokeAPI, oferece uma experiência completa para descobrir informações detalhadas sobre todos os Pokémons.

### ✨ Principais Funcionalidades

- **🔍 Busca Inteligente**: Sistema de busca com autocomplete em tempo real
- **📱 Design Responsivo**: Interface moderna com tema espacial e efeitos glassmorphism
- **🌟 Navegação Fluida**: Navegação próximo/anterior entre Pokémons durante a busca
- **📊 Informações Completas**: Stats, tipos, peso, altura e experiência base em português
- **🎨 Alternância de Sprites**: Visualização entre versões normal e shiny
- **📄 Paginação**: Sistema de paginação para navegar por todos os Pokémons
- **⚡ Performance**: Carregamento otimizado com cache de dados da API

### 🎨 Design Moderno

- **Tema Espacial**: Fundo com gradiente escuro e estrelas animadas
- **Glassmorphism**: Efeitos de vidro fosco em todos os elementos
- **Animações Suaves**: Micro-animações e transições elegantes
- **Tipografia Moderna**: Fontes Orbitron e Inter para uma estética futurista
- **Cores Dinâmicas**: Cores específicas para cada tipo de Pokémon
## 🚀 Tecnologias Utilizadas

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates, CSS3, JavaScript ES6+
- **API**: [PokeAPI v2](https://pokeapi.co/)
- **Fontes**: Google Fonts (Orbitron, Inter)
- **Animações**: CSS Animations & Transitions

## 📦 Instalação

### Pré-requisitos

- PHP 8.2 ou superior
- Composer
- Node.js e NPM (opcional, para assets)

### Passos para Instalação

1. **Clone o repositório**
   ```bash
   git clone https://github.com/seu-usuario/pokedex-laravel.git
   cd pokedex-laravel
   ```

2. **Instale as dependências**
   ```bash
   composer install
   ```

3. **Configure o ambiente**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Inicie o servidor**
   ```bash
   php artisan serve
   ```

5. **Acesse a aplicação**
   ```
   http://localhost:8000
   ```

## 🎮 Como Usar

### Navegação Principal
- **Página Inicial**: Exibe Pokémons com paginação
- **Busca**: Digite o nome de um Pokémon na barra de pesquisa
- **Autocomplete**: Sugestões aparecem conforme você digita
- **Navegação**: Use os botões "Anterior" e "Próximo" para navegar

### Funcionalidades Especiais
- **Sprites**: Clique nos botões "Normal" ou "Shiny" para alternar imagens
- **Navegação por Busca**: Ao pesquisar um Pokémon específico, navegue pelos adjacentes
- **Informações Detalhadas**: Veja stats, tipos, peso, altura e experiência base

## 🗂️ Estrutura do Projeto

```
app/
├── Http/Controllers/
│   └── PokemonController.php    # Controller principal
routes/
├── web.php                      # Rotas da aplicação
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php       # Layout base
│   └── pokemons/
│       └── index.blade.php     # View principal da Pokédex
```

## 🔧 Principais Rotas

- `GET /` - Página inicial (redirecionamento)
- `GET /pokemons` - Listagem de Pokémons com paginação
- `GET /pokemons?search={nome}` - Busca por Pokémon específico
- `GET /pokemons-autocomplete` - API de autocomplete
- `GET /pokemons/{name}` - Detalhes de um Pokémon específico

## 🎨 Customização

### Cores dos Tipos
As cores dos tipos de Pokémon podem ser personalizadas no CSS:

```css
.fire { background: linear-gradient(45deg, #ff6b6b, #ff8e8e); }
.water { background: linear-gradient(45deg, #4ecdc4, #45b7d1); }
.grass { background: linear-gradient(45deg, #6bcf7f, #57d167); }
/* ... outros tipos */
```

### Animações
Personalize as animações das estrelas e transições modificando os keyframes CSS.

## 🤝 Contribuindo

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-funcionalidade`)
3. Commit suas mudanças (`git commit -am 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/nova-funcionalidade`)
5. Abra um Pull Request

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 🙏 Agradecimentos

- **[PokeAPI](https://pokeapi.co/)** - Pela API gratuita e completa
- **[Laravel](https://laravel.com/)** - Framework PHP elegante e poderoso
- **Nintendo/Game Freak** - Pelos sprites e conceitos Pokémon

## 📞 Contato

Se você tiver alguma dúvida ou sugestão, sinta-se à vontade para abrir uma issue ou entrar em contato.

---

<p align="center">
  <strong>Feito com ❤️ e Laravel</strong>
</p>
