@if (auth()->user()->user_role_id == 3)
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Become a Lecturer') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('As a lecturer, you will have the opportunity to share your knowledge and expertise with students.') }}
        </p>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('You can inspire and guide the next generation of professionals.') }}
        </p>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Click the button below to change your role to lecturer.') }}
        </p>
    </header>

    <div class="mt-6">
        <form method="post" action="{{ route('role.change') }}">
            @csrf
            <x-primary-button>{{ __('Change Role') }}</x-primary-button>
        </form>
    </div>
</section>
@elseif (auth()->user()->user_role_id == 2)
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Become a Student') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('As a student, you will have the opportunity to learn from the best lecturers.') }}
        </p>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('You can gain knowledge and skills that will help you succeed in your career.') }}
        </p>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Click the button below to change your role to student.') }}
        </p>
    </header>

    <div class="mt-6">
        <form method="post" action="{{ route('role.change') }}">
            @csrf
            <x-primary-button>{{ __('Change Role') }}</x-primary-button>
        </form>
    </div>
    @endif