<div>
  <!-- Main Content -->
  <section>
    <div class="container">
      <div class="row gx-5 d-flex justify-content-between">
        <div class="col-md-7">

          <!-- Latest Articles -->
          <section>
            @foreach ($latestPosts as $post)
              <!-- Latest Articles -->
              <div class="card border-0 my-5" wire:key='post-{{ $post->id }}'>
                <img src="{{ Storage::disk('r2')->url($post->cover_image) }}" class="card-img-top rounded-0"
                  alt="{{ $post->title }}" />
                <div class="card-body text-center">
                  <div class="creation-date my-2">
                    <span class="small px-1">{{ $post->published_at?->format('F j, Y') }}</span>
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
                    class="card-link btn btn-outline-secondary rounded-0">
                    Continue Reading
                  </a>
                  <a href="#" class="card-link text-decoration-none text-black"><span
                      class="text-secondary">{{ count($post->comments) }}</span> Comments</a>
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
                <div class="col-md-6 my-5" wire:key="{{ $post->id }}">
                  <a wire:navigate class="text-decoration-none text-secondary"
                    href="{{ route('post.single', $post->slug) }}">
                    <div class="card rounded-0 border-0 text-center">
                      <img src="{{ asset('uploads/' . $post->long_image) }}" class="img-fluid card-img-top"
                        alt="{{ $post->title }}" />
                      <div class="card-body d-flex flex-column align-items-center text-center">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                          {!! $post->meta_description !!}
                          {{-- {!! Str::limit($post->content, 79) !!} --}}
                        </p>
                        <p class="card-text">
                          <span class="text-danger fs-6">{{ $post->comments_count }}</span>
                          <span class="fs-6">comments</span>
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
              @endforeach
              @if ($olderPosts->count() >= $perPage * $page)
                <div class="load my-5 py-5 text-center">
                  <button wire:click="loadMoreOlderPosts" wire:loading.attr="disabled"
                    class="btn btn-outline-secondary rounded-0">
                    <span wire:loading.remove>Load Previous articles</span>
                    <span wire:loading>Loading...</span>
                  </button>
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
        </div>
      </div>
    </div>
  </section>
  <!-- Archives -->
  @if ($archivedPosts->isNotEmpty())
    <section>
      <div class="container">
        <div class="row gap-5 justify-content-center">
          <div class="col-md-12">
            <h1 class="text-center my-5">From the archives</h1>
          </div>
          @foreach ($archivedPosts as $post)
            <div class="col-md-3" wire:key="archived-{{ $post->id }}">
              <div class="card text-center rounded-0 border-0">
                <img src="{{ asset('uploads/' . $post->long_image) }}" class="card-img-top" alt="{{ $post->title }}" />
                <div class="card-body">
                  <h6>
                    <a class="text-decoration-none my-5 text-secondary"
                      href="{{ route('category.listing', $post->category->slug) }}">
                      {{ $post->category->name }}
                    </a>
                  </h6>

                  <h5 class="card-title">
                    <a class="text-decoration-none text-secondary" href="{{ route('post.single', $post->slug) }}">
                      {{ $post->title }}
                    </a>
                  </h5>

                  <p class="card-text">
                    {!! Str::limit($post->content, 79) !!}
                  </p>

                  <a href="{{ route('post.single', $post->slug) }}" class="btn">
                    <span class="text-danger">{{ count($post->comments) }}</span> comments
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif
</div>