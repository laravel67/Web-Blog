@php
use Illuminate\Support\Str;
@endphp
<div class="isolate bg-white">
    <div class="mt-10">
        <button type="button"
            class="block w-full rounded-md bg-indigo-600 px-4 py-2.5 text-center text-sm font-semibold text-white shadow hover:bg-indigo-500 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            onclick="toggleModal(true)">
            Tambah Komentar
        </button>
    </div>
</div>

@forelse ($comments as $comment)
<div class="flex items-start gap-4 mt-6">
    <!-- Avatar -->
    <div class="flex-shrink-0">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Str::limit($comment->name, 30)) }}&background=random&color=fff&bold=true"
            alt="{{ $comment->name }}" class="h-10 w-10 rounded-full object-cover border border-gray-300 shadow-sm" />
    </div>

    <!-- Komentar -->
    <div class="flex-1 bg-gray-50 rounded-lg px-4 py-3 shadow-sm">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h4 class="text-sm font-semibold text-gray-900">{{ $comment->name }}</h4>
            <span class="text-xs text-gray-500">
                {{ $comment->created_at->diffForHumans() }}
            </span>
        </div>

        <!-- Isi Komentar -->
        <p class="text-sm text-gray-800 whitespace-pre-line leading-relaxed mt-1">
            {{ $comment->content }}
        </p>
    </div>
</div>
@empty
<p class="text-sm text-gray-500 mt-4">Belum ada komentar 😌</p>
@endforelse
<div id="commentModal"
    class="fixed inset-0 z-[99] hidden items-center justify-center overflow-y-auto bg-gray-800/60 backdrop-blur-sm transition-opacity duration-300 ease-out"
    role="dialog" aria-modal="true" aria-labelledby="modal-title">

    <!-- Backdrop -->
    <div id="modalBackdrop" class="fixed inset-0 bg-gray-500/75 opacity-0 transition-opacity duration-300 ease-out"
        aria-hidden="true"></div>

    <!-- Modal Container -->
    <div class="relative z-10 w-full max-w-lg p-4 sm:my-12 mx-auto transform transition-all duration-300 ease-out scale-95 opacity-0 translate-y-4"
        id="modalContent">
        <div class="rounded-xl bg-white shadow-lg overflow-hidden">

            <!-- Modal Form -->
           <form action="{{ route('post.comment') }}" method="POST">
            @csrf
            <div class="px-6 py-5">
                <input type="hidden" name="post_id" id="post_id" value="{{ $id }}">
        
                <h3 class="text-lg font-bold text-gray-900 mb-4" id="modal-title">Tulis Komentar</h3>
        
                {{-- Input Nama --}}
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input name="name" id="name" class="w-full rounded-lg border px-3 py-2 mb-1 text-sm text-gray-800 placeholder-gray-400 
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none
                           @error('name') border-red-500 ring-red-300 ring-2 @enderror" placeholder="Nama..."
                    value="{{ old('name') }}" />
                @error('name')
                <p class="text-sm text-red-600 mb-4">{{ $message }}</p>
                @enderror
        
                {{-- Textarea Komentar --}}
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Komentar</label>
                <textarea name="content" id="content" rows="4" class="w-full rounded-lg border px-3 py-2 text-sm text-gray-800 placeholder-gray-400 
                           focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 focus:outline-none
                           @error('content') border-red-500 ring-red-300 ring-2 @enderror"
                    placeholder="Tulis sesuatu...">{{ old('content') }}</textarea>
                @error('content')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        
            {{-- Actions --}}
            <div class="flex justify-end gap-3 bg-gray-50 px-6 py-4">
                <button type="button"
                    class="inline-flex justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100"
                    onclick="toggleModal(false)">
                    Batal
                </button>
                <button type="submit"
                    class="inline-flex justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                    Kirim
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Script with Transition Control -->
@push('js')
<script>
    function toggleModal(show) {
    const modal = document.getElementById('commentModal');
    const backdrop = document.getElementById('modalBackdrop');
    const content = document.getElementById('modalContent');

    if (show) {
      modal.classList.remove('hidden');
      requestAnimationFrame(() => {
        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');

        content.classList.remove('opacity-0', 'translate-y-4', 'scale-95');
        content.classList.add('opacity-100', 'translate-y-0', 'scale-100');
      });
    } else {
      backdrop.classList.remove('opacity-100');
      backdrop.classList.add('opacity-0');

      content.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
      content.classList.add('opacity-0', 'translate-y-4', 'scale-95');

      setTimeout(() => {
        modal.classList.add('hidden');
      }, 200); // match duration ease-in
    }
  }
</script>
@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function () {
        toggleModal(true);
    });
</script>
@endif
@endpush