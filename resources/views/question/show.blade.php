<x-app-layout>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415 7.067 14.348a1 1 0 11-1.415-1.415l2.933-2.933L5.652 7.067a1 1 0 011.415-1.415L10 8.585l2.933-2.933a1 1 0 011.415 1.415L11.415 10l2.933 2.933a1 1 0 010 1.415z" />
                </svg>
            </span>
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <path
                        d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415 7.067 14.348a1 1 0 11-1.415-1.415l2.933-2.933L5.652 7.067a1 1 0 011.415-1.415L10 8.585l2.933-2.933a1 1 0 011.415 1.415L11.415 10l2.933 2.933a1 1 0 010 1.415z" />
                </svg>
            </span>
        </div>
    @endif

    <div class="container mx-auto max-w-4xl py-8 px-6 contain-content">
        <!-- Header bo'limi -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Savollar ro'yxati</h1>
            <a href="{{ route('question.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded">
                Savol qo'shish
            </a>
        </div>

        <!-- Savollar ro'yxati -->
        <div class="bg-white shadow-md rounded-lg mb-6 p-6">
            <div>
                <!-- Savol sarlavhasi -->
                <h2 class="text-lg font-semibold text-gray-800 mb-2">
                    <a href="{{ route('question.show', $question->id) }}" class="hover:text-blue-600 transition">
                        {{ $question->title }}
                    </a>
                </h2>
                <!-- Savol sarlavhasi ostiga o'chirish tugmasi -->
                @if (auth()->id() === $question->user_id || auth()->user()->hasRole('admin'))
                    <form action="{{ route('question.destroy', $question->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2 px-4 rounded">
                            Savolni o'chirish
                        </button>
                    </form>
                @endif

                <!-- Savol haqida ma'lumot -->
                <p class="text-sm text-gray-600 mb-4">
                    Muallif: <span
                        class="font-medium text-gray-800">{{ $question->user ? $question->user->name : 'Noma’lum foydalanuvchi' }}</span>
                    <span>• {{ $question->created_at->diffForHumans() }}</span>
                </p>

                <!-- Savol tavsifi -->
                <p class="text-gray-700 mb-4">
                    {{ $question->description }}
                </p>
            </div>

            <!-- Javoblar bo'limi -->
            <div class="border-t border-gray-200 mt-4 pt-4">
                <h3 class="text-md font-semibold text-gray-800 mb-4">Javoblar:</h3>
                @forelse ($question->answers as $answer)
                    <div class="bg-gray-100 rounded-lg p-4 mb-3">
                        <p class="text-gray-700">{{ $answer->content }}</p>
                        <p class="text-sm text-gray-500 mt-2">Muallif: <span
                                class="font-medium">{{ $answer->user->name }}</span> •
                            {{ $answer->created_at->diffForHumans() }}</p>
                        @if (auth()->id() === $answer->user_id || auth()->user()->hasRole('admin'))
                            <form action="{{ route('answer.destroy', $answer->id) }}" method="POST" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-2 px-4 rounded">
                                    Javobni o'chirish
                                </button>
                            </form>
                        @endif
                    </div>

                @empty
                    <p class="text-gray-600">Hozircha javoblar yo'q. Birinchi bo'lib javob bering!</p>
                @endforelse
            </div>

            <!-- Javob qo'shish formasi -->
            <div class="mt-4">
                <form action="{{ route('answer.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                    <div class="mb-4">
                        <label for="content-{{ $question->id }}"
                            class="block text-sm font-medium text-gray-700">Javobingiz</label>
                        <textarea id="content-{{ $question->id }}" name="content" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            placeholder="Javobingizni yozing..." required></textarea>
                    </div>
                    <button type="submit"
                        class="font-bold py-2 px-6 rounded-lg shadow-md hover:shadow-lg transition transform hover:-translate-y-1"
                        style="background-color: #4f46e5; color: white;">
                        Javobni yuborish
                    </button>


                </form>
            </div>
        </div>
    </div>
</x-app-layout>
