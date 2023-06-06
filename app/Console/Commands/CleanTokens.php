<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Token;
use Illuminate\Console\Command;

class CleanTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean Otp database, remove all old otps that is expired or used';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $otp = Token::all();
            $now = Carbon::now()->timestamp;
            $del =  $otp->filter(function ($item, $key) use ($now) {
                $validityAccess = $item->updated_at->addMinutes($item->validity)->timestamp;
                return !$item->valid || $validityAccess < $now;
            })->pluck('id');

            $this->info("Found {$del->count()} expired otps.");
            Token::whereIn('id', $del)->delete();
            $this->info("expired tokens deleted");
        } catch (\Exception $e) {
            $this->error("Error:: {$e->getMessage()}");
        }

        return 0;
    }
}
