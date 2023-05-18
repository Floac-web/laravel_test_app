<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use App\Models\ProductTranslation;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search;

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $perPage = 5;

    public $paginateOptions = ['5', '10', '15'];

    protected $listeners = ['deleted', '$refresh'];

    public function deleted()
    {
        $this->emit('deleted');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.admin.product.index', [
            'products' => Product::query()
            ->whereTranslationLike('title', "%$this->search%")
            // whereHas('translations', function ($query) {
            //     $query->where('title', 'like', '%' . $this->search . '%');
            // })
                ->when($this->sortField === 'title', function ($query) {
                    $query->orderByTranslation('title', $this->sortDirection);
                    // $query->orderBy(
                    //     ProductTranslation::select('title')
                    //         ->whereColumn('products.id', 'product_translations.product_id')
                    //         ->where('product_translations.locale', config('app.locale')),
                    //     $this->sortDirection
                    //     );
                })
                ->when($this->sortField === 'id' || $this->sortField === 'status', function ($query) {
                    $query->orderBy($this->sortField, $this->sortDirection);
                })
                ->with('translations', 'mainPhoto')
                ->paginate($this->perPage)
        ]);
    }
}
