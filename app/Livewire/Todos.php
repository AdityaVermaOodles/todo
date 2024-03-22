<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Todo;

class Todos extends Component
{
    #[Validate('required|min:5|max:100')]
    public $title;

    public $search;

    public $editId;

    #[Validate('required|min:5|max:100')]
    public $editTitle;

    public function clearFlashMessage()
    {
        $this->flashMessage = NULL;
    }

    public function addTodo()
    {
        $validated = $this->validateOnly('title');

        Todo::create($validated);

        $this->reset('title');

        session()->flash('success', "Task added successfully!");
    }

    public function toggleCompleted($todoId)
    {
        $todo = Todo::find($todoId);
        $todo->completed = !$todo->completed;
        $todo->save();

        if($todo->completed == 0)
        session()->flash('successToggleIncomplete', "Task marked incomplete!");
        else
        session()->flash('successToggleComplete', "Task marked complete!");
    }

    public function updateTodo($todoId)
    {
        $todo = Todo::find($todoId);
        $this->editId = $todoId;
        $this->editTitle = $todo->title;
    }

    public function update()
    {
        $this->validateOnly($this->editTitle);
        Todo::find($this->editId)->update([
            'title' => $this->editTitle,
        ]);

        $this->cancelUpdate();

        session()->flash('successUpdate', "Task updated successfully!");

    }

    public function cancelUpdate()
    {
        $this->reset('editId', 'editTitle');
    }

    public function deleteTodo($todoId)
    {
        Todo::find($todoId)->delete();

        session()->flash('successDanger', "Task deleted successfully!");
    }

    public function render()
    {
        $todo = Todo::where('title', 'like', "%{$this->search}%")->orderByDesc('created_at')->paginate(5);
        return view('livewire.todos', [
            'todos' => $todo,
        ]);
    }
}
