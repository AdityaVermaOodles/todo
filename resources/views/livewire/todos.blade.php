<div class="space-y-8 text-gray-600 mb-8">
    <h2 class="bg-violet-300 text-violet-900 text-2xl py-3 text-center">Todo</h2>
    @if(session('success'))
    <div class="text-center text-xs text-green-700">
        <p wire:poll.2000ms="clearFlashMessage">{{ session('success') }}</p>
    </div>
    @endif
    <form class="w-2/5 p-4 mx-auto bg-gray-100 rounded-xl space-y-4 text-sm">
        <h3 class="text-center text-violet-700 uppercase">Create new</h3>
        <div class="flex flex-col space-y-2">
            <label for="title"><i class="fa-solid fa-hand-pointer"></i> Todo</label>
            <input wire:model="title" type="text" class="border rounded-sm p-1 outline-0" placeholder="Enter todo . . .">
        </div>
        @error('title')
        <p class="text-xs text-red-500">{{ $message }}</p>
        @enderror
        <div class="text-center">
            <button wire:click.prevent="addTodo" class="bg-violet-400 hover:bg-violet-500 text-white px-6 py-1 rounded">Add</button>
        </div>
    </form>

    <hr>

    <div class="w-2/5 mx-auto space-y-4 text-sm">
        <h3 class="text-violet-900 text-lg font-bold text-center uppercase">My Todos</h3>
        @if(session('successDanger'))
        <div class="text-center text-xs text-red-700">
            <p wire:poll.2000ms="clearFlashMessage">{{ session('successDanger') }}</p>
        </div>
        @endif
        @if(session('successUpdate'))
        <div class="text-center text-xs text-green-700">
            <p wire:poll.2000ms="clearFlashMessage">{{ session('successUpdate') }}</p>
        </div>
        @endif
        @if(session('successToggleComplete'))
        <div class="text-center text-xs text-green-700">
            <p wire:poll.2000ms="clearFlashMessage">{{ session('successToggleComplete') }}</p>
        </div>
        @endif
        @if(session('successToggleIncomplete'))
        <div class="text-center text-xs text-red-700">
            <p wire:poll.2000ms="clearFlashMessage">{{ session('successToggleIncomplete') }}</p>
        </div>
        @endif
        <div class="flex w-full">
            <input wire:model.live.debounce.500ms="search" type="text" class="border w-11/12 p-1 px-3 rounded-l outline-0" placeholder="search . . .">
            <i class="fa-solid fa-magnifying-glass w-1/12 bg-violet-100 flex justify-center items-center rounded-r"></i>
        </div>
        @if(count($todos))
        @foreach($todos as $todo)
        <div class="border p-3 rounded-sm flex justify-between shadow-lg">
            <div class="space-y-2">
                <div class="flex items-start gap-3">
                    @if($todo->completed)
                    <input wire:click="toggleCompleted({{ $todo->id }})" type="checkbox" class="cursor-pointer mt-1" checked>
                    @else
                    <input wire:click="toggleCompleted({{ $todo->id }})" type="checkbox" class="cursor-pointer mt-1">
                    @endif

                    @if($editId === $todo->id)
                    <div class="space-y-3 mb-3">
                        <input wire:model="editTitle" type="text" class="outline-0 border rounded-sm p-1">
                        <div>
                            <a wire:click="update" class="bg-green-400 hover:bg-green-500 text-white px-5 py-1 rounded cursor-pointer">Update</a>
                            <a wire:click="cancelUpdate" class="bg-red-400 hover:bg-red-500 text-white px-5 py-1 rounded cursor-pointer">Cancel</a>
                        </div>
                    </div>
                    @else
                    <p>{{ $todo->title }}</p>
                    @endif
                </div>
                <p class="text-xs text-gray-400">{{ $todo->created_at }}</p>
            </div>
            <div class="space-x-2 flex items-end">
                <a wire:click="updateTodo({{ $todo->id }})"><i class="fa-regular fa-pen-to-square text-blue-500 hover:text-blue-600 cursor-pointer"></i></a>
                <span>|</span>
                <a wire:click="deleteTodo({{ $todo->id }})"><i class="fa-solid fa-trash text-red-500 hover:text-red-600 cursor-pointer"></i></a>
            </div>
        </div>
        @endforeach
        @else
        <div class="border p-3 rounded-sm flex justify-center shadow-lg text-red-600">
            <p>No todos found!</p>
        </div>
        @endif
        <div class="pagination">
            {{ $todos->links() }}
        </div>
    </div>
</div>
