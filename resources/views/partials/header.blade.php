<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="{{ route('home') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none fs-4 me-3">
          Logo
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="{{ route('home') }}" class="nav-link px-2 text-white">Главная</a></li>
          <li><a href="{{ route('articles.index') }}" class="nav-link px-2 text-warning">Читать блог</a></li>
          <li><a href="{{ route('feedback.create') }}" class="nav-link px-2 text-white">Контакты</a></li>
          <li><a href="{{ route('feedback.index') }}" class="nav-link px-2 text-secondary">Отзывы</a></li>
        </ul>
      </div>
    </div>
</header>