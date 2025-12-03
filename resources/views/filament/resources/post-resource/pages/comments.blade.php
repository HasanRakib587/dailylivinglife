<x-filament-panels::page>
<div class="bg-gray-50 min-h-screen py-10">
  <div class="flex flex-col gap-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
      <div class="text-lg font-semibold">
        Comments <span class="text-gray-500 text-base">({{ $post->comments->count() }})</span>
      </div>
    </div>

    <!-- Comments Card -->
    <div class="bg-white shadow-md rounded-xl p-6">
      <div class="space-y-6">
        @forelse ($post->comments as $comment)
          <div class="flex items-start space-x-6">
            <img
              src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp"
              alt="avatar"
              class="w-16 h-16 rounded-full shadow-md"
            />

            <div class="flex-1 mx-1 px-1 p-3">
              <div class="flex justify-between items-center">
                <p class="font-medium text-gray-800">
                  {{ $comment->name }}
                  <span class="text-sm text-gray-500">- {{ $comment->created_at->diffForHumans() }}</span>
                </p>
                <button
                  wire:click="deleteComment({{ $comment->id }})"
                  onclick="confirm('Are you sure you want to delete this comment?') || event.stopImmediatePropagation()"
                  class="text-red-500 hover:text-red-700 my-3"
                >Delete</button>
              </div>

              <p class="text-sm text-gray-600 mt-1">{!! $comment->comment !!}</p>

              <button
                wire:click="startReply({{ $comment->id }})"
                class="inline-block text-blue-600 hover:text-blue-800 mt-3"
              >Reply</button>

              @if($replyingTo === $comment->id)
                <div class="mt-3 space-y-2">
                  <textarea wire:model="replyText" class="w-full border rounded p-2" rows="2" placeholder="Write your reply..."></textarea>
                  <div class="flex gap-2">
                    <button wire:click="submitReply" class="px-3 py-1 bg-gray-300 rounded">Post Reply</button>
                    <button wire:click="cancelReply" class="px-3 py-1 bg-gray-300 rounded">Cancel</button>
                  </div>
                </div>
              @endif

              <hr class="my-2"/>

              @foreach ($comment->replies as $reply)
                <div class="flex items-start space-x-4 mt-6">
                  <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp"
                    alt="avatar"
                    class="w-16 h-16 rounded-full shadow-md"
                  />
                  <div class="flex-1">
                    <div class="flex justify-between items-center">
                      <p class="font-medium text-gray-800 px-2">
                        {!! $reply->name !!}
                        <span class="text-sm text-gray-500">- {{ $reply->created_at->diffForHumans() }}</span>
                      </p>
                      <button
                         wire:click="deleteReply({{ $reply->id }})"
                        onclick="confirm('Are you sure you want to delete this reply?') || event.stopImmediatePropagation()"
                        class="text-red-500 hover:text-red-700 my-5"
                      >Delete</button>
                    </div>
                    <p class="text-sm text-gray-600 mt-1 px-2">{!! $reply->reply !!}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @empty
          <h2>There are No Comments!</h2>
        @endforelse
      </div>
    </div>
  </div>
</div>
</x-filament-panels::page>
