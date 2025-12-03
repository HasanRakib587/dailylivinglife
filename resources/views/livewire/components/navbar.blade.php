<!-- Navabar -->
@php
    $leftCategories = $categories->take(4);
    $rightCategories = $categories->skip(4);
@endphp
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary position-relative">
      <div class="container">
        <!-- Hamburger -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarContent"
          aria-controls="navbarContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- ✅ One logo (we’ll center it responsively with CSS) -->
        <a class="navbar-brand fw-bold text-uppercase" href="#">Daily Living Life</a>

        <!-- Collapsible Menus -->
        <div
          class="collapse navbar-collapse justify-content-between"
          id="navbarContent"
        >
          <!-- Left Menu -->
          <ul class="navbar-nav">
            @foreach ($leftCategories as $category)
              <a class="d-block d-md-none text-decoration-none text-start" href=""
                >{{ $category->name }}</a
              >
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle d-none d-md-block"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  {{ $category->name }}
                </a>
                @if($category->children->isNotEmpty())
                  <ul class="dropdown-menu custom-dropdown">
                    @foreach($category->children as $child)
                      <li>
                        <a class="dropdown-item" href="{{ route('category.listing', $child->slug) }}">
                          {{ $child->name }}
                        </a>
                      </li>
                    @endforeach                    
                    <li><hr class="dropdown-divider d-block d-md-none" /></li>
                  </ul>
                @endif
              </li>              
            @endforeach            
          </ul>

          <!-- Right Menu -->
          <ul class="navbar-nav ms-auto">
            @foreach ($rightCategories as $category)
              <a class="d-block d-md-none text-decoration-none text-start" href="">
                  {{ $category->name }}
              </a>
              <li class="nav-item dropdown">
                  <a
                      class="nav-link dropdown-toggle d-none d-md-block"
                      href="#"
                      role="button"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                  >
                      {{ $category->name }}
                  </a>
                  @if($category->children->isNotEmpty())
                      <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                          @foreach($category->children as $child)
                              <li><a class="dropdown-item" href="#">{{ $child->name }}</a></li>
                          @endforeach
                          <li><hr class="dropdown-divider d-block d-md-none" /></li>
                      </ul>
                  @endif
              </li>
            @endforeach

            <!-- Static "About Me" dropdown -->
            <a class="d-block d-md-none text-decoration-none text-start" href=""
              >About Me</a
            >
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle d-none d-md-block"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                About Me
              </a>
              <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                <li><a class="dropdown-item" href="#">Contact</a></li>
                <li><a class="dropdown-item" href="#">Privacy Policy</a></li>
                <li>
                  <a class="dropdown-item" href="#">Terms & Condition</a>
                </li>
                <li><hr class="dropdown-divider d-block d-md-none" /></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
</header>