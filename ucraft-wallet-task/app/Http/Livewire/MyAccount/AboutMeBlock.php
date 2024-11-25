<?php

namespace App\Http\Livewire\MyAccount;

use App\Forms\Components\NoticeField;
use App\Filament\Forms\Components\TextInputWithSearch;
use App\Models\UserData;
use App\Repositories\AdministrativeDutiesRepository;
use App\Repositories\AgeGroupsRepository;
use App\Repositories\EducationInstitutionsRepository;
use App\Repositories\TeachingSubjectsRepository;
use Closure;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Livewire\Component;

/** @property ComponentContainer $form */
class AboutMeBlock extends Component implements HasForms
{
    use InteractsWithForms;

    public function render(): View
    {
        return view('livewire.my-account.about-me-block');
    }

}
