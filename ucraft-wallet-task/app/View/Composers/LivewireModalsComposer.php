<?php

namespace App\View\Composers;

use App\Common\FlowProgressTracker;
use App\Common\FlowProgressTypes;
use App\Http\Livewire\Modals\ApproveNameModal;
use App\Http\Livewire\Modals\VerifyEmailAfterFillingEmailModal;
use App\Http\Livewire\Modals\FillEmailModal;
use App\Http\Livewire\Modals\FillProfilePromptForLegacyUsersModal;
use App\Http\Livewire\Modals\FillProfilePromptModal;
use App\Http\Livewire\Modals\SubscribeToNewsletterModal;
use App\Http\Livewire\Modals\VerifyEmailAfterStandardRegistrationModal;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LivewireModalsComposer
{
    public function __construct(private FlowProgressTracker $flowProgressTracker) {}

    public function compose(View $view): void
    {
        if ($modal = $this->getLivewireModalName()) {
            $view->with('openLivewireModal', $modal);
        }
    }

    private function getLivewireModalName(): ?string
    {
        // 0. Check if we have orders to open a modal in the query params.
        if ($modalName = request()->query('open-modal')) {
            return $modalName;
        }

        $user = Auth::user();

        if (!$user) {
            return null;
        }

        // 1. Make sure user has an email.
        if (!$user->email) {
            return FillEmailModal::getName();
        }

        // 2. Make sure it has been verified.
        if (!$user->hasVerifiedEmail()) {
            if ($this->flowProgressTracker->userDid(FlowProgressTypes::EMAIL_VERIFICATION_SENT_AFTER_FILLING_EMAIL)) {
                return VerifyEmailAfterFillingEmailModal::getName();
            }

            return VerifyEmailAfterStandardRegistrationModal::getName();
        }


        return null;
    }
}
