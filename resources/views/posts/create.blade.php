<x-app-layout>
    <div class="container">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create Post') }}
        </div>

        @php
            $error = '';
        @endphp
        @if($errors->any())
            @foreach($errors->all() as $er)
                @php
                    $error .= $er . '</br>';
                @endphp
            @endforeach
        @endif

        <!-- Session Status -->

        <input type="text" id="error" value="{{ $error }}" readonly hidden>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('post.create') }}">
            @csrf

            <!-- Title -->
            <div>
                <label for="title">{{ __('Title') }}</label>
                <input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus />
            </div>

            <!-- Description -->
            <div>
                <label for="description">{{ __('Description') }}</label>
                <textarea id="description" rows="10" class="block mt-1 w-full" name="description" required autofocus></textarea>
            </div>

            <!-- Groups -->
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="groups" name="groups[]" multiple>
                <option value="">Select Group</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->title}}</option>
                 @endforeach
            </select>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>


<script>
    $(document).ready(function() {
        if ($('#error').val() != '') {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: $('#error').val(),
                showConfirmButton: false,
                timer: 1500
            });
        }

        $('#groups').select2();
    });
</script>