<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Deal;
use Mail;
use DB;

class SendMailOneDayBefore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_mail_one_day_before';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'a.	For Inspection, PnS, Mortgage Contingency and Closing Dates – email to all parties on the deal (except for client type) stating that we are requesting an extension for 24 hours of Inspection or Mortgage or Closing Contingency) ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $subject = 'due dates notification';
        $from_address = env('MAIL_ADDRESS_FROM');

		$deals = Deal::where(function($t){
					$t->where(function($query){
							$query->whereNotNull('inspection_date');
							$query->where(DB::raw("TIMESTAMPDIFF(HOUR,inspection_date,NOW())"), "=", 24);
						})
						->orWhere(function($query){
							$query->whereNotNull('pns_date');
							$query->where(DB::raw("TIMESTAMPDIFF(HOUR,pns_date,NOW())"), "=", 24);
						})
						->orWhere(function($query){
							$query->whereNotNull('mortage_contingency_date');
							$query->where(DB::raw("TIMESTAMPDIFF(HOUR,mortage_contingency_date,NOW())"), "=", 24);
						});
				})
				->whereHas('deal_parties', function($q) {
					$q->whereNotNull('email');
				})
				->get();
				
		foreach($deals as $deal)
		{
			foreach($deal->deal_parties as $deal_party)
			{
				$message = env('APP_URL') . '/deals/' . $deal->id . '/edit' . ' one of deal dates will expire in 24 hours';
				$to = $deal_party->email;
				try {
					Mail::raw($message, function($message) use($subject, $to, $from_address)
					{
						$message->from($from_address, 'New Message');
						$message->to($to)->subject($subject);
					});
				}
				catch (\Exception $e){
					
				}
			}
		}
    }
}
