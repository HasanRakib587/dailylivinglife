<div>
  <!-- Main Content -->
  <section>
    <div class="container">
      <div class="row g-5">
        <div class="col-md-8">

          <!-- Latest Articles -->
          <section>
            @foreach ($latestPosts as $post)
              <!-- Latest Articles 1 -->
              <div class="card border-0 my-5" wire:key='{{ $post->id }}'>
                <img src="{{ asset('uploads/'. $post->cover_image) }}" class="card-img-top rounded-0"
                  alt="{{ $post->title }}" />
                <div class="card-body text-center">
                  <div class="creation-date my-2">
                    <span class="small px-1">{{ $post->created_at->format('F j, Y') }}</span>
                    <span class="d-inline-block bg-danger rounded-circle" style="width: 10px; height: 10px"></span>
                    <span class="small px-1">Safiul Manowar</span>
                  </div>
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <div class="card-text post-content">
                    {{-- {!! Str::limit($post->content, 79) !!} --}}
                    {{ Str::limit(strip_tags($post->content), 79) }}
                  </div>
                </div>
                <div class="card-body custom-card-body">
                  <a wire:navigate href="{{ route('post.single', $post->slug) }}"
                    class="card-link btn btn-outline-danger rounded-0">Continue Reading</a>
                  <a href="#" class="card-link text-decoration-none text-black"><span
                      class="text-danger">{{ count($post->comments) }}</span> Comments</a>
                </div>
              </div>
            @endforeach
            <hr class="text-dark" />
          </section>

          <!-- Older Posts -->
          <section>
            <div class="row">
              @foreach ($olderPosts as $post)
                <!-- Older Post 1 -->
                <div class="col-md-6 my-5" wire:key='{{ $post->id }}'>
                  <div class="card rounded-0 border-0 text-center">
                    <img src="{{ Storage::url($post->long_image) }}" class="card-img-top" alt="{{ $post->title }}" />
                    <div class="card-body">
                      <h5 class="card-title">{{ $post->title }}</h5>
                      <p class="card-text">
                        {!! Str::limit($post->content, 79) !!}
                      </p>
                      <a href="#" class="text-decoration-none">
                        <span class="text-danger">{{ count($post->comments) }}</span> comments
                      </a>
                    </div>
                  </div>
                </div>
              @endforeach
              @if ($olderPosts->isNotEmpty())
                <div class="load my-5 py-5 text-center">
                  <a class="btn btn-outline-danger rounded-0" href="">Load Previous articles</a>
                </div>
              @endif
            </div>
          </section>

        </div>
        <div class="col-md-4">

          <!-- Author Info -->
          <livewire:components.author-info />

          <!-- Big Salad -->
          <div class="big-salad text-center" style="margin-top: 70vh">
            <livewire:components.sidebar />
          </div>
          {{-- @if ($featuredPosts->isNotEmpty())
          @endif --}}
        </div>
      </div>
    </div>
  </section>

  <!-- Archives -->
  @if ($archivedPosts->isNotEmpty())
    <section>
      <div class="container">
        <div class="row gap-5 justify-content-center">
          <h1 class="text-center my-5">From the archives</h1>
          @foreach ($archivedPosts as $post)
            <div class="col-md-3" wire:key='{{ $post->id }}'>
              <div class="card text-center rounded-0 border-0">
                <img src="{{ Storage::url($post->long_image) }}" class="card-img-top" alt="{{ $post->title }}" />
                <div class="card-body">
                  <h6>
                    <a class="text-decoration-none my-5" href="">{{ $post->category->name }}</a>
                  </h6>
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p class="card-text">
                    {!! Str::limit($post->content, 79) !!}
                  </p>
                  <a href="#" class="btn"><span class="text-danger">{{ count($post->comments) }}</span> comments</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
</div>