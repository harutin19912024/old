<?php

namespace App\Common;

use App\Mail\InstitutionRepresentativeEnquiryMail;
use App\Models\InstitutionRepresentativeEnquiry;
use Mail;

class Mailer
{
    public function __construct(private ConfigHelper $configHelper) {}

    public function sendInstitutionRepresentativeEnquiry(InstitutionRepresentativeEnquiry $enquiry): void
    {
        $userData = $enquiry->user->userData;
        $institution = $userData->institution;

        $catchall = $this->configHelper->getInstitutionRepresentativeCatchallEmails();
        $recipients = $catchall->isNotEmpty() ? $catchall : collect([$institution->email]);

        foreach ($recipients as $recipient) {
            Mail::to($recipient)->send(new InstitutionRepresentativeEnquiryMail($enquiry));
        }

        $enquiry->update([
            'sent_to' => $recipients,
            'sent_at' => now(),
        ]);
    }
}
