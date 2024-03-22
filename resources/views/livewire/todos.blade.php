<div class="space-y-8 text-gray-600">
    <h2 class="bg-violet-300 text-violet-900 text-2xl py-3 text-center">Todo</h2>
    <form class="w-2/5 p-4 mx-auto bg-gray-100 rounded-xl space-y-4 text-sm">
        <h3 class="text-center text-violet-700 uppercase">Create new</h3>
        <div class="flex flex-col space-y-2">
            <label for="title"><i class="fa-solid fa-hand-pointer"></i> Todo</label>
            <input wire:model="title" type="text" class="border rounded-sm p-1 outline-0" placeholder="Enter todo . . .">
        </div>
        @error('title')
        <p class="text-xs text-red-500">Error</p>
        @enderror
        <div class="text-center">
            <button class="bg-violet-400 hover:bg-violet-500 text-white px-6 py-1 rounded">Add</button>
        </div>
    </form>

    <hr>

    <div class="w-2/5 mx-auto space-y-4">
        <h3 class="text-violet-900 text-lg font-bold py-3 text-center uppercase">My Todos</h3>
        <div class="flex w-full">
            <input wire:model="search" type="text" class="border w-11/12 p-1 px-3 rounded-l outline-0" placeholder="search . . .">
            <i class="fa-solid fa-magnifying-glass w-1/12 bg-violet-100 flex justify-center items-center rounded-r"></i>
        </div>
        <div class="border p-3 rounded-sm flex justify-between shadow-lg">
            <div class="space-y-2">
                <div class="flex gap-3">
                    <input type="checkbox" name="" id="" class="cursor-pointer">
                    <p>Title</p>
                </div>
                <p class="text-xs text-gray-400">Created at</p>
            </div>
            <div class="space-x-2">
                <a><i class="fa-regular fa-pen-to-square text-blue-500 hover:text-blue-600 cursor-pointer"></i></a>
                <span>|</span>
                <a><i class="fa-solid fa-trash text-red-500 hover:text-red-600 cursor-pointer"></i></a>
            </div>
        </div>
    </div>
</div>
