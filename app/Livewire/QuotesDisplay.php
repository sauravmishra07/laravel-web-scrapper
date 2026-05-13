<?php

namespace App\Livewire;

use App\Models\Quote;
use Livewire\Component;

class QuotesDisplay extends Component
{
    public $quotes = [];
    public $searchTerm = '';
    public $sortBy = 'newest';

    public function mount()
    {
        $this->loadQuotes();
    }

    public function loadQuotes()
    {
        $query = Quote::query();

        // Search functionality
        if ($this->searchTerm) {
            $query->where('quote', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('author', 'like', '%' . $this->searchTerm . '%');
        }

        // Sort functionality
        if ($this->sortBy === 'newest') {
            $query->latest();
        } elseif ($this->sortBy === 'oldest') {
            $query->oldest();
        } elseif ($this->sortBy === 'author') {
            $query->orderBy('author', 'asc');
        }

        $this->quotes = $query->get();
    }

    public function refreshQuotes()
    {
        $this->loadQuotes();
    }

    public function deleteQuote($id)
    {
        Quote::find($id)->delete();
        $this->loadQuotes();
    }

    public function render()
    {
        return view('livewire.quotes-display');
    }
}
