<x-app-layout>
    <div class="container">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Edit Post') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('post.update', ['postid' => $post->first()->id]) }}">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div>
                <label for="title">{{ __('Title') }}</label>
                <input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $post->first()->title }}" required autofocus />
            </div>

            <!-- Description -->
            <div>
                <label for="description">{{ __('Description') }}</label>
                <textarea id="description" rows="10" class="block mt-1 w-full" name="description" value="{{ $post->first()->description }}" required autofocus></textarea>
            </div>

            <!-- Groups -->
            <div>
                <label for="groups">{{ __('Groups') }}</label>
                <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="groups" name="groups[]" multiple>
                    <option value="">Select Group</option>
                    @foreach($groups as $group)
                    <option value="{{ $group->id }}" {{ $post->groups->contains($group->id) ? 'selected' : '' }}>{{ $group->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">
                    {{ __('Submit') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#groups').select2();
        });
    </script>
@endpush
