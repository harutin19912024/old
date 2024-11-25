<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Deal;
use Mail;
use DB;


class SendMailDueDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send_mail_for_due_dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Agent reminder every day that smth is due starting 3 days before due date (all except for the Offer date)';

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
		
		$deals = Deal::where(function($query){
					$query->whereNotNull('inspection_date');
					$query->where(DB::raw("DATEDIFF(inspection_date,NOW())"), "<=", 3);
				})
				->orWhere(function($query){
					$query->whereNotNull('pns_date');
					$query->where(DB::raw("DATEDIFF(pns_date,NOW())"), "<=", 3);
				})
				->orWhere(function($query){
					$query->whereNotNull('mortage_contingency_date');
					$query->where(DB::raw("DATEDIFF(mortage_contingency_date,NOW())"), "<=", 3);
				})
				->get();
				
		foreach($deals as $deal)
		{
			if(!$deal->user_id || !$deal->user || !$deal->user->email)
				continue;
			
			$message = env('APP_URL') . '/deals/' . $deal->id . '/edit' . ' one of deal dates will expire soon';
			$to = $deal->user->email;
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
